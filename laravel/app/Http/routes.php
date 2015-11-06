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

// search results page
Route::get('search', 'PagesController@searchResult');

// product page
Route::get('product', 'PagesController@product');

// add product page
Route::get('addProduct', 'PagesController@addProduct');

// product page logged in
Route::get('productLoggedIn', 'PagesController@productLoggedIn');

// user account
Route::get('userAccount', 'PagesController@userAccount');

// user account admin
Route::get('userAccountAdmin', 'PagesController@userAccountAdmin');

// user account public
Route::get('userAccountPublic', 'PagesController@userAccountPublic');