<?php
ob_start();
session_start();
require_once __DIR__ . '/../src/init.php';

$container->register('\Models\Users\UserDbGateway', function (\Services\DIContainer $container) {
    return new \Models\Users\UserDbGateway($container->get('PDO'));
});

$userDbGateway = $container->get('\Models\Users\UserDbGateway');

$search = (!empty($_GET['q'])) ? trim(strval($_GET['q'])) : '';

$curPage = (!empty($_GET['page']) && is_numeric($_GET['page'])) ? abs((int)($_GET['page'])) : 1;
$sort = (!empty($_GET['sort'])) ? trim(strip_tags($_GET['sort'])) : 'id';

$allowed = ['uid', 'name', 'surname', 'email', 'birthday', 'gender'];
$sort = in_array($sort, $allowed) ? $sort : 'id';

$numberOfUsers = $userDbGateway->countOfUsers();
$recordsPerPage = 4;

$pager = new Helpers\Pager($numberOfUsers, $recordsPerPage, 'index.php?page={page}');
$users = $userDbGateway->getUsers($search, $sort, $pager->getOffset($curPage), $recordsPerPage);

$pageTitle = 'Список пользователей';

require_once __DIR__ . '/../views/index.html';
?>