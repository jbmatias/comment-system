<?php

namespace App\Api\Services\Post;

use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentResponse;

class PostService implements IPostService {
    
    /**
     * initialize class properties
     * @var $post
     * @var $comment
     * @var $response
     */

    private $post;
    private $comment;
    private $response;

    
    public function __construct(
        Post $post,
        Comment $comment,
        CommentResponse $response)
    {        
        $this->post = $post;
        $this->comment = $comment;
        $this->response = $response;
    }

    /**
     * return Post with Comments and Comments responses
     * @param null
     */

    public function get() {
        return response()->json($this->post->with(['comments' => function($q) {
            return $q->with(['username', 'responses' => function($res) {
                return $res->with('username');
            }]);
        }])->get());
    }
    
    /**
     * save Comment if Post has less than 3 Comments
     * @param $id
     * @param $comment
     * @param $username_id
     */
    public function postComment($id, $comment, $username_id) {

        $post = $this->post->find($id)->with('comments')->first();
        
        if(count($post->comments) < 3) {
            $comment = $this->comment->create([
                'post_id' => $id,
                'username_id' => $username_id,
                'comment' => $comment
            ]);
    
            return $this->comment
                ->where('id',$comment->id)
                ->where('username_id', $username_id)
                ->with('username', 'responses')->first();
        }        

        return response()->json(['error' => 'Post has already reached 3 comments now!'], 404);
    }

    /**
     * respond to a comment
     * @param $request
     */
    public function respondToComment($request) {
        $response = $this->response->create([
            'comment_id' => $request->comment_id,
            'username_id' => $request->username_id,
            'response' => $request->response
        ]);

        return $this->response
            ->where('id',$response->id)
            ->where('comment_id',$response->comment_id)
            ->where('username_id', $response->username_id)
            ->with('username')->first();
    }

}