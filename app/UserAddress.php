<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'line_1',
        'line_2',
        'city',
        'state',
        'zip_code',
    ];
}
