<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Sign up a new user
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
}
