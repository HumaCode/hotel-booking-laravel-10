<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $title = 'Login Page';

        return view('auth.login_page', compact('title'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $id = Auth::user()->id;
        $data = User::findOrFail($id);

        $username = $data->name;

        $url = '';
        if ($request->user()->role === 'admin') {
            $url = '/admin/dashboard';
        } else {
            $url = '/dashboard';
        }

        $notification = [
            'message'       => 'User ' . $username . ' Login Successfully.',
            'alert-type'    => 'info'
        ];

        // return redirect()->intended(RouteServiceProvider::HOME);
        return redirect()->intended($url)->with($notification);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
