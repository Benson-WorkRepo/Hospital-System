<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\signInFunction;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/layout', function () {
    return view('layout');
})->name('homepage');

Route::get('/login', [signInFunction::class, 'login']) ->name('login');
Route::post('/login', [signInFunction::class, 'loginPost']) ->name('login.post');

Route::get('/signup', [signInFunction::class, 'signup']) ->name('signup');
Route::post('/signup', [signInFunction::class, 'signupPost']) ->name('signup.post');


Route::get('/', function(){
    return view('dashboard');
})->name('admindashboard');

Route::get('/adminlogin', [signInFunction::class, 'adminlogin']) ->name('adminlogin');
Route::post('/adminlogin', [signInFunction::class, 'adminloginPost']) ->name('adminlogin.post');


Route::get('/logout',[signInFunction::class],'logout') ->name('logout');