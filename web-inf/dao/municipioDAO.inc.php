<?php

class municipioDAO{
	private $conexion;
	function __construct(){
		$this->conexion = new conexion();
		$this->conexion->getConexion()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	function listar($request){
		try{
			$parameters = NULL;

			$query = "SELECT * "
					."FROM municipio as m, departamento as d "
					."WHERE d.dep_id = m.dep_id";
			
			if(array_key_exists("departamento", $request)){
				$parameters = array("%".$request['departamento']."%");
				$query = $query." AND lower(dep_nombre) LIKE lower(?)";
			}
			
			if(array_key_exists("departamento_id", $request)){
				if($parameters != NULL){
					array_push($parameters, $request['departamento_id']);
				}else{
					$parameters = array($request['departamento_id']);
				}
				$query = $query." AND lower(m.dep_id) = ?";
			}
			
			if(array_key_exists("municipio", $request)){
				if($parameters != NULL){
					array_push($parameters, $request['municipio']);
				}else{
					$parameters = array($request['municipio']);
				}
				$query = $query." AND lower(m.mun_nombre) LIKE lower(?)";
			}
			
			if(array_key_exists("municipio_id", $request)){
				if($parameters != NULL){
					array_push($parameters, $request['municipio_id']);
				}else{
					$parameters = array($request['municipio_id']);
				}
				$query = $query." AND lower(m.mun_id) = ?";
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
