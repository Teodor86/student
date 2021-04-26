<?php
ob_start();
session_start();
require_once __DIR__ . '/../src/init.php';

$container->register('\Models\Users\UserDbGateway', function (\Services\DIContainer $container) {
    return new \Models\Users\UserDbGateway($container->get('PDO'));
});

$userDbGateway = $container->get('\Models\Users\UserDbGateway');

$user = new Models\Users\User;
$unique = new Helpers\UniqueCodeGenerator;
$validate = new Models\Users\UserValidator($userDbGateway);

$isUserExists = new Helpers\Authorization($userDbGateway);
if ($isUserExists->getUserByCookie()) {
    $user->setAttributes($isUserExists->getUserByCookie());
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
        if ($isUserExists->getUserByCookie()) {
            $result = $userDbGateway->update($user);
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

