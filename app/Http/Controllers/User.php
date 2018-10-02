<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller


{

    // private $customerValidate = [
    //     'name' => 'required|unique:users|min:2|max:32',
    //     'email' => 'required',
    //     // 'avatar' => 'image|max:1999',
    //     // 'user_type' => 'required|in:admin,customer,institute',
    //     'password' => 'required|min:4|max:32',
    //     // 'confirm_password' => 'same:password',
    //     // 'first_name' => 'required',
    //     // 'last_name' => 'required',
    //     // 'phone_number' => 'required',
    //     // 'birthday' => 'required|date_format:Y-m-d',
    //     // 'gender' => 'required|in:male,female'
    // ];

   public function customerSignUp(Request $request){

    $request=new SignUp();
    $request->name = $request->name;
    $request->email = $request->Input('email');
    $request->password = $request->password;
    $request->save();
    $requests=SignUp::all();
   }


}
