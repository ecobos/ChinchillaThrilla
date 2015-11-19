<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Review;

class ReviewController extends Controller
{

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

    public function createReview(Request $request)
    {
        $product_id = $request->input('product_id');
        $user_id = $request->input('user_id');
        $review = $request->input('review_text');
        Review::createReview($product_id, $user_id, $review);
    }

    public function getOverallRating($product_id)
    {
        var_dump(Review::getOverallRating($product_id));
    }

}
