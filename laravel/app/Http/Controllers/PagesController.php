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

    /**
     * PagesController constructor. Sets up the middleware
     */
    public function __construct()
    {
        $this->middleware('adminsOnly', ['only' => 'editProduct']);
    }

    /**
     * Get the about page
     *
     * @return view About page
     */
    public function about()
    {
        $page_name = 'About The Team';
        return view('misc.about', compact('page_name'));
    }

    /**
     * Get the home page
     *
     * @return view home page
     */
    public function home()
    {
        return view('welcome');
    }

    /**
     * Returns product search results page
     *
     * @return View for product search results
     */
    public function searchResult()
    {
        return view('search_results');
    }

    /**
     * Returns the Add a product page
     *
     * @return View Add a product form
     */
    public function addProduct()
    {
        $categories = Category::all(); // get all categories

        $cat_array = array();
        // populate category array with current categories in the database
        foreach ($categories as $cat) {
            // get the name of each category
            $cat_array[$cat->category_name] = $cat->category_name;
        }

        $brands = Brand::all(); // get all brands
        $brand_array = array();
        // populate brand array with current ones in the database
        foreach ($brands as $b) {
            // get the name of each brand
            $brand_array[$b->brand_name] = $b->brand_name;
        }

        // New array element will be inserted to the beginning of the list
        array_unshift($cat_array, 'Select a Category');
        array_unshift($brand_array, 'Select a Brand');
        // returns view with all category and brand data for drop menus
        return view('add_product')->with('categories', $cat_array)->with('brands', $brand_array);
    }

    /**
     * Returns view that allows the Admin to edit product submissions made by users
     * @param string $prod_id is the product ID
     * @return view Edit Product Submission form
     */
    public function editProduct($prod_id)
    {
        $categories = Category::all(); // get all categories

        $cat_array = array();
        // populate category array with current ones in the database
        foreach ($categories as $cat) {
            // get category names
            $cat_array[$cat->category_name] = $cat->category_name;
        }

        $brands = Brand::all(); // get all brands
        $brand_array = array();
        // populate brand array with current ones in the database
        foreach ($brands as $b) {
            // get the name of each brand
            $brand_array[$b->brand_name] = $b->brand_name;
        }

        // New array element will be inserted to the beginning of the list
        array_unshift($cat_array, 'Select a Category');
        array_unshift($brand_array, 'Select a Brand');

        // overwrite features by user
        $current_features = Feature_Rating_Total::where('prod_id', $prod_id)->get();

        // get features by name
        $feature_names = array();
        $i = 1; // array index counter
        foreach ($current_features as $feature) {
            $feature_names[$i] = Feature::find($feature->feature_id)->feature_name;
            $i++; // needed for array indexing
        }

        // undo feature and product linkage
        foreach ($current_features as $feature) {
            Feature_Rating_Total::where(['prod_id' => $prod_id,
                'feature_id' => $feature->feature_id])->delete();
        }


        // Get submitted product data
        $product = Product::find($prod_id);
        $brand_name = Brand::where('brand_id', $product->prod_brand)->first()->brand_name;
        $category_name = Category::where('category_id', $product->prod_category)->first()->category_name;

        // Detailed information for a product
        $more_prod_info = array('brand' => $brand_name, 'category' => $category_name);

        // return view and product data needed to output the edit form
        return view('edit_submission')->with('categories', $cat_array)->with('brands', $brand_array)
            ->with('product', $product)->with('prod_info', $more_prod_info)
            ->with('features', $feature_names);
    }

    /**
     * Displays a form for reviewing a product.
     *
     * @param string $prod_id is the product ID
     * @return view Review Product Form
     */
    public function review($prod_id)
    {
        $page_name = 'Review Page';
        $product = Product::find($prod_id);
        $product_name = null;

        // get product name if prod exist, otherwise return 404
        if (empty($product)) {
            return view('product404');
        } else {
            $product_name = $product->prod_name;
        }

        // Get an array of feature for product
        $features = Feature_Rating_Total::select('feature_id')->where('prod_id', $prod_id)->get();
        $feat_array = array();
        $feat_count = 0;
        foreach ($features as $feat) {
            $feat_array[$feat->feature_id] = Feature::where('feature_id', $feat->feature_id)->first();
            $feat_count++;
        }

        // Check if user already made a review for that product
        $exist_review = Review::where(['prod_id' => $prod_id,
            'user_id' => Auth::id()])->first();

        $previous_review = "";
        $previous_overall_rating = 0;
        // output previous review and scores to user in case they wish to change it
        $feat_scores = array();
        if ($exist_review) {
            $previous_overall_rating = $exist_review->overal_rating;
            $previous_review = $exist_review->review_text;
            // get how the user scored each feature for this product
            foreach ($feat_array as $feat) {
                $feat_scores[$feat->feature_id] = Feature_Rating::where(['prod_id' => $prod_id,
                    'user_id' => Auth::id(),
                    'feature_id' => $feat->feature_id])->first()->rating;
            }
        }

        // Setup the data to be passed to the view
        $product_array = array(
            'product_name' => $product_name,
            'prod_id' => $prod_id,
            'feat_count' => $feat_count,
            'review' => $previous_review,
            'rating' => $previous_overall_rating);

        return view('review_page')->with('features', $feat_array)->with('product', $product_array)->with('scores', $feat_scores);
    }

    /**
     * Returns resource not found page (HTTP code: 404)
     * @return view 404 page
     */
    public function pageNotFound()
    {
        return view('errors.404');
    }

}
