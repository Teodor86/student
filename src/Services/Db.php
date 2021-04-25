<?php

namespace Services;

class Db
{
    /**
     * @return \PDO
     */
    function getConnection()
    {
        require_once __DIR__ . '/../config.php';

        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $options = array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        );

        $pdo = new \PDO($dsn, $config['user'], $config['pass'], $options);
        return $pdo;
    }
}

?>