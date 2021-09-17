<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }


    public function login(LoginRequest $request)
    {


        $credentials = $request->only('email', 'password' );
        if (Auth::attempt($credentials)) {

            if (Auth::user()->isAdmin()) {

                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('dashboard');



        }

        return redirect("login")->withErrors('Login details are not valid');
    }

    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return back();
    }

}
