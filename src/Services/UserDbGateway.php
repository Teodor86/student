<?php

namespace Services;

use Models\Users\User;

class UserDbGateway
{
    /** @var \PDO */
    private $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

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
     * @return User|null
     */
    public function getUserByAuthorizationCode(string $code): ?User
    {
        $query = "SELECT * FROM users WHERE code = :code";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':code', $code, \PDO::PARAM_STR);
        $stmt->execute();
        $entities = $stmt->fetchAll(\PDO::FETCH_CLASS, User::class);
        return $entities ? $entities[0] : null;
    }

    /**
     * @return array
     */
    public function getUsers(string $search, string $sort, int $skip, int $num): array
    {
        $searchQuery = '';

        if (!empty($search)) {
            $searchQuery = 'WHERE CONCAT(name, "", surname, "", email) LIKE :search';
            $s = "%$search%";
        }

        $allowed = ['uid', 'name', 'surname', 'email', 'birthday', 'gender'];
        $sort = in_array($sort, $allowed) ? $sort : 'id';

        $query = "SELECT id, name, surname, email, birthday, gender FROM users $searchQuery 
        ORDER BY $sort LIMIT :skip, :num";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':skip', (int)$skip, \PDO::PARAM_INT);
        $stmt->bindValue(':num', (int)$num, \PDO::PARAM_INT);
        if (!empty($searchQuery)) {
            $stmt->bindValue(":search", $s);
        }
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, User::class);
    }

    /**
     * @return int
     */
    public function countOfUsers(): int
    {
        $query = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->db->query($query);
        return $stmt->fetchColumn();
    }

    /**
     * @return array
     */
    public function search(string $search): array
    {
        $query = "SELECT * FROM users WHERE name LIKE ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute(array("%$search%"));
        return $stmt->fetchAll();
    }

    /**
     * @return bool
     */
    public function isUsedEmail(string $email, ?int $id): bool
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
        return boolval($row);
    }
}