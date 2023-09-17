<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function editRoom($id)
    {
        $editData = Room::findOrFail($id);

        return view('backend.allroom.rooms.edit_rooms', compact('editData'));
    }
}
