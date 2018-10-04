<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    
    protected $fillable = [
        'user_id','name', 'email','password','confirm_password','address_line1','address_line2','city','province','country','postal_code'
    ];
}
