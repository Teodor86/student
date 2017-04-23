<?php
class PDOFactory 
{ 
	function getConnection() {
		require_once 'config.php';

		$dsn = "mysql:host={$config['host']};dbname={$config['table']}";
		$username = $config['user'];
		$password = $config['pass'];
		$options = array(
		    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		); 

		$this->conn = new PDO($dsn, $username, $password, $options);
		return $this->conn;
	} 	
}
?>
