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


    // Get feature names and scores
    public static function getFeatures ($prod_id)
    {
        $count = DB::table('feature_rating_totals')
            ->join('features', 'features.feature_id' , '=', 'feature_rating_totals.feature_id')
            ->select(['feature_name', 'score', 'total_votes'])
            ->where('prod_id', '=', $prod_id)
            ->count();

        if($count == 0)
            return;
        
        if($count <= 10)
        {
            $top = $count - floor($count/2);
            $bottom = floor($count/2);
            $pros = DB::table('feature_rating_totals')
                ->join('features', 'features.feature_id' , '=', 'feature_rating_totals.feature_id')
                ->select(['feature_name', 'score', 'total_votes'])
                ->where('prod_id', '=', $prod_id)
                ->orderBy('score', 'desc')
                ->take($top)
                ->get();

            $cons = DB::table('feature_rating_totals')
                ->join('features', 'features.feature_id' , '=', 'feature_rating_totals.feature_id')
                ->select(['feature_name', 'score', 'total_votes'])
                ->where('prod_id', '=', $prod_id)
                ->orderBy('score', 'desc')
                ->skip($top)
                ->take($bottom)
                ->get(); 
        }
        else 
        {
            $top = 5;
            $bottom = 5;
            $pros = DB::table('feature_rating_totals')
                ->join('features', 'features.feature_id' , '=', 'feature_rating_totals.feature_id')
                ->select(['feature_name', 'score', 'total_votes'])
                ->where('prod_id', '=', $prod_id)
                ->orderBy('score', 'desc')
                ->take($top)
                ->get();

            $cons = DB::table('feature_rating_totals')
                ->join('features', 'features.feature_id' , '=', 'feature_rating_totals.feature_id')
                ->select(['feature_name', 'score', 'total_votes'])
                ->where('prod_id', '=', $prod_id)
                ->orderBy('score')
                ->take($bottom)
                ->get(); 
        }

        $result = array();
        $result['pros'] = $pros;
        $result['cons'] = $cons;
        return $result;
    }


    // Insert a new feature into the Feature table
    public static function createFeature($feature_name)
    {
		DB::table('features')
			-> insert([
				'feature_name' => $feature_name
			]);
    }

    // Insert a new row in feature_rating_totals
    //		which keeps track of a feature rating
    //		for a specific product
    public static function createProductFeature($prod_id, $feature_id) {
		$feature = new Feature_Rating_Total;
		$feature->prod_id = $prod_id;
		$feature->feature_id = $feature_id;
		$feature->score = 0;
		$feature->total_votes = 0;
		$feature->save();
    }


    // Allow a user to create or update a product feature
    //		$rating = a value that is either -1 OR 1 ONLY
    public static function rate ($user_id, $prod_id, $feature_id, $rating)
    {
        $rating = intval($rating);
    	if($rating == -1 || $rating = 1)
    	{
            // Check if user already voted on this feature
        	$score_inc = $rating;
        	$history = Feature_Rating::where([
    	    						"prod_id" 	 =>	$prod_id,
    	    						"user_id" 	 =>	$user_id,
    	    						"feature_id" => $feature_id])
        						      ->first();       	  

        	//	update old history
        	if($history)
        	{
        		$score_inc -= $history->rating; //erase old vote
                Feature_Rating::where([
                                    "prod_id"    => $prod_id,
                                    "user_id"    => $user_id,
                                    "feature_id" => $feature_id])
                                    ->update(['rating' => $rating]);		
        	}
        	else
        	{
        		$featRating = new Feature_Rating;
        		$featRating->user_id = $user_id;
        		$featRating->prod_id = $prod_id;
        		$featRating->feature_id = $feature_id;
        		$featRating->rating = $rating;
        		$featRating->save();
        	}

        	// Update totals
            $total_score = Feature_Rating_Total::where(['prod_id' => $prod_id, 'feature_id' => $feature_id])->first()->score + $score_inc;
            $total_votes = Feature_Rating_Total::where(['prod_id' => $prod_id, 'feature_id' => $feature_id])->first()->total_votes;

            if($history == null){
                $total_votes += 1;
            }

            Feature_Rating_Total::where(['prod_id' => $prod_id, 'feature_id' => $feature_id])
                ->update
                ([
                    'score'         => (int)$total_score,
                    'total_votes'   => (int)$total_votes
                ]);

            return "$total_score, $total_votes";
        }
        else 
            return $rating;
    } 
}
