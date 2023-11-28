<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard(){
        return view("panel.dashboard");
    }

    public function settings(Request $request){
        if($request->method() === "POST"){
            $request->validate([
                "password"  => ["required","min:8","max:32"],
                "conf_password"     => ["required","same:password"]
            ]);

            $auth   = Auth::user();
            $user   = User::find($auth->id);
            $user->password     = Hash::make($request->input("password"));
            if($user->save()){
                return back()->with([
                    "message"   => "Successfuly change password"
                ]);    
            }

            return back()->with([
                "message"   => "Failed, Please try again"
            ]);
        }else{
            return view("panel.settings");
        }
    }
}
