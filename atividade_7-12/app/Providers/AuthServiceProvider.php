<?php

namespace App\Providers;

use App\Models\Book;
use App\Policies\BookPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Book::class => BookPolicy::class,
        Author::class => AuthorPolicy::class,
        Publisher::class => PublisherPolicy::class,
        User::class => UserPolicy::class,
        Category::class => CategoryPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-borrowings', function ($user) {
            return in_array($user->role, ['admin', 'bibliotecario']);
        });
    }
}
