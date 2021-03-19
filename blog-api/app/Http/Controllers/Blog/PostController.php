<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Api\Services\Post\IPostService;

class PostController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $postService;

    public function __construct(IPostService $postService)
    {
        $this->postService = $postService;
    }
    
    public function getPost() {
        return response()->json($this->postService->get());
    }

}
