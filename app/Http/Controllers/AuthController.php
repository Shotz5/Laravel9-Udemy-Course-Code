<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function create() 
    {
        return inertia('Auth/Login');
    }

    public function store(Request $request)
    {
        // Always authenticate forever, unless user logs out
        if (!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]), true)) {
            // Will use the same exceptions as $request->validate to propogate exception to frontend
            throw ValidationException::withMessages([
                'email' => 'Authentication failed',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/listing');
    }

    public function destory()
    {
        
    }
}
