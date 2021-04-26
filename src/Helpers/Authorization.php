<?php

namespace Helpers;

use Models\Users\UserDbGateway;

class Authorization
{
    /** @var \Models\Users\UserDbGateway */
    private $gateway;

    /**
     * UserValidator constructor.
     * @param \Models\Users\UserDbGateway $userGateway
     */
    public function __construct(UserDbGateway $userGateway)
    {
        $this->gateway = $userGateway;
    }

    /**
     * @param string $code
     */
    public static function setAuthorize(string $code): void
    {
        setcookie('user', $code, time() + 60 * 60 * 24 * 365, '/', null, null, true);
    }

    /**
     * @return mixed
     */
    public function getUserByCookie(): mixed
    {
        if (isset($_COOKIE['user'])) {
            return $this->gateway->getUserByAuthorizationCode($_COOKIE['user']);
        }
        return null;
    }
}

?>