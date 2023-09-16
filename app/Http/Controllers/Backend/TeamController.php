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

    public function editTeam($id)
    {
        $team = Team::findOrFail($id);

        return view('backend.team.edit_team', compact('team'));
    }

    public function teamUpdate(Request $request)
    {
        $id = $request->id;
        $data = Team::findOrFail($id);

        $validated = $request->validate([
            'name'      => 'required',
            'position'  => 'required',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        if ($request->file('image')) {

            // unlink foto
            if ($data->image <> "") {
                unlink($data->image);
            }

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 670)->save('uploads/team/' . $name_gen);
            $save_url = 'uploads/team/' . $name_gen;

            $data->image = $save_url;
        }

        $data->name         = $validated['name'];
        $data->position     = $validated['position'];
        $data->facebook     = $request->facebook;
        $data->instagram    = $request->instagram;
        $data->twitter      = $request->twitter;
        $data->updated_at   = Carbon::now();

        $data->save();

        $notification = [
            'message'       => 'Team update successfully',
            'alert-type'    => 'success'
        ];

        return redirect()->route('all.team')->with($notification);
    }

    public function teamDelete($id)
    {
        $data = Team::findOrFail($id);

        // unlink foto
        if ($data->image <> "") {
            unlink($data->image);
        }

        $data->delete();

        $notification = [
            'message'       => 'Team delete successfully',
            'alert-type'    => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
