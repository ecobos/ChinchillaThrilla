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

// home page
// no Controller called, just returns static page
Route::get('/', function () {
    return view('welcome');
});

// route gets called by going to  http://localhost:8000/profile
// calls profile function in PagesController
// profile function within PagesController then calls the view within resources/views
Route::get('profile', 'PagesController@profile');

// about page
Route::get('about', 'PagesController@about');




// AUTHENTICATION

Route::get('/auth/facebook', 'Auth\AuthController@authRedirectToFacebook');
Route::get('/auth/facebook/login-callback', 'Auth\AuthController@handleFacebookCallback');

Route::get('/auth/google', 'Auth\AuthController@authRedirectToGoogle');
Route::get('/auth/google/login-callback', 'Auth\AuthController@handleGoogleCallback');

Route::get('/checkAuth', 'Auth\AuthController@showValidated');


// PRODUCT ROUTES
Route::group(['prefix'=>'product'], function()
{
        Route::get('',['uses'=>'ProductController@getProducts']); 
        Route::get('{id}', ['uses'=>'ProductController@getProduct']); 
        Route::post('', ['uses'=>'ProductController@create']); 
        Route::put('{id}', ['uses'=>'ProductController@updateProduct']); 
        Route::delete('{id}', ['uses'=>'ProductController@deleteProduct']); 

});


// SEARCH ROUTES
Route::group(['prefix'=>'search'], function()
{
		Route::get('product/{query}', 	['uses'=>'SearchController@getProducts']);
		Route::get('category/{query}', 	['uses'=>'SearchController@getProductsByCategory']);
		Route::get('brand/{query}', 	['uses'=>'SearchController@getProductsByBrand']);
});


// REVIEW ROUTES
Route::group(['prefix'=>'reviews'], function()
{
	Route::get('{product_id}', ['uses'=>'ReviewController@getProductReviews']);
	Route::post('', ['uses'=>'ReviewController@createReview']);
});

