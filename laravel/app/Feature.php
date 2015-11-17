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
    	if($rating != -1 || $rating != 1)
    		return;

    	// Check if user already voted on this feature
    	$score_inc = $rating;
    	$history = Feature_Rating::where([
	    						"prod_id" 	 =>	$prod_id,
	    						"user_id" 	 =>	$user_id,
	    						"feature_id" => $feature_id])
    						->first();
    	
    	//	update old history
    	if($history->count())
    	{
    		$score_inc -= $history->rating; //erase old   		
    		$history->rating = $rating;
    		$history->save();
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
    	$total = Feature_Rating_Total::where(['prod_id' => $prod_id, 'feature_id' => $feature_id])->first();
    	$total->score = $total->score + $total_inc;
    	$total->total_votes = ($history ? $total->total_votes : $total->total_votes+1);
    	$total->save();
    } 
}
