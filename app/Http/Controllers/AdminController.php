<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.index');
    }

    public function adminLogin()
    {
        return view('admin.auth.admin_login');
    }

    public function adminForgotPass()
    {
        return view('admin.auth.admin_forgot_password');
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::findOrFail($id);


        return view('admin.admin_profile', compact('profileData'));
    }

    public function adminProfileStore(Request $request)
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
                unlink('uploads/admin_images/' . $data->photo);
            }

            $file       = $request->file('photo');
            $filename   = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->name     = $validated['name'];
        $data->email    = $validated['email'];
        $data->phone    = $validated['phone'];
        $data->address  = $validated['address'];
        $data->save();

        return redirect()->back();
    }
}
