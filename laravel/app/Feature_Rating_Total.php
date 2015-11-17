<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature_Rating_Total extends Model
{
    protected $table = 'feature_rating_totals';
    protected $primary = ['user_id','prod_id','feature_id'];
    protected $fillable = ['score', 'total_votes'];
}
