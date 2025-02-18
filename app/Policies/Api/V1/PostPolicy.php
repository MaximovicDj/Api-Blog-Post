<?php

namespace App\Policies\Api\V1;

use App\Models\Post;
use App\Models\User;
use App\Permissions\Abilities;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        if($user->tokenCan(Abilities::VIEW_ANY_POST))
        {
            return true;
        }
        else if($user->tokenCan(Abilities::VIEW_OWN_POST))
        {
            return $user->id == $post->user_id;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->tokenCan(Abilities::CREATE_POST))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        if($user->tokenCan(Abilities::UPDATE_ALL_POSTS))
        {
            return true;
        }
        if($user->tokenCan(Abilities::UPDATE_OWN_POST))
        {
            return $post->user_id === $user->id;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        if($user->tokenCan(Abilities::DELETE_ALL_POSTS))
        {
            return true;
        }
        if($user->tokenCan(Abilities::DELETE_OWN_POST))
        {
            return $post->user_id == $user->id;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }
}
