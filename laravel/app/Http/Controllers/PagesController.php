<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Category;
use App\Brand;
use App\Product;
use App\Feature_Rating_Total;
use App\Feature;

class PagesController extends Controller
{

    // returns page with passed in $page_name
    public function about() {
    	$page_name = 'About The Team';

    	return view('misc.about', compact('page_name'));
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

    public function review($prod_id) {
        $page_name = 'Review Page';
        $product = Product::find($prod_id);
        $product_name;

        // get product name if prod exist, otherwise return 404
        if(empty($product)) {
            return view('product404'); 
        }
        else {
            $product_name = $product->prod_name;
        }

        // get array of feature for product
        $features = Feature_Rating_Total::select('feature_id')->where('prod_id', $prod_id)->get();
        $feat_array = array();
        $feat_count = 0; 
        foreach($features as $feat) {
            //print $feat;
            // get name of feature using id
            //$feat_array[$feat->feature_id] = Feature::where('feature_id',$feat->feature_id)->first()->feature_name;
            $feat_array[$feat->feature_id] = Feature::where('feature_id',$feat->feature_id)->first();
            //$f = Feature::where('feature_id',$feat->feature_id)->first();
            //print $f->feature_name; 
            $feat_count++;
        }

        $product_array = array(
            'product_name' => $product_name,
            'prod_id'      => $prod_id,
            'feat_count'   => $feat_count);

        return view('review_page')->with('features', $feat_array)->with('product', $product_array);
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
        return view('errors.404');
    }

    public function submissionFailed() {
        return view('submission_failed');
    }
}
