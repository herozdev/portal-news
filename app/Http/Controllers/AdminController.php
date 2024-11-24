<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function auth()
    {
        return view('login', [
            'title' => "Login User",
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function registration()
    {
        return view('register', [
            'title' => "Registration User",
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:5', 'max:50', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'max:15']
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        // $request->session()->flash('success', 'Registration Successfull!!');

        return redirect('/auth')->with('success', 'Registration Successfull!!');

    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Username and Password not found!!');
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'title' => "Dashboard"
        ]);
    }
}
