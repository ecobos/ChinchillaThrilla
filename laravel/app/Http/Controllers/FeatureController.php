<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Feature;

class FeatureController extends Controller
{

	public function getFeatures($prod_id)
	{
		return Feature::getFeatures($prod_id);
	}

	// The handle for rating a Product Feature
	public function rate (Request $request)
	{
		$user_id 	= $request->input('user_id');
		$prod_id 	= $request->input('prod_id');
		$feature_id = $request->input('feature_id');
		$rating 	= $request->input('rating');
		var_dump( Feature::rate($user_id, $prod_id, $feature_id, $rating));
	}

	// Add a feature to a product
	public function createProductFeature(Request $request)
	{
		$prod_id	= $request->input('prod_id');
		$feature_id	= $request->input('feature_id');
		Feature::createProductFeature($prod_id, $feature_id);
		return "Should be new product feature";
	}

}