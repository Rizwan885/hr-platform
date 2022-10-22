<?php

use App\Http\Controllers\AdminGoogleController;
use App\Http\Controllers\AdminIndeedController;
use App\Http\Controllers\ApplicantGoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Category;
use App\Http\Controllers\EmpLinkedInController;
use App\Http\Controllers\EmployeerIndeedController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LinkedInController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('google',function(){

// Return view('google');

// });

// Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');

// Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

// Route::get('showjobs',[JobController::class,'show'])->name('showjobs');

Route::get('/loginform',function(){
    return view('login');
});
Route::get('/dashboard',function(){
    return view('dashboard');
})->name('dashboard');

Route::get('/applyindeed',function(){
    return view('indeedapply');
})->name('applyindeed');

Route::get('/applylinkedin',function(){
    return view('linkedinapply');
})->name('applylinkedin');


// Route::post('login',[AuthController::class,'userLogin'])->name('userLogin');

Route::get('auth/emp/google',[GoogleController::class,'redirect'])->name('emp_google');
Route::get('login/google/callback',[GoogleController::class,'handleCallback'])->name('google-callback');

Route::get('auth/admin/google',[AdminGoogleController::class,'redirect'])->name('admin_google');
Route::get('login/google/callback',[AdminGoogleController::class,'handleCallback'])->name('google-callback');

Route::get('auth/google',[ApplicantGoogleController::class,'redirect'])->name('applicant_google');
Route::get('login/google/callback',[ApplicantGoogleController::class,'handleCallback'])->name('google-callback');

//---------Admin Indeed Login---------
 Route::post('auth/admin/indeed',[AdminIndeedController::class,'redirect'])->name('admin_indeed');
 Route::get('indeed/oauth/callback',[AdminIndeedController::class,'handleCallback'])->name('indeed-callback');
//---------Admin Indeed Login---------





// Route::get('linkedin/login',[LinkedInController::class,'provider'])->name('linkedin.login');
// Route::get('linkedin/callback',[LinkedInController::class,'providerCallback'])->name('linkedin.user');

Route::post('auth/linkedin',[EmpLinkedInController::class,'redirect'])->name('emplinkedin_login');
Route::get('login/linkedin/callback',[EmpLinkedInController::class,'handleCallback'])->name('emplinkedin_callback');



//---------Employeer Indeed Login---------
 Route::post('auth/employeer/indeed',[EmployeerIndeedController::class,'redirect'])->name('emp_indeed');
 Route::get('indeed/oauth/callback',[EmployeerIndeedController::class,'handleCallback'])->name('emp_indeed-callback');
//---------Employeer Indeed Login---------



