<?php

namespace App\Http\Controllers;

use App\Http\Requests;

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

    public function 

}
