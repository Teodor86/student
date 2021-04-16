<?php

namespace Models\Users;

class User
{
    private $name;
    private $surname;
    private $email;
    private $birthday;
    private $gender;
    private $code;
    private $uid;

    const GENDER_MALE = 'M';
    const GENDER_FEMALE = 'F';

    public function setAttributes(array $input)
    {
        foreach ($input as $key => $value) {
            if (property_exists("Models\Users\User", $key)) {
                $this->$key = $value;
            }
        }
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setUserId(int $uid)
    {
        $this->uid = $uid;
    }

    public function getUserId(): ?int
    {
        return $this->uid;
    }
}

?>