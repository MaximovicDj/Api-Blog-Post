<?php

namespace App\Policies\Api\V1;

use App\Models\Comment;
use App\Models\User;
use App\Permissions\Abilities;

class CommentPolicy
{
    public function store(User $user): bool
    {
        if($user->tokenCan(Abilities::COMMENT_ALL_POSTS))
        {
            return true;
        }
        return false;
    }

    public function update(User $user, Comment $comment): bool
    {
        if($user->tokenCan(Abilities::UPDATE_ALL_COMMENTS))
        {
            return true;
        }
        else if($user->tokenCan(Abilities::UPDATE_OWN_COMMENT))
        {
            return $user->id == $comment->user_id;
        }
        return false;
    }

    public function destroy(User $user, Comment $comment): bool
    {
        if($user->tokenCan(Abilities::DELETE_ALL_COMMENTS))
        {
            return true;
        }
        if($user->tokenCan(Abilities::DELETE_RELATED_COMMENT))
        {
            return $user->id == $comment->post->user_id;
        }
        if($user->tokenCan(Abilities::DELETE_OWN_COMMENT))
        {
            return $user->id == $comment->user_id;
        }
        return false;
    }
}
