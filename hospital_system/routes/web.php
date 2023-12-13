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

Route::get('/admindashboard', [PatientController::class, 'searchPatients'])->name('admindashboard');


Route::get('/', [PatientController::class, 'searchPatients'])->name('admindashboard');


//showing the login form
Route::get('/adminlogin', [Docsignin::class, 'adminlogin']) ->name('adminlogin');
//handle the adminlogin data
Route::post('/adminloginpost', [Docsignin::class, 'adminloginPost']) ->name('adminlogin.post');


Route::post('/admindashboard', [PatientController::class, 'setDuration'])->name('setDuration');
Route::get('/admindashboard', [PatientController::class, 'togglePregnancyStatus'])->name('ogglePregnancyStatus');
Route::post('/admindashboard', [PatientController::class, 'assignWardAndBed'])->name('assignWardAndBed');
Route::post('admindashboard', [PatientController::class, 'removeUser'])->name('removeUser');



Route::get('/logout',[signInFunction::class],'logout') ->name('logout');