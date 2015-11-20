<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Review;
use \DateTime;
use DB;

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

    // making static call to database to ensure our view is working 
    // This is Gil's view... will replace profile view returned in profile func
    public function userAccount($user_id) {
        $user = User::find($user_id);
        // check for no results, display user not found page
        if(empty($user)) {
            return view('user404');
        }
        // else; get data and return view
        $name = $user->name;
        $avatar_link = $user->avatar;

        // if using facebook's avatar pic, change the avatar type to large
        if($user->auth_provider == 'facebook') {
            $avatar_link = str_replace('normal', 'large', $avatar_link);
        }
        elseif($user->auth_provider == 'google') {
            // if using google's avatar pic, change pic size to 200
            $avatar_link = substr($avatar_link, 0, strlen($avatar_link)-2) . '200';
        }
        
        // get date in DD/MM/YY format
        $date_time = new DateTime($user->created_at);
        $member_since_date = $date_time->format('m-d-Y');

        // get number of review made by this user
        $total_reviews = Review::where('user_id', $user_id)->count();

        return view('user_account_public', compact('name', 'avatar_link', 'member_since_date', 'total_reviews'));
    }
}
