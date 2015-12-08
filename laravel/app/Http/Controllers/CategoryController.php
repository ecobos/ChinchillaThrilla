<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Response;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use DB;

/**
 * Class CategoryController
 * Controls the retrieval, creation, deletion and searching of categories
 * @package App\Http\Controllers
 */
class CategoryController extends ApiGuardController
{
    // methods that don't need api key authentication
    protected $apiMethods = [
        'getCategories' => [
            'keyAuthentication' => false
        ],
    ];

    /**
     * Get list of categories based on search name
     *
     * @param string $name is the brand name
     * @return array of brands; 404 if no brands by that name exists
     */
    public function getCategoryByName($name) {
        $categories = Category::where('category_name', 'like', '%' . $name . '%')->get();
        if(empty($categories)) {
            return new Response('Product not found', 404);
        }
        return $categories->toArray();
    }

    /**
     * Gets a category by name using its ID
     *
     * @param string $id is the category ID
     * @return mixed the desired category name. Otherwise, 404 if no category by that name exists
     */
    public function getCategory($id) {
        $cat = Category::find($id);
        // no category found by ID
        if(empty($cat)) {
            return new Response('Product not found', 404);
        }

        return $cat->category_name;
    }

    /**
     * Gets all categories in database
     *
     * @return array of categories
     */
    public function getCategories() {
        $categories = Category::all();
        return $categories->toArray();
    }

    /**
     * Creates a new category in database
     *
     * @param Request $request is the request POSTed
     * @return Response 400 if json POST request is malformed
     */
    public function create(Request $request)
    {
        // get the data from the POST request
        $cat_name = $request->input("category_name");

        // check if category name was posted correctly
        if($cat_name) {
            // save new category
            $new_category = new Category;
            $new_category->category_name = $cat_name;
            $new_category->save();
        }
        else {
            return new Response('Malformed json request', 400);
        }
    }

    /**
     * Updates existing category in database based on ID
     * @param Request $request is the request POSTed
     * @param string $id the id of category to update
     * @return Response 404 if category is not found in database
     */
    public function update(Request $request, $id)
    {
        // find category to update
        $cat = Category::find($id);
        if(empty($cat)) {
            return new Response('Product not found', 404);
        }
        // Update category
        $cat->category_name = $request->input("category_name");
        $cat->save();    
    }

    /**
     * Deletes existing category from database
     *
     * @param string $id the category ID
     * @return Response 404 if category is not found
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
