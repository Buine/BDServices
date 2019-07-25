<?php

class departamentoDAO{
	private $conexion;
	function __construct(){
		$this->conexion = new conexion();
		$this->conexion->getConexion()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	function listar($request){
		try{
			$parameters = array("%");

			$query = "SELECT * "
					."FROM departamento as d "
					."WHERE lower(d.dep_nombre) LIKE lower(?)";

			if(array_key_exists("nombre", $request)){
				$parameters = array("%".$request['nombre']."%");
			}
			
			$t = $this->conexion->getConexion()->prepare("SET NAMES 'utf8';");
			$t->execute();
			$p = $this->conexion->getConexion()->prepare($query);
			$p->execute($parameters);
			$rs = $p->fetchALL(PDO::FETCH_OBJ);
		} catch (PDOException $ex) {
			$rs = array(
				"Error" => "Listar departamento",
				"Detalle" => $ex->getMessage()
			);
		}
		return $rs;
	}
}
