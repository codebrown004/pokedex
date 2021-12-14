<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->except( 'login', 'authenticate', 'signup', 'register');
        $this->middleware('guest');
    }



    public function login()
    {
        return view('pages.login');
    }

    public function authenticate(LoginRequest $input)
    {
        if(! auth()->attempt(request(['email', 'password'])))
        {
            return back()->withErrors([
                        'message' => 'Please check your credentials and try again.'
                    ]);
        }

        return redirect()->home();
    }

    public function signup()
    {
        return view('pages.signup');
    }

    public function register()
    {
        $this->validate(request(),[
                'firstname'  => 'required',
                'lastname'  => 'required',
                'birthday'  => 'required|date',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:3|confirmed'
        ]);

        $user = \App\User::create(
            ['firstname' => request('firstname'),
             'lastname' => request('lastname'), 
             'birthday' => request('birthday'), 
             'email' => request('email'), 
             'password' => Hash::make(request('password'))]);

        auth()->login($user);

        // dd($user);

        return redirect()->home();
    }

}
