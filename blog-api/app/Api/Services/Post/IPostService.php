<?php

namespace App\Api\Services\Post;

use App\Models\Post;

interface IPostService {            

    /**
     * Get All Posts
     * @param none
     */

    public function get();
    
     /**
     * Comment to a Post
     * @param $id
     * @param $comment
     * @param $username_id
     */

    public function postComment($id, $comment, $username_id);

    /**
     * respond to a Comment
     * @param $request     
     */

    public function respondToComment($request);

}