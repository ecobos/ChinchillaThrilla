<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminsOnly', ['only' => 'adminPanel']);
    }


    public function profile($id = null)
    {
        // Define the default user values
        $user = ''; //no user
        $name_default = "John Doe";
        $email_default = "sadpanda@gmail.com";
        $avatar_default = "http://www.garderoba.si/image/cache/data/MAJICE_GARDEROBA.si/M/meme-pokerface-KVADRAT-600x600.png";

        // If a user ID was specified, check if it exists or fail
        if(isset($id)){
            try{
                $user = User::findOrFail($id);
            } catch (ModelNotFoundException $e){
                return Redirect::action('PagesController@pageNotFound');
            }

        }
        else if(Auth::user()){
            $user = Auth::user();
        }

        $name = isset($user->name) ? $user->name : $name_default;
        $email = isset($user->email) ? $user->email : $email_default;
        $avatar = isset($user->avatar) ? $user->avatar : $avatar_default;

        return view('profile', compact('name', 'email', 'avatar'));
    }

    public function adminPanel(){

            echo "hello admin";


    }
}
