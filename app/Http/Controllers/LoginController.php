<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Sign up a new user.
     *
     * @param Request $request
     * @return void
     */
    public function signup(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string|min:3|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string',
        ]);

        $user = new User;
        $user->username = $credentials['username'];
        $user->password = Hash::make($credentials['password']);
        $user->save();

        return redirect('auth/login')->with('flash', 'User registered!');
    }

    /**
     * Log in a user.
     *
     * @param Request $request
     * @return void
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        // will reach here only if valid login
        return back()->withErrors([
            'credentials' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('auth/login');
    }
}
