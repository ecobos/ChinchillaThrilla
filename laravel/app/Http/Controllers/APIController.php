<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\User;

/**
 * Class APIController
 * Controls the creation, deletion and retrieval of API keys
 * @package App\Http\Controllers
 */
class APIController extends ApiGuardController
{
    /**
     * Specifies which method are guarded by API key and the authorization level needed
     */
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
     * Grant API access to a specific user by creating an API key for them
     * @param Request $request is the request POSTed
     * @return Response 200 (ok) if able to create API key; 404 if not a valid user; 400 if user has an API key already
     */
    public function create(Request $request)
    {

        // get User ID from request
        $userID = $request->input("user_id");
        // check whether this user already has an API key
        $apiKey = ApiKey::where('user_id', $userID)->first();

        if ($apiKey) {
            return new Response('This user already has an API key', 400);
        }
        else {
            $user = User::find($userID);
            if(empty($user)) {
                return new Response('This is not a valid user. Try again.', 404);
            }
        }

        // create API key for user if the above checks are passed
        $apiKey = new ApiKey;
        $apiKey->key = $apiKey->generateKey();
        $apiKey->user_id = $userID;
        $apiKey->level = 1;

        $apiKey->save(); // save API key in database
    }

    /**
     * Retrieves the API key for a user
     * @param $user_id is the ID of the user
     * @return Response 200 (ok) if API key is found; 404 otherwise
     */
    public function get($user_id) {
        print 'get ' . $user_id;
        $apiKey = ApiKey::where('user_id', $user_id);
        if(empty($apiKey)) {
            return new Response('API key for that ID not found');
        }
        return $apiKey;
    }

    /**
     * Revoke access to anyone who misuses API key
     * @param $user_id is the id of the user
     * @return Response 404 if user is not found
     */
    public function delete($user_id)
    {
        $apiKey = ApiKey::where('user_id', $user_id);
        if(empty($apiKey)) {
            return new Response('API key for that ID not found', 404);
        }
        $apiKey->delete(); // delete from database
    }
}
