<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SubCategoryController extends Controller
{
    public function create(Request $req,$id){
   $validator=Validator::make($req->all(),[
        'title'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }

     else
     {
        $existing=SubCategory::where('title',$req->title)->first();
        if($existing)
        {
        return response()->json(['Error'=>'Sub_Category Already Exisits'],400);

        }
        else
        {
        $category=Category::find($id);
        $subcategory=new SubCategory();
        $subcategory->title=$req->title;
        $result=$category->addSubCat()->save($subcategory);
        if($result)
        return response()->json(['message'=>'Sub_Category Created'],201);
        else
        return response()->json(['Error'=>'Cannot create Sub_Category'],400);

     }
     }
    
    }
        //------------------Show Sub_Categories----------------
    public function show(){
        $subcategories=SubCategory::all();
        if($subcategories)
        {
            return response()->json(["subcategories"=>$subcategories],200);
        }
        else
        {
            return response()->json(["message"=>"No Sub_Categories Found"],404);

        }
    }
        //------------------Show Sub_Categories----------------

        //------------------Edit Sub_Categories----------------

     public function edit($id){
     
          $validator=Validator::make(["id"=>$id],[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $subcategory=SubCategory::find($id);
     if($subcategory)
     {
        return response()->json(["subcategory"=>$subcategory],200);
     }
     else
     {
    return response()->json(["message"=>"No Sub Category Found"],404);
     }
     
    }  


        //------------------Edit Sub_Categories----------------

        //------------------Update Sub_Categories----------------


     public function update(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required'],
        'title'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }  
     $subcategory=SubCategory::find($req->id);
     $subcategory->title=$req->title;
     $result=$subcategory->update();
      if($result)
        {
            return response()->json(["message"=>"Sub_Category Updated"],200);
        }
        else
        {
            return response()->json(["message"=>"Cannot Update Sub_Category"],404);

        }
    }
        //------------------Update Sub_Categories----------------

        //------------------Delete Sub_Categories----------------


 public function delete(Request $req){
    $validator=Validator::make($req->all(),[
        'id'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }

     $subcategory=SubCategory::find($req->id);
     if($subcategory!=null)
     {
     $result=$subcategory->delete();
      if($result)
        {
            return response()->json(["message"=>"Sub_Category Deleted"],200);
        }
        else
        {
            return response()->json(["Error"=>"Cannot Delete Sub_Category"],400);

        }
     }
     else
     {
         return response()->json(["Error"=>"SUb_Category Does Not Exists"],400);

     }
    }


        //------------------Delete Sub_Categories----------------
}
