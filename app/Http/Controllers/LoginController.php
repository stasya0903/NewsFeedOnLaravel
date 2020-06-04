<?php

namespace App\Http\Controllers;

use App\Adaptors\Adaptor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login($socialNetwork)
    {
        if (Auth::check()) {
            return redirect()->route('Home');
        }
        return Socialite::with($socialNetwork)->redirect();
    }

    public function response(Adaptor $userAdaptor, $socialNetwork)
    {
        if (Auth::check()) {
            return redirect()->route('Home');
        }

        try {
            $user = Socialite::driver($socialNetwork)->user();
            $userInSystem = $userAdaptor->getUserBySocId($user, $socialNetwork);
            Auth::login($userInSystem);
            return redirect()->route('Home');

        } catch (\Exception $exception) {

            return redirect('/login')

                ->with('error' , $exception->getMessage());
        }


    }

}
