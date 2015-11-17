<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature_Rating extends Model
{
    protected $table = "feature_ratings";
    protected $primary = ['user_id','prod_id','feature_id'];
}
