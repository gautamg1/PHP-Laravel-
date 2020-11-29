<?php

class Database{

	public $host = HOST;
	public $user = USER;
	public $database = DATABASE;
	public $password = PASSWORD;
	public $conn;
	public $result;

	public function __construct(){

		return $this->conn = new mysqli($this->host,$this->user,$this->password,$this->database);

	}

	public function query($qry){

		return $this->result = $this->conn->query($qry);
	}

	public function rowCount(){

		return $this->result = mysqli_num_rows($this->result);
	}

	
	public function fetch($result){

		return $this->result = mysqli_fetch_assoc($result);
	}

	public function fetchAll(){

		return $this->result->fetch_all(MYSQLI_ASSOC);
	}
}


?>