<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\User;

class APIController extends ApiGuardController
{
    protected $apiMethods = [
        'create' => [
            'level' => 10
        ],
        'delete' => [
            'level' => 10
        ],
        'get' => [
            'keyAuthentication' => false
        ],
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /*
    Grant API access to a specific user
    */
    public function create(Request $request)
    {
        //$apiKey = new Chrisbjr\ApiGuard\ApiKey;
        // check whether this user already has an API key

        // get User ID from request
        $userID = $request->input("user_id");
        print $userID;

        $apiKey = ApiKey::where('user_id', $userID)->first();
        print $apiKey;
        if ($apiKey) {
            return new Response('This user already has an API key');
        }
        else {
            $user = User::find($userID);
            if(empty($user)) {
                return new Response('This is not a valid user. Try again.'); 
            }
        }

        // create API key for user if the above checks work
        //$apiKey = App::make(Config::get('apiguard.model', 'Chrisbjr\ApiGuard\Models\ApiKey'));
        $apiKey = new ApiKey;
        $apiKey->key = $apiKey->generateKey();
        $apiKey->user_id = $userID;
        $apiKey->level = 1;

        print 'Your key: ' . $apiKey->key;
        $apiKey->save();
    }

    /* 
    ID is the API key ID...
    We can change that ID to be the user ID or so... depending on the use case.
    */
    public function get($id) {
        $apiKey = ApiKey::find($id);
        if(empty($apiKey)) {
            return new Response('API key for that ID not found', 404);
        }
        return $apiKey;
    }


    /*
    Revoke access to anyone who misbehaves
    */
    public function delete($id)
    {
        $apiKey = ApiKey::find($id);
        if(empty($apiKey)) {
            return new Response('API key for that ID not found', 404);
        }
        $apiKey->delete();
    }
}
