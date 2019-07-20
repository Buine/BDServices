<?php
class conexion{
	
	private $conn;
	private $user;
	private $password;
	
	function __construct(){
		try{
			$this->user = "postgres";
			$this->password = "12345";
			$this->conn = new PDO(
				'pgsql:host=localhost;dbname=libreria;port=5432',
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