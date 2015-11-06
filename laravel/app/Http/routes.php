<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');

Route::group(['prefix' => 'profile'], function(){
	Route::get('/', 'ProfileController@profile'); //Display the logged in user's profile, otherwise should redirect to login page

	Route::group(['prefix' => 'admin'], function(){
		Route::get('/', 'ProfileController@adminPanel');
	});

	Route::get('/{user_id?}', 'ProfileController@profile');

});

// AUTHENTICATION
Route::group(['prefix' => 'auth'], function(){
	Route::get('facebook', 'Auth\AuthController@authRedirectToFacebook');
	Route::get('facebook/login-callback', 'Auth\AuthController@handleFacebookCallback');
	Route::get('google', 'Auth\AuthController@authRedirectToGoogle');
	Route::get('google/login-callback', 'Auth\AuthController@handleGoogleCallback');
	Route::get('logout', 'Auth\AuthController@doLogout');
});

// PRODUCT ROUTES
Route::group(['prefix'=>'product'], function()
{
	Route::get('/',['uses'=>'ProductController@getProducts']);
	Route::get('{id}', ['uses'=>'ProductController@getProduct']);
	Route::post('/', ['uses'=>'ProductController@create']);
	Route::put('{id}', ['uses'=>'ProductController@updateProduct']);
	Route::delete('{id}', ['uses'=>'ProductController@deleteProduct']);
});

// BRAND ROUTES
Route::group(['prefix'=>'brand'], function()
{
	Route::get('/',['uses'=>'BrandController@getBrands']);
	Route::get('{id}', ['uses'=>'BrandController@getBrand']); 
	Route::get('name/{name}', ['uses'=>'BrandController@getBrandByName']);
	Route::post('/', ['uses'=>'BrandController@create']);
	Route::put('{id}', ['uses'=>'BrandController@update']); 
	Route::delete('{id}', ['uses'=>'BrandController@delete']); 
	
});

// CATEGORY ROUTES
Route::group(['prefix'=>'category'], function()
{
	Route::get('/',['uses'=>'CategoryController@getCategories']);
	Route::get('{id}', ['uses'=>'CategoryController@getCategory']); 
	Route::get('name/{name}', ['uses'=>'CategoryController@getCategoryByName']);
	Route::post('/', ['uses'=>'CategoryController@create']);
	Route::put('{id}', ['uses'=>'CategoryController@update']); 
	Route::delete('{id}', ['uses'=>'CategoryController@delete']); 
	
});

// SEARCH ROUTES
Route::group(['prefix'=>'search'], function()
{
		Route::get('/', ['uses'=>'SearchController@index']);
		Route::get('results', 	['uses'=>'SearchController@getProducts']);
		// Route::get('product/{query}', 	['uses'=>'SearchController@getProducts']);
		// Route::get('category/{query}', 	['uses'=>'SearchController@getProductsByCategory']);
		// Route::get('brand/{query}', 	['uses'=>'SearchController@getProductsByBrand']);
});


// REVIEW ROUTES
Route::group(['prefix'=>'reviews'], function()
{
	Route::get('{product_id}', ['uses'=>'ReviewController@getProductReviews']);
	Route::post('/', ['uses'=>'ReviewController@createReview']);
});
