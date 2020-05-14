<?php


namespace App\Adaptors;

use App\User;
use Illuminate\Support\Facades\Auth;
use SocialiteProviders\Manager\OAuth2\User as UserOAuth;

class Adaptor
{
    public function getUserBySocId($user, string $socName)
    {
        $userInSystem = User::query()
                ->where('id_in_soc', $user->id)
                ->where('type_auth', $socName)
                ->first() ?? $this->userWithSameEmail($user, $socName);


        if (is_null($userInSystem)) {
            $userInSystem = new User();
            $userInSystem->fill([
                'name' => !empty($user->getName() ||  $user->getNickName()) ? ($user->getName() ?? $user->getNickName()) : '',
                'email' => $this->getUserEmail($user, $socName),
                'password' => '',
                'id_in_soc' => !empty($user->getId()) ? $user->getId() : '' ,
                'type_auth' => $socName,
                'avatar' => !empty($user->getAvatar()) ? $user->getAvatar() : ''
            ]);
            $userInSystem->save();
        }
        return $userInSystem;
    }

    public function getUserEmail($user, $socialNetwork)
    {
        $userEmail = '';
        if ($socialNetwork == 'vkontakte') {
            $userEmail = $user->accessTokenResponseBody['email'];
        } else {
            $userEmail = $user->email;
        }

        return $userEmail;

    }

    public function userWithSameEmail($user, $socialNetwork)
    {
        $userInTheSystem = User::query()
            ->where('email', $this->getUserEmail($user, $socialNetwork))
            ->first();
        if ($userInTheSystem) {
            $userInTheSystem->update([
                'id_in_soc' => !empty($user->getId()) ? $user->getId() : '',
                'type_auth' => $socialNetwork,
                'avatar' => !empty($user->getAvatar()) ? $user->getAvatar() : ''
            ]);
        }
        return $userInTheSystem;
    }
}
