<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Response;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use DB;

class CategoryController extends ApiGuardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // get list of categories based on search name
    public function getCategoryByName($name) {
        $categories = Category::where('category_name', 'like', '%' . $name . '%')->get();
        if(empty($categories)) {
            return new Response('Product not found', 404);
        }

        return $categories->toArray();
    }

    // get specific category based on ID
    public function getCategory($id) {
        $cat = Category::find($id);

        if(empty($cat)) {
            return new Response('Product not found', 404);
        }

        // get each field if passing over to view
        $cat_name = $cat->category_name;

        // else return the entire object
        return $cat;
    }

    // get all categories in database
    public function getCategories() {
        $categories = Category::all();
        return $categories->toArray();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // get the data from the POST request
        $cat_name = $request->input("category_name");

        // POST new category
        $new_category = new Category; 
        $new_category->category_name = $cat_name;
        $new_category->save();
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
        // find cat to update
        $cat = Category::find($id);
        if(empty($cat)) {
            return new Response('Product not found', 404);
        }
        // Update brand
        $cat->category_name = $request->input("category_name");
        $cat->save();    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $cat = Category::find($id);
        if(empty($cat)) {
            return new Response('Product not found', 404);
        }
        $cat->delete();
    }
}
