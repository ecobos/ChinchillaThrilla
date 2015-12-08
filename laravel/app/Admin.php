<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Admin extends Model
{
    protected $primaryKey = 'admin_id';

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
    protected $fillable = ['admin_id'];

    public function makeAdmin($user_id){

        // Make sure that the user actually exists in the user's table
        $integrity_check = User::find($user_id)->first();

        // If a record was found for the user then we can add the user into the admins table
        if(!is_null($integrity_check)){
            $this->create([
               'admin_id' => $user_id
            ]);
            return true;
        }
    }
}
