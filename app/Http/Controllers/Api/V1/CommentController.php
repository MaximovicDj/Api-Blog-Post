<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCommentRequest;
use App\Http\Requests\Api\V1\UpdateCommentRequest;
use App\Http\Resources\Api\V1\PostResource;
use App\Models\Comment;
use App\Models\Post;
use App\Traits\ApiResponses;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use AuthorizesRequests, ApiResponses;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        $this->authorize('store', Comment::class);
        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->post_id = $post->id;
        $comment->user_id = $request->user()->id;
        $comment->save();
        return new PostResource($post->load('comments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);
        $comment->comment = $request->input('comment');
        $comment->save();
        return new PostResource($post->load('comments'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('destroy', $comment);
        $comment->delete();
        return $this->successResponse('Comment deleted successfully');
    }
}
