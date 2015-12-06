<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Feature;

/**
 * Class FeatureController
 * Controls the rating, retrieval and creation of features
 * @package App\Http\Controllers
 */
class FeatureController extends Controller
{
    /**
     * Gets a list of features for a given product
     * @param $prod_id is the product ID
     * @return array of features for a given product
     */
	public function getFeatures($prod_id)
	{
		return Feature::getFeatures($prod_id);
	}

    /**
     * Rates a feature for a given product
     * @param Request $request is the request POSTed
     */
	public function rate (Request $request)
	{
        // get all data from POST request needed to make rating
		$user_id 	= $request->input('user_id');
		$prod_id 	= $request->input('prod_id');
		$feature_id = $request->input('feature_id');
		$rating 	= $request->input('rating');

        // rate feature
		Feature::rate($user_id, $prod_id, $feature_id, $rating);
	}

    /**
     * Links a feature to a product
     * @param Request $request is the request POSTed
     */
	public function createProductFeature(Request $request)
	{
        // get all data from POST request need to tie feature to product
		$prod_id	= $request->input('prod_id');
		$feature_id	= $request->input('feature_id');
        // tie feature to product
		Feature::createProductFeature($prod_id, $feature_id);
	}

}