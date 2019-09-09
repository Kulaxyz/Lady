<?php

namespace App\Providers;

use App\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->role == 'admin') {
                return true;
            }
        });

        Gate::define('delete-post', function ($user, Post $post) {
            return $user->role == 'moderator' || $user->id == $post->user_id;
        });

//        Gate::define('delete-comment', function ($user, Post $post) {
//            return $user->role == 'moderator' || $user->id == $post->user_id;
//        });

//        Gate::define('manage-post', function ($user, $post) {
//            return $user->id == $post->user_id;
//        });
        Gate::define('add-tag', function ($user) {
            return $user->role == 'moderator';
        });

    }
}
