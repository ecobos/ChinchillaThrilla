<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Review extends Model
{

    /**
     * Create a review for a product.
     *
     * @param string $product_id the product's ID
     * @param string $user_id the user's ID
     * @param string $review_text the review of the product
     * @param string $rating the given rating for the product
     */
    static function createReview($product_id, $user_id, $review_text, $rating)
    {
        $review = new Review;
        $review->prod_id = $product_id;
        $review->user_id = $user_id;
        $review->review_text = $review_text;
        $review->overal_rating = $rating;

        // Commit changes to the database
        $review->save();
    }

    /**
     * Get the average rating for a product.
     *
     * @param string $product_id the product's ID
     * @return int the average rating for the specified product
     */
    static function getOverallRating($product_id)
    {
        return DB::select('SELECT AVG(overal_rating) as rating, COUNT(overal_rating) as total FROM reviews where prod_id = ?', [$product_id])[0];
    }

    /**
     * Get some user reviews for a product
     *
     * @param string $user_id the user's ID
     * @param int $limit the max number of reviews to get. Default = 10.
     * @return mixed reviews for a product
     */
    static function getUserReviews($user_id, $limit = 10)
    {
        $userReviews = DB::table('reviews')
            ->join('users', 'users.user_id', '=', 'reviews.user_id')
            ->select('review_text', 'name')
            ->where('reviews.user_id', $user_id)
            ->take($limit)
            ->get();
        return $userReviews;
    }

    /**
     * Get the count of reviews for a product.
     *
     * @param string $product_id the product's ID
     * @return int count of reviews for the specified product
     */
    static function getProductReviewCount($product_id)
    {
        return DB::select('SELECT COUNT(review_text) as total FROM reviews where prod_id = ?', [$product_id])[0];
    }

    /**
     * Get product reviews starting at the specified "skipTo" start location
     *
     * @param string $product_id the product's ID
     * @param string $skipTo the start from location
     * @return array collection of result
     */
    static function getProductReviews($product_id, $skipTo)
    {
        $productReviews = DB::table('reviews')
            ->join('users', 'users.user_id', '=', 'reviews.user_id')
            ->select('review_text', 'name', 'users.user_id', 'users.avatar')
            ->where('prod_id', $product_id)
            ->skip($skipTo)
            ->take()
            ->get();
        return $productReviews;
    }

    /**
     * Get the count of helpful reviews that user has received.
     *
     * @param string $user_id the user's ID
     * @return int the number of helpful reviews from the user
     */
    static public function helpfulReviews($user_id)
    {
        return DB::select('SELECT SUM(vote) as total FROM review_votes where other_uid = ?', [$user_id])[0]->total;
    }

}
