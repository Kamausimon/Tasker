<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
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
            Log::info('Data validated for user registration', ['email' => $request->email]);

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => '/images/dummy_profile_image.png'
            ]);
            Auth::login($user);
            Log::info('success registering user');

            return redirect()->route('login')->with('success', 'user registered successfully');
        } catch (\Exception $e) {
            Log::error('Error registering user: ' . $e->getMessage(), ['email' => $request->email]);
            return redirect()->route('register')->with('error', 'There was an error registering the user.');
        }
    }
}
