<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store()
    {
        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:40',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8|max:40',
            ]
        );

        User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Your account has been created');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
        $validated = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8|max:40',
            ]
        );

        if (auth()->attempt($validated)) { // if the user is authenticated auth() bawaan laravel

            request()->session()->regenerate(); // regenerate the session to prevent session fixation attacks (security)

            return redirect()->route('dashboard')->with('success', 'You are now logged in');
        }


        return redirect()->route('login')->withErrors(
            [
                'email' => 'The provided credentials do not match our records.',
            ]
        );
    }

    public function logout()
    {
        auth()->logout(); // logout the user

        request()->session()->invalidate(); // invalidate the session

        request()->session()->regenerateToken(); // regenerate the CSRF token

        return redirect()->route('dashboard')->with('success', 'You are now logged out');
    }
}
