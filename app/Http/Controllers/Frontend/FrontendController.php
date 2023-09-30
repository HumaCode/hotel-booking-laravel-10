<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomBookedDate;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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

    public function bookingSearch(Request $request)
    {
        $request->flash();

        // if ($request->check_in == $request->check_out) {
        //     $notification = [
        //         'message'       => 'Something went to wrong',
        //         'alert-type'    => 'error'
        //     ];

        //     return redirect()->back()->with($notification);
        // }

        $sdate      = date('Y-m-d', strtotime($request->check_in));
        $edate      = date('Y-m-d', strtotime($request->check_out));
        $alldate    = Carbon::create($edate)->subDay();
        $d_period   = CarbonPeriod::create($sdate, $alldate);

        $dt_array = [];
        foreach ($d_period as $period) {
            array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $dt_array)
            ->distinct()->pluck('booking_id')->toArray();

        $rooms = Room::withCount('room_numbers')->where('status', 1)->get();

        return view('frontend.room.search_room', compact('check_date_booking_ids', 'rooms'));
    }

    public function searchRoomDetails(Request $request, $id)
    {
        $request->flash();

        $roomdetail = Room::with('type', 'multiimage', 'facility')->findOrFail($id);
        $otherroom  = Room::with('type', 'multiimage', 'facility')->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(2)->get();
        $room_id = $id;

        return view('frontend.room.search_room_details', compact('roomdetail', 'otherroom', 'room_id'));
    }

    public function checkRoomAvailability(Request $request)
    {
        $sdate = date('Y-m-d', strtotime($request->check_in));
        $edate = date('Y-m-d', strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $alldate);
        $dt_array = [];
        foreach ($d_period as $period) {
            array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $dt_array)->distinct()->pluck('booking_id')->toArray();

        $room = Room::withCount('room_numbers')->find($request->room_id);

        $bookings = Booking::withCount('assign_rooms')->whereIn('id', $check_date_booking_ids)->where('rooms_id', $room->id)->get()->toArray();

        $total_book_room = array_sum(array_column($bookings, 'assign_rooms_count'));

        $av_room = @$room->room_numbers_count - $total_book_room;

        $toDate = Carbon::parse($request->check_in);
        $fromDate = Carbon::parse($request->check_out);
        $nights = $toDate->diffInDays($fromDate);

        return response()->json(['available_room' => $av_room, 'total_nights' => $nights]);
    }
}
