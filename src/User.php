<?php
class User
{
    private $name;
    private $surname;
    private $email;
    private $birthday;
    private $gender;
    private $code;
    private $uid;
    
    function __construct($data) {
		
        if(is_array($data)) {
            $this->name = (isset($data['name'])) ? trim($data['name']) : null;
            $this->surname = (isset($data['surname'])) ? trim($data['surname']) : null;
            $this->email = (isset($data['email'])) ? trim(strip_tags($data['email'])) : null;
            $this->birthday = (isset($data['birthday'])) ? trim($data['birthday']) : null;
            $this->gender = (isset($data['gender'])) ? trim($data['gender']) : null;
            $this->code = (isset($data['code'])) ? trim($data['code']) : null;
        } else {
          throw new Exception('Введите правильные данные.');
        }
    }
	
    function setName($name) {
        $this->name = $name;
    }
    
    function getName() {
        return $this->name;
    }
    
    function setSurname($surname) {
        $this->surname = $surname;
    }
    
    function getSurname() {
        return $this->surname;
    }
    
    function setEmail($email) {
        $this->email = $email;
    }
    
    function getEmail() {
        return $this->email;
    }
    
    function setBirthday($birthday) {
        $this->birthday = $birthday;
    }
    
    function getBirthday() {
        return $this->birthday;
    }
    
    function setGender($gender) {
        $this->gender = $gender;
    }
    
    function getGender() {
        return $this->gender;
    }
    
    function setCode($code) {
        if(isset($code)) {
            $this->code = $code;
        }
    }
    
    function getCode() {
        return $this->code;
    }
    
    function setUserId($uid) {
        $this->uid = $uid;
    }
    
    function getUserId() {
        return $this->uid;
    }
}
?>