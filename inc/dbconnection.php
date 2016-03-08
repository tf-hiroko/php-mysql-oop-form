<?php

class Database{
	private $host = "localhost";
	private $username = "root";
	private $password = "root";
	private $database = "vday2014DB";
	private $conn;

	/**
	 * Create MySQL database connection.
	 */
	function __construct() {
		$this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
	
		// Error handling
		if(mysqli_connect_error()) {
			die('ConnectError: ' . $mysqli->connect_error);
		}
		//echo 'connection is success.';
	}


	/**
	 * Get Create MySQL database connection.
	 */
	function getConnection(){
	    return $this->conn;
	}
	
}
//TEST CODE for dbconnection.php
/*
$db = new Database();
$conn = $db->getConnection();
echo '<br><br>';
var_dump($conn);
*/
?>