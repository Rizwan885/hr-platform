<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
     //---------------------- Add Category---------
    public function create(Request $req){
     $validator=Validator::make($req->all(),[
        'title'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }    
     else
     {
      $existing=Category::where('title',$req->title)->first();
      if($existing)
      {

        return response()->json(['Error'=>'Category Already Exists'],400);
      }
      else
      {

      
        $category= new Category();
        $category->title=$req->title;
        $result=$category->save();
        if($result)
        return response()->json(['message'=>'Category Created'],201);
        else
        return response()->json(['error'=>'Cannot Create Category'],400);
     }
     }
    }
     //---------------------- Add Category---------


    public function show(){
        $categories=Category::all();
     //---------------------- Show Category---------
        if($categories)
        {
            return response()->json(["categories"=>$categories->title],200);
        }
        else
        {
            return response()->json(["message"=>"No Categories Found"],404);

        }
    }
     //---------------------- Show Category---------

     //---------------------- Edit Category---------
   
  public function edit($id){
     
          $validator=Validator::make(["id"=>$id],[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $category=Category::find($id);
     if($category)
     {
        return response()->json(["category"=>$category],200);
     }
     else
     {
    return response()->json(["message"=>"No Category Found"],404);
     }
     
    }  

     //---------------------- Edit Category---------

     //---------------------- Delete Category---------

    public function delete(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }

     $category=Category::find($req->id);
     if($category!=null)
     {
     $result=$category->delete();
      if($result)
        {
            return response()->json(["message"=>"Category Deleted"],200);
        }
        else
        {
            return response()->json(["Error"=>"Cannot Delete Category"],400);

        }
     }
     else
     {
         return response()->json(["Error"=>"Category Does Not Exists"],400);

     }
    }
     //---------------------- Delete Category---------

     //---------------------- Update Category---------

    public function update(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required'],
        'title'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $category=Category::find($req->id);
     $category->title=$req->title;
     $result=$category->update();
      if($result)
        {
            return response()->json(["message"=>"Category Updated"],200);
        }
        else
        {
            return response()->json(["Error"=>"Cannot Update Category"],400);

        }
    }
     //---------------------- Update Category---------
}
