<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookArea;
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
            'message'       => 'Team updated successfully',
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




    // ===============================BOOK AREA =====================================

    public function bookArea()
    {
        $book = BookArea::find(1);

        return view('backend.bookarea.book_area', compact('book'));
    }

    public function bookAreaUpdate(Request $request)
    {
        $id     = $request->id;
        $data   = BookArea::findOrFail($id);

        $validated = $request->validate([
            'short_title'   => 'required',
            'main_title'    => 'required',
            'short_desc'    => 'required',
            'link_url'      => 'required',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        if ($request->file('image')) {

            // unlink foto
            if ($data->image <> "") {
                unlink($data->image);
            }

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1000, 1000)->save('uploads/bookarea/' . $name_gen);
            $save_url = 'uploads/bookarea/' . $name_gen;

            $data->image = $save_url;
        }

        $data->short_title      = $validated['short_title'];
        $data->main_title       = $validated['main_title'];
        $data->short_desc       = $validated['short_desc'];
        $data->link_url         = $validated['link_url'];
        $data->updated_at       = Carbon::now();

        $data->save();

        $notification = [
            'message'       => 'Book Area updated successfully',
            'alert-type'    => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
