<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return view('administrator.auth.login');
    }

    public function authenticate(Request $request)
    {
        Auth::shouldUse('administrator');

        $messages = [
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',
        ];

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], $messages);

        if (Auth::attempt($credentials)) {
            session(['superuserlogin' => true]);
            return redirect('/superuseradminlacj5ub3lqwysaj9rik5/dashboard');
        }

        session()->flash('error', 'You have entered invalid credentials');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/superuseradminlacj5ub3lqwysaj9rik5/login');
    }
}

