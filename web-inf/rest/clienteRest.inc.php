<?php
class clienteREST {
    function __construct() {
        $this->REST();
    }

	private function REST(){
		header("Content-type: application/json");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        $metodo = $_SERVER['REQUEST_METHOD'];
        $dao = new clienteDAO();
		
		switch($metodo){
			case 'GET':
				$rs = $dao->listar($_GET);
				break;
			case 'POST':
                $rs = $dao->agregar(json_decode(file_get_contents("php://input")));
                break;
            case 'PUT':
                $rs = $dao->actualizar(json_decode(file_get_contents("php://input")));
                break;
            case 'DELETE':
				$rs = $dao->eliminar($_GET);
                break;
            default:
                $rs = array(
                    "Metodo" => $metodo,
                    "Mensaje" => "No soportado..."
                    );
                break;
        }
        echo json_encode($rs, JSON_UNESCAPED_UNICODE);
	}

}
