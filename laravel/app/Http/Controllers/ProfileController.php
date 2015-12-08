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
use App\Product;

class ProfileController extends Controller
{
    /**
     * ProfileController constructor. Initialized the middleware
     */
    public function __construct()
    {
        $this->middleware('adminsOnly', ['only' => 'adminPanel']);
    }


    /**
     * Retieves and display the proper profile give the viewing user's login status.
     *
     * @param string $id
     * @return mixed
     */
    public function profile($id = null)
    {
        // Default values
        $user = null;

        // If a user ID was specified
        if(isset($id)){
            try{
                // Look up the user or fail
                $user = User::findOrFail($id);
            } catch (ModelNotFoundException $e){
                // If the user is not found, alert the user
                return Redirect::action('PagesController@pageNotFound');
            }
            // Define the view to be used
            $page = 'user_account_public';

            // Make the profile name discreet by truncating the last name to the first letter
            $name = $this->makeDiscrete($user->name);

            // Get date in DD/MM/YY format
            $date_time = new DateTime($user->created_at);
            $member_since_date = $date_time->format('m-d-Y');

            // Get number of review made by this user
            $total_reviews = Review::where('user_id', $id)->count();

            // Get the number of useful reviews made by the user
            $usefulness = Review::where('user_id', $id)->sum('total_usefulness');

            // Define the base user information retrieved from the database
            $base_info = array( 'page_title' => "User Profile",
                                'name' => $name,
                                'avatar' => $user->avatar,
                                'member_since_date' => $member_since_date,
                                'total_reviews' => $total_reviews,
                                'total_usefulness' => $usefulness
                            );
            $reviews = array();
        }
        // If no ID was specified and a user is currently logged in
        else if(Auth::check()){
            // Define the view to be used
            $page = 'user_account';

            // Get the currently authenticated user information
            $user = Auth::user();
            $id = $user->user_id;
            //var_dump($user);

            // Get date in DD/MM/YY format
            $date_time = new DateTime($user->created_at);
            $member_since_date = $date_time->format('m-d-Y');

            // Returns an array of reviews and associated products
            $reviews = DB::table('reviews')->select('products.prod_id','products.prod_name','products.prod_img_path','reviews.review_text','reviews.created_at')
                                            ->join('products', 'products.prod_id', '=', 'reviews.prod_id')
                                            ->where('user_id', $id)->get();

            // Get the number of useful reviews made by the user
            $usefulness = Review::where('user_id', $id)->sum('total_usefulness');

            // Define the base user information for the view
            $base_info = array( 'page_title' => "My Profile",
                                'name' => $user->name,
                                'email' => $user->email,
                                'auth_type' => $user->auth_provider,
                                'avatar' => $user->avatar,
                                'member_since_date' => $member_since_date,
                                'total_reviews' => count($reviews),
                                'total_usefulness' => $usefulness
                            );
        }
        // if no ID was specified and the user is not logged in
        else{
            // Redirect them to the login page with an alert
            return Redirect::to('/auth/login')->with([
                    'alert-type'=> 'alert-danger',
                    'status' => 'Please Login']);
        }

        // Display the appropriate page with proper user information
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
        // Split the name on the blank space
        $tmp_name = explode(" ", $name);

        // If a last name is set
        if(isset($tmp_name[1]) && isNonEmptyString($tmp_name[1])){
            // Truncate the last name to the first letter
            $tmp_name[1] = substr($tmp_name[1], 0 ,1 );
            // Glue together the last name with the first name
            $name = implode(" ", $tmp_name);
        }
        return $name;
    }


    /**
     * Get the reviews and new products that require admin approval.
     *
     * @return View the administrator panel
     */
    public function adminPanel(){
        // Get the logged in user
        $user = Auth::user();

        // Define the base information to be sent to the view
        $base_info = array( 'page_title' => "Administrator Account",
                            'name' => $user->name,
                            'email' => $user->email,
                            'avatar' => $user->avatar );

        // Get the reviews the need admin review and their associated user information
        $reviews_for_approval = Review::select('reviews.user_id', 'name', 'reviews.prod_id', 'prod_name', 'review_text', 'reviews.updated_at', 'avatar')
                    ->join('products', 'products.prod_id', '=', 'reviews.prod_id')
                    ->join('users', 'reviews.user_id', '=', 'users.user_id')
                    ->where('needsAdminReview', 1)->get()->sortBy('updated_at');


        // Get any unpublished products
        $products = Product::select('prod_id', 'prod_name', 'prod_description', 'prod_img_path')->where('isPublished', 0)->get();


        // Send the information to the proper view to be displayed
        return view('user_account_admin')->with(['base_info' => $base_info,
                                                'reviews' => $reviews_for_approval,
                                                'reviews_count' => $reviews_for_approval->count(),
                                                'products' => $products,
                                                'prodcuts_count' => $products->count()
                                            ]);

    }

}