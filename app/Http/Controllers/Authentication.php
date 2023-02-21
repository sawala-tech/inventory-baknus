<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Authentication extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('pages.auth.app');
    }
    
    public function login(Request $request)
    {
        
        $validate=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validate){
            $credentials=$request->only('email','password');
            if(Auth::attempt($credentials)){
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }
        }
        return back()->with('error','Email atau Password salah');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
