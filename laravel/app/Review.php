<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Review extends Model
{



    //protected $primaryKey = ['user_id','prod_id'];

    static function createReview($product_id, $user_id, $review_text)
    {
        $review = new Review;
        $review->prod_id = $product_id;
        $review->user_id = $user_id;
        $review->review_text = $review_text;
        $review->overall_rating = $overall_rating;
  		$review->save();
    }

    static function getOverallRating($product_id)
    {
        return DB::select('SELECT AVG(overal_rating) as rating, COUNT(overal_rating) as total FROM reviews where prod_id = ?', [$product_id])[0];
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

    public function product(){
        return $this->belongsTo('App\Product', 'prod_id', 'prod_id');
    }


}
