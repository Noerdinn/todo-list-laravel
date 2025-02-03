<?php

namespace App\Providers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // kirim data nama email ke navbar profile
        View::composer('components.navbar', function ($view) {
            $view->with('user', Auth::user());
        });

        // kirim task user yang belum selesai
        View::composer('components.sidebar', function ($view) {
            $user = Auth::user();
            $taskCount = $user ? Task::where('user_id', $user->id)->where('is_complete', false)->count() : 0;
            $view->with('taskCount', $taskCount);
        });
    }
}
