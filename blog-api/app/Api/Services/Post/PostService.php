<?php

namespace App\Api\Services\Post;

use App\Models\Post;

class PostService implements IPostService {
    
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function get() {
        return response()->json($this->post->all());
    }
    
    public function saveName() {
        
    }

}