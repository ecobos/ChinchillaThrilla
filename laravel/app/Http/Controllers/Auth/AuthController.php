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
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'doLogout']);
    }


    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function authRedirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleFacebookCallback()
    {
        try{
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e){
            return Redirect::to('auth/facebook');
        }


        $authUser = $this->findOrCreateUser($user, 'facebook');

        Auth::login($authUser, true);

        $name = $authUser->name;
        $email = $authUser->email;
        $avatar = $authUser->avatar;

        return Redirect::to('/profile');
    }

    /**
     *
     * @param $aUser
     * @return static
     */
    private function findOrCreateUser($aUser, $authProvider){

        if($authUser = User::where('app_id', $aUser->id)->where('auth_provider', $authProvider)->first()){
            return $authUser;
        }

        return User::create([
            'auth_provider' => $authProvider,
            'app_id' => $aUser->id,
            'name' => $aUser->name,
            'email' => $aUser->email,
            'avatar' => $aUser->avatar
        ]);
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function authRedirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleGoogleCallback()
    {

        try{
            $user = Socialite::driver('google')->user();
        } catch (Exception $e){
            return Redirect::to('auth/google');
        }


        $authUser = $this->findOrCreateUser($user, 'google');

        Auth::login($authUser, true);

        return Redirect::to('/profile');
    }

    public function doLogout(){
        Auth::logout();

        return Redirect::to('/')->with([
            'alert-type' => 'alert-success',
            'status' => 'Successfully Logged Out. See you later!'
        ]);
    }

    public function doLogin(){
        return view('auth.login_page');
    }
}
