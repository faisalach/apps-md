<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view("panel.login");
    }

    public function authenticated(Request $request){

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required','min:8'],
        ]);

        $remember_me    = !empty($request->input("remember_me")) ? 1 : 0;
 
        if (Auth::attempt($credentials,$remember_me)) {
            $request->session()->regenerate();
 
            return redirect(route("dashboard"));
        }

        return back()->with([
            'message' => 'Incorrect username and password.',
        ])->onlyInput('username','remember_me');

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }


}
