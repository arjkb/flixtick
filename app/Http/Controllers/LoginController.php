<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        dd('validated');
    }
}
