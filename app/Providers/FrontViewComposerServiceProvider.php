<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontViewComposerServiceProvider extends ServiceProvider
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
        View::composer('frontend.home.team', function ($view) {
            $teams = Team::latest()->get(); // Misalnya, Anda ingin mengambil data user saat ini

            $view->with(['teams' => $teams]);
        });
    }
}
