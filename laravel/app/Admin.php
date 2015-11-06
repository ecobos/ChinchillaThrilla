<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Admin extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id'];

    public function makeAdmin($user_id){
        // Make sure that the user actually exists in the User's table
        $integrity_check = User::find($user_id)->first();

        if(!is_null($integrity_check)){
            $this->create([
               'user_id' => $user_id
            ]);
            return true;
        }
    }
}
