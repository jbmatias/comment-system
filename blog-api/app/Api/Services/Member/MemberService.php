<?php

namespace App\Api\Services\Member;

use Illuminate\Http\Request;
use App\Models\Username;

class MemberService implements IMemberService {
        
    private $username;
    
    public function __construct(Username $username)
    {
        $this->username = $username;
    }

    public function save(Request $request) {
        return $this->username->create($request->all());
    }        

}