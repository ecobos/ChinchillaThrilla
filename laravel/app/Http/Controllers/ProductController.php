<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Http\Response;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use DB;

use App\Review;
use App\Brand;
use App\Category;
use App\Feature_Rating_Total;
use App\Feature;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Admin;


/**
 * Class ProductController
 * Controls the creation, deletion, retrieval and updating of products
 * @package App\Http\Controllers
 */
class ProductController extends ApiGuardController
{
    // ADMIN only: gives the admin a preview of a product
    public function __construct()
    {
        $this->middleware('adminsOnly', ['only' => 'adminProductPreview']);
    }

    // methods that don't need api key authentication
    protected $apiMethods = [
        'getProductView' => [
            'keyAuthentication' => false
        ],
        'createWithAPIKey' => [
            'keyAuthentication' => false
        ],
        'adminProductPreview' => [
            'keyAuthentication' => false
        ],
        'publishProduct' => [
            'keyAuthentication' => false
        ],

    ];

    /**
     * Gets list of products based on search name
     *
     * @param string $name the name of the product
     * @return Response|array retrieved product.
     */
    public function getProductByName($name)
    {
        // Get products that match the provided name
        $products = Product::where('prod_name', 'like', '%' . $name . '%')->get();
        if (empty($products)) {
            return new Response('Product not found', 404);
        }
        // return array of products
        return $products->toArray();
    }

    /**
     * Returns product with specified ID
     *
     * @param string $id is the product ID
     * @return Response 404 if product is not found
     */
    public function getProduct($id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            // no product found, return 404 response
            return new Response('Product not found', 404);
        }
        // returns json data
        return $product;
    }

    /**
     * Get the view for the specified product.
     *
     * @param string $id is the product ID
     * @return view product page for a given product
     */
    public function getProductView($id)
    {
        $product = Product::find($id); // find product

        // Check the product exists and that is already approved by admin
        if (empty($product) || $product->isPublished == 0) {
            // Let the user know that the product was not found
            return view('product404');

        }

        // Set up the data to be passed to the view
        $prod_id = $id;
        $name = $product->prod_name;
        $model = $product->prod_model;
        $brand = $product->prod_brand;
        $desc = $product->prod_description;
        $rating = $product->overall_rating;
        $img_path = $product->prod_img_path;

        $features = Feature::getFeatures($id);
        $totalRating = Review::getOverallRating($id);
        $logged_in = Auth::check();
        $reviewCount = Review::getProductReviewCount($id)->total;

        // return product page for this product
        return view('product_page', compact('prod_id', 'brand', 'name', 'model', 'desc', 'rating', 'img_path', 'features', 'totalRating', 'logged_in', 'reviewCount'));
    }

    /**
     * Display the product preview for the admin.
     *
     * @param string $id the product ID
     * @return view product preview page
     */
    public function adminProductPreview($id)
    {
        $product = Product::find($id);

        // check product exists
        if (empty($product)) {
            // Let the user know that the product was not found
            return view('product404');

        }

        // Set up the data to be passed to the view
        $prod_id = $id;
        $name = $product->prod_name;
        $model = $product->prod_model;
        $brand = $product->prod_brand;
        $category = $product->prod_category;
        $desc = $product->prod_description;
        $rating = $product->overall_rating;
        $img_path = $product->prod_img_path;

        $features = Feature::getFeatures($id);
        $totalRating = Review::getOverallRating($id);;
        $logged_in = false; // admin does not need to review a product
        $reviewCount = 1; // Needed as a view placeholder

        // Return product page for this product for admin to see
        return view('product_page', compact('prod_id', 'brand', 'name', 'model', 'desc', 'rating', 'img_path', 'features', 'totalRating', 'logged_in', 'reviewCount'));
    }

    /**
     * Returns all products in database
     *
     * @return array of products
     */
    public function getProducts()
    {
        $products = Product::all();
        return $products->toArray();
    }


    /**
     * Creates a product based on information received from POST request. Developer access level.
     *
     * @param Request $request is the request POSTed by developer
     * @return Response 400 if json request is malformed
     */
    public function create(Request $request)
    {
        // Get the data from the POST request (assuming JSON data was posted... keys need to match the ones in parantheses)
        $name = $request->input("prod_name");
        $model = $request->input("prod_model");
        $brand = $request->input("prod_brand");
        $category = $request->input("prod_category");
        $desc = $request->input("prod_description");
        $rating = $request->input("overall_rating");
        $img_path = $request->input("prod_img_path");

        // Check that all needed fields were posted
        if ($name == null || $model == null || $brand == null || $category == null || $rating == null) {
            return new Response('Malformed json request', 400);
        }

        // Populate fields of new product and save in database
        $product = new Product;
        $product->prod_name = $name;
        $product->prod_model = $model;
        $product->prod_brand = $brand;
        $product->prod_category = $category;
        $product->prod_description = $desc;
        $product->overall_rating = $rating;
        $product->prod_img_path = $img_path;

        // Commit changes to the database
        $product->save();
    }

    /**
     * Creates a product based on information received from POST request
     *
     * @param Request $request the requested posted
     * @param string $api_key the API key provided
     * @return Response 401 if API key provided is invalid
     */
    public function createWithAPIKey(Request $request, $api_key)
    {
        // check if authorized to POST
        $match_key = ApiKey::where('key', $api_key)->first();

        // not authorized to POST (public key in form)
        if (empty($match_key)) {
            return new Response('An invalid API key was provided with the API request', 401);
        }

        // check if user is logged in
        if (!Auth::check()) {
            // redirect user to login page if not logged in
            return Redirect::to('/auth/login')->with([
                'alert-type' => 'alert-danger',
                'status' => 'Please Login']);
        }


        // get the data from the POST request (assuming JSON data was posted... keys need to match the ones in parantheses)
        $name = $request->input("prod_name");
        $model = $request->input("prod_model");
        $brand = $request->input("prod_brand");

        // check for that all fields were entered
        if ($name == null || $model == null || $brand == null) {
            return Redirect::to('/submission_failed');
        }

        // get brand id to check for existing record in database
        $brand_obj = Brand::where('brand_name', $brand)->first();
        $existing_product = null;

        // check if brand exists, check for product against database
        if ($brand_obj) {
            // get brand_id
            $brand_id = $brand_obj->brand_id;
            // this brand exists, so we check if prod is in database already
            $existing_product = Product::where(['prod_name' => $name,
                'prod_model' => $model,
                'prod_brand' => $brand_id])->first();
        }

        // product does not exist, add it
        if (empty($existing_product)) {

            // if brand does not exist, add it to brands table first
            $new_brand = Brand::where('brand_name', $brand)->first();
            if (empty($new_brand)) {
                //print 'brand does not exist!';
                $new_brand = new Brand;
                $new_brand->brand_name = $brand;
                $new_brand->save();
            }
            // update brandID on newly added product to be inserted into database
            $brand = Brand::where('brand_name', $new_brand->brand_name)->first()->brand_id;

            // if category does not exist, add it to category table
            $category = $request->input("prod_category");

            // check that category is not null
            if ($category == null) {
                return Redirect::to('/submission_failed');
            }

            $new_cat = Category::where('category_name', $category)->first();
            if (empty($new_cat)) {
                $new_cat = new Category;
                $new_cat->category_name = $category;
                $new_cat->save();
            }

            // update ID on category being inserted to database
            $category = Category::where('category_name', $new_cat->category_name)->first()->category_id;
            $desc = $request->input("prod_description");

            // check if user uploaded an image for the product
            // upload to amazon S3
            if ($request->hasFile('image')) {
                $image = $request->file("image");
                $image_file_name = time() . '_' . $image->getClientOriginalName();

                // create a new instance of s3 to upload to AWS server
                \Storage::disk("s3")->put($image_file_name, file_get_contents($image), "public");

                $bucket_name = "s3prod-images";
                $region = "us-west-1";
                // Generate URL
                $image_url = "https://s3-" . $region . ".amazonaws.com/" . $bucket_name . "/" . $image_file_name;
            } else {
                // set image path to default image if no image provided
                $image_url = 'http://www.trendmakina.com/wp-content/uploads/2014/05/empty-product-large.png';
            }

            $product = new Product; // new instance of product
            // populate fields of new product
            $product->prod_name = $name;
            $product->prod_model = $model;
            $product->prod_brand = $brand;
            $product->prod_category = $category;
            $product->prod_description = $desc;
            $product->prod_img_path = $image_url;
            $product->save();

            // get product id for newly added product
            $prod_id = $product->prod_id;
        } else {
            // product already exists, simply get the prod_id
            $prod_id = $existing_product->prod_id;
        }

        // Add features to database for this product
        $feature_id = null;
        // Check all input boxes
        for ($i = 1; $i < 11; $i++) {
            $spec_details = $request->input('spec' . $i);
            // Check that the features are not empty
            if (strcmp($spec_details, "") != 0) {
                $existing_feature = Feature::where('feature_name', $spec_details)->first();
                // Add feature to features table if none exists already
                if (empty($existing_feature)) {
                    print 'feature ' . $spec_details . ' does not exist';
                    $add_feat = new Feature;
                    $add_feat->feature_name = $spec_details;
                    $add_feat->save();

                    // get feature_id of newly added feature
                    $feature_id = $add_feat->feature_id;
                } else {
                    // it does exist, simply get id of feat
                    $feature_id = $existing_feature->feature_id;
                }

                // check if this product already has this feature
                $prod_feat = Feature_Rating_Total::where([
                    "prod_id" => $prod_id,
                    "feature_id" => $feature_id])
                    ->first();
                if (empty($prod_feat)) {
                    // tie product to that feature
                    $new_prod_feat = new Feature_Rating_Total;
                    $new_prod_feat->prod_id = $prod_id;
                    $new_prod_feat->feature_id = $feature_id;
                    $new_prod_feat->save();
                }
            }
        }

        // check if product was reviewed by admin
        if (Admin::find(Auth::user()->user_id) != null) {
            // publish product on website
            if ($existing_product) {
                $existing_product->isPublished = 1;
                $existing_product->save();
            }

        }

        // show success message to user after adding product
        return Redirect::to('/addproduct')->with([
            'alert-type' => 'alert-success',
            'status' => 'Successfully Added Product']);
    }


    /**
     * Update a product.
     *
     * @param Request $request is the request POSTed
     * @param string $id the product ID
     * @return Response 404 if product is not found; 400 if json was malformed
     */
    public function update(Request $request, $id)
    {
        // find product to update
        $product = Product::find($id);
        // check product exists
        if (empty($product)) {
            return new Response('Product not found', 404);
        }

        // get new data to update Product with
        $name = $request->input("prod_name");
        $model = $request->input("prod_model");
        $brand = $request->input("prod_brand");
        $category = $request->input("prod_category");
        $desc = $request->input("prod_description");
        $rating = $request->input("overall_rating");
        $img_path = $request->input("prod_img_path");

        // check that all needed fields were posted
        if ($name == null || $model == null || $brand == null
            || $category == null || $rating == null
        ) {
            return new Response('Malformed json request', 400);
        }

        // update product
        $product->prod_name = $name;
        $product->prod_model = $model;
        $product->prod_brand = $brand;
        $product->prod_category = $category;
        $product->prod_description = $desc;
        $product->overall_rating = $rating;
        $product->prod_img_path = $img_path;
        $product->save();

    }

    /**
     * Deletes a product.
     *
     * @param string $id the product ID
     * @return Response 404 if product is not found
     */
    public function delete($id)
    {
        $product = Product::find($id);
        if (empty($product)) {
            return new Response('Product not found', 404);
        }
        $product->delete();
    }

    /**
     * Changes isPublished flag on product to be published and seen on site.
     *
     * @param Request $req is the POST request
     */
    public function publishProduct(Request $req)
    {
        $prod_id = $req->input('productID');
        $product = Product::find($prod_id);
        $product->isPublished = 1;
        $product->save(); // save changes to product
    }
}
