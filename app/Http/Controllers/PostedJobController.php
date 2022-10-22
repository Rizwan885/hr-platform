<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use App\Models\PostedJobs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class PostedJobController extends Controller
{
  // Applied Jobs Add //
    public function postedJobDetails(){

    $jobTitle = Job::select('title')->first();
    $jobsubTitle = Job::select('subTitle')->first();
    $jobLocation = Job::select('location')->first();
    $jobdescription = Job::select('jdd')->first();

    $jobType = Job::select('job_types.jobType')
        ->leftJoin('job_types', 'jobs.type_id', '=', 'job_types.id')
        ->first();
    $jobCategory = Job::select('categories.title')
        ->leftJoin('categories', 'jobs.category_id', '=', 'categories.id')
        ->first();

    $jobSubcategory = Job::select('sub_categories.title')
        ->leftJoin('sub_categories', 'jobs.subCategory_id', '=', 'sub_categories.id')
        ->first();


    $jobStatus = Job::select('statuses.status')
        ->leftJoin('statuses', 'jobs.status_id', '=', 'statuses.id')
        ->first();

    $existing=PostedJobs::where('job_title',$jobTitle->title)->first();
    if($existing)
    {
      return response()->json(['Error'=>'Job Already Applied'],400);
    }
    else
   {
    try {
    
    
    $postedjob=new PostedJobs();

    $postedjob->job_title=$jobTitle->title;
    $postedjob->job_subTitle=$jobsubTitle->subTitle;
    $postedjob->job_description=$jobdescription->jdd;
    $postedjob->job_location=$jobLocation->location;
    $postedjob->job_type=$jobType->jobType;
    $postedjob->job_category=$jobCategory->title;
    $postedjob->job_subCategory=$jobSubcategory->title;
    $postedjob->job_status=$jobStatus->status;
    $postedjob->applied_date=Carbon::now();

    $postedjob->save();
      return response()->json(['message'=>'Applied Job'],201);

    }
    catch(\Throwable $th){
      return response()->json(['Error'=>$th],500);
    }
   }
    }
    
  // Applied Jobs Add //

  //----------Delete Applied Jobs------- //


  public function delete(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }

     $appliedjob=PostedJobs::find($req->id);
     if($appliedjob!=null)
     {
     $result=$appliedjob->delete();
      if($result)
        {
            return response()->json(["message"=>"Applied Job Deleted"],200);
        }
        else
        {
            return response()->json(["Error"=>"Cannot Delete Applied Job"],400);

        }
     }
     else
     {
         return response()->json(["Error"=>"Applied Job Does Not Exists"],400);

     }
    }

  //----------Delete Applied Jobs------- //

  //----------Show Applied Jobs------- //
  public function show(Request $req){

      if($req->bearerToken())
      {
        $appliedjobs=PostedJobs::paginate(5);
        if($appliedjobs)
        {
            return response()->json(["jobs"=>$appliedjobs],200);
        }
        else
        {
            return response()->json(["message"=>"No Applied Jobs Found"],404);

        }
      
      }
      else
      {
         return response()->json(['error'=>'Not Login'],401);

      }
    }

  //----------Show Applied Jobs------- //

  //----------Filter by Category------- //

   
 }
