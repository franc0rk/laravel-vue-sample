<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'bio',
        'phone',
        'gender',
        'website',
        'birthday',
    ];
}
