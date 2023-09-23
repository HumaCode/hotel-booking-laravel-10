<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function allFrontendRoomList()
    {
        $rooms = Room::latest()->get();

        return view('frontend.room.all_rooms', compact('rooms'));
    }

    public function roomDetailPage($id)
    {
        $roomdetail = Room::findOrFail($id);

        return view('frontend.room.room_detail', compact('roomdetail'));
    }
}
