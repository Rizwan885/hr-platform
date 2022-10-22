<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Employeer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AdminGoogleController extends Controller
{
   public function redirect()

    {

        return Socialite::driver('google')->redirect();

    }

    public function handleCallback(){
      try{
      $user=Socialite::driver('google')->user();
      $result=Admin::where('email',$user->email)->first();
        if($result)
        {
          if($result->google_id==$user->id){
          return redirect('/dashboard');
          }
          else
          {
          $result->google_id=$user->id;
          $result->update();
          return redirect('/dashboard');

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
