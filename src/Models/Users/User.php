<?php

namespace Models\Users;

class User
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $surname = null;
    private ?string $email = null;
    private ?string $birthday = null;
    private ?string $gender = null;
    private ?string $code = null;

    const GENDER_MALE = 'M';
    const GENDER_FEMALE = 'F';

    public function setAttributes(array $input)
    {
        foreach ($input as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function setUserId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }
}