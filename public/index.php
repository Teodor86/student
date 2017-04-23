<?php
require_once '../src/init.php';

$db = new PDOFactory;
$pdo = $db->getConnection();
$userGateway = new UserGateway($pdo);

if(!empty($_GET['q'])) {
	
	$search = (!empty($_GET['q'])) ? trim($_GET['q']) : null;
	$searchResult = $userGateway->search($search);

	$pageTitle = 'Поиск пользователей';
	require_once '../views/search.php';
		
} else {
	$cur_page = (!empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
	$order = (!empty($_GET['order'])) ? trim(strip_tags($_GET['order'])) : 'uid';
	
	switch($order) {
		case 'name': $sort = 'name'; break;
		case 'surname': $sort = 'surname'; break;
		case 'email': $sort = 'email'; break;
		case 'birthday': $sort = 'birthday'; break;
		case 'gender': $sort = 'gender'; break;
		case 'uid': $sort = 'uid'; break;
		default: $sort = 'uid';
	}
  
	$count = $userGateway->getCountUsers();
	$perPage = 4;

	$pager = new Pager($count['total'], $perPage, 'index.php?order={order}&page={page}');
	$users = $userGateway->getUsers($sort, $pager->getOffset($cur_page), $perPage);

	$pageTitle = 'Список пользователей';
	require_once '../views/index.php';
}
?>
