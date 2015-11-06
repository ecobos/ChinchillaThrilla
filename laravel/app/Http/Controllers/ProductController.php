<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Response;
use DB;

// 'php artisan tinker' to test the model classes
class ProductController extends Controller
{
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
        
        if(empty($product)) {
            // return 404 view
            return view('404');
        }

        // get all data to pass on over to view
        $name = $product->prod_name;
        $model = $product->prod_model;
        $brand = $product->prod_brand;
        $category = $product->prod_category;
        $desc = $product->prod_description;
        $rating = $product->overall_rating;
        $img_path = $product->prod_img_path;

        // return product page for this product
        return view('product_page', compact('brand', 'name', 'model', 'desc', 'rating', 'img_path'));
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

    // Creates a product based on information received from POST request
    public function create(Request $request)
    {   
        var_dump($request);
        // get the data from the POST request (assuming JSON data was posted... keys need to match the ones in parantheses)
        $name = $request->input("prod_name");
        print $name;
        $model = $request->input("prod_model");
        $brand = $request->input("prod_brand");
        $category = $request->input("prod_category");
        $desc = $request->input("prod_description");
        $rating = $request->input("overall_rating");
        $img_path = $request->input("prod_img_path");

        /*
        Product::create(["prod_name" => $name, 
                         "prod_model" => $model,
                         "prod_brand" => $brand,
                         "prod_category" => $category, 
                         "prod_description" => $desc,
                         "overall_rating" => $rating,
                         "prod_img_path" => $img_path]);
                         */
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
}
