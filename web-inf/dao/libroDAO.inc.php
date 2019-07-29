<?php
class libroDAO{
	private $conexion;
	function __construct(){
		$this->conexion = new conexion();
		$this->conexion->getConexion()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	function listar($request){
		try{
			$parameters = array("%"); //Busqueda por default (Todos elementos sin filtros)
			$query = "SELECT * ".
				     "FROM (SELECT l.*, a.autor_nombre, e.editorial_nombre, GROUP_CONCAT(g.genero_nombre SEPARATOR ', ') as generos ".
				           "FROM libro as l, generoxlibro as gxl, genero as g, editorial as e, autor as a ".
					       "WHERE lower(libro_titulo) like lower(?) AND ".
				                 "l.libro_cod = gxl.libro_cod AND ".
				                 "gxl.genero_cod = g.genero_cod  AND ".
				                 "l.editorial_cod = e.editorial_cod AND ".
				                 "a.autor_id = l.autor_id ".
				           "GROUP BY l.libro_cod, a.autor_id, e.editorial_cod) as x ";

			if(array_key_exists("titulo", $request)){
				$parameters = array("%".$request['titulo']."%"); // Busqueda por titulo
			}
			
			if(array_key_exists("genero", $request)){
				array_push($parameters, "%".$request['genero']."%"); 
				$query = $query."WHERE lower(x.generos) like lower(?)"; // Busqueda por genero
			}
			
			if(array_key_exists("autor", $request)){
				array_push($parameters, "%".$request['autor']."%"); 
				$query = $query."WHERE lower(x.autor_nombre) like lower(?)"; // Busqueda por autor
			}
			
			if(array_key_exists("editorial", $request)){
				array_push($parameters, "%".$request['editorial']."%"); 
				$query = $query."WHERE lower(x.editorial_nombre) like lower(?)"; // Busqueda por editorial
			}
			
			if(array_key_exists("id", $request)){
				array_push($parameters, "%".$request['id']."%"); 
				$query = $query."WHERE lower(x.libro_cod) like ?"; // Busqueda por id
			}
			
			$t = $this->conexion->getConexion()->prepare("SET NAMES 'utf8';");
			$t->execute();
			
			$p = $this->conexion->getConexion()->prepare($query);
			$p->execute($parameters);
			$rs = $p->fetchALL(PDO::FETCH_OBJ);
			
		}catch(PDOException $ex){
			$rs = array(
				"Title " => "Ocurrio un error al buscar o listar",
				"Message " => $ex->getMessage()
			);
		}
		return($rs);
	}
}