<?php

namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Controllers\Api\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\DataProviders\PostDataProvider;
use App\Http\Requests\Api\Post\CreatePostRequest;
use App\Http\Requests\Api\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    use ApiResponser;

    public function index(PostDataProvider $provider):JsonResponse
    {
        return $this->successResponse([
//            $provider->getBuilder()->paginate(10)->withQueryString()
            'data' => PostResource::collection(Post::paginate(10))
        ]);
    }

    public function store(CreatePostRequest $request):JsonResponse
    {
        $post = Post::create(array_merge($request->all(),['user_id' => $request->user()->id]));
        return $this->successResponse([
            'data' => PostResource::make($post)->hide(['created_at','updated_at'])
        ]);
    }

    public function find(Post $post):JsonResponse
    {
        return $this->successResponse([
            'data' => PostResource::make($post->load(['comments','user']))->hide(['updated_at'])
        ]);
    }

    public function update(Post $post,UpdatePostRequest $request):JsonResponse
    {
        $post->update($request->only(['title','description','image','video']));
        return $this->successResponse([
            'message' => __("AuthApi.msg.updated"),
            'data' => $post
        ]);
    }

    public function remove(Post $post):JsonResponse
    {
        $post->deleteOrFail();
        return $this->successResponse([
            'message' => __("AuthApi.msg.removed")
        ]);
    }
}
