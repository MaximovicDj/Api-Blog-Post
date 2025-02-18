<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StorePostRequest;
use App\Http\Requests\Api\V1\UpdatePostRequest;
use App\Http\Resources\Api\V1\PostResource;
use App\Models\Post;
use App\Permissions\Abilities;
use App\Traits\ApiResponses;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    use AuthorizesRequests, ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if($user->tokenCan(Abilities::VIEW_ALL_POSTS))
        {
            return PostResource::collection(Post::with(['user', 'category'])->paginate(10));
        }
        else
        {
            return PostResource::collection(Post::with(['user', 'category'])->where('user_id', $user->id)->paginate(10));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $this->authorize('create', Post::class);
        $post = new Post();
        $post = $post->create($request->mappedData());
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $data = $request->mappedData();
        $data['user_id'] = $post->user_id;
        $post->update($data);
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return $this->successResponse('Successfully deleted post');
    }
}
