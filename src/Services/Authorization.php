<?php

namespace Services;

use Services\UserDbGateway;
use Models\Users\User;

class Authorization
{
    /** @var \Services\UserDbGateway */
    private $gateway;

    public function __construct(UserDbGateway $userGateway)
    {
        $this->gateway = $userGateway;
    }

    public static function createToken(User $user): void
    {
        setcookie('user', $user->getCode(), time() + 60 * 60 * 24 * 365, '/', null, null, true);
    }

    /**
     * @return User|null
     */
    public function getUserByToken(): ?User
    {
        if (isset($_COOKIE['user'])) {
            return $this->gateway->getUserByAuthorizationCode($_COOKIE['user']);
        }
        return null;
    }
}