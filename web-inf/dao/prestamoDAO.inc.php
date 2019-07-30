<?php

class prestamoDAO{
	private $conexion;
	function __construct(){
		$this->conexion = new conexion();
		$this->conexion->getConexion()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	function listar($request){
		try{
			$parameters = array(NULL);

			$query = "SELECT p.prestamo_cod, p.cliente_doc, l.libro_titulo, a.autor_nombre, p.prestamo_fecha_sal, p.prestamo_fecha_reg, p.prestamo_cantidad, p.prestamo_estado "
					."FROM prestamo as p, libro as l, autor as a "
					."WHERE p.libro_cod = l.libro_cod AND l.autor_id = a.autor_id";

			if(array_key_exists("doc", $request)){
				$parameters = array($request['doc']);
				$query = $query." AND p.cliente_doc = ?";
			}
			
			$t = $this->conexion->getConexion()->prepare("SET NAMES 'utf8';");
			$t->execute();
			$p = $this->conexion->getConexion()->prepare($query);
			$p->execute($parameters);
			$rs = $p->fetchALL(PDO::FETCH_OBJ);
		} catch (PDOException $ex) {
			$rs = array(
				"Error" => "Listar prestamo",
				"Detalle" => $ex->getMessage()
			);
		}
		return $rs;
	}
}
