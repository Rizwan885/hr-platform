<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Applicant;
use App\Models\Employeer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class EmpLinkedInController extends Controller
{
   public function redirect()

    {

        return Socialite::driver('linkedin')->redirect();

    }

    public function handleCallback(){
      try{
      $user=Socialite::driver('linkedin')->user();
      $result=Employeer::where('email',$user->email)->first();
        if($result)
        {
          if($result->linkedin_id != null){
          return view('dashboard',['data'=>$user]);
          }
          else
          {
          $result->linkedin_id=$user->id;
          $result->update();
          return view('dashboard',['data'=>$user]);

          }
        }
        else
        {
          return response()->json(['error'=>'Account Not Found'],404);
        }

      
 
      }
      catch(Exception $exception)
      {
        return response()->json(['error'=>$exception]);
      }
    }
}
