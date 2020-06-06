<?php


namespace App\Adaptors;

use App\User;
use Illuminate\Support\Facades\Auth;
use SocialiteProviders\Manager\OAuth2\User as UserOAuth;

class SocialNetworkAuthService
{
    public function getUserBySocId(SocialMediaAdaptor $user, string $socName)
    {
        $userInSystem = User::query()
                ->where('id_in_soc', $user->getId_in_soc())
                ->where('type_auth', $socName)
                ->first()
            ?? $this->userWithSameEmail($user, $socName);

        if (is_null($userInSystem)) {
            $userInSystem = $user->createUserInSystem();
        }

        return $userInSystem;
    }

    public function userWithSameEmail( SocialMediaAdaptor $user, $socialNetwork)
    {
        $userInTheSystem = User::query()
            ->where('email', $user->getEmail())
            ->first();
        if ($userInTheSystem) {
            $userInTheSystem->update([
                'id_in_soc' => $user->getId_in_soc(),
                'type_auth' => $socialNetwork,
                'avatar' => $user->getAvatar()
            ]);
        }
        return $userInTheSystem;
    }
}
