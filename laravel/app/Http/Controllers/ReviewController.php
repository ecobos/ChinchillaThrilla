<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\Review;

class ReviewController extends ApiGuardController
{
    // methods that don't need api key authentication
    protected $apiMethods = [
        'createReviewWithAPIKey' => [
            'keyAuthentication' => false
        ],
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

    public function getProductReviews($product_id) 
    {
        //Note: this function also contains an implicit parameter "$limit"
        $data = Review::getProductReviews($product_id);
        return $data;
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
    public function createReviewWithAPIKey(Request $request, $api_key)
    {
        // check for empty fields client side
        $product_id = $request->input('product_id');
        $user_id = $request->input('user_id');
        $review = $request->input('review_text');
        Review::createReview($product_id, $user_id, $review);
    }

}
