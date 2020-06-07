<?php

namespace App\Http\Controllers;

use App\Adaptors\SocialMediaAdaptor;
use App\Services\SocialNetworkAuthService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Model\Repository\ProductRepository;
use App\Adaptors\GitHubAdaptor;
use App\Adaptors\VkontakteAdaptor;


class SocialLoginController extends Controller
{
    public function login($socialNetwork)
    {
        if (Auth::check()) {
            return redirect()->route('Home');
        }
        return Socialite::with($socialNetwork)->redirect();
    }

    public function response(SocialNetworkAuthService $socialNetworkAuthService, $socialNetwork)
    {
        if (Auth::check()) {
            return redirect()->route('Home');
        }

        try {
            $user = $this->getSocialAuthAdapter(Socialite::driver($socialNetwork)->user(), $socialNetwork);
            $userInSystem = $socialNetworkAuthService->getUserBySocId($user, $socialNetwork);
            Auth::login($userInSystem);
            return redirect()->route('Home');

        } catch (\Exception $exception) {

            return redirect('/login')

                ->with('error' , $exception->getMessage());
        }


    }

    protected function getSocialAuthAdapter($user, $socialNetwork): SocialMediaAdaptor
    {
        $socialNetworkAdaptor = "App\Adaptors\'" . ucfirst($socialNetwork) . 'Adaptor';
        return /*new VkontakteAdaptor($user, $socialNetwork)*/new $socialNetworkAdaptor($user, $socialNetwork);

    }

}
