<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function canDestroy($user):bool
    {
        return $user->type === "admin";
    }

    public function canChangeStatus($user):bool
    {
        return $user->isAdmin();
    }
}
