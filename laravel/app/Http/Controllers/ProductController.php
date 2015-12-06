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


// 'php artisan tinker' to test the model classes
class ProductController extends ApiGuardController
{
    // give the admin a preview of a product
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

    // get list of products based on search name
    public function getProductByName($name) {
        $products = Product::where('prod_name', 'like', '%' . $name . '%')->get();
        if(empty($products)) {
            return new Response('Product not found', 404);
        }

        return $products->toArray();
    }


    // Returns product with specified ID
    // returns view right now, make one for API calls and one for the internal pages returned
    // or call the controller function internally
    // once that happens... make call to review controller to get reviews for this product
    public function getProduct($id) {
        $product = Product::find($id);
        
        if(empty($product)) {
            // no product found, return 404 response
            return new Response('Product not found', 404);
        }

        // returns json data
        return $product;
    }

    public function getProductView($id) {
        $product = Product::find($id);
        
        if(empty($product) || $product->isPublished==0) {
            // return 404 view
            return view('product404');

        }

        // get all data to pass on over to view
        $prod_id = $id;
        $name = $product->prod_name;
        $model = $product->prod_model;
        $brand = $product->prod_brand;
        $category = $product->prod_category;
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


    public function adminProductPreview($id) {
        $product = Product::find($id);
        
        if(empty($product)) {
            // return 404 view
            return view('product404');

        }

        // get all data to pass on over to view
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
        $reviewCount = 1;


        // return product page for this product for admin to see
        return view('product_page', compact('prod_id', 'brand', 'name', 'model', 'desc', 'rating', 'img_path', 'features', 'totalRating', 'logged_in', 'reviewCount'));
    }

    // Returns array of products
    public function getProducts() {
        $products = Product::all();
        return $products->toArray();
    }


    // make sure request is correct... no need for fillable array
    /*
    {
    "prod_name": "QuietComfort® 25 Acoustic Noise Cancelling Headphones",
    "prod_model": "QUIETCOMFORT 25 HEADPHONES BLK",
    "prod_brand": 55,
    "prod_category": 42,
    "prod_description": "QuietComfort 25 Acoustic Noise Cancelling headphones are the best-performing around-ear headphones from Bose. They give you crisp, powerful sound--and quiet that lets you hear your music better. Bose advances their industry-leading headphones with the latest proprietary Bose Active EQ and TriPort technology, giving the music you love deep, clear sound. At the same time, Bose noise cancelling technology monitors the noise around you and cancels it out, helping you focus on what you want to hear--whether it’s your music, your calls or simply peace and quiet. With a distinctive design and two color options to match your style, these headphones look as good as they sound. They’re also comfortable, durably made and easy to stow, with earcups that pivot to fit in a small carrying case. Customized for Apple devices. Included: QuietComfort 25 headphones; 56-inch QC25 inline remote and microphone cable; airline adapter; carrying case; AAA battery.",
    "overall_rating": 6,
    "prod_img_path": "http://ecx.images-amazon.com/images/I/71%2BHRQB7YCL._SX425_.jpg"
}

    */

    // Creates a product based on information received from POST request  (Developer)
    public function create(Request $request)
    {   
        //var_dump($request);

        // get the data from the POST request (assuming JSON data was posted... keys need to match the ones in parantheses)
        $name = $request->input("prod_name");
        $model = $request->input("prod_model");
        $brand = $request->input("prod_brand");
        $category = $request->input("prod_category");
        $desc = $request->input("prod_description");
        $rating = $request->input("overall_rating");
        $img_path = $request->input("prod_img_path");



        // don't forget to check for empty fields... throw error
        $product = new Product; // new instance of product
        // populate fields of new product
        $product->prod_name = $name;
        $product->prod_model = $model;
        $product->prod_brand = $brand;
        $product->prod_category = $category;
        $product->prod_description = $desc;
        $product->overall_rating = $rating;
        $product->prod_img_path = $img_path;
        $product->save();

    }

// Creates a product based on information received from POST request (non-Developer)
public function createWithAPIKey(Request $request, $api_key)
{   
    // workaround API key issue
    //print $api_key;
    // check if authorized to POST 
    $match_key = ApiKey::where('key', $api_key)->first();
    //print $match_key;

    // not authorized to POST (public key in form)
    if (empty($match_key)) {
        return new Response('An invalid API key was provided with the API request', 401);
    }

    // check if user is logged in
    if(!Auth::check()) {
        // redirect user to login page if not logged in
        return Redirect::to('/auth/login')->with([
                    'alert-type'=> 'alert-danger',
                    'status' => 'Please Login']);
    }


    // get the data from the POST request (assuming JSON data was posted... keys need to match the ones in parantheses)
    $name = $request->input("prod_name");
    $model = $request->input("prod_model");
    $brand = $request->input("prod_brand");

    // check for that all fields were entered 
    if($name == null || $model == null || $brand == null) {
        return Redirect::to('/submission_failed');
    }

    $prod_id = null;

    // get brand id to check for existing record in database
    $brand_obj = Brand::where('brand_name', $brand)->first();
    $existing_product = null;

    // check if brand exists, check for product against database
    if($brand_obj) {
        // get brand_id
        $brand_id = $brand_obj->brand_id;
        // this brand exists, so we check if prod is in database already
        $existing_product = Product::where(['prod_name' => $name,
                                        'prod_model' => $model,
                                        'prod_brand' => $brand_id])->first();
    }
    
    // produt does not exist, add it
    if(empty($existing_product)) {

        // if brand does not exist, add it to brands table first
        $new_brand = Brand::where('brand_name', $brand)->first();
        if(empty($new_brand)) {
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
        if($category == null) {
            return Redirect::to('/submission_failed');
        }

        $new_cat = Category::where('category_name', $category)->first();
        if(empty($new_cat)) {
            //print 'category does not exist';
            $new_cat = new Category; 
            $new_cat->category_name = $category;
            //print 'category inserted: ' . $new_cat;
            $new_cat->save();
        }

        // update ID on category being inserted to database
        $category = Category::where('category_name', $new_cat->category_name)->first()->category_id;

        $desc = $request->input("prod_description");

        $image = '';
        $image_url = '';

        // check if user uploaded an image for the product
        // upload to amazon S3 
        if($request->hasFile('image')) {
            $image = $request->file("image");
            $image_file_name = time() . '_' . $image->getClientOriginalName();

            // create a new instance of s3 to upload to AWS server
            \Storage::disk("s3")->put($image_file_name, file_get_contents($image), "public");

            $bucket_name = "s3prod-images";
            $region = "us-west-1";
            // Generate URL
            //https://s3-us-west-1.amazonaws.com/s3prod-images/Google-Nexus-10.jpg
            $image_url = "https://s3-" . $region . ".amazonaws.com/" . $bucket_name . "/" . $image_file_name;      
        }
        else {
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
    }
    else {
        // product already exists, simply get the prod_id
        //print 'prod already exists ' . $existing_product->prod_name;
        $prod_id = $existing_product->prod_id;
    }

    
    // add features to database for this product
    $spec_details = "";
    $feature_id = null;
    // check all input boxes
    for($i = 1; $i<11; $i++) {
        $spec_details = $request->input('spec' . $i);
        // check that the features are not empty
        if(strcmp($spec_details, "") != 0) {
            $existing_feature = Feature::where('feature_name', $spec_details)->first();
            // add feature to features table if none exists already
            if(empty($existing_feature)) {
                print 'feature ' . $spec_details . ' does not exist';
                $add_feat = new Feature;
                $add_feat->feature_name = $spec_details;
                $add_feat->save();

                // get feature_id of newly added feature
                $feature_id = $add_feat->feature_id;
            }
            else {
                // it does exist, simply get id of feat
                $feature_id = $existing_feature->feature_id;
            }

            // check if this product already has this feature
            $prod_feat = Feature_Rating_Total::where([
                                    "prod_id"    => $prod_id,
                                    "feature_id" => $feature_id])
                                      ->first();  
            if(empty($prod_feat)) {
                // tie product to that feature
                $new_prod_feat = new Feature_Rating_Total; 
                $new_prod_feat->prod_id = $prod_id;
                $new_prod_feat->feature_id = $feature_id;
                $new_prod_feat->save();
            }
        }
    }

    // check if product was reviewed by admin
    if(Admin::find(Auth::user()->user_id) != null) {
        // publish product on website
        if($existing_product) {
            $existing_product->isPublished = 1;
            $existing_product->save();
        }
        
    }

    // show success message to user after adding product
    return Redirect::to('/addproduct')->with([
                    'alert-type'=> 'alert-success',
                    'status' => 'Successfully Added Product']);

}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // find product to update
        $product = Product::find($id);
        //var_dump($product);
        if(empty($product)) {
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $product = Product::find($id);
        if(empty($product)) {
            return new Response('Product not found', 404);
        }
        $product->delete();
    }

    // change isPublished flag on product to be published and see on site
    public function publishProduct(Request $req) {
        $prod_id = $req->input('productID');
        $product = Product::find($prod_id);
        $product->isPublished = 1;
        $product->save();
    }
}
