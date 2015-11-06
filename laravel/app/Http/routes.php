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

Route::get('profile', 'PagesController@profile');

// about page
Route::get('about', 'PagesController@about');

// search results page
Route::get('search', 'PagesController@searchResult');

// product page
Route::get('product', 'PagesController@product');

// product page
Route::get('productLoggedIn', 'PagesController@productLoggedIn');

// AUTHENTICATION

Route::get('/auth/facebook', 'Auth\AuthController@authRedirectToFacebook');
Route::get('/auth/facebook/login-callback', 'Auth\AuthController@handleFacebookCallback');

Route::get('/auth/google', 'Auth\AuthController@authRedirectToGoogle');
Route::get('/auth/google/login-callback', 'Auth\AuthController@handleGoogleCallback');

Route::get('/auth/logout', ['middleware' => 'ifAuth', function(){

        Auth::logout();
        return "<b> Logged out </b>";
}]);

Route::get('/checkAuth', 'Auth\AuthController@showValidated');


// PRODUCT ROUTES
Route::group(['prefix'=>'products'], function()
{

        Route::get('',['uses'=>'ProductController@getProducts']); 
        Route::get('{id}', ['uses'=>'ProductController@getProduct']); 
        Route::post('', ['uses'=>'ProductController@create']); 
        Route::put('{id}', ['uses'=>'ProductController@updateProduct']); 
        Route::delete('{id}', ['uses'=>'ProductController@deleteProduct']); 

});

/*
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
	Route::get('',['uses'=>'ProductController@getProducts']); 
	Route::get('{id}', ['uses'=>'ProductController@getProduct']); 
	Route::get('/name/{name}', ['uses'=>'ProductController@getProductByName']);
	Route::post('', ['uses'=>'ProductController@create']); 
	Route::put('{id}', ['uses'=>'ProductController@update']); 
	Route::delete('{id}', ['uses'=>'ProductController@delete']); 
	
});
*/

// BRAND ROUTES
Route::group(['prefix'=>'brand'], function()
{
	Route::get('',['uses'=>'BrandController@getBrands']); 
	Route::get('{id}', ['uses'=>'BrandController@getBrand']); 
	Route::get('/name/{name}', ['uses'=>'BrandController@getBrandByName']);
	Route::post('', ['uses'=>'BrandController@create']); 
	Route::put('{id}', ['uses'=>'BrandController@update']); 
	Route::delete('{id}', ['uses'=>'BrandController@delete']); 
	
});

// CATEGORY ROUTES
Route::group(['prefix'=>'category'], function()
{
	Route::get('',['uses'=>'CategoryController@getCategories']); 
	Route::get('{id}', ['uses'=>'CategoryController@getCategory']); 
	Route::get('/name/{name}', ['uses'=>'CategoryController@getCategoryByName']);
	Route::post('', ['uses'=>'CategoryController@create']); 
	Route::put('{id}', ['uses'=>'CategoryController@update']); 
	Route::delete('{id}', ['uses'=>'CategoryController@delete']); 
	
});

// SEARCH ROUTES
Route::group(['prefix'=>'search'], function()
{
		Route::get('', ['uses'=>'SearchController@index']);
		Route::get('results', 	['uses'=>'SearchController@getProducts']);
		// Route::get('product/{query}', 	['uses'=>'SearchController@getProducts']);
		// Route::get('category/{query}', 	['uses'=>'SearchController@getProductsByCategory']);
		// Route::get('brand/{query}', 	['uses'=>'SearchController@getProductsByBrand']);
});


// REVIEW ROUTES
Route::group(['prefix'=>'reviews'], function()
{
	Route::get('{product_id}', ['uses'=>'ReviewController@getProductReviews']);
	Route::post('', ['uses'=>'ReviewController@createReview']);
});
