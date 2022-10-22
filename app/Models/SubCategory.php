<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
     public $table="sub_categories";
     public $fillable = ['title'];
     public $timestamps=false;
     public function relatedCat(){
    $this->belongsTo(Category::class);
   }
}
