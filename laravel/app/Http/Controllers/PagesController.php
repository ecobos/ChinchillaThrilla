<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class PagesController extends Controller
{

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

    public function review() {

        $page_name = 'Review Page';
        return view('review_page');
    }

    public function productLoggedIn() {

        $page_name = 'Product Logged In Page';
        return view('product_page_log');
    }

    public function addProduct() {

        $page_name = 'Add Product';
        return view('add_product');
    }

    public function userAccount() {

        $page_name = 'User Account';
        return view('user_account');
    }

    public function userAccountAdmin() {

        $page_name = 'Admin User Account';
        return view('user_account_admin');
    }

    public function userAccountPublic() {

        $page_name = 'User Account Public';
        return view('user_account_public');
    }
    public function pageNotFound(){
        return view('404');
    }
}
