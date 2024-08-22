<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function register()
    {
        return view('auth.register');
    }

    public function RegisterUser(Request $request)
    {
        try {
            $request->merge([
                'email' => trim($request->email)
            ]);

            $request->validate([
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed'
            ]);
            Log::info('data validated');

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => '/images/dummy_profile_image.png'
            ]);
            Auth::login($user);
            Log::info('success registering user');
            return Redirect::route('auth.login')->with('success', 'user registered successfully');
        } catch (\Exception $e) {
            Log::error('error registering user' . $e->getMessage());
            return Redirect::route('auth.register');
        }
    }
}
