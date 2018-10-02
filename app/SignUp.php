<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignUp extends Model
{
    protected $fillable = [
        'name', 'email','password',
    ];
}
