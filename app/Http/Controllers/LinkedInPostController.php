<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkedInPostController extends Controller
{
    public function postlinked(){
       $data=[
        "elements"=>[ "integrationContext"=> "urn:li:organization:2414183",
         "description"=>"We are looking for a passionate Software Engineer to design, develop and install software solutions. Software Engineer responsibilities include gathering user requirements, defining system functionality and writing code in various languages. Our ideal candidates are familiar with the software development life cycle (SDLC) from preliminary system analysis to tests and deployment.",
         "employmentStatus"=> "PART_TIME",
         "externalJobPostingId"=>"1234",
            "listedAt"=> 1440716666,
            "jobPostingOperationType"=> "CREATE",
         "title"=> "Software Engineer",
          "location"=> "India",
           "workplaceTypes"=>[
    "remote"
   ]
        ]
       ];
        return view('linkedinpost',['data'=>$data]);
    }
}
