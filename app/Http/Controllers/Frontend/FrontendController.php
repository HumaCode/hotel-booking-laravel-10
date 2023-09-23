<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function allFrontendRoomList()
    {
        $rooms = Room::with('type', 'multiimage', 'facility')->latest()->get();

        return view('frontend.room.all_rooms', compact('rooms'));
    }

    public function roomDetailPage($id)
    {
        $roomdetail = Room::with('type', 'multiimage', 'facility')->findOrFail($id);
        $otherroom  = Room::with('type', 'multiimage', 'facility')->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(2)->get();

        return view('frontend.room.room_detail', compact('roomdetail', 'otherroom'));
    }
}
