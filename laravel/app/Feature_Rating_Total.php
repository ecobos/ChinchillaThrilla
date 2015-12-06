<?php

// NOTE: All function associating this class are found within Feature.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature_Rating_Total extends Model
{
	// Explicit Table name
    protected $table = 'feature_rating_totals';
    // Explicit Primary Key
    protected $primary = ['user_id','prod_id','feature_id'];
    protected $fillable = ['score', 'total_votes'];
}
