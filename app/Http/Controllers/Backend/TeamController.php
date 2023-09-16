<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class TeamController extends Controller
{
    public function allTeam()
    {
        $teams = Team::latest()->get();

        return view('backend.team.all_team', compact('teams'));
    }

    public function addTeam()
    {
        return view('backend.team.add_team');
    }

    public function teamStore(Request $request)
    {
        $validate = $request->validate([
            'name'      => 'required',
            'position'  => 'required',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(550, 670)->save('uploads/team/' . $name_gen);
        $save_url = 'uploads/team/' . $name_gen;

        Team::insert([
            'name'          => $validate['name'],
            'position'      => $validate['position'],
            'facebook'      => $request->facebook,
            'instagram'     => $request->instagram,
            'twitter'       => $request->twitter,
            'image'         => $save_url,
            'created_at'    => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Team data inserted successfully.',
            'alert-type'    => 'success'
        ];

        return redirect()->route('all.team')->with($notification);
    }
}
