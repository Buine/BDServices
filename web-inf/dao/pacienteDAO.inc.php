<?php
class pacienteDAO{
	private $conexion;
	function __construct(){
		$this->conexion = new conexion();
		$this->conexion->getConexion()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	function listar($request){
		try{
			$paramater = array("%");
			if(array_key_exists("valor", $request)){
				$paramater = array("%".$request['valor']."%");
			}
			$query = "SELECT * ".
				     "FROM paciente ".
					 "WHERE lower(paciente_nombre) like lower(?)";
			$p = $this->conexion->getConexion()->prepare($query);
			$p->execute($paramater);
			$rs = $p->fetchALL(PDO::FETCH_OBJ);
		}catch(PDOException $ex){
			$rs = array("Title " => "Ocurrio un error al buscar o listar",
					    "Message " => $ex->getMessage());
		}
		return($rs);
	}
}