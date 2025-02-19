<?php

namespace App\Permissions;

use App\Models\User;

final class Abilities
{

    // Admin have full access to all posts logic
    public const UPDATE_ALL_POSTS = 'update:all:posts';
    public const DELETE_ALL_POSTS = 'delete:all:posts';
    public const VIEW_ALL_POSTS = 'view:all:posts';
    public const VIEW_ANY_POST = 'view:any:post';

    public const CREATE_POST = 'create:post';
    public const UPDATE_OWN_POST = 'update:own:post';
    public const DELETE_OWN_POST = 'delete:own:post';
    public const VIEW_OWN_POST = 'view:own:post';
    public const VIEW_OWN_POSTS = 'view:own:posts';

    public const COMMENT_ALL_POSTS = 'comment:all:posts';
    public const UPDATE_ALL_COMMENTS = 'update:all:comments';
    public const DELETE_ALL_COMMENTS = 'delete:all:comments';
    public const DELETE_RELATED_COMMENT = 'delete:related:comment';
    public const UPDATE_OWN_COMMENT = 'edit:own:comment';
    public const DELETE_OWN_COMMENT = 'delete:own:comment';


    /**
     * @param User $user
     * @return array
     */
    public static function setAbilities(User $user): array
    {
        if($user->hasRole('admin'))
        {
            return [
                self::UPDATE_ALL_POSTS,
                self::DELETE_ALL_POSTS,
                self::VIEW_ALL_POSTS,
                self::VIEW_ANY_POST,
                self::CREATE_POST,
                self::COMMENT_ALL_POSTS,
                self::UPDATE_ALL_COMMENTS,
                self::DELETE_ALL_COMMENTS,
            ];
        }
        if($user->hasRole('editor'))
        {
            return [
                self::CREATE_POST,
                self::UPDATE_OWN_POST,
                self::DELETE_OWN_POST,
                self::VIEW_OWN_POST,
                self::VIEW_OWN_POSTS,
                self::COMMENT_ALL_POSTS,
                self::UPDATE_OWN_COMMENT,
                self::DELETE_OWN_COMMENT,
                self::DELETE_RELATED_COMMENT,

            ];
        }
        if($user->hasRole('user'))
        {
            return [
                self::COMMENT_ALL_POSTS,
                self::UPDATE_OWN_COMMENT,
                self::DELETE_OWN_COMMENT
            ];
        }
        return [];
    }
}
