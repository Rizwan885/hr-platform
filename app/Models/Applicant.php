<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Applicant extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;
     public $table="applicants";
     public  $fillable = ['firstname','lastname','email','password','phoneNumber','cv','coverLetter','google_id'];
     public $timestamps=false;

}
