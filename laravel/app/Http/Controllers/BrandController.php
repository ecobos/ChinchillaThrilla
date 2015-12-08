<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Brand;
use Illuminate\Http\Response;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use DB;

/**
 * Class BrandController
 * Controls the retrieval, creation, deletion, and searching of brands
 * @package App\Http\Controllers
 */
class BrandController extends ApiGuardController
{
    /**
     * Get list of brands based on search name
     *
     * @param string $name is the brand name
     * @return mixed List of brands. Otherwise, 404 if no brand is found
     */
    public function getBrandByName($name) {
        $brands = Brand::where('brand_name', 'like', '%' . $name . '%')->get();
        if(empty($brands)) {
            return new Response('Product not found', 404);
        }
        return $brands->toArray();
    }

    /**
     * Get specific brand name based on ID
     *
     * @param string $id is the brand ID
     * @return mixed The desired brand. Otherwise, 404 if not brand is found with $id
     */
    public function getBrand($id) {
        $brand = Brand::find($id);

        // if brand is not found, return 404
        if(empty($brand)) {
            return new Response('Product not found', 404);
        }
        return $brand->brand_name;
    }

    /**
     * Gets all brands in database
     *
     * @return array of brands
     */
    public function getBrands() {
        $brands = Brand::all();
        return $brands->toArray();
    }

    /**
     * Creates new brand in database
     *
     * @param Request $request is the request POSTed
     * @return Response 400 Bad Request if request is missing fields
     */

    public function create(Request $request)
    {
        // get brand name from the POST request
        $brand_name = $request->input("brand_name");

        if($brand_name) {
            // save new brand
            $new_brand = new Brand;
            $new_brand->brand_name = $brand_name;
            $new_brand->save();
        }
        else {
            return new Response('Malformed json request', 400);
        }
    }

    /**
     * Updates an existing brand in database
     *
     * @param Request $request is the request POSTed
     * @param string $id is the brand id
     * @return Response 404 if brand is not found
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
     * Deletes a brand from database
     *
     * @param string $id is the brand ID
     * @return Response 404 if brand is not found
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
