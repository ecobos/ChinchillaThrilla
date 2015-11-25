<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
        // Default values
        $user = null;
        //$name = "";//= "John Doe";
        //$avatar = ""; //= "http://www.garderoba.si/image/cache/data/MAJICE_GARDEROBA.si/M/meme-pokerface-KVADRAT-600x600.png";


        // If a user ID was specified, check if it exists or fail
        if(isset($id)){
            try{
                $user = User::findOrFail($id);
            } catch (ModelNotFoundException $e){
                return Redirect::action('PagesController@pageNotFound');
            }
            $page = 'user_account_public';
            $name = $this->makeDiscrete($user->name);

            // get date in DD/MM/YY format
            $date_time = new DateTime($user->created_at);
            $member_since_date = $date_time->format('m-d-Y');

            // get number of review made by this user
            $total_reviews = Review::where('user_id', $id)->count();
            $usefulness = Review::where('user_id', $id)->sum('total_usefulness');

            $base_info = array( 'page_title' => "User Profile",
                                'name' => $name,
                                'avatar' => $user->avatar,
                                'member_since_date' => $member_since_date,
                                'total_reviews' => $total_reviews,
                                'total_usefulness' => $usefulness);
            $reviews = array();
        }
        else if(Auth::check()){
            $page = 'user_account';
            $user = Auth::user();
            $id = $user->user_id;
            //var_dump($user);

            // get date in DD/MM/YY format
            $date_time = new DateTime($user->created_at);
            $member_since_date = $date_time->format('m-d-Y');

            //$reviews = Review::select('prod_id','review_text','created_at')->where('user_id', $id)->get();

            // Returns an array of reviews and associated products
            $reviews = DB::table('reviews')->select('products.prod_id','products.prod_name','products.prod_img_path','reviews.review_text','reviews.created_at')
                                            ->join('products', 'products.prod_id', '=', 'reviews.prod_id')
                                            ->where('user_id', $id)->get();

            $usefulness = Review::where('user_id', $id)->sum('total_usefulness');

            $base_info = array( 'page_title' => "My Profile",
                                'name' => $user->name,
                                'email' => $user->email,
                                'auth_type' => $user->auth_provider,
                                'avatar' => $user->avatar,
                                'member_since_date' => $member_since_date,
                                'total_reviews' => count($reviews),
                                'total_usefulness' => $usefulness);
        }
        else{
            return Redirect::to('/auth/login')->with('alert-type', 'alert-danger')->with('status', 'Please Login');
        }

        // if using facebook's avatar pic, change the avatar type to large
        /*if($user->auth_provider == 'facebook') {
            $avatar = str_replace('normal', 'large', $avatar);
        }
        elseif($user->auth_provider == 'google') {
            // if using google's avatar pic, change pic size to 200
            $avatar = substr($avatar, 0, strlen($avatar)-2) . '200';
        } */

        return view($page)->with('base_info', $base_info)->with('reviews', $reviews);
    }

    /**
     * Converts a user's full name to a more discrete name by truncating the last name to the first character.
     *
     * Ex. Edgar Cobos  --> Edgar C.
     *
     * @param string $name a user's first or full name
     * @return string name with last name truncated to first character
     */
    private function makeDiscrete($name){
        $tmp_name = explode(" ", $name);
        if(isset($tmp_name[1]) && isNonEmptyString($tmp_name[1])){
            $tmp_name[1] = substr($tmp_name[1], 0 ,1 );
            $name = implode(" ", $tmp_name);
        }
        return $name;
    }


    public function adminPanel(){
        $user = Auth::user();

        $base_info = array( 'page_title' => "Administrator Account",
                            'name' => $user->name,
                            'email' => $user->email,
                            'avatar' => $user->avatar );

        $reviews = Review::select('prod_id','review_text','created_at')->where('user_id', 104)->get()->toArray();
        //return view('user_account_admin', compact('page_title','name', 'email', 'avatar'));
        return view('user_account_admin')->with('base_info', $base_info)->with('reviews', $reviews);
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
