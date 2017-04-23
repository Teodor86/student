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
	
	try {
		
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
    } catch(Exception $e) {
		$file = 'log.txt';
		$date = date('Y-m-d H:i:s');
		$error = 'Message: '.$e->getMessage().PHP_EOL.'File: '.$e->getFile().PHP_EOL.'Line: '.$e->getLine().PHP_EOL.'Date: '.$date."\r\n\r\n";
		file_put_contents($file, $error, FILE_APPEND);
		echo $e->getMessage();
	}
}

$pageTitle = 'Редактировать пользователя';
require_once '../views/edit.php';
?>