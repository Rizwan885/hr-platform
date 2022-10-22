<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobDetails;
use Illuminate\Http\Request;

class JobDetailsController extends Controller
{
    public function addjobDetails(){
    $jobTitle = Job::select('title')->first();
    $jobsubTitle = Job::select('subTitle')->first();
    $jobLocation = Job::select('location')->first();
    $jobdescription = Job::select('jdd')->first();
    $jobopenat = Job::select('openedAt')->first();
    $jobupdatedat = Job::select('updatedAt')->first();

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

    $existing=JobDetails::where('job_title',$jobTitle->title)->first();
    if($existing)
    {
      return response()->json(['Error'=>'Job Details Already Added'],400);
    }
    else
   {
    try {
    
    
    $jobdetails=new JobDetails();

    $jobdetails->job_title=$jobTitle->title;
    $jobdetails->job_subTitle=$jobsubTitle->subTitle;
    $jobdetails->job_description=$jobdescription->jdd;
    $jobdetails->job_location=$jobLocation->location;
    $jobdetails->job_type=$jobType->jobType;
    $jobdetails->job_category=$jobCategory->title;
    $jobdetails->job_subCategory=$jobSubcategory->title;
    $jobdetails->job_status=$jobStatus->status;
    $jobdetails->openedAt=$jobopenat->openedAt;
    $jobdetails->updatedAt=$jobupdatedat->updatedAt;

    $result=$jobdetails->save();
    if($result)
      return response()->json(['message'=>'Job Details Added'],201);
    else

      return response()->json(['Error'=>'Cannot Add Job Details'],400);

    }
    catch(\Throwable $th){
      return response()->json(['Error'=>$th],500);
    }
   }
    }
    
  // Applied Jobs Add //


  //------ Show Job Details-------//



   public function showjobDetails(Request $req){

      if($req->bearerToken())
      {
        $jobdetails=JobDetails::paginate(5);
        if($jobdetails)
        {
            return response()->json(["jobdetails"=>$jobdetails],200);
        }
        else
        {
            return response()->json(["message"=>"No Jobs Found"],404);

        }
      
      }
      else
      {
         return response()->json(['error'=>'Not Login'],401);

      }
    }
    //-------------------Show  Job Details------------

    //-------------------Show Recent Job Details------------
   public function showrecentjobDetails(Request $req){

      if($req->bearerToken())
      {
        $jobdetails=JobDetails::latest('openedAt')->paginate(5);
        if($jobdetails)
        {
            return response()->json(["jobdetails"=>$jobdetails],200);
        }
        else
        {
            return response()->json(["message"=>"No Jobs Found"],404);

        }
      
      }
      else
      {
         return response()->json(['error'=>'Not Login'],401);

      }
    }
    //-------------------Show Recent Job Details------------
}

