<?php

namespace App\Http\Controllers;
use App\SignUp;
use App\Admin;
use App\Institute;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserControl extends Controller


{
    public $successStatus = 200;
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
       $user=new User([
           'name' => $request->name,
           'email' => $request->email,
           'user_type'=>"customer",
           'password' => bcrypt($request->password),
           //'confirm_password' => bcrypt($request->confirm_password)
       ]);
       $user->save();

    $customer=new SignUp([
        'user_id'=>$user->id,
        'name' => $request->name,
       'email' => $request->email,
      'password' => bcrypt($request->password),
      'confirm_password' => bcrypt($request->confirm_password)
    ]);
     $customer->save();
     $customers=SignUp::all();
    return response()->json($user) ;
   }


   public function adminSignUp(Request $request){

    $request->validate($this->adminValidate);
    $user=new User([
        'name' => $request->name,
       'email' => $request->email,
       'user_type'=>"admin",
       'password' => bcrypt($request->password),
        //'confirm_password' => bcrypt($request->confirm_password)
    ]);

       $user->save();
       $users=User::all();


        $admin=new Admin([
            'user_id'=>$user->id,
            'name' => $request->name,
            'email' => $user->email,
            'password' => bcrypt($request->password),
            'confirm_password' => bcrypt($request->confirm_password)
        ]);

        $admin->save();
        $admins=Admin::all();
        return response()->json($admins) ;



       }
    public function instituteSignUp(Request $request){
        $request->validate($this->instituteValidate);

        $user=new User([
            'name' => $request->name,
            'email' => $request->email,
            'user_type'=>"institute",
            'password' => bcrypt($request->password),
            //'confirm_password' => bcrypt($request->confirm_password)
        ]);
        $user->save();

        $institute=new Institute([
            'user_id'=>$user->id,
           'name' => $request->name,
           'email' => $request->email,
            'address_line1'=> $request->address_line1,
            'address_line2'=> $request->address_line2,
            'city'=> $request->city,
            'province'=> $request->province,
           'country' => $request->country,
          'postal_code' => $request->postal_code,
          'password' => bcrypt($request->password),
            'confirm_password' => bcrypt($request->confirm_password),
        ]);
       
        $institute->save();
        $institutes=Institute::all();
        return response()->json($institute) ;
    }


    public function login(){

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function details($id) 
    { 
        $user = Auth::user(); 
        $user = User::where('id',$id)->get();
        return response()->json($user);
       // return response()->json(['success' => $user], $this-> successStatus); 
    } 
}
