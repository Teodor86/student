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

$container = new \Services\DIContainer;

$container->register('config', function (\Services\DIContainer $container) {
    $config = __DIR__ . '/config.php';
    return $config;
});

$container->register('PDO', function (\Services\DIContainer $container) {
    // Для соединения с БД нам нужны данные из конфига, получаем их
    // из контейнера
    require $config = $container->get('config');
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8";
    $pdo = new \PDO($dsn, $config['user'], $config['pass'], [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ]);
    return $pdo;
});

?>