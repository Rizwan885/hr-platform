<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function PHPUnit\Framework\fileExists;

class ApplicantController extends Controller
{
     //---------------------- Add Applicant---------
     public function applicantRegister(Request $req){
     $validator=Validator::make($req->all(),[
        'firstname'=>['required'],
        'lastname'=>['required'],
        'email'=>['required','email'],
        'password'=>['required','min:6'],
        'phoneNumber'=>['required','max:15','numeric'],
        'cv'=>['required','mimes:pdf,doc,docx']
      
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }    
     else
     {
      try {
        // Handling CV file//

        $cvname=time().$req->file('cv')->getClientOriginalName();
        if(filesize($req->file('cv'))>8000000)
        {

        return response()->json(['error'=>'File size is greater than 8 MB'],400);
        }
        else
        {
        $existing=Applicant::where('email',$req->email)->first();
        if($existing)
        {

        return response()->json(['error'=>'Account Already Exists'],400);
        }
        else
        {
            if(fileExists(public_path('cv/'+$req->file('cv'))))
            {
            return response()->json(['error'=>'CV Already Exists'],400);
            }
        $req->file('cv')->storeAs('public/cv',$cvname);
        // Handling CV file//
        $applicant= new Applicant();
        $applicant->firstname=$req->firstname;
        $applicant->lastname=$req->lastname;
        $applicant->email=$req->email;
        $applicant->password=Hash::make($req->password);
        $applicant->phoneNumber=$req->phoneNumber;
        $applicant->cv=$cvname;
        $applicant->coverLetter=$req->coverLetter;
        $result=$applicant->save();
        if($result)
        return response()->json(['message'=>'Registered Successfully'],201);
        else
        return response()->json(['message'=>'Cannot Register'],400);
        }
        }
  
      } catch (\Throwable $th) {
         return response()->json(['error'=>$th],500);
      }
            }
    }

   //---------------------- Add Applicant---------



    //-------------------Show Applicant Info------------

      public function show(){
       $applicant=Auth::user();
       $applicantid=$applicant->id;
        $applicantinfo=Applicant::find($applicantid);
   
        if($applicantinfo)
        {
            return response()->json(["applicant_info"=>$applicantinfo],200);
        }
        else
        {
            return response()->json(["Error"=>"No Record Found"],404);

        }
    }
   
    //-------------------Show Applicant Info------------



    //-------------------Update Admin Account------------

   public function updateAccount(Request $req){
    $validator=Validator::make($req->all(),[
      'id'=>['required'],
       'firstname'=>['required'],
       'lastname'=>['required'],
        'email'=>['required','email'],
        'password'=>['required'],
       'phoneNumber'=>['required','max:15','numeric'],
        'cv'=>['required','mimes:pdf,doc,docx']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     else{
      $cvname=time().$req->file('cv')->getClientOriginalName();
        if(filesize($req->file('cv'))>8000000)
        {

        return response()->json(['error'=>'File size is greater than 8 MB'],400);
        }
        else
      {
       
       $applicantinfo=Applicant::find($req->id);
       unlink(storage_path('app/public/cv/'.$applicantinfo->cv));
       $req->file('cv')->storeAs('public/cv',$cvname);
        $applicantinfo->firstname=$req->firstname;
        $applicantinfo->lastname=$req->lastname;
        $applicantinfo->email=$req->email;
        $applicantinfo->password=Hash::make($req->password);
        $applicantinfo->phoneNumber=$req->phoneNumber;
        $applicantinfo->cv=$cvname;
        $applicantinfo->coverLetter=$req->coverLetter;
        $result=$applicantinfo->update();

         if($result)
        return response()->json(['message'=>'Account Updated'],200);
        else
        return response()->json(['message'=>'Cannot Update Account'],400);
   
      }   
   
   }
   }


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
    
}
