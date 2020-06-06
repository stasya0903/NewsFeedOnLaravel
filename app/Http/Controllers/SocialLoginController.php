<?php

namespace App\Http\Controllers;

use App\Adaptors\SocialNetworkAuthService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Model\Repository\ProductRepository;

class SocialLoginController extends Controller
{
    public function login($socialNetwork)
    {
        if (Auth::check()) {
            return redirect()->route('Home');
        }
        return Socialite::with($socialNetwork)->redirect();
    }

    public function response(SocialNetworkAuthService $userAdaptor, $socialNetwork)
    {
        if (Auth::check()) {
            return redirect()->route('Home');
        }

        try {
            $user = $this->getSocialAuthAdapter(Socialite::driver($socialNetwork)->user(), $socialNetwork);
            $userInSystem = $userAdaptor->getUserBySocId($user, $socialNetwork);
            Auth::login($userInSystem);
            return redirect()->route('Home');

        } catch (\Exception $exception) {

            return redirect('/login')

                ->with('error' , $exception->getMessage());
        }


    }

    protected function getSocialAuthAdapter($user, $socialNetwork)
    {
        $socialNetworkAdaptor = ucfirst($socialNetwork) . 'Adaptor';
        return new $socialNetworkAdaptor($user);

    }

}
