<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    // specifiy our primary key field
    protected $primaryKey = 'user_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['auth_provider', 'app_id', 'name', 'email', 'avatar'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['auth_provider', 'app_id', 'remember_token'];

    /**
     * Check if the user is an admin.
     *
     * @return bool true if the user is also in the admin's table. False otherwise.
     */
    public function isAdmin()
    {
        // Check if the user 'hasOne' entry in the admins table
        $check = $this->hasOne('App\Admin')->first();

        // If nothing is returned then false
        return is_null($check) ? false : true;
    }

}
