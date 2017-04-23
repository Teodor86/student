<?php
session_start();
require_once '../src/init.php';

$db = new PDOFactory;
$pdo = $db->getConnection();
$userGateway = new UserGateway($pdo);

$code = Authorization::getCookie();

$users = $userGateway->selectUserByCode($code);
$form = new FormHelper;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
    $user = new User($users);
    $user->setName($_POST['name']);
		$user->setSurname($_POST['surname']);
		$user->setEmail($_POST['email']);
		$user->setBirthday($_POST['birthday']);
		$user->setGender($_POST['gender']);
		$user->setUserId($_POST['userid']);
		
		$validate = new UserValidator($userGateway);
		$errors = $validate->check($user);
			
		if( empty($errors)) {		
        $result = $userGateway->updateUser($user);
		 
        if($result !== false) {
            header('Location:edit.php');
            exit;
        }
		}
}

$pageTitle = 'Редактировать пользователя';
require_once '../views/edit.php';
?>