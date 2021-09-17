<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
class RegisterController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('ref')) {
            User::where('referral_code', 'like', $request->ref)->increment('views');
        }
        return view('auth.register');
    }

    public function store(RegistrationRequest $request)
    {

        $referrer_id = null;
        if ($request->has('ref')) {

            $check_referrer_id = User::where('referral_code', '=', $request->ref)->first();
            $referrer_id = $check_referrer_id ? $check_referrer_id->id : null;

        }
        $path = 'img/profile/';
        $file = $request->file('image');

        $extension = $file->getClientOriginalExtension();
        $filename =  time() . '.' . $extension;
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
            'referrer_id' => $referrer_id,
            'image' => $path.$filename,
        ]);

        $file->move($path, $filename);

        \Auth::login($user);

        return redirect()->intended('dashboard');

    }

}
