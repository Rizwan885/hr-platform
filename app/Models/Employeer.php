<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employeer extends  Authenticatable
{
     use HasApiTokens, HasFactory, Notifiable;
     public $table="employeers";
     public $fillable = ['firstname','lastname','email','phoneNumber','businessName','password','coverLetter','google_id']; 

}
