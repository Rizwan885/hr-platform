<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobDetailsController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\PostedJobController;
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

// //------------------------- Category Routes-----------------
// Route::post('/addcat',[CategoryController::class,'create'])->name('addcat');
// Route::get('/showcats',[CategoryController::class,'show'])->name('showcats');
// Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('editcat');
// Route::put('/update',[CategoryController::class,'update'])->name('updatecat');
// Route::delete('/delete',[CategoryController::class,'delete'])->name('deletecat');
// //------------------------- Category Routes-----------------


// //-------------------------Sub Category Routes-----------------
// Route::post('/addsubcat/{id}',[SubCategoryController::class,'create'])->name('addsubcat');
// Route::get('/showsubcats',[SubCategoryController::class,'show'])->name('showcats');
// Route::get('/editsubcat/{id}',[SubCategoryController::class,'edit'])->name('editsubcat');
// Route::put('/updatesubcat',[SubCategoryController::class,'update'])->name('updatesubcat');
// //-------------------------Sub Category Routes-----------------



// //-------------------------Status Routes-----------------
// Route::post('/addstatus',[StatusController::class,'create'])->name('addstatus');
// Route::get('/showstatuses',[StatusController::class,'show'])->name('showstatuses');
// Route::get('/editstatus/{id}',[StatusController::class,'edit'])->name('editstatus');
// Route::put('/updatestatus',[StatusController::class,'update'])->name('updatestatus');
// Route::delete('/deletestatus',[StatusController::class,'delete'])->name('deletestatus');
// //-------------------------Status Routes-----------------

// //-------------------------Job Type Routes-----------------
// Route::post('/addjobtype',[JobTypeController::class,'create'])->name('addjobtype');
// Route::get('/showjobtypes',[JobTypeController::class,'show'])->name('showjobtypes');
// Route::get('/editjobtype/{id}',[JobTypeController::class,'edit'])->name('editjobtype');
// Route::put('/updatejobtype',[JobTypeController::class,'update'])->name('updatejobtype');
// Route::delete('/deletejobtype',[JobTypeController::class,'delete'])->name('deletejobtype');
// //-------------------------Job Type Routes-----------------

// //-------------------------Job Routes-----------------
// Route::post('/addjob',[JobController::class,'create'])->name('addjob');
// Route::get('/editjob/{id}',[JobController::class,'edit'])->name('editjob');
// Route::put('/updatejob',[JobController::class,'update'])->name('updatejob');
// Route::delete('/deletejob',[JobController::class,'delete'])->name('deletejob');
// Route::get('/filtercat/{id}',[JobController::class,'filtercat'])->name('filtercat');
// Route::get('/filtersubcat/{id}',[JobController::class,'filtersubcat'])->name('filtersubcat');
// Route::get('/filterstatus/{id}',[JobController::class,'filterstatus'])->name('filterstatus');
// Route::get('/showrecentjobs',[JobController::class,'showRecentJobs'])->name('showRecentJobs');
// //-------------------------Job Routes-----------------

// Route::post('/addemployeer',[EmployeerController::class,'create'])->name('addemployeer');
// Route::get('/showemployeers',[EmployeerController::class,'show'])->name('showemployeers');
// Route::get('/editemployeer/{id}',[EmployeerController::class,'edit'])->name('editemployeer');
// Route::put('/updateemployeer',[EmployeerController::class,'update'])->name('updateemployeer');
// Route::delete('/deleteemployeer',[EmployeerController::class,'delete'])->name('deleteemployeer');

//-------------------------Job Routes-----------------

// //-------------------------Applicant Routes-----------------
// Route::post('/addapplicant',[ApplicantController::class,'create'])->name('addapplicant');
// Route::get('/showappliedjobs',[ApplicantController::class,'show'])->name('showappliedjobs');
// Route::delete('/deleteappliedjob',[ApplicantController::class,'delete'])->name('deletappliedjob');
// //-------------------------Applicant Routes-----------------



//-------------------------Auth Routes------------------------

// Route::post('userregister',[UserController::class,'userRegister'])->name('userregister');
// Route::post('adminregister',[AdminController::class,'adminRegister'])->name('adminregister');
// Route::post('adminlogin',[AdminController::class,'adminLogin'])->name('adminlogin');


// Route::group(['middleware'=>'auth:api'],function(){
// Route::get('/showpostedjobs',[JobController::class,'show'])->name('showjob');

// });

// Route::group(['middleware'=>'auth:admin-api'],function(){
// Route::get('/showpostedjobs',[JobController::class,'show'])->name('showjob');

// });

//-------------------------Auth Routes------------------------
// Route::get('showpostedjobs',[AuthController::class,'show'])->name('show');


// AUTHENTICATION API FOR Admin
       Route::post('adminregister',[AdminController::class,'adminRegister'])->name('adminregister');
Route::group( ['prefix' => 'admin','middleware' => ['auth:admin-api','scopes:admin'] ],function(){
   
   //--------------------Admin Info----------------
    
        Route::get('showinfo',[AdminController::class, 'show'])->name('showinfo');
        Route::get('logout',[AdminController::class, 'logout'])->name('logout');
        Route::put('updateinfo',[AdminController::class, 'updateAccount'])->name('updateinfo');
        Route::put('resetpassword',[AdminController::class, 'resetPassword'])->name('resetpassword');

    //--------------------Admin Info----------------
   
    //-------------------Employees operations for admin------------------
       Route::get('/showemployeers',[EmployeerController::class,'show'])->name('showemployeers');
       Route::delete('/deleteemployeer',[EmployeerController::class,'delete'])->name('deleteemployeer');
       Route::get('/editemployeer/{id}',[EmployeerController::class,'edit'])->name('editemployeer');
       Route::put('/updateemployeer',[EmployeerController::class,'update'])->name('updateemployeer');
    //-------------------Employees operations for admin------------------


        //------------------------- Category Routes-----------------
        Route::post('/addcat',[CategoryController::class,'create'])->name('addcat');
        Route::get('/showcats',[CategoryController::class,'show'])->name('showcats');
        Route::get('/editcat/{id}',[CategoryController::class,'edit'])->name('editcat');
        Route::put('/updatecat',[CategoryController::class,'update'])->name('updatecat');
        Route::delete('/deletecat',[CategoryController::class,'delete'])->name('deletecat');
        //------------------------- Category Routes-----------------


        //-------------------------Sub Category Routes-----------------
        Route::post('/addsubcat/{id}',[SubCategoryController::class,'create'])->name('addsubcat');
        Route::get('/showsubcats',[SubCategoryController::class,'show'])->name('showcats');
        Route::get('/editsubcat/{id}',[SubCategoryController::class,'edit'])->name('editsubcat');
        Route::put('/updatesubcat',[SubCategoryController::class,'update'])->name('updatesubcat');
        //-------------------------Sub Category Routes-----------------

        //-------------------------Status Routes-----------------
        Route::post('/addstatus',[StatusController::class,'create'])->name('addstatus');
        Route::get('/showstatus',[StatusController::class,'show'])->name('showstatuses');
        Route::get('/editstatus/{id}',[StatusController::class,'edit'])->name('editstatus');
        Route::put('/updatestatus',[StatusController::class,'update'])->name('updatestatus');
        Route::delete('/deletestatus',[StatusController::class,'delete'])->name('deletestatus');
        //-------------------------Status Routes-----------------

        //-------------------------Job Type Routes-----------------
        Route::post('/addjobtype',[JobTypeController::class,'create'])->name('addjobtype');
        Route::get('/showjobtypes',[JobTypeController::class,'show'])->name('showjobtypes');
        Route::get('/editjobtype/{id}',[JobTypeController::class,'edit'])->name('editjobtype');
        Route::put('/updatejobtype',[JobTypeController::class,'update'])->name('updatejobtype');
        Route::delete('/deletejobtype',[JobTypeController::class,'delete'])->name('deletejobtype');
        //-------------------------Job Type Routes-----------------

        //-------------------------Job Routes-----------------
        Route::post('/addjob',[JobController::class,'create'])->name('addjob');
        Route::get('/editjob/{id}',[JobController::class,'edit'])->name('editjob');
        Route::put('/updatejob',[JobController::class,'update'])->name('updatejob');
        Route::delete('/deletejob',[JobController::class,'delete'])->name('deletejob');
        Route::get('/filtercat/{id}',[JobController::class,'filtercat'])->name('filtercat');
        Route::get('/filtersubcat/{id}',[JobController::class,'filtersubcat'])->name('filtersubcat');
        Route::get('/filterstatus/{id}',[JobController::class,'filterstatus'])->name('filterstatus');
        Route::get('/showrecentjobs',[JobController::class,'showRecentJobs'])->name('showRecentJobs');
        //-------------------------Job Routes-----------------

        //-------------------------Applicant Routes-----------------
        Route::post('/addapplicant',[ApplicantController::class,'create'])->name('addapplicant');
        Route::get('/showappliedjobs',[ApplicantController::class,'show'])->name('showappliedjobs');
        Route::delete('/deleteappliedjob',[ApplicantController::class,'delete'])->name('deletappliedjob');
        //-------------------------Applicant Routes-----------------

}); 

// AUTHENTICATION API ROUTES FOR Admin





//AUTHENTICATION API ROUTES FOR EMPLOYEER
       Route::post('empregister',[EmployeerController::class,'empRegister'])->name('empregister');

Route::group( ['prefix' => 'employeer','middleware' => ['auth:employeer-api','scopes:employeer'] ],function(){

    //--------------------Show Employeers----------------
    
        Route::get('showinfo',[EmployeerController::class, 'show'])->name('showinfo');
        Route::put('updateinfo',[EmployeerController::class, 'updateAccount'])->name('updateinfo');
        Route::put('resetpassword',[EmployeerController::class, 'resetPassword'])->name('resetpassword');
        Route::get('logout',[EmployeerController::class, 'logout'])->name('logout');

    //--------------------Show Employeers----------------
     

    //--------------------Category Routes----------------
        Route::get('showcats',[CategoryController::class, 'show'])->name('showcats');
    //--------------------Category Routes----------------

    //--------------------Sub Category Routes----------------
        Route::get('/showsubcats',[SubCategoryController::class,'show'])->name('showcats');
    //--------------------Sub Category Routes----------------

    //--------------------Status Routes----------------
        Route::get('/showstatus',[StatusController::class,'show'])->name('showstatuses');
         Route::get('/editstatus/{id}',[StatusController::class,'edit'])->name('editstatus');
        Route::put('/updatestatus',[StatusController::class,'update'])->name('updatestatus');
    //--------------------Status Routes----------------

    //--------------------Job Type Routes----------------
        Route::get('/showjobtypes',[JobTypeController::class,'show'])->name('showjobtypes');
        Route::get('/editjobtype/{id}',[JobTypeController::class,'edit'])->name('editjobtype');
        Route::put('/updatejobtype',[JobTypeController::class,'update'])->name('updatejobtype');
    //--------------------Job Type Routes----------------
    
    //--------------------Job Routes----------------
      Route::post('/postjob',[JobController::class,'create'])->name('postjob');
        Route::get('/editjob/{id}',[JobController::class,'edit'])->name('editjob');
        Route::put('/updatejob',[JobController::class,'update'])->name('updatejob');
        Route::delete('/deletejob',[JobController::class,'delete'])->name('deletejob');

    
        Route::get('/showpostedjobs',[JobController::class,'show'])->name('showpostedjobs');

    //--------------------Job Routes----------------

    //--------------------Applied Jobs----------------
    Route::delete('deleteappliedjobs',[PostedJobController::class, 'delete'])->name('deleteappliedjobs');

    //--------------------Applied Jobs----------------
}); 

Route::fallback(function () {
    return response()->json(['error' => 'Route Not Found'], 404);
});

//AUTHENTICATION API ROUTES FOR EMPLOYEER


//AUTHENTICATION API ROUTES FOR Applicant

Route::post('applicantregister',[ApplicantController::class,'applicantRegister'])->name('applicantregister');

Route::group(['prefix'=>'applicant','middleware'=>['auth:applicant-api','scopes:applicant']],function(){
//--------------------Applicant Info----------------
    
        Route::get('showinfo',[ApplicantController::class, 'show'])->name('showinfo');
        Route::get('logout',[ApplicantController::class, 'logout'])->name('logout');
        Route::post('updateinfo',[ApplicantController::class, 'updateAccount'])->name('updateinfo');
        Route::put('resetpassword',[ApplicantController::class, 'resetPassword'])->name('resetpassword');

    //--------------------Applicant Info----------------

    //--------------------Posted Jobs Detail----------------
        Route::post('addappliedjobs',[PostedJobController::class, 'postedJobDetails'])->name('addappliedjobs');
        Route::get('showappliedjobs',[PostedJobController::class, 'show'])->name('showappliedjobs');
    //--------------------Posted Jobs Detail----------------

    //--------------------Jobs Details----------------
        Route::post('addjobdetails',[JobDetailsController::class, 'addjobDetails'])->name('addjobdetails');
        Route::get('showjobdetails',[JobDetailsController::class, 'showjobDetails'])->name('showjobdetails');
        Route::get('showrecentjobdetails',[JobDetailsController::class, 'showrecentjobDetails'])->name('showrecentjobdetails');
    //--------------------Jobs Details----------------

    //--------------------Show Status----------------

        Route::get('/showstatus',[StatusController::class,'show'])->name('showstatuses');

    //--------------------Show Status----------------

    //--------------------Show Job Type----------------

        Route::get('/showjobtypes',[JobTypeController::class,'show'])->name('showjobtypes');
    //--------------------Show Job Type----------------

    //--------------------Show Categories----------------

        Route::get('/showcats',[CategoryController::class,'show'])->name('showcats');
    //--------------------Show Categories----------------
        Route::get('/filtercat/{id}',[JobController::class,'filtercat'])->name('filtercat');
        Route::get('/filtersubcat/{id}',[JobController::class,'filtersubcat'])->name('filtersubcat');
        Route::get('/filterstatus/{id}',[JobController::class,'filterstatus'])->name('filterstatus');
        Route::get('/showrecentjobs',[JobController::class,'showRecentJobs'])->name('showRecentJobs');

    //--------------------Show Categories----------------
});
 