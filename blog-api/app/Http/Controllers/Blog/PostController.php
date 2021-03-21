<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Api\Services\Post\IPostService;
use App\Api\Services\Member\IMemberService;

class PostController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $postService;
    public $memberService;

    /**
     * initialize all service containers and interfaces
     * check App\Providers\AppServiceProvider to see the bindings
     * @var $postService
     * @var $memberService
     */
    public function __construct(
        IPostService $postService,
        IMemberService $memberService)
    {
        $this->postService = $postService;
        $this->memberService = $memberService;
    }
    
    /**
     * return Post data
     * @param null
     */
    public function getPost() {
        return response()->json($this->postService->get());
    }

    /**
     * save username
     * @param $request
     */
    public function saveName(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',            
        ]);
        
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return $this->memberService->save($request);        
    }

    /**
     * post comment
     * @param $id
     * @param $request
     */

    public function postComment($id, Request $request) {
        
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|min:1',            
            'username_id' => 'required'
        ]);
        
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return $this->postService->postComment($id, $request->comment, $request->username_id);        
    }

    /**
     * respond to a cooment
     * @param $request
     */
    public function respondToComment(Request $request) {
        $validator = Validator::make($request->all(), [
            'response' => 'required|string|min:1',                        
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return $this->postService->respondToComment($request);        
    }

}
