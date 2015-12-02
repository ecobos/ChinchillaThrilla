<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Category;
use App\Brand;
use App\Product;
use App\Feature_Rating_Total;
use App\Feature;
use Illuminate\Support\Facades\Auth;
use App\Review;
use App\Feature_Rating;

class PagesController extends Controller
{

    // give the admin ability to edit a product
    public function __construct()
    {
        $this->middleware('adminsOnly', ['only' => 'editProduct']);
    }

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

        array_unshift($cat_array, 'Select a Category');
        array_unshift($brand_array, 'Select a Brand');
        return view('add_product')->with('categories', $cat_array)->with('brands', $brand_array);
    }

    // allows the admin to edit a product submission before approving
    public function editProduct($prod_id) {
        $categories = Category::all();

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

        array_unshift($cat_array, 'Select a Category');
        array_unshift($brand_array, 'Select a Brand');

        // overwrite features by user
        $current_features = Feature_Rating_Total::where('prod_id', $prod_id)->get();

        // get features by name
        $feature_names = array();
        $i = 1;
        foreach($current_features as $feature) {
            $feature_names[$i] = Feature::find($feature->feature_id)->feature_name;
            $i = $i + 1;
        }

        // undo feature and product linkage
        foreach($current_features as $feature) {
            Feature_Rating_Total::where(['prod_id' => $prod_id,
                                                           'feature_id' => $feature->feature_id])->delete();
        }
        

        // get submitted product data
        $product = Product::find($prod_id);
        $brand_name = Brand::where('brand_id', $product->prod_brand)->first()->brand_name;
        $category_name = Category::where('category_id', $product->prod_category)->first()->category_name;
        $more_prod_info = array('brand' => $brand_name, 
                                'category' => $category_name);

        return view('edit_submission')->with('categories', $cat_array)->with('brands', $brand_array)->with('product', $product)->with('prod_info', $more_prod_info)->with('features', $feature_names);
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

        // check if user already made a review for that product
        $exist_review = Review::where(['prod_id' => $prod_id,
                                        'user_id' => Auth::id()])->first();

        $previous_review = "";
        $previous_overall_rating = 0;
        // output previous review and scores to user in case they wish to change it
        $feat_scores = array();
        if($exist_review) {
            $previous_overall_rating = $exist_review->overal_rating;
            $previous_review = $exist_review->review_text;
            // get how the user scored each feature for this product
            foreach($feat_array as $feat) {
                $feat_scores[$feat->feature_id] = Feature_Rating::where(['prod_id' => $prod_id,
                                                        'user_id' => Auth::id(), 
                                                        'feature_id' => $feat->feature_id])->first()->rating;
                //print $feat_scores[$feat->feature_id];
            }
        }

        $product_array = array(
            'product_name' => $product_name,
            'prod_id'      => $prod_id,
            'feat_count'   => $feat_count,
            'review'       => $previous_review,
            'rating'       => $previous_overall_rating);

        return view('review_page')->with('features', $feat_array)->with('product', $product_array)->with('scores', $feat_scores);
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
