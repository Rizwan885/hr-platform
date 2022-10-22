<?php

namespace App\Http\Controllers;

use App\Models\Employeer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

class EmployeerController extends Controller
{
   //---------------------- Add Employeer---------
     public function empRegister(Request $req){
     $validator=Validator::make($req->all(),[
        'firstname'=>['required'],
        'lastname'=>['required'],
        'email'=>['required','email'],
        'password'=>['required','min:6'],
        'phoneNumber'=>['required','max:15','numeric'],
        'businessName'=>['required'],
      
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }    
     else
     {
      try {
        $employeer= new Employeer();
        $employeer->firstname=$req->firstname;
        $employeer->lastname=$req->lastname;
        $employeer->email=$req->email;
        $employeer->password=Hash::make($req->password);
        $employeer->phoneNumber=$req->phoneNumber;
        $employeer->businessName=$req->businessName;
        $employeer->coverLetter=$req->coverLetter;
        $result=$employeer->save();
        if($result)
        return response()->json(['message'=>'Registered Successfully'],201);
        else
        return response()->json(['message'=>'Cannot Register'],400);
  
      } catch (\Throwable $th) {
         return response()->json(['error'=>$th],500);
      }
            }
    }

   //---------------------- Add Employeer---------


   //---------------------- Show Employeers---------

  public function show(){
       $employeer=Auth::user();
       $empid=$employeer->id;
        $employeers=Employeer::find($empid);
   
        if($employeer)
        {
            return response()->json(["employeer_info"=>$employeer],200);
        }
        else
        {
            return response()->json(["message"=>"No Employeer Account Found"],404);

        }
    }
   

   //---------------------- Show Employeers---------

   //----------------------Logout---------
   
    public function logout (Request $request)
    {
        $token = $request->user()->token();

        $token->revoke();

        $response = ['message' => 'You have been successfully logged out!'];

        return response()->json($response, 200);
    }

   //----------------------Logout---------


   //---------------------- Update Account Info---------

public function updateAccount(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required'],
        'firstname'=>['required'],
        'lastname'=>['required'],
        'email'=>['required','email'],
        'password'=>['required','min:6'],
        'phoneNumber'=>['required','max:15','numeric'],
        'businessName'=>['required'],
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $employeer=Employeer::find($req->id);
        $employeer->firstname=$req->firstname;
        $employeer->lastname=$req->lastname;
        $employeer->email=$req->email;
        $employeer->password=Hash::make($req->password);;
        $employeer->phoneNumber=$req->phoneNumber;
        $employeer->businessName=$req->businessName;
        $employeer->coverLetter=$req->coverLetter;
     $result=$employeer->update();
      if($result)
        {
            return response()->json(["message"=>"Employeer Updated"],200);
        }
        else
        {
            return response()->json(["message"=>"Cannot Update Employeer"],404);

        }
    }



   //---------------------- Update Account Info---------
  



   // //---------------------- Edit Employeers---------

   //  public function edit($id){
     
   //        $validator=Validator::make(["id"=>$id],[
   //      'id'=>['required']
   //   ]);

   //   if($validator->fails())
   //   {
   //      return response()->json(['error'=>$validator->errors()],422);
   //   }  
   //   $employeer=Employeer::find($id);
   //   if($employeer)
   //   {
   //      return response()->json(["employeer"=>$employeer],200);
   //   }
   //   else
   //   {
   //  return response()->json(["message"=>"No Employeer Found"],404);
   //   }
     
   //  }  


   //---------------------- Edit Employeers---------

   //---------------------- Update Employeers---------

  public function update(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required'],
        'firstname'=>['required'],
        'lastname'=>['required'],
        'email'=>['required'],
        'phoneNumber'=>['required','max:15','numeric'],
        'businessName'=>['required'],
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $employeer=Employeer::find($req->id);
        $employeer->firstname=$req->firstname;
        $employeer->lastname=$req->lastname;
        $employeer->email=$req->email;
        $employeer->phoneNumber=$req->phoneNumber;
        $employeer->businessName=$req->businessName;
        $employeer->coverLetter=$req->coverLetter;
     $result=$employeer->update();
      if($result)
        {
            return response()->json(["message"=>"Employeer Updated"],200);
        }
        else
        {
            return response()->json(["message"=>"Cannot Update Employeer"],404);

        }
    }
   //---------------------- Update Employeers---------
   
   //---------------------- Delete Employeers---------
  
   public function delete(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $employeer=Employeer::find($req->id);
     $result=$employeer->delete();
      if($result)
        {
            return response()->json(["message"=>"Employeer Deleted"],200);
        }
        else
        {
            return response()->json(["message"=>"Cannot Delete Employeer"],404);

        }
    }
   //---------------------- Delete Employeers---------

   //---------------Reset Password----------


   public function  resetPassword  (Request $req){
     $validator= Validator::make($req->all(),[
        'email'=>['required'],
        'password'=>['required'],
     ]);
     if($validator->fails())
     {
        return response()->json(['errors'=>$validator->errors()],422);
     }
      if(Employeer::where('email',$req->email)->doesntExist())
      {
        return response()->json(['errors'=>'Email not found'],404);

      }

      $employeer=Employeer::where('email','=',$req->email)->first();
    
       $employeer->password=Hash::make($req->password);

   
       $result=$employeer->update();
      if($result)
      {
        return response()->json(['message'=>'Password Reset Successfully'],200);

      }
      else{

        return response()->json(['message'=>'Could not reset Password'],200);
      }
   }

   //---------------Reset Password----------


     

   
}
