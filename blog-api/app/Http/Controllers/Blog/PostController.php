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

    public function __construct(
        IPostService $postService,
        IMemberService $memberService)
    {
        $this->postService = $postService;
        $this->memberService = $memberService;
    }
    
    public function getPost() {
        return response()->json($this->postService->get());
    }

    public function saveName(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',            
        ]);
        
        if($validator->fails()) {
            return $validator->errors();
        }

        $this->memberService->save($request);

        return response()->json(['message' => 'username successfully saved!']);
    }

}
