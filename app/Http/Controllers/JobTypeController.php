<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobTypeController extends Controller
{
        public function create(Request $req){
     $validator=Validator::make($req->all(),[
        'jobType'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }    
     else
     {
        $existing= JobType::where('jobType',$req->jobType)->first();
         if($existing)
        {
        return response()->json(['Error'=>'jobType Already Exisits'],400);

        }
        else{
        $jobType= new JobType();
        $jobType->jobType=$req->jobType;
        $result=$jobType->save();
        if($result)
        return response()->json(['message'=>'jobType Created'],201);
        else
        return response()->json(['Error'=>'Cannot Create jobType'],400);
        }
     }
    }

    public function show(){
        $jobTypes=JobType::all();
        if($jobTypes)
        {
            return response()->json(["jobTypes"=>$jobTypes],200);
        }
        else
        {
            return response()->json(["message"=>"No jobTypes Found"],404);

        }
    }
   
  public function edit($id){
     
          $validator=Validator::make(["id"=>$id],[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $jobType=JobType::find($id);
     if($jobType)
     {
        return response()->json(["jobType"=>$jobType],200);
     }
     else
     {
    return response()->json(["message"=>"No jobType Found"],404);
     }
     
    }

    public function delete(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $jobType=JobType::find($req->id);
     if($jobType!=null)
     {
     $result=$jobType->delete();
      if($result)
        {
            return response()->json(["message"=>"Job_Type Deleted"],200);
        }
        else
        {
            return response()->json(["message"=>"Cannot Delete Job_Type"],400);

        }
     }
     else
     {
            return response()->json(["Error"=>"jobType Not Found"],404);

     }
    }
  
   
 public function update(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required'],
        'jobType'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $jobType=JobType::find($req->id);
     $jobType->jobType=$req->jobType;
     $result=$jobType->update();
      if($result)
        {
            return response()->json(["message"=>"jobType Updated"],200);
        }
        else
        {
            return response()->json(["Error"=>"Cannot Update jobType"],400);

        }
    }
    
}
