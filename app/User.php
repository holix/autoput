<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'admin',
    ];

    protected $casts = [
        'admin' => 'bool'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
