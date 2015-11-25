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

class ReviewController extends ApiGuardController
{
    // methods that don't need api key authentication
    protected $apiMethods = [
        'createReviewWithAPIKey' => [
            'keyAuthentication' => false
        ],
        'getProductReviews' => [
            'keyAuthentication' => false]
    ];

    public function index()
    {

        $users = DB::table('users')
                ->select('user_id', 'name')
                ->get();

        $products = DB::table('products')
                ->select('prod_name', 'prod_id')
                ->get();

        $data = 
        [   
            'users'     => $users,
            'products'  => $products
        ];

        return view('reviewtest')->with('data', $data);
    
        //UNCOMMENT AFTER TESTING 
        //return Redirect::to('/');
    }

    public function getUserReviews($user_id) 
    {
        //Note: this function also contains an implicit parameter "$limit"
        $data = Review::getUserReviews($user_id);
        return $data;
    }

    public function getProductReviews($product_id, $skip) 
    {
        //Note: this function also contains an implicit parameter "$limit"
        $data = Review::getProductReviews($product_id, $skip);
        return json_encode($data);
    }

    // Creates a review based on information received from POST request (Developer)
    public function createReview(Request $request)
    {
        // check for empty fields client side
        $product_id = $request->input('product_id');
        $user_id = $request->input('user_id');
        $review = $request->input('review_text');
        Review::createReview($product_id, $user_id, $review);
    }

    // Creates a review based on information received from POST request (non-Developer)
    // adds feature rated by user as well
    public function createReviewWithAPIKey(Request $request, $prod_id, $api_key)
    {
        // check for empty fields client side
       
        // check if authorized to POST 
        $match_key = ApiKey::where('key', $api_key)->first();
        // not authorized to POST 
        if (empty($match_key)) {
            return new Response('An invalid API key was provided with the API request', 401);
        }
       
        // check if user is logged in
        if(!Auth::check()) {
            // redirect user to home page if not logged in
            return Redirect::to('/');
        }

        $user_id = Auth::id(); // hardcoded for now
        $overall_rating = intval($request->input('rating'));

        // check for valid rating
        if($overall_rating < 0) {
            $overall_rating = 0; 
        }
        else if ($overall_rating > 6) {
            $overall_rating = 6; 
        }


        $exist_review = Review::where(['prod_id' => $prod_id,
                                        'user_id' => $user_id])->first();


        $review = $request->input('review_text');

        // check for all fields required fields, 
        if($review == null || $overall_rating == null) {
            return Redirect::to('/submission_failed');

        }

        if(empty($exist_review)) {
            Review::createReview($prod_id, $user_id, $review, $overall_rating);
        }
        else {
            print 'updating previous review';
            // update previous review with new data
            Review::where(['prod_id' => $prod_id, 'user_id' => $user_id])
                  ->update(['review_text'  => $review, 'overal_rating' => $overall_rating]);
        }

        // get feature array from form
        $features = $request->input('features');

        if($features != null) {
            foreach($features as $feat_id => $value) {
                // rate feature using id, check for empty
                //print $value; 
                if(!is_null($value)) {
                    print 'feat id: ' . $feat_id;
                    Feature::rate($user_id, $prod_id, $feat_id, intval($value));
                }
            }
        }

    }

    public function getOverallRating($product_id)
    {
        var_dump(Review::getOverallRating($product_id));
    }

}
