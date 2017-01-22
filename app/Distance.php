<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distance extends Model
{
    protected $fillable = ['tollbooth1_id', 'tollbooth2_id', 'value'];

    protected $casts = [
        'value' => 'integer'
    ];
}
