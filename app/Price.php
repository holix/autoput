<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['tollbooth1_id', 'tollbooth2_id', 'category_id', 'value'];

    protected $casts = [
        'value' => 'float'
    ];
}
