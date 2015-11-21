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

    public function pageNotFound(){
        return view('404');
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

}
