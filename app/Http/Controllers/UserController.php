<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function userProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::findOrFail($id);

        return view('frontend.dashboard.edit_profile', compact('profileData'));
    }

    public function userProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);

        $validated = $request->validate([
            'name'      => 'required|unique:users,name,' . $id,
            'email'     => 'required|email|unique:users,email,' . $id,
            'phone'     => 'required|unique:users,phone,' . $id,
            'address'   => 'required',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        if ($request->file('photo')) {

            // unlink foto
            if ($data->photo <> "") {
                unlink('uploads/user_images/' . $data->photo);
            }

            $file       = $request->file('photo');
            $filename   = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/user_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->name     = $validated['name'];
        $data->email    = $validated['email'];
        $data->phone    = $validated['phone'];
        $data->address  = $validated['address'];
        $data->save();

        $notification = [
            'message'       => 'User profile update successfully',
            'alert-type'    => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function userLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message'       => 'Logout is successfully',
            'alert-type'    => 'success'
        ];

        return redirect('/login')->with($notification);
    }

    public function userChangePassword()
    {
        return view('frontend.dashboard.user_change_password');
    }

    public function passwordChangeStore(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            $notification = [
                'message'       => 'Old password does not match',
                'alert-type'    => 'error'
            ];

            return back()->with($notification);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = [
            'message'       => 'Password change successfully.',
            'alert-type'    => 'success'
        ];

        return back()->with($notification);
    }
}
