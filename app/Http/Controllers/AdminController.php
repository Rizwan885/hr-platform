<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 

class AdminController extends Controller
{
   public function adminRegister(Request $req)
   {
      $input=$req->all();
          $validator=Validator::make($req->all(),[
        'name'=>['required'],
        'email'=>['required','email'],
        'password'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }    
   try {
           $user=new Admin();
     $user->name=$req->name;
     $user->email=$req->email;
     $user->password=Hash::make($req->password);;
     $result=$user->save();
     if($result)
     {
    
        return response()->json(['message'=>'Registered Successfully'],201);
     }
     else
     {
        return response()->json(['message'=>'Cannot Create Admin'],400);

     }
   

      
   } catch (\Throwable $th) {

        return response()->json(['error'=>$th],500);
   }
    

   }


   
    //-------------------Show Admin Info------------

      public function show(){
       $admin=Auth::user();
       $adminid=$admin->id;
        $admins=Admin::find($adminid);
   
        if($admin)
        {
            return response()->json(["admin_info"=>$admin],200);
        }
        else
        {
            return response()->json(["message"=>"No Admin Account Found"],404);

        }
    }
   
    //-------------------Show Admin Info------------

    //-------------------Logout------------
    public function logout (Request $request)
    {
        $token = $request->user()->token();

        $token->revoke();

        $response = ['message' => 'You have been successfully logged out!'];

        return response()->json($response, 200);
    }

    //-------------------Logout------------

    //-------------------Update Admin Account------------

   public function updateAccount(Request $req){
    $validator=Validator::make($req->all(),[
      'id'=>['required'],
       'name'=>['required'],
        'email'=>['required','email'],
        'password'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $admin=Admin::find($req->id);
     $admin->name=$req->name;
     $admin->email=$req->email;
     $admin->password=Hash::make($req->password);;
     $result=$admin->update();
      if($result)
        {
            return response()->json(["message"=>"Account Updated"],200);
        }
        else
        {
            return response()->json(["Error"=>"Cannot Update Account"],400);

        }
    }


    //-------------------Update Admin Account------------


   //---------------------- Delete Employeers---------
  
   public function delete(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $admin=Admin::find($req->id);
     $result=$admin->delete();
      if($result)
        {
            return response()->json(["message"=>"Account Deleted"],200);
        }
        else
        {
            return response()->json(["message"=>"Cannot Delete Account"],404);

        }
    }
   //---------------------- Delete Employeers---------


   //---------------Reset Password----------


   public function  resetPassword  (Request $req){
     $validator= Validator::make($req->all(),[
        'email'=>['required','email'],
        'password'=>['required'],
     ]);
     if($validator->fails())
     {
        return response()->json(['errors'=>$validator->errors()],422);
     }
      if(Admin::where('email',$req->email)->doesntExist())
      {
        return response()->json(['errors'=>'Email not found'],404);

      }

      $admin=Admin::where('email','=',$req->email)->first();
    
       $admin->password=Hash::make($req->password);

   
       $result=$admin->update();
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
