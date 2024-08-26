<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //
    public function loginForm()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|string'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return Redirect::to('/tasks')->with('status', 'success logging you in');
        }

        Log::warning('failed login attempt', ['email' => $request->email]);

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records'
        ])->withInput($request->only('email', 'remember'));
    }
}
