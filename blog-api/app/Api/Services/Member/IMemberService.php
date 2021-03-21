<?php

namespace App\Api\Services\Member;
use Illuminate\Http\Request;

interface IMemberService {                 
     
     /**
      * save username
      * @param $request
      */
      
     public function save(Request $request);

}