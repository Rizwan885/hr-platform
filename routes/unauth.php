<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\Status;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Models\Employeer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



//-------------------------Auth Routes------------------------

Route::post('emplogin',[AuthController::class,'userLogin'])->name('emp   login');
Route::post('adminlogin',[AuthController::class,'userLogin'])->name('adminlogin');
Route::post('applicantlogin',[AuthController::class,'userLogin'])->name('applicantlogin');
    
Route::fallback(function(){
    return response()->json(['error'=>'Unauthorized']);
});