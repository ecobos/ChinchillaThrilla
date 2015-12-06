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

/**
 * Class PagesController
 * Controls the retrieval of views within our web application
 * @package App\Http\Controllers
 */
class PagesController extends Controller
{

    // ADMIN Only: gives the admin ability to edit a product
    public function __construct()
    {
        $this->middleware('adminsOnly', ['only' => 'editProduct']);
    }

    /**
     * Returns about page
     * @return view About page
     */
    public function about() {
    	$page_name = 'About The Team';
    	return view('misc.about', compact('page_name'));
    }

    /**
     * Returns home page
     * @return view home page
     */
    public function home() {
        return view('welcome');
    }

    /**
     * Returns product search results page
     * @return view for product search results
     */
    public function searchResult() {
        $page_name = 'Product Search';
        return view('search_results');
    }

    /**
     * Returns the Add a product page
     * @return view Add a product form
     */
    public function addProduct() {
        $categories = Category::all(); // get all categories

        $cat_array = array();
        // populate category array with current categories in the database
        foreach($categories as $cat) {
            // get the name of each category
            $cat_array[$cat->category_name] = $cat->category_name;
        }

        $brands = Brand::all(); // get all brands
        $brand_array = array();
        // populate brand array with current ones in the database
        foreach($brands as $b) {
            // get the name of each brand
            $brand_array[$b->brand_name] = $b->brand_name;
        }

        array_unshift($cat_array, 'Select a Category');
        array_unshift($brand_array, 'Select a Brand');
        // returns view with all category and brand data for drop menus
        return view('add_product')->with('categories', $cat_array)->with('brands', $brand_array);
    }

    /**
     * Returns view that allows the Admin to edit product submissions made by users
     * @param $prod_id is the product ID
     * @return view Edit Product Submission form
     */
    public function editProduct($prod_id) {
        $categories = Category::all(); // get all categories

        $cat_array = array();
        // populate category array with current ones in the database
        foreach($categories as $cat) {
            // get category names
            $cat_array[$cat->category_name] = $cat->category_name;
        }

        $brands = Brand::all(); // get all brands
        $brand_array = array();
        // populate brand array with current ones in the database
        foreach($brands as $b) {
            // get the name of each brand
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
            $i++; // needed for array indexing
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
        // return view and product data needed to output the edit form
        return view('edit_submission')->with('categories', $cat_array)->with('brands', $brand_array)
            ->with('product', $product)->with('prod_info', $more_prod_info)
            ->with('features', $feature_names);
    }

    /**
     * Returns view for reviewing a product
     * @param $prod_id is the product ID
     * @return view Review Product Form
     */
    public function review($prod_id) {
        $page_name = 'Review Page';
        $product = Product::find($prod_id);
        $product_name = null;

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

    /**
     * Returns resource not found page (404)
     * @return view 404 page
     */
    public function pageNotFound(){
        return view('errors.404');
    }

    /**
     * Returns view for server side checks... in case user by passes required fields client-side
     * @return view for failed submissions
     */
    public function submissionFailed() {
        return view('submission_failed');
    }
}
