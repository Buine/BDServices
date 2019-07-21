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
			$query = "SELECT * ".
				     "FROM (SELECT l.*, a.autor_nombre, e.editorial_nombre, STRING_AGG(g.genero_nombre, ', ') as generos ".
				           "FROM libro as l, generoxlibro as gxl, genero as g, editorial as e, autor as a ".
					       "WHERE lower(libro_titulo) like lower(?) AND ".
				                 "l.libro_cod = gxl.libro_cod AND ".
				                 "gxl.genero_cod = g.genero_cod  AND ".
				                 "l.editorial_cod = e.editorial_cod AND ".
				                 "a.autor_id = l.autor_id ".
				           "GROUP BY l.libro_cod, a.autor_id, e.editorial_cod) as x ";
			
			if(array_key_exists("valor", $request)){
				$paramater = array("%".$request['valor']."%");
			}
			
			if(array_key_exists("genero", $request)){
				array_push($paramater, "%".$request['genero']."%"); 
				$query = $query."WHERE lower(x.generos) like ?";
			}
			
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