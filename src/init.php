<?php
error_reporting(-1);

spl_autoload_register(function ($className) {
    $path = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});

set_exception_handler(function ($exception) {
    header('HTTP/1.1 503 Service Temporarily Unavailable');
    header('Status: 503 Service Temporarily Unavailable');
    error_log($exception->__toString(), 3, '../src/error.log');
    $pageTitle = "Error";
    require_once '../views/error.html';
});

$db = new Services\Db;
$pdo = $db->getConnection();
$userDbGateway = new Models\Users\UserDbGateway($pdo);

?>