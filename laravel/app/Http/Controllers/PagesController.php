<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Category;
use App\Brand;

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

    // testing adding product page
    public function addProduct() {
        $categories = Category::all();
        //var_dump($categories);

        $cat_array = array();
        // populate category array with current ones in the database
        foreach($categories as $cat) {
            $cat_array[$cat->category_name] = $cat->category_name;
        }

        $brands = Brand::all();
        $brand_array = array();
        // populate brand array with current ones in the database
        foreach($brands as $b) {
            $brand_array[$b->brand_name] = $b->brand_name;
        }

        //var_dump($array);
        array_unshift($cat_array, 'Select a Category');
        array_unshift($brand_array, 'Select a Brand');
        return view('add_product')->with('categories', $cat_array)->with('brands', $brand_array);
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
