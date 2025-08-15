<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;

class BookPolicy
{
    public function viewAny(User $user)
    {
        return true; // Everyone can view books
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    public function update(User $user)
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    public function delete(User $user)
    {
        return $user->role === 'admin';
    }

    public function borrow(User $user)
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }
}
