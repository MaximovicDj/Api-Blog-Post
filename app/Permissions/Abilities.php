<?php

namespace App\Permissions;

use App\Models\User;

final class Abilities
{
    // categoires const
    public const CREATE_CATEGORY = 'create:category';
    public const VIEW_CATEGORY = 'view:category';
    public const UPDATE_CATEGORY = 'update:category';
    public const DELETE_CATEGORY = 'delete:category';

    /**
     * @param User $user
     * @param string $role
     * @return array
     */
    public static function setAbilities(User $user, string $role): array
    {
        if($user->hasRole($role))
        {
            return [
                self::CREATE_CATEGORY,
                self::VIEW_CATEGORY,
                self::UPDATE_CATEGORY,
                self::DELETE_CATEGORY,
            ];
        }
    }
}
