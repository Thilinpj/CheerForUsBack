<?php

namespace App;

use Illuminate\Database\Eloquent\Model;




class SignUp extends Model
{
    protected $fillable = [
        'user_id','name', 'email','password','confirm_password'
    ];
}
