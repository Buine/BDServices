<?php

class autorREST {
    function __construct() {
        $this->REST();
    }
    
    private function REST(){
        header("Content-type: application/json");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        $metodo = $_SERVER['REQUEST_METHOD'];
        $dao = new autorDAO();  
        switch ($metodo) {
            case 'GET':
                $rs = $dao->listar($_GET);
                break;
            case 'POST':
                $rs = array(
                    "Metodo" => $metodo,
                    "Mensaje" => "En construccion agregar..."
                    );
                break;
            case 'PUT':
                $rs = array(
                    "Metodo" => $metodo,
                    "Mensaje" => "En construccion editar..."
                    );
                break;
            case 'DELETE':
                $rs = array(
                    "Metodo" => $metodo,
                    "Mensaje" => "En construccion borrar..."
                    );
                break;
            default:
                $rs = array(
                    "Metodo" => $metodo,
                    "Mensaje" => "No soportado..."
                    );
                break;
        }
        echo json_encode($rs, JSON_UNESCAPED_UNICODE);
		/*
		json_encode($data, JSON_UNESCAPED_UNICODE)
		json_decode($json, false, 512, JSON_UNESCAPED_UNICODE)
		*/
    }
}