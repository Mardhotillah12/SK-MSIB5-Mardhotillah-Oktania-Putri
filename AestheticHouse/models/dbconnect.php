<?php
class Connection {
	var $host = "localhost";
	var $username = "root";
	var $password = "";
	var $database = "AestheticHouse";
	var $koneksi;

	function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
	}
}
?>