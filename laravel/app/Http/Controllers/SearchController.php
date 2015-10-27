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
        $results = DB::table('products')
                    -> select('prod_name')
                    -> where('prod_name', 'LIKE', "%{$query}%")->get();
        return var_dump($results);
    }

    public function getProductsByCategory ($query)
    {
        $results = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'products.prod_id')
                    -> select('prod_name', 'category_name')
                    -> where('category_name', 'LIKE', "%{$query}%")->get();
        return var_dump($results);
    }
}
