<?php

namespace Models\Users;

use Models\Users\User;

class UserDbGateway
{
    /** @var \PDO */
    private $db;

    /**
     * UserDbGateway constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    /**
     * @param \Models\Users\User $user
     */
    public function save(User $user): void
    {
        $query = "INSERT INTO users(
                                  name,
                                  surname,
                                  email,
                                  birthday,
                                  gender,
                                  code) 
                                  VALUES(
                                  :name,
                                  :surname,
                                  :email,
                                  :birthday,
                                  :gender,
                                  :code)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':name', $user->getName(), \PDO::PARAM_STR);
        $stmt->bindValue(':surname', $user->getSurname(), \PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $stmt->bindValue(':birthday', $user->getBirthday(), \PDO::PARAM_INT);
        $stmt->bindValue(':gender', $user->getGender(), \PDO::PARAM_STR);
        $stmt->bindValue(':code', $user->getCode(), \PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getUserByAuthorizationCode($code): mixed
    {
        $query = "SELECT * FROM users WHERE code = :code";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':code', $code, \PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row;
    }

    /**
     * @param \Models\Users\User $user
     */
    public function update(User $user): void
    {
        $query = "UPDATE users SET 
                            name = :name,
                            surname = :surname,
                            email = :email,
                            birthday = :birthday,
                            gender = :gender 
                            WHERE code = :code";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':name', $user->getName(), \PDO::PARAM_STR);
        $stmt->bindValue(':surname', $user->getSurname(), \PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $stmt->bindValue(':birthday', $user->getBirthday(), \PDO::PARAM_INT);
        $stmt->bindValue(':gender', $user->getGender(), \PDO::PARAM_STR);
        $stmt->bindValue(':code', $user->getCode(), \PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * @param $search
     * @param $sort
     * @param $skip
     * @param $num
     * @return array
     */
    public function getUsers($search, $sort, $skip, $num): array
    {
        $searchQuery = '';

        if (!empty($search)) {
            $searchQuery = 'WHERE name LIKE :search';
            $s = "%$search%";
        }

        $query = "SELECT id, name, surname, email, birthday, gender FROM users $searchQuery ORDER BY $sort LIMIT :skip, :num";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':skip', (int)$skip, \PDO::PARAM_INT);
        $stmt->bindValue(':num', (int)$num, \PDO::PARAM_INT);
        if (!empty($searchQuery)) {
            $stmt->bindValue(":search", $s);
        }
        $stmt->execute();
        $row = $stmt->fetchAll();
        return $row;
    }

    /**
     * @return int
     */
    public function countOfUsers(): int
    {
        $query = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->db->query($query);
        $row = $stmt->fetchColumn();
        return $row;
    }

    /**
     * @param $search
     * @return array
     */
    public function search($search): array
    {
        $query = "SELECT * FROM users WHERE name LIKE ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute(array("%$search%"));
        return $stmt->fetchAll();
    }

    /**
     * @param $email
     * @param $id
     * @return mixed
     */
    public function isUsedEmail($email, $id)
    {
        if (empty($id)) {
            $id = 0;
        }

        $query = "SELECT id FROM users WHERE email = :email AND id != :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row;
    }
}