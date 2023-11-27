<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\customercredentials;
use App\Models\messaging; //use in other controllers
class signInFunction extends Controller
{
    function login(){
        return view('login');
    }
    function signup(){
        return view('signup');
    }
    function adminlogin(){
        return view('adminlogin');
    }
    function loginPost(Request $request){
        $request->validate([
            'ID' =>'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('ID','password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('homepage'));
        }
        return redirect(route('login'))->with("error", "invalid credentials");

    }
    function signupPost(Request $request){
      $request->validate([
        'firstName' => 'required',
        'lastName' => 'required',
        'phoneNo' => 'required',
        'ID' =>'required|unique:customercredentials',
        'password' => 'required'
      ]);  
      $data['fName'] = $request->firstName;
      $data['lName']  = $request->lastName;
      $data['phone']   = $request->phoneNo;
      $data['ID'] = $request->ID;
      $data['password'] = Hash::make($request->password); 
      $user = customercredentials::create($data);
      if(!$user){
        return redirect(route('signup'))->with("error", "Try Again");
      }
      $sms = new messaging();
      $sms -> sendSMS("Account created successfully",$request->phoneNo);
      return redirect(route('login'))->with("Success", "Login with new credentials");

    }
    
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
