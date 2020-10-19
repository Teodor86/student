<?php
class UserGateway
{
	private $db;
    
    function __construct(PDO $pdo) {
      $this->db = $pdo;		
    }
	
    function save(User $user) {

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
          $stmt->bindValue(':name', $user->getName(), PDO::PARAM_STR);
          $stmt->bindValue(':surname', $user->getSurname(), PDO::PARAM_STR);
          $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
          $stmt->bindValue(':birthday', $user->getBirthday(), PDO::PARAM_INT);
          $stmt->bindValue(':gender', $user->getGender(), PDO::PARAM_STR);
          $stmt->bindValue(':code', $user->getCode(), PDO::PARAM_STR);
          $stmt->execute();
    }
	
    function selectUserByCode($code) {
      
        $query = "SELECT * FROM users WHERE code = :code";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':code', $code, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
	
    function getUsers($sort, $skip, $num) {
      
        $query = "SELECT uid, name, surname, email, birthday, gender FROM users ORDER BY $sort LIMIT $skip, $num";
        $stmt = $this->db->query($query);
        $row = $stmt->fetchAll();
        return $row;
    }
  
    function getCountUsers() {
        
        $query = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->db->query($query);
        $row = $stmt->fetchAll();
        return $row[0];
      
    }
	
    function updateUser(User $user) {
      
        $query = "UPDATE users SET 
                              name = :name,
                              surname = :surname,
                              email = :email,
                              birthday = :birthday,
                              gender = :gender 
                              WHERE code = :code";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':surname', $user->getSurname(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':birthday', $user->getBirthday(), PDO::PARAM_INT);
        $stmt->bindValue(':gender', $user->getGender(), PDO::PARAM_STR);
        $stmt->bindValue(':code', $user->getCode(), PDO::PARAM_STR);
        $stmt->execute();
      
    }
	
    function search($search) {
      
        $query = "SELECT * FROM users WHERE name LIKE ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute(array("%$search%"));
        $row = $stmt->fetchAll();
        return $row;
      
    }
	
    function checkEmail($email, $id) {

        if(empty($id)) {
          $id = '';
        }

        $query = "SELECT uid FROM users WHERE email = :email AND uid != :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
}
?>
