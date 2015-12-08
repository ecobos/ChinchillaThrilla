<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance. Apply middleware.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'doLogout']);
    }


    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response status result of the redirect
     */
    public function authRedirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handles the Facebook callback once the user has authenticated with Facebook.
     * Obtains the user's information from Facebook.
     *
     * @return Response redirect user to their profile page
     */
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            // In case of an error, have the user try again
            return Redirect::to('auth/facebook');
        }

        // Check if the user is new or existing
        $authUser = $this->findOrCreateUser($user, 'Facebook');

        // Log the user into our system
        Auth::login($authUser, true);

        return Redirect::to('/profile');
    }

    /**
     * Check if a user exists in our database. If they exists, then restore that user.
     * Otherwise, create the new user.
     *
     * @param User $aUser the user to check
     * @return User the setup user
     */
    private function findOrCreateUser($aUser, $authProvider)
    {

        // Check if the user already exists in our system
        if ($authUser = User::where('app_id', $aUser->id)->where('auth_provider', $authProvider)->first()) {
            return $authUser;
        }

        // Order matters. Set avatar regardless of auth provider
        $avatar = $aUser->avatar;

        // If Google is the auth provider, then update the URL to get the higher quality image
        if ($authProvider == 'Google') {
            // if using google's avatar pic, change pic size to 300
            $avatar = substr($avatar, 0, strlen($avatar) - 2) . '300';
        }

        // Create and insert the user into the database
        return User::create([
            'auth_provider' => $authProvider,
            'app_id' => $aUser->id,
            'name' => $aUser->name,
            'email' => $aUser->email,
            'avatar' => $avatar
        ]);
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response status result of the redirect
     */
    public function authRedirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handles the Facebook callback once the user has authenticated with Google.
     * Obtains the user's information from Google
     *
     * @return Response redirect user to their profile page
     */
    public function handleGoogleCallback()
    {

        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            // In case of an error, have the user try again
            return Redirect::to('auth/google');
        }

        // Check if the user is new or existing
        $authUser = $this->findOrCreateUser($user, 'Google');

        // Log the user into our system
        Auth::login($authUser, true);

        return Redirect::to('/profile');
    }

    /**
     * Log a user out of the system
     *
     * @return Response redirect to the main page with logout feedback
     */
    public function doLogout()
    {
        // Log the user out of the system
        Auth::logout();

        // Redirect to the main page and provide feedback
        return Redirect::to('/')->with([
            'alert-type' => 'alert-success',
            'status' => 'Successfully Logged Out. See you later!'
        ]);
    }

    /**
     * Display the login page.
     *
     * @return View the login page
     */
    public function doLogin()
    {
        return view('auth.login_page');
    }
}
