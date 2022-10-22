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

class AdminIndeedController extends Controller
{
   public function redirect()

    {

        return Socialite::driver('indeed')->redirect();

    }

    public function handleCallback(){
      try{
      $user=Socialite::driver('indeed')->user();
      $result=Admin::where('email',$user->email)->first();
        if($result)
        {
          if($result->indeed_id != null){
           return redirect('/dashboard')->with('username',$user->email);
          }
          else
          {
          $result->indeed_id=$user->id;
          $result->update();
          return redirect('/dashboard')->with('username',$user->email);

          }
        }
        else
        {
          return response()->json(['error'=>'error']);
        }

      
 
      }
      catch(Exception $exception)
      {
        return response()->json(['error'=>$exception]);
      }
    }
}
