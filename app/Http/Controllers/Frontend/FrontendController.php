<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function allFrontendRoomLits()
    {
        $rooms = Room::latest()->get();

        return view('frontend.room.all_rooms', compact('rooms'));
    }
}
