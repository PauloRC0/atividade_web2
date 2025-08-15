<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, User $targetUser)
    {
        return $user->role === 'admin' || 
               ($user->role === 'bibliotecario' && $user->id === $targetUser->id);
    }

    public function delete(User $user)
    {
        return $user->role === 'admin';
    }
}
