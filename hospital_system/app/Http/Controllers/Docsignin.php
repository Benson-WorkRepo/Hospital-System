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
            return redirect()->intended(route('admindashboard'));
        }
        return redirect(route('adminlogin'))->with("error", "invalid credentials");
    }
}