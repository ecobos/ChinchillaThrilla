<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Review extends Model
{

    static function createReview($product_id, $user_id, $review_text)
    {
        $review = new Review;
        $review->prod_id = $product_id;
        $review->user_id = $user_id;
        $review->review_text = $review_text;

  		$review->save();
    }

    static function getUserReviews($user_id, $limit=10)
    {
        $datas = DB::table('reviews')
                -> join('users', 'users.user_id', '=', 'reviews.user_id')
                -> select('review_text', 'name')
                -> where('reviews.user_id', $user_id)
                -> take($limit)
                -> get();
        return $datas; 
    }

    static function getProductReviews($product_id, $skip)
    {
    	$datas = DB::table('reviews')
    			-> join('users', 'users.user_id', '=', 'reviews.user_id')
    			-> select('review_text', 'name', 'users.user_id', 'users.avatar')
    			-> where('prod_id', $product_id)
                -> skip($skip)
    			-> take(3)
    			-> get();
    	return $datas;   			
    }

}
