<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\Review;

use App\Feature;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/**
 * Class ReviewController
 * Controls the creation, deletion, updating, liking and flagging of reviews
 * @package App\Http\Controllers
 */
class ReviewController extends ApiGuardController
{
    // methods that don't need api key authentication
    // ADMIN permissions are set in middleware
    protected $apiMethods = [
        'createReviewWithAPIKey' => ['keyAuthentication' => false],
        'getProductReviews' => ['keyAuthentication' => false],
        'deleteReview' => ['keyAuthentication' => false],
        'moderateReview' => ['keyAuthentication' => false],
        'deleteUserReview' => ['keyAuthentication' => false]
    ];

    /**
     * ReviewController constructor. Gives Admin the ability to delete and moderate reviews
     */
    public function __construct()
    {
        $this->middleware('adminsOnly', ['only' => ['deleteUserReview', 'moderateReview']]);
    }

    /**
     * Get a user's reviews
     *
     * @param string $user_id the user ID
     * @return array a collection of a user reviews
     */
    public function getUserReviews($user_id)
    {
        //Note: this function also contains an implicit parameter "$limit"
        $data = Review::getUserReviews($user_id);
        return $data;
    }

    /**
     * Get product reviews, starting at the $skipTo marker
     *
     * @param string $product_id is the product ID
     * @param $skipTo number of review to skip between API calls
     * @return array of review data for a given product
     */
    public function getProductReviews($product_id, $skipTo)
    {
        //Note: this function also contains an implicit parameter "$limit"
        $data = Review::getProductReviews($product_id, $skipTo);
        return json_encode($data);
    }

    /**
     * Creates a review for a product. Developer access level
     * @param Request $request is the json request POSTed
     */
    public function createReview(Request $request)
    {
        // get needed data from request
        $product_id = $request->input('product_id');
        $user_id = $request->input('user_id');
        $review = $request->input('review_text');
        Review::createReview($product_id, $user_id, $review);
    }


    /**
     * Creates a review for a product and adds feature rated by user
     *
     * @param Request $request is the json request POSTed
     * @param string $prod_id is the product ID
     * @param string $api_key is the API key provided
     * @return Response if provided API key is invalid (HTTP code: 401)
     */
    public function createReviewWithAPIKey(Request $request, $prod_id, $api_key)
    {
        // check if authorized to POST 
        $match_key = ApiKey::where('key', $api_key)->first();
        // not authorized to POST 
        if (empty($match_key)) {
            return new Response('An invalid API key was provided with the API request', 401);
        }

        // check if user is logged in
        if (!Auth::check()) {
            // redirect user to login page if not logged in
            return Redirect::to('/auth/login')->with([
                'alert-type' => 'alert-danger',
                'status' => 'Please Login']);
        }

        $user_id = Auth::id(); // get logged in user's ID
        $overall_rating = intval($request->input('rating'));

        // check for valid rating
        if ($overall_rating < 0) {
            $overall_rating = 0;
        } else if ($overall_rating > 6) {
            $overall_rating = 6;
        }

        // get the comment about the product
        $review = $request->input('review_text');

        // get existing review for that product made by this user
        $exist_review = Review::where(['prod_id' => $prod_id,
            'user_id' => $user_id])->first();

        // check for all fields required fields
        if ($review == null || $overall_rating == null) {
            return Redirect::to('/submission_failed');

        }

        // if not review exist, create it
        if (empty($exist_review)) {
            Review::createReview($prod_id, $user_id, $review, $overall_rating);
        } else {
            // update previous review with new data
            Review::where(['prod_id' => $prod_id, 'user_id' => $user_id])
                ->update(['review_text' => $review, 'overal_rating' => $overall_rating]);
        }

        // get feature array from form
        $features = $request->input('features');

        if ($features != null) {
            foreach ($features as $feat_id => $value) {
                // rate feature using id, do not rate any unchecked features
                if (!is_null($value)) {
                    Feature::rate($user_id, $prod_id, $feat_id, intval($value));
                }
            }
        }

        // display updated or created review confirmation
        if (empty($exist_review)) {
            return Redirect::to('/products/' . $prod_id)->with([
                'alert-type' => 'alert-success',
                'status' => 'Review Successfully Created']);
        }
        return Redirect::to('/products/' . $prod_id)->with([
            'alert-type' => 'alert-success',
            'status' => 'Review Successfully Updated']);
    }

    /**
     * Deletes a specific review for a product created by the logged in user
     *
     * @param Request $request product associated with the review
     */
    public function deleteReview(Request $request)
    {
        $prod_id = $request->input('productID');
        Review::where('user_id', Auth::id())->where('prod_id', $prod_id)->delete();
    }

    /**
     * Gets the six star overall rating for a product
     * @param string $product_id the product ID
     */
    public function getOverallRating($product_id)
    {
        Review::getOverallRating($product_id);
    }

    /**
     * Moderate a review. Admin access level needed.
     *
     * @param Request $request is the json POST request
     */
    public function moderateReview(Request $request)
    {
        // get user and product IDs
        $user_id = $request->input('user_id');
        $prod_id = $request->input('prod_id');

        // approve review by changing needsAdminReview field to zero
        Review::where(['prod_id' => $prod_id, 'user_id' => $user_id])
            ->update(['needsAdminReview' => 0]);

    }

    /**
     * Delete a review. Admin access level needed.
     *
     * @param Request $request is the json request POSTed
     */
    public function deleteUserReview(Request $request)
    {
        // get user and product IDs
        $user_id = $request->input('user_id');
        $prod_id = $request->input('prod_id');

        // delete review
        Review::where(['prod_id' => $prod_id, 'user_id' => $user_id])->delete();
    }

    /**
     * Flag a review for admin review.
     *
     * @param Request $request is the json POST request
     */
    public function flagReview(Request $request)
    {
        // get user and product IDs
        $user_id = $request->input('user_id');
        $prod_id = $request->input('prod_id');

        // flag review by changing needsAdminReview field to 1
        Review::where(['prod_id' => $prod_id, 'user_id' => $user_id])->update(['needsAdminReview' => 1]);
    }

    /**
     * "like"/upvote a user's review for a product.
     *
     * @param Request $request is the json POST request
     */
    public function likeReview(Request $request)
    {
        // Get user ID of person upvoting the review
        $reviewer = $request->input('other_uid');

        // Get user ID of person who created the review
        $liker = $request->input('this_uid');

        // Get product ID of the product in reference
        $prod_id = $request->input('prod_id');

        // get review votes
        $result = DB::table('review_votes')->where(
            ['other_uid' => $reviewer,
                'this_uid' => $liker,
                'prod_id' => $prod_id,
            ])->first();

        // insert a 1 in database if first "like"/upvote was entered
        if (!$result) {
            DB::table('review_votes')->insert(
                ['other_uid' => $reviewer,
                    'this_uid' => $liker,
                    'prod_id' => $prod_id,
                    'vote' => 1
                ]);
        }
    }

    /**
     * Get the amount of useful reviews a user has made.
     *
     * @param Request $request is the json request POSTed
     * @return int amount of helpful reviews made by a given users
     */
    public function helpfulReviews(Request $request)
    {
        $user_id = $request->input('user_id');
        return Review::helpfulReviews($user_id);
    }

}
