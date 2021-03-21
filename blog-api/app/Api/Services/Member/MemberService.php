<?php

namespace App\Api\Services\Member;

use Illuminate\Http\Request;
use App\Models\Username;

class MemberService implements IMemberService {
    
    /**
     * initialize class property
     * @var $username
     */
    private $username;
    
    public function __construct(Username $username)
    {        
        $this->username = $username;
    }

    public function save(Request $request) {

        /**
         * create and return username
         * @param $request
         */
        return $this->username->create($request->all());
    }        

}