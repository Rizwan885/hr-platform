<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;
      public $table="job_types";
     public $fillable = ['jobType'];
     public $timestamps=false;
       public function  relatedJob(){
    return  $this->belongsTo(Job::class);
   }
}
