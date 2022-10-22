<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
   public function userRegister(Request $req)
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
     $user=new User();
     $user->name=$req->name;
     $user->email=$req->email;
     $user->password=bcrypt($req->password);
     $result=$user->save();
     if($result)
     {
    $token = $user->createToken('Laravel-9-Passport-Auth')->accessToken;
        return response()->json(['message'=>'User Created with Token']);
     }
     else
     {
        return response()->json(['message'=>'Cannot Create User']);

     }
    //  $user = User::create([
    //         'name' => $req->name,
    //         'email' => $req->email,
    //         'password' => bcrypt($req->password)
    //     ]);
    

   }


    public function userLogin(Request $req)
    {
        $input=$req->all();
          $validator=Validator::make($req->all(),[
        'email'=>['required','email'],
        'password'=>['required','']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }    
    
     if(Auth::attempt(['email'=>$input['email'],'password'=>$input['password']]))
     {
        
       $user=Auth::user();
       $token=$user->createToken('Token Name')->accessToken;      

       return response()->json(['token'=>$token]);
     }
     else
     {
       return response()->json(['token'=>'User Not Found']);

     }
    }
}
