<?php


namespace App\Adaptors;


class GithubAdaptor extends SocialMediaAdaptor
{
    public function getName(): string
    {
        return !empty($this->user->getName() ||  $this->user->getNickName());
    }
}
