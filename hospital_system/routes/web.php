<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\signInFunction;
use App\Http\Controllers\Docsignin;
use App\Http\Controllers\PatientController;

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


// Route::get('/', function(){
//     return view('admindashboard');
// })->name('admindashboard');

Route::get('/', [PatientController::class, 'showQueue'])->name('admindashboard');


//showing the login form
Route::get('/adminlogin', [signInFunction::class, 'adminlogin']) ->name('adminlogin');
//handle the adminlogin data
Route::post('/adminloginpost', [Docsignin::class, 'adminloginPost']) ->name('adminlogin.post');


Route::post('/patient/set-duration/{patientNumber}', [PatientController::class, 'setDuration'])->name('setDuration');
Route::get('/queue', [PatientController::class, 'showQueue'])->name('showQueue');
Route::post('/patient/join-queue/{patientNumber}', [PatientController::class, 'joinQueue'])->name('joinQueue');
Route::post('/patient/set-duration/{patientNumber}', [PatientController::class, 'setDuration'])->name('setDuration');



Route::get('/logout',[signInFunction::class],'logout') ->name('logout');