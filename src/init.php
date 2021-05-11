<?php
error_reporting(-1);

spl_autoload_register(function ($className) {
    $path = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});

set_error_handler(function ($errno, $errmsg, $filename, $linenum) {
    if (!error_reporting()) {
        return;
    }

    throw new ErrorException($errmsg, $errno, 0, $filename, $linenum);
});

set_exception_handler(function (Throwable $exception) {
    header('HTTP/1.1 503 Service Temporarily Unavailable');
    header('Status: 503 Service Temporarily Unavailable');
    error_log($exception->__toString(), 3, '../src/error.log');
    $pageTitle = "Error";
    require_once '../views/error.html';
});

$container = new \Services\DIContainer;

$container->register('config', function (\Services\DIContainer $container) {
    $config = (require __DIR__ . '/config.php')['db'];
    return $config;
});

$container->register('PDO', function (\Services\DIContainer $container) {
    $config = $container->get('config');

    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
    $pdo = new \PDO($dsn, $config['user'], $config['pass'], [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ]);
    return $pdo;
});

$container->register('\Services\UserDbGateway', function (\Services\DIContainer $container) {
    return new \Services\UserDbGateway($container->get('PDO'));
});

$container->register('\Services\Authorization', function (\Services\DIContainer $container) {
    return new \Services\Authorization($container->get('\Services\UserDbGateway'));
});