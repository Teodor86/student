<?php
ob_start();
session_start();
require_once __DIR__ . '/../src/init.php';

$user = new Models\Users\User;
$unique = new Helpers\UniqueCodeGenerator;
$validate = new Models\Users\UserValidator($userDbGateway);

if (!is_null(Helpers\Authorization::getCookie())) {
    $input = $userDbGateway->selectUserByAuthorizationCode(Helpers\Authorization::getCookie());
    $user->setAttributes($input);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = [];
    $allowed = ['name', 'surname', 'email', 'birthday', 'gender'];

    foreach ($allowed as $allow) {
        $input[$allow] = array_key_exists($allow, $_POST) ? trim(strval($_POST[$allow])) : '';
    }

    $user->setAttributes($input);
    $errors = $validate->check($user);

    if (empty($errors)) {
        if (!is_null(Helpers\Authorization::getCookie())) {
            $result = $userDbGateway->updateUser($user);
            Helpers\FlashMessage::setFlashMessage('editOfUser', 'Ваш профиль редактирирован.', 'success');

            if ($result !== false) {
                header('Location:index.php');
                exit;
            }
        } else {
            $user->setCode($unique->createCode(80));
            Helpers\Authorization::setAuthorize($user->getCode());

            $userDbGateway->save($user);
            Helpers\FlashMessage::setFlashMessage('accountOfUser', 'Поздравляю с успешной регистрацией!', 'success');

            header('Location:index.php');
            exit;
        }
    }
}

$pageTitle = 'Регистрация пользователя';
require_once '../views/signup.html';

