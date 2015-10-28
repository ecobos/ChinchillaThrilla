<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Review;

class ReviewController extends Controller
{

    public function index()
    {
        return Redirect::to('/');
    }

    public function getProductReviews($product_id) 
    {
        return var_dump(Review::getProductReviews($product_id));
    }

    public function createReview(Request $request)
    {
        $product_id = $request->input('product_id');
        $user_id = $request->input('user_id');
        $review = $request->input('review_text');
        Review::createReview($product_id, $user_id, $review);
    }

}
