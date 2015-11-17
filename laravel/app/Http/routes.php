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


// if php artisan serve doesn't work, try: php -S localhost:8000 -t public (where public is the directory where you want your server to look in)


Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');



Route::group(['prefix' => 'profile'], function(){
	// testing user account page
	Route::get('/account/{user_id}', 'ProfileController@userAccount');

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
Route::group(['prefix'=>'products'], function()
{

	// API routes
	Route::group(['prefix'=>'api/v1/json'], function() 
	{
        Route::get('',['uses'=>'ProductController@getProducts']); 
        Route::get('{id}', ['uses'=>'ProductController@getProduct']); 
        Route::post('', ['uses'=>'ProductController@create']); 
        Route::put('{id}', ['uses'=>'ProductController@updateProduct']); 
        Route::delete('{id}', ['uses'=>'ProductController@deleteProduct']); 
    });

    // view routes
    Route::get('{id}', ['uses'=>'ProductController@getProductView']); 
    

});

// BRAND ROUTES
Route::group(['prefix'=>'brand'], function()
{
	// API routes
	Route::group(['prefix'=>'api/v1/json'], function() {
		Route::get('',['uses'=>'BrandController@getBrands']); 
		Route::get('{id}', ['uses'=>'BrandController@getBrand']); 
		Route::get('/name/{name}', ['uses'=>'BrandController@getBrandByName']);
		Route::post('', ['uses'=>'BrandController@create']); 
		Route::put('{id}', ['uses'=>'BrandController@update']); 
		Route::delete('{id}', ['uses'=>'BrandController@delete']); 
	});

	
});

// CATEGORY ROUTES
Route::group(['prefix'=>'category'], function()
{

	// API routes
	Route::group(['prefix'=>'api/v1/json'], function() {
		Route::get('',['uses'=>'CategoryController@getCategories']); 
		Route::get('{id}', ['uses'=>'CategoryController@getCategory']); 
		Route::get('/name/{name}', ['uses'=>'CategoryController@getCategoryByName']);
		Route::post('', ['uses'=>'CategoryController@create']); 
		Route::put('{id}', ['uses'=>'CategoryController@update']); 
		Route::delete('{id}', ['uses'=>'CategoryController@delete']); 
	});

	
});

// SEARCH ROUTES
Route::group(['prefix'=>'search'], function()
{
		Route::get('/', ['uses'=>'SearchController@index']);
		Route::get('results', 	['uses'=>'SearchController@getProducts']);
});


// REVIEW ROUTES
Route::group(['prefix'=>'reviews'], function()
{

	Route::get('{product_id}', ['uses'=>'ReviewController@getProductReviews']);
	Route::post('/', ['uses'=>'ReviewController@createReview']);

	// Test form for review creation
	Route::get('',	
		['uses'=>'ReviewController@index']
	);
	// Get the reviews for a product
	Route::get('product/{product_id}',
		['uses'=>'ReviewController@getProductReviews']
	);
	// Get the reviews from a user
	Route::get('user/{user_id}',
		['uses'=>'ReviewController@getUserReviews']
	);
	// Create a new Review for ($prod_id, $user_id)
	Route::post('', 
		['uses'=>'ReviewController@createReview']
	);

});


Route::group(['prefix'=>'apikeys'], function()
{
	// API routes
	Route::group(['prefix'=>'/v1'], function() 
	{
        Route::get('{id}', ['uses'=>'APIController@get']); 
        Route::post('', ['uses'=>'APIController@create']); 
        Route::delete('{id}', ['uses'=>'APIController@delete']); 
    });

});

