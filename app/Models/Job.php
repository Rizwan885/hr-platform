<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
       public $table="jobs";
     public $fillable = ['title','subTitle','jdd','location','type_id','category_id','subCategory_id','status_id','openedAt','closedAt','updatedAt'];
     public $timestamps=false;

     public function relatedEmployeer(){
    return  $this->hasMany(Employeer::class);
   }
     public function addJobType(){
    return  $this->hasMany(JobType::class);
   }
     public function category(){
    return  $this->hasOne(Category::class);
   }
     public function addSubCat(){
    return  $this->hasMany(SubCategory::class);
   }
     public function addStatus(){
    return  $this->hasMany(Status::class);
   }
   
}
