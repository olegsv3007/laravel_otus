<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin;
    }

    public function view(User $user, User $model)
    {
        return
            $user->isAdmin ||
            $user->id == $model->id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, User $model)
    {
        return
            $user->isAdmin ||
            $user->id == $model->id;
    }

    public function delete(User $user, User $model)
    {
        return $user->isAdmin;
    }

    public function restore(User $user, User $model)
    {
        return $user->isAdmin;
    }

    public function forceDelete(User $user, User $model)
    {
        return $user->isAdmin;
    }
}
