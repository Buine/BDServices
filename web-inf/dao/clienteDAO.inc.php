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
			
			$query = "SELECT c.cliente_doc, c.cliente_nombre, c.cliente_apellido, c.cliente_genero, c.cliente_fecha_nac , cliente_rh ,d.dep_nombre, m. mun_nombre ".
				     "FROM cliente as c, municipio as m, departamento as d ".
					 "WHERE c.mun_id = m.mun_id AND c.dep_id = m.dep_id AND m.dep_id = d.dep_id ".
					 "AND lower(c.cliente_nombre) LIKE lower(?)";
				
			if(array_key_exists('nombre', $request)){
				$parameters = array("%".$request['nombre']."%");
			}
			
			if(array_key_exists('doc', $request)){
				array_push($parameters, $request['doc']);
				$query = $query." AND c.cliente_doc = ? ";
			}
			
			if(array_key_exists('apellido', $request)){
				array_push($parameters, "%".$request['apellido']."%");
				$query = $query." AND lower(c.cliente_apellido) LIKE lower(?) ";
			}
			
			if(array_key_exists('departamento', $request)){
				array_push($parameters, "%".$request['departamento']."%");
				$query = $query." AND lower(d.dep_nombre) LIKE lower(?) ";
			}
			
			if(array_key_exists('municipio', $request)){
				array_push($parameters, "%".$request['municipio']);
				$query = $query." AND lower(m.mun_nombre) LIKE lower(?) ";
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
