<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class SearchController extends Controller
{

    /*
        Returns the Search Page
    */
    public function index() {
        return view('search');
    }

    /*
        Searches database for products
        - Input:
        -   The search query (eg "samsung galaxy")
        -   The search type (expecting 'product', 'category', or 'brand')
        - Output:
        -   A list of products found from search including:
        -       'prod_name', 'prod_id', 'url'
    */
    public function getProducts (Request $request)
    {
        // Results to return
        $results = array ();

        // Seperate query by spaces and search for each word
        $words = explode (" ", $request->input('query'));
        foreach ($words as $w)
        {
            // Getting DB result
            $db_result = array();

            // search Products
            if($request->input('type') == "product")        
            {
                $db_result = DB::table('products')
                        -> select('*')
                        -> where('prod_name', 'LIKE', "%{$w}%")
                        -> get();
            }

            // search Categories
            else if($request->input('type') == "category")  
            {
                // Getting DB result
                $db_result = DB::table('products')
                            -> join('categories', 'products.prod_category', '=', 'categories.category_id')
                            -> select('products.*','categories.category_name', 'products.prod_id')
                            -> where('category_name', 'LIKE', "%{$w}%")
                            -> get();
            }

            // search Brands
            else if($request->input('type') == "brand")     
            {
                // Getting DB result
                $db_result = DB::table('products')
                            -> join('brands', 'products.prod_brand', '=', 'brands.brand_id')
                            -> select('products.*','brands.brand_name')
                            -> where('brand_name', 'LIKE', "%{$w}%")
                            -> get();
            }

            // Unioning this search result with other results
            foreach ($db_result as $product){
                $product->url = "/product/{$product->prod_id}";
                $results[] = $product;
            }
        }

        return view('search_results')->with(
            [
                'results'   => $results,
                'query'     => $request->input('query'),
            ]
        );
    }

    // public function getProductsByCategory ($query)
    // {
    //     $results = array ();
    //     $words = explode (" ", $query);

    //     foreach ($words as $w)
    //     {
    //         // Getting DB result
    //         $db_result = DB::table('products')
    //                     -> join('categories', 'products.prod_category', '=', 'categories.category_id')
    //                     -> select('products.prod_name','categories.category_name', 'products.prod_id')
    //                     -> where('category_name', 'LIKE', "%{$query}%")
    //                     -> get();

    //         // adding it array of datas
    //         foreach ($db_result as $product){
    //             $product->url = "/product/{$product->prod_id}";
    //             $results[] = $product;
    //         } 
    //     }
    //     return view('test')->with(
    //         [
    //             'results'   => $results,
    //             'query'     => $query,
    //         ]
    //     );
    // }



    // public function getProductsByBrand ($query)
    // {
    //     $results = array ();
    //     $words = explode (" ", $query);

    //     foreach ($words as $w)
    //     {
    //         // Getting DB result
    //         $db_result = DB::table('products')
    //                     -> join('brands', 'products.prod_brand', '=', 'brands.brand_id')
    //                     -> select('products.prod_name','brands.brand_name', 'products.prod_id')
    //                     -> where('brand_name', 'LIKE', "%{$query}%")
    //                     -> get();

    //         // adding it array of datas
    //         foreach ($db_result as $product){
    //             $product->url = "/product/{$product->prod_id}";
    //             $results[] = $product;
    //         }
    //     }
    //     return view('test')->with(
    //         [
    //             'results'   => $results,
    //             'query'     => $query,
    //         ]
    //     );
    // }



}
