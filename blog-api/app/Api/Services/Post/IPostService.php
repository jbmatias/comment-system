<?php

namespace App\Api\Services\Post;

use App\Models\Post;

interface IPostService {            

    /**
     * Get All Posts
     * @param none
     */

     public function get();
     
     public function postComment($id, $comment, $username_id);

     public function respondToComment($request);

}