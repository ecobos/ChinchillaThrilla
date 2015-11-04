<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    // returns faux profile page
    public function profile()
    {
        $name = "Yo Mama";
        $email = "sadpanda@gmail.com";
        $avatar = "";

        if(Auth::user()){
            $user = Auth::user();
            $name = $user->name;
            $email = $user->email;
            $avatar = $user->avatar;
        }

    	return view('profile', compact('name', 'email', 'avatar'));
    }

    // returns page with passed in $page_name
    public function about() {
    	$page_name = 'About The Team';

    	return view('about', compact('page_name'));
    }

    // returns static home page
    public function home() {

        return view('welcome');
    }

    public function searchResult() {

        $page_name = 'Product Search';
        return view('search_results');
    }

    public function product() {

        $page_name = 'Product Page';
        return view('product_page');
    }

    public function productLoggedIn() {

        $page_name = 'Product Logged In Page';
        return view('product_page_log');
    }
}
