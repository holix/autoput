<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['claim_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tollbooth() {
        return $this->belongsTo(Tollbooth::class);
    }

    public function claim() {
        return $this->belongsTo(Claim::class);
    }
}
