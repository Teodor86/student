<?php

namespace Models\Users;

use Models\Users\UserDbGateway;

class UserValidator
{
    private $gateway;

    public function __construct(UserDbGateway $userGateway)
    {
        $this->gateway = $userGateway;
    }

    public function check(User $user)
    {
        if (empty($user->getName())) {
            $errors[] = 'Имя должно быть заполнено';
        } elseif (!preg_match('/^([А-Яа-я-]{3,30})$/u', $user->getName())) {
            $errors[] = 'Имя может содержать только русские буквы, дефис и не может быть меньше 3-х символов и больше 30 символов.';
        }

        if (empty($user->getSurname())) {
            $errors[] = 'Фамилия должно быть заполнено';
        } elseif (!preg_match('/^([А-Яа-я-]{3,30})$/u', $user->getSurname())) {
            $errors[] = 'Фамилия может содержать только русские буквы, дефис и не может быть меньше 3-х символов и больше 30 символов.';
        }

        if (empty($user->getEmail())) {
            $errors[] = 'Напишите свою электронную почту.';
        } elseif (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Это не правильная электронная почта. Напишите правильную.';
        } elseif ($this->gateway->checkEmail($user->getEmail(), $user->getUserId())) {
            $errors[] = 'Эта электронная почта сушествует в базе данных.';
        }

        if (empty($user->getBirthday())) {
            $errors[] = 'Вы не выбрали год рождения';
        }

        return $errors;
    }
}

?>