<?php
session_start();
ob_start();
require_once '../src/init.php';

$generatePass = new PasswordGenerator;

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$db = new PDOFactory;
	$pdo = $db->getConnection();
	$user = new User($_POST);
	$userGateway = new UserGateway($pdo);
	$validate = new UserValidator($userGateway);
	$errors = $validate->check($user);

	if(empty($errors)) {
			
		$code = $generatePass->createPass(60);
		$user->setCode($code);
		Authorization::setAuthorize($user->getCode());

		$result = $userGateway->save($user);
		
		if($result !== false) {
			$_SESSION['success'] = 'Регистрация прошло успешно';
			header('Location:edit.php');
			exit;
		}			
	}
}

$pageTitle = 'Регистрация пользователя';
require_once '../views/signup.php';
?>
