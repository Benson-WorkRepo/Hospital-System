<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\doctorcredentials;
use App\Models\messaging; //use in other controllers
class Docsignin extends Controller
{
    function adminloginPost(Request $request){
        $request->validate([
            'workID'=>'required',
            'password'=> 'required',
        ]);
        $credentials = $request->only('workID','password');
        if(Auth::guard('doc')->attempt($credentials)){
           dd();
            return redirect()->intended(route('admindashboard'));
        }dd();
        return redirect(route('adminlogin'))->withErrors("error", "invalid credentials");
    }
    function adminlogin(){
        return view('adminlogin');
    }
}