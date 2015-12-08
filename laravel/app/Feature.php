<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Feature_Rating_Total;
use App\Feature_Rating;

class Feature extends Model
{
    // specifiy our primary key field
    protected $primaryKey = 'feature_id';


    /**
     *  Get the best and worst feature for a product
     *
     * @param string $prod_id the product we are looking for
     * @return array|void results of the query
     */
    public static function getFeatures($prod_id)
    {
        // Get the total number of feature ratings available for the specific product
        $count = DB::table('feature_rating_totals')
            ->join('features', 'features.feature_id', '=', 'feature_rating_totals.feature_id')
            ->select(['feature_name', 'score', 'total_votes'])
            ->where('prod_id', '=', $prod_id)
            ->count();

        // Product does not have features
        if ($count == 0) {
            return;
        }

        // Divide the results into manageable chunks
        if ($count <= 10) {
            $top = $count - floor($count / 2);
            $bottom = floor($count / 2);

            // Get the top feature with the highest rating scores
            $pros = DB::table('feature_rating_totals')
                ->join('features', 'features.feature_id', '=', 'feature_rating_totals.feature_id')
                ->select(['feature_name', 'score', 'total_votes'])
                ->where('prod_id', '=', $prod_id)
                ->orderBy('score', 'desc')
                ->take($top)
                ->get();

            // Get the top feature with the lowest rating scores
            $cons = DB::table('feature_rating_totals')
                ->join('features', 'features.feature_id', '=', 'feature_rating_totals.feature_id')
                ->select(['feature_name', 'score', 'total_votes'])
                ->where('prod_id', '=', $prod_id)
                ->orderBy('score', 'desc')
                ->skip($top)
                ->take($bottom)
                ->get();
        } // If more than 10 features only grab 5 worst and 5 best
        else {
            $top = 5;
            $bottom = 5;

            // Get the top feature with the highest rating scores
            $pros = DB::table('feature_rating_totals')
                ->join('features', 'features.feature_id', '=', 'feature_rating_totals.feature_id')
                ->select(['feature_name', 'score', 'total_votes'])
                ->where('prod_id', '=', $prod_id)
                ->orderBy('score', 'desc')
                ->take($top)
                ->get();

            // Get the top feature with the lowest rating scores
            $cons = DB::table('feature_rating_totals')
                ->join('features', 'features.feature_id', '=', 'feature_rating_totals.feature_id')
                ->select(['feature_name', 'score', 'total_votes'])
                ->where('prod_id', '=', $prod_id)
                ->orderBy('score')
                ->take($bottom)
                ->get();
        }

        // Divide into pros and cons
        $result = array();
        $result['pros'] = $pros;
        $result['cons'] = $cons;
        return $result;
    }


    /**
     * Create a new feature.
     *
     * @param string $feature_name the name of the feature
     */
    public static function createFeature($feature_name)
    {
        DB::table('features')->insert([
            'feature_name' => $feature_name
        ]);
    }

    /**
     * Create a product-feature association to be able to keep track of a
     *  rating associated with each product's features
     *
     * @param string $prod_id the product ID
     * @param string $feature_id the feature ID
     */
    public static function createProductFeature($prod_id, $feature_id)
    {
        $feature = new Feature_Rating_Total;
        $feature->prod_id = $prod_id;
        $feature->feature_id = $feature_id;

        // Set initialized values
        $feature->score = 0;
        $feature->total_votes = 0;

        // Commit the changes to the database
        $feature->save();
    }

    /**
     * Record a user's vote for a product's feature.
     *
     * @param string $user_id the user's ID
     * @param string $prod_id the product's ID
     * @param string $feature_id the feature's ID
     * @param string $rating the users rating for the feature
     */
    public static function rate($user_id, $prod_id, $feature_id, $rating)
    {
        $rating = intval($rating);
        if ($rating == -1 || $rating = 1) {
            // Check if user already voted on this feature
            $score_inc = $rating;
            $history = Feature_Rating::where([
                "prod_id" => $prod_id,
                "user_id" => $user_id,
                "feature_id" => $feature_id])
                ->first();

            //	Update old history
            if ($history) {
                $score_inc -= $history->rating; // Erase old vote
                Feature_Rating::where([
                    "prod_id" => $prod_id,
                    "user_id" => $user_id,
                    "feature_id" => $feature_id])
                    ->update(['rating' => $rating]);
            } // Create a new Feature_Rating
            else {
                $featRating = new Feature_Rating;
                $featRating->user_id = $user_id;
                $featRating->prod_id = $prod_id;
                $featRating->feature_id = $feature_id;
                $featRating->rating = $rating;

                // Commit the changes to the database
                $featRating->save();
            }

            // Update the feature's overall score
            $total_score = Feature_Rating_Total::where(['prod_id' => $prod_id, 'feature_id' => $feature_id])->first()->score + $score_inc;

            // Update the total number of votes
            $total_votes = Feature_Rating_Total::where(['prod_id' => $prod_id, 'feature_id' => $feature_id])->first()->total_votes;

            if ($history == null) {
                $total_votes += 1;
            }

            // Update the score of the Product Feature Total
            Feature_Rating_Total::where(['prod_id' => $prod_id, 'feature_id' => $feature_id])
                ->update
                ([
                    'score' => (int)$total_score,
                    'total_votes' => (int)$total_votes
                ]);

        }

    }

}

