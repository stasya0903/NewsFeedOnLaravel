<?php


namespace App\Adaptors;


use App\User;

abstract class SocialMediaAdaptor
{
    public $user;
    public $id_in_soc;
    public $name;
    public $email;
    public $avatar;
    public $socMediaName;

    public function __construct($user, $socMediaName)
    {
        $this->user = $user;
        $this->socMediaName = $socMediaName;
    }
    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return !empty($this->user->getAvatar()) ? $this->user->getAvatar() : '';
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->user->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->user->name;
    }

    public function getId_in_soc()
    {
        return $this->id_in_soc = !empty($this->user->getId()) ? $this->user->getId() : '';
    }

    public function createUserInSystem()
    {
        $userInSystem = new User();
        $userInSystem->fill([
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => '',
            'id_in_soc' => $this->getId_in_soc(),
            'type_auth' => $this->socMediaName,
            'avatar' => $this->getAvatar()
        ]);
        $userInSystem->save();
        return $userInSystem;
    }


}
