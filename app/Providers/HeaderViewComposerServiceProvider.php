<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HeaderViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('admin.body.header', function ($view) {
            $profileData = User::find(auth()->user()->id); // Misalnya, Anda ingin mengambil data user saat ini

            $view->with(['profileData' => $profileData]);
        });
    }
}
