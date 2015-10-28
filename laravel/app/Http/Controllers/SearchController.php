<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class SearchController extends Controller
{
    public function getProducts ($query)
    {
        $results = array ();
        $words = explode (" ", $query);

        foreach ($words as $w)
        {
            // Getting DB result
            $result = DB::table('products')
                    -> select('prod_name')
                    -> where('prod_name', 'LIKE', "%{$w}%")
                    -> get();

            // adding it array of datas
            foreach ($result as $r) 
                $results[] = $r;
        }

        return var_dump($results);
    }

    public function getProductsByCategory ($query)
    {
        $results = array ();
        $words = explode (" ", $query);

        foreach ($words as $w)
        {
            // Getting DB result
            $result = DB::table('products')
                        -> join('categories', 'products.prod_category', '=', 'categories.category_id')
                        -> select('products.prod_name','categories.category_name')
                        -> where('category_name', 'LIKE', "%{$query}%")
                        -> get();

            // adding it array of datas
            foreach ($result as $r) 
                $results[] = $r;
        }
        return var_dump($results);
    }



    public function getProductsByBrand ($query)
    {
        $results = array ();
        $words = explode (" ", $query);

        foreach ($words as $w)
        {
            // Getting DB result
            $result = DB::table('products')
                        -> join('brands', 'products.prod_brand', '=', 'brands.brand_id')
                        -> select('products.prod_name','brands.brand_name')
                        -> where('brand_name', 'LIKE', "%{$query}%")
                        -> get();

            // adding it array of datas
            foreach ($result as $r) 
                $results[] = $r;
        }
        return var_dump($results);
    }



}
