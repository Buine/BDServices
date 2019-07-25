<?php
class clienteDAO{
	private $conexion;
	function __construct(){
		$this->conexion = new conexion();
		$this->conexion->getConexion()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	function actualizar($request){
		try{
			$paramaters = array(
				$request->departamento,
				$request->municipio,
				$request->doc
			);
			
			$query = "UPDATE cliente SET dep_id = ?, mun_id = ? "
			."WHERE cliente_doc = ?";
			
			$p = $this->conexion->getConexion()->prepare($query);
			$p->execute($paramaters);
			
			if ($p->rowCount() >= 0)
                $rs = array(
                    "DAO" => "Cliente",
                    "Mensaje" => "Cliente actualizado"
                );
			
		} catch (PDOException $ex){
			$rs = array(
				"Error" => "Editar Cliente",
				"Detalles" => $ex->getMessage()
			);
		}
		return $rs;
	}
	
	function agregar($request){
		try{
			$paramaters = array(
				$request->doc, 
				$request->apellido, 
				$request->nombre, 
				$request->genero, 
				$request->fecha_nac,
				$request->departamento,
				$request->municipio,
				$request->rh
			);
			
			$query = "INSERT INTO cliente VALUES( ?, ?, ?, ?, ?, ?, ?, ? )";
			
			$p = $this->conexion->getConexion()->prepare($query);
			$p->execute($paramaters);
			
			if ($p->rowCount() >= 0)
                $rs = array(
                    "DAO" => "Cliente",
                    "Mensaje" => "Cliente registrado"
                );
			
		} catch (PDOException $ex){
			$rs = array(
				"Error" => "Crear Cliente",
				"Detalles" => $ex->getMessage()
			);
		}
		return $rs;
	}
	
	function listar($request){
		try{
			$parameters = array("%");
			
			$query = "SELECT * ".
				     "FROM cliente ".
					 "WHERE lower(cliente_nombre) LIKE lower(?) ";
				
			if(array_key_exists('nombre', $request)){
				$parameters = array("%".$request['nombre']."%");
			}
			
			if(array_key_exists('doc', $request)){
				array_push($parameters, $request['doc']);
				$query = $query."AND cliente_doc = ? ";
			}
			
			$t = $this->conexion->getConexion()->prepare("SET NAMES 'utf8';");
			$t->execute();
			$p = $this->conexion->getConexion()->prepare($query);
			$p->execute($parameters);
			$rs = $p->fetchALL(PDO::FETCH_OBJ);

		} catch (PDOException $ex) {
			$rs = array(
				"Error" => "Listar Clientes",
				"Detalles" => $ex->getMessage()
			);
		}
		return $rs;
	}
}
