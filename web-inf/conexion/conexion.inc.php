<?php
class conexion{
	
	private $conn;
	private $user;
	private $password;
	
	function __construct(){
		try{
			$this->user = "root";
			$this->password = "123";
			$this->conn = new PDO(
				'mysql:host=localhost;dbname=libreria;port=3306',
				$this->user,
				$this->password
			);
		} catch (PDOException $ex){
			echo("ERROR: ".$ex->getMessage());
		}
	}
	
	function getConexion(){
		return $this->conn;
	}
}