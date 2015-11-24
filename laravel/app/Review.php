<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Review extends Model
{
    protected $primary = ['user_id','prod_id'];
    static function createReview($product_id, $user_id, $review_text, $rating)
    {
        $review = new Review;
        $review->prod_id = $product_id;
        $review->user_id = $user_id;
        $review->review_text = $review_text;
        $review->overal_rating = $rating;

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

    static function getProductReviews($product_id, $limit=10)
    {
    	$datas = DB::table('reviews')
    			-> join('users', 'users.user_id', '=', 'reviews.user_id')
    			-> select('review_text', 'name', 'users.user_id')
    			-> where('prod_id', $product_id)
    			-> take($limit)
    			-> get();
    	return $datas;   			
    }
}
