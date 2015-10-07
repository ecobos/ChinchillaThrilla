<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    // returns faux profile page
    public function profile()
    {
    	//$name = 'Kelby Sapien';
    	//$user = []
    	//$user['first'] = 'Jane';
    	//$user['last'] = 'Doe';
    	//$user['email'] = 'jdoe@gmail.com';
    	$first = 'Jane';
    	$last = 'Doe';
    	$email = 'jdoe@gmail.com';
    	//return view('user_account'->with('name', $name);
    	return view('user_account', compact('first', 'last', 'email'));
    }

    // returns page with passed in $page_name
    public function about() {
    	$page_name = 'About The Team';

    	return view('about', compact('page_name'));
    }

    // returns static home page
    public function home() {

        return view('welcome');
    }
}
