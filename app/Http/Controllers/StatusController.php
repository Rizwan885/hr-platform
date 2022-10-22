<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class StatusController extends Controller
{
    public function create(Request $req){
      $validator=Validator::make($req->all(),[
        'status'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     else
     {
        $existing=Status::where('status',$req->status)->first();
        if($existing)
        {
        return response()->json(['Error'=>'Status Already Exists'],400);

        }
        else
        {
          $status= new Status();
        $status->status=$req->status;
        $result=$status->save();
        if($result)
        return response()->json(['message'=>'Status Added'],200);
        else
        return response()->json(['message'=>'Status Not Added'],500);
     }
     }
    }

    public function show(){
        $statuses=Status::all();
        if($statuses)
        {
            return response()->json(["statuses"=>$statuses],200);
        }
        else
        {
            return response()->json(["message"=>"No Status Found"],404);

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
     $status=Status::find($id);
     if($status)
     {
        return response()->json(["status"=>$status],200);
     }
     else
     {
    return response()->json(["message"=>"No Status Found"],404);
     }
     
    }  


    public function update(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required'],
        'status'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $status=Status::find($req->id);
     $status->status=$req->status;
     $result=$status->update();
      if($result)
        {
            return response()->json(["message"=>"Status Updated"],200);
        }
        else
        {
            return response()->json(["message"=>"Cannot Update Status"],404);

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
     $status=Status::find($req->id);
     if($status!=null)
     {
     $result=$status->delete();
      if($result)
        {
            return response()->json(["message"=>"Status Deleted"],200);
        }
        else
        {
            return response()->json(["message"=>"Cannot Delete Status"],400);


        }
    }
    else
    {
            return response()->json(["Error"=>"Status Not Found"],404);

    }
  }
   
}
