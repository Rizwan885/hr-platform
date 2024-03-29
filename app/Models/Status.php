<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
      public $table="statuses";
     public $fillable = ['status'];
     public $timestamps=false;
       public function  relatedJob(){
    return  $this->belongsTo(Job::class);
   }
}
