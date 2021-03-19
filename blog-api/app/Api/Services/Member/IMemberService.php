<?php

namespace App\Api\Services\Member;
use Illuminate\Http\Request;

interface IMemberService {                 
     
     public function save(Request $request);

}