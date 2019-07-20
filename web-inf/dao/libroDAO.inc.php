<?php
class libroDAO{
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
			$query = "SELECT l.*, g.* ".
				     "FROM libro as l, generoxlibro as gxl, genero as g ".
					 "WHERE lower(libro_titulo) like lower(?) ".
				     "      AND l.libro_cod = gxl.libro_cod AND gxl.genero_cod = g.genero_cod";
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