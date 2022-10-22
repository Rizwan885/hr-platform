<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    //-------------------Create Job------------

   public function create(Request $req){
     $validator=Validator::make($req->all(),[
        'title'=>['required'],
        'subTitle'=>['required'],
        'jdd'=>['required'],
        'location'=>['required'],
        'type_id'=>['required'],
        'category_id'=>['required'],
        'subCategory_id'=>['required'],
        'status_id'=>['required'],
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }    
     else
     {
      $existing=Job::where('title',$req->title)->first();
      if($existing)
      {

        return response()->json(['Error'=>'Job Already Exists'],400);
      }
      else
      {
        $job= new Job();
        $job->title=$req->title;
        $job->subTitle=$req->subTitle;
        $job->jdd=$req->jdd;
        $job->location=$req->location;

     //======================== ( Job Types)==========//
       $job->type_id=$req->type_id;
     //======================== ( Job Types)==========//
     
     //======================== ( Category)==========//
       $job->category_id=$req->category_id;
     //======================== (Category)==========//
     
     //======================== ( Sub Category)==========//
       $job->subCategory_id=$req->subCategory_id;
     //======================== (Sub Category)==========//
     
     
     //======================== ( Status)==========//
       $job->status_id=$req->status_id;
     //======================== (Status)==========//
    
     //======================== (Opened At)==========//
       $openedAt=Carbon::now();
       $job->openedAt=$openedAt;
     //======================== (Opened At)==========//
    
     
   //   //======================== (Closed At)==========//
   //     $job->closedAt=$req->closedAt;
   //   //======================== (Closed At)==========//

   //   //======================== (Updated At)==========//
   //     $job->updatedAt=$req->updatedAt;
   //   //======================== (Updated At)==========//
     


        $result=$job->save();
        if($result)
        return response()->json(['message'=>'Job Posted'],201);
        else
        return response()->json(['Error'=>'Cannot Post Job'],400);
     }
     }
    }

    //-------------------Create Job------------

    //-------------------Show Posted Job------------
   
   public function show(Request $req){

      if($req->bearerToken())
      {
        $jobs=Job::paginate(5);
        if($jobs)
        {
            return response()->json(["jobs"=>$jobs],200);
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
    //-------------------Show Posted Job------------


    //-------------------Edit Posted Job------------

     public function edit(Request $req,$id){
     
          $validator=Validator::make(["id"=>$id],[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $job=Job::find($id);
     if($job)
     {
        return response()->json(["job"=>$job],200);
     }
     else
     {
    return response()->json(["message"=>"No Job Found"],404);
     }
     
    }  
    //-------------------Edit Posted Job------------
    
    //-------------------Update Posted Job------------
    public function update(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required'],
        'title'=>['required'],
        'subTitle'=>['required'],
        'jdd'=>['required'],
        'location'=>['required'],
        'type_id'=>['required'],
        'category_id'=>['required'],
        'subCategory_id'=>['required'],
        'status_id'=>['required'],
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $job=Job::find($req->id);
        $job->title=$req->title;
        $job->subTitle=$req->subTitle;
        $job->jdd=$req->jdd;
        $job->location=$req->location;
       $job->type_id=$req->type_id;
        $job->category_id=$req->category_id;
        $job->subCategory_id=$req->subCategory_id;
        $job->status_id=$req->status_id;
      $updatedAt=Carbon::now();
       $job->updatedAt=$updatedAt;
        $result=$job->update();
      if($result)
        {
            return response()->json(["message"=>"Job Updated"],200);
        }
        else
        {
            return response()->json(["Error"=>"Cannot Update Job"],400);

        }
    }

    //-------------------Update Posted Job------------

    //-------------------Delete Posted Job------------
 
  public function delete(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $job=Job::find($req->id);
     if($job!=null)
     {
     $result=$job->delete();
      if($result)
        {
            return response()->json(["message"=>"Job Deleted"],200);
        }
        else
        {
            return response()->json(["message"=>"Cannot Delete Job"],400);

        }
     }
     else
     {
            return response()->json(["Error"=>"Job Not Found"],404);

     }
    }
  
    //-------------------Delete Posted Job------------


    //------------------- Filter by Category------------
  
     public function filtercat(Request $req,$id){
     
          $validator=Validator::make(["id"=>$id],[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $job=Job::where('category_id','=',$id)->first();

   
     if($job)
     {
        return response()->json(["job"=>$job],200);
     }
     else
     {
    return response()->json(["message"=>"No Job Found"],404);
     }
     
    }  

    //------------------- Filter by Category------------
   

    //------------------- Filter by Sub Category------------
  
     public function filtersubcat(Request $req,$id){
     
          $validator=Validator::make(["id"=>$id],[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $job=Job::where('subCategory_id','=',$id)->first();
     if($job)
     {
        return response()->json(["job"=>$job],200);
     }
     else
     {
    return response()->json(["message"=>"No Job Found"],404);
     }
     
    }  

    //------------------- Filter by Sub Category------------

    //------------------- Filter by Status------------
  
     public function filterstatus(Request $req,$id){
     
          $validator=Validator::make(["id"=>$id],[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $job=Job::where('status_id','=',$id)->first();
     if($job)
     {
        return response()->json(["job"=>$job],200);
     }
     else
     {
    return response()->json(["message"=>"No Job Found"],404);
     }
     
    }  

    //------------------- Filter by Status------------
    
      
    //-------------------Show Recent Jobs------------
   
   public function showRecentJobs(){
        $jobs=Job::latest('openedAt')->paginate(4);
        if($jobs)
        {
            return response()->json(["Recent jobs"=>$jobs],200);
        }
        else
        {
            return response()->json(["message"=>"No Recent Jobs Found"],404);

        }
    }
    //-------------------Show Recent Jobs------------

}
