<?php
ob_start();
session_start();
require_once __DIR__ . '/../src/init.php';

$userDbGateway = $container->get('\Services\UserDbGateway');
$authHelper = $container->get('\Services\Authorization');

$search = (!empty($_GET['q'])) ? trim(strval($_GET['q'])) : '';

$curPage = (!empty($_GET['page']) && is_numeric($_GET['page'])) ? abs((int)($_GET['page'])) : 1;
$sort = (!empty($_GET['sort'])) ? trim(strip_tags($_GET['sort'])) : 'id';

$countOfUsers = $userDbGateway->countOfUsers();
$recordsPerPage = 4;

$pager = new Helpers\Pager($countOfUsers, $recordsPerPage, 'index.php?page={page}');
$users = $userDbGateway->getUsers($search, $sort, $pager->getOffset($curPage), $recordsPerPage);

$pageTitle = 'Список пользователей';
require_once __DIR__ . '/../views/index.html';