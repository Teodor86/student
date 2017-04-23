<?php
class PDOFactory 
{ 
	private $conn; 
	
	function getConnection() {
		require_once 'config.php';

		try {
		
			$dsn = "mysql:host={$config['host']};dbname={$config['table']}";
			$username = $config['user'];
			$password = $config['pass'];
			$options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			); 

			$this->conn = new PDO($dsn, $username, $password, $options);
			return $this->conn;
		} catch (PDOException $e) {
			$file = 'log.txt';
			$date = date('Y-m-d H:i:s');
			$error = 'Message: '.$e->getMessage().PHP_EOL.'File: '.$e->getFile().PHP_EOL.'Line: '.$e->getLine().PHP_EOL.'Date: '.$date."\r\n\r\n";
			file_put_contents($file, $error, FILE_APPEND);
			die ("Couldn't connect to database");
		}
	} 	
}
?>