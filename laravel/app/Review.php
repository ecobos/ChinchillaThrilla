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

    static function getProductReviews($product_id, $limit=10)
    {
    	$datas = DB::table('reviews')
    			-> join('users', 'users.user_id', '=', 'reviews.user_id')
    			-> select('review_text', 'name')
    			-> where('prod_id', $product_id)
    			-> take($limit)
    			-> get();
    	return $datas;   			
    }
}
