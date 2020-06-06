<?php


namespace App\Adaptors;


class VkontakteAdaptor extends SocialMediaAdaptor
{
    public function getEmail()
    {
        return $this->user->accessTokenResponseBody['email'];
    }

}
