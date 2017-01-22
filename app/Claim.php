<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = ['plates', 'category_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tollbooth() {
        return $this->belongsTo(Tollbooth::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
