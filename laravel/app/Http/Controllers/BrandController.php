<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Brand;
use Illuminate\Http\Response;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use DB;

class BrandController extends ApiGuardController
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

    // get list of brands based on search name
    public function getBrandByName($name) {
        $brands = Brand::where('brand_name', 'like', '%' . $name . '%')->get();
        if(empty($brands)) {
            return new Response('Product not found', 404);
        }

        return $brands->toArray();
    }

    // get specific brand based on ID
    public function getBrand($id) {
        $brand = Brand::find($id);

        if(empty($brand)) {
            return new Response('Product not found', 404);
        }

        // get each field if passing over to view
        $brand_name = $brand->brand_name;

        // else return the entire object
        return $brand;
    }

    // get all brands in database
    public function getBrands() {
        $brands = Brand::all();
        return $brands->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // get the data from the POST request
        $brand_name = $request->input("brand_name");

        // POST new brand
        $new_brand = new Brand; // 
        $new_brand->brand_name = $brand_name;
        $new_brand->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        // find brand to update
        $brand = Brand::find($id);
        
        if(empty($brand)) {
            return new Response('Product not found', 404);
        }
        // Update brand
        $brand->brand_name = $request->input("brand_name");
        $brand->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $brand = Brand::find($id);
        if(empty($brand)) {
            return new Response('Product not found', 404);
        }
        $brand->delete();
    }
}
