<?php

namespace App\Http\Controllers;
use App\Providers\AppServiceProvider\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function userLogin(Request $req){

     $input=$req->all();
          $validator=Validator::make($req->all(),[
        'email'=>['required','email'],
        'password'=>['required','']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }    
     
     
     if(Auth::guard(\Request::segment(3))->attempt(['email'=>$input['email'],'password'=>$input['password']]))
     {
        
       $user=Auth::guard(\Request::segment(3))->user();
       $token=$user->createToken('Token Name',[\Request::segment(3)])->accessToken;      
        
       return response()->json(['Token'=>$token],200);
        
     }
     else
     {
       return response()->json(['Error'=>'Account doest not exists'],404);

     }
     
}

 protected function unauthenticated($request, array $guards)
    {
        abort(response()->json(['error' => 'Unauthenticated.'], 401));
    }



 
}
