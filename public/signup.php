<?php
ob_start();
session_start();
require_once __DIR__ . '/../src/init.php';

$userDbGateway = $container->get('\Services\UserDbGateway');
$authHelper = $container->get('\Services\Authorization');

$user = new Models\Users\User;
$unique = new Helpers\UniqueCodeGenerator;
$validator = new Services\UserValidator($userDbGateway);

if ($authHelper->getUserByToken()) {
    $user = $authHelper->getUserByToken();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $input = [];
    $allowed = ['name', 'surname', 'email', 'birthday', 'gender'];

    foreach ($allowed as $allow) {
        $input[$allow] = array_key_exists($allow, $_POST) ? trim(strval($_POST[$allow])) : '';
    }

    $user->setAttributes($input);

    $errors = [];
    $errors = $validator->check($user);

    if (empty($errors)) {
        if ($authHelper->getUserByToken()) {
            $userDbGateway->update($user);
            Helpers\FlashMessage::set('editOfUser', 'Ваш профиль редактирирован.', 'success');

            header('Location:index.php');
            exit;

        } else {
            $user->setCode($unique->createCode(80));
            $userDbGateway->save($user);
            Services\Authorization::createToken($user);

            Helpers\FlashMessage::set('accountOfUser', 'Поздравляю с успешной регистрацией!', 'success');

            header('Location:index.php');
            exit;
        }
    }
}

$pageTitle = 'Регистрация пользователя';
require_once '../views/signup.html';

