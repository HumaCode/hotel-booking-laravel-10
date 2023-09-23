<?php

namespace App\Providers;

use App\Models\BookArea;
use App\Models\Room;
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
            $teams      = Team::latest()->get();

            $view->with([
                'teams'     => $teams,
            ]);
        });

        View::composer('frontend.home.room_area_two', function ($view) {
            $bookarea   = BookArea::find(1);

            $view->with([
                'bookarea'  => $bookarea,
            ]);
        });

        View::composer('frontend.home.room_area', function ($view) {
            $rooms   = Room::with('type', 'multiimage', 'facility')->latest()->limit(4)->get();

            $view->with([
                'rooms'  => $rooms,
            ]);
        });

        View::composer('frontend.body.navbar', function ($view) {
            $roomType   = Room::with('type', 'multiimage', 'facility')->latest()->get();

            $view->with([
                'roomType'  => $roomType,
            ]);
        });
    }
}
