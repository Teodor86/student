<?php
session_start();
ob_start();
require_once '../src/init.php';

$generatePass = new PasswordGenerator;

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	try {
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
	}	catch(Exception $e) {
			$file = 'log.txt';
			$date = date('Y-m-d H:i:s');
			$error = 'Message: '.$e->getMessage().PHP_EOL.'File: '.$e->getFile().PHP_EOL.'Line: '.$e->getLine().PHP_EOL.'Date: '.$date."\r\n\r\n";
			file_put_contents($file, $error, FILE_APPEND);
			echo $e->getMessage();
	}	
}

$pageTitle = 'Регистрация пользователя';
require_once '../views/signup.php';
?>