<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        $user           = User::where("username",$request->input("username"))->first();
        if(!empty($user->role)){
            $login  = Auth::guard($user->role)->attempt($credentials,$remember_me);
            if ($login) {
                $request->session()->regenerate();
                return redirect(route("dashboard"));
            }
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
