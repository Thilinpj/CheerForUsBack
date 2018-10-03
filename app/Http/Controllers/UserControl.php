<?php

namespace App\Http\Controllers;
use App\SignUp;
use App\Admin;
use App\Institute;
use App\User;
use Illuminate\Http\Request;

class UserControl extends Controller


{
    private $customerValidate = [
     'name' =>'required|unique:sign_ups|min:3|max:32',
     'email'=>'required|unique:sign_ups|email',
     'password'=>'required|min:5|max:32',
     'confirm_password'=>'same:password',
    ];
    private $adminValidate = [
        'name' =>'required|unique:admins|min:3|max:32',
        'email'=>'required|unique:admins|email',
        'password'=>'required|min:5|max:32',
        'confirm_password'=>'same:password',
       ];

    private $instituteValidate = [
        'name' =>'required|unique:institutes|min:3|max:32',
        'email'=>'required|unique:institutes|email',
        'address_line1'=>'required',
        'address_line2' => 'required',
        'city' => 'required',
        'province' => 'required',
        'country' => 'required',
        'postal_code' => 'required',
        'password'=>'required|min:5|max:32',
        'confirm_password'=>'same:password',
       ];

   public function customerSignUp(Request $request){
$request->validate($this->customerValidate);
    $detail=new SignUp();
    $detail->name = $request->name;
    $detail->email = $request->email;
    $detail->password = bcrypt($request->password);
    $detail->confirm_password = bcrypt($request->confirm_password);
    $detail->save();
    $details=SignUp::all();
    return response()->json($details) ;
   }
   public function adminSignUp(Request $request){
    $request->validate($this->customerValidate);


    $common=new User();
    $common->name = $request->name;
    $common->email = $request->email;
    //$common->userType=$request='admin';
    $common->password = bcrypt($request->password);
    $common->save();  
    $commons=User::all();
    return response()->json($commons) ;

        $detail=new Admin();
        $detail->name = $request->name;
        $detail->email = $request->email;
        $detail->password = bcrypt($request->password);
        $detail->confirm_password = bcrypt($request->confirm_password);
        $detail->save();
        $details=Admin::all();
        return response()->json($details) ;



       }
    public function instituteSignUp(Request $request){
        $request->validate($this->instituteValidate);
        $detail=new Institute();
        $detail->name = $request->name;
        $detail->email = $request->email;
        $detail->address_line1= $request->address_line1;
        $detail->address_line2= $request->address_line2;
        $detail->city= $request->city;
        $detail->province= $request->province;
        $detail->country = $request->country;
        $detail->postal_code = $request->postal_code;
        $detail->password = bcrypt($request->password);
        $detail->confirm_password = bcrypt($request->confirm_password);
        $detail->save();
        $details=Institute::all();
        return response()->json($details) ;
    }

}
