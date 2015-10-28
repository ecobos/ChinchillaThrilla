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
	Route::get('/name/{name}', ['uses'=>'ProductController@getProductByName']);
	Route::post('', ['uses'=>'ProductController@create']); 
	Route::put('{id}', ['uses'=>'ProductController@update']); 
	Route::delete('{id}', ['uses'=>'ProductController@delete']); 
	
});

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
