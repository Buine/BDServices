<?php
if(array_key_exists("recurso", $_GET)){
    switch ($_GET['recurso']){
        case 'libro':
            require_once './web-inf/conexion/conexion.inc.php';
            require_once 'web-inf/dao/libroDAO.inc.php';
            require_once 'web-inf/rest/libroRest.inc.php';
            $rest = new libroREST();
            break;
		case 'cliente':
			require_once './web-inf/conexion/conexion.inc.php';
            require_once 'web-inf/dao/clienteDAO.inc.php';
            require_once 'web-inf/rest/clienteRest.inc.php';
			$rest = new clienteREST();
			break;
		case 'departamento':
			require_once './web-inf/conexion/conexion.inc.php';
            require_once 'web-inf/dao/departamentoDAO.inc.php';
            require_once 'web-inf/rest/departamentoRest.inc.php';
			$rest = new departamentoREST();
			break;
		case 'municipio':
			require_once './web-inf/conexion/conexion.inc.php';
            require_once 'web-inf/dao/municipioDAO.inc.php';
            require_once 'web-inf/rest/municipioRest.inc.php';
			$rest = new municipioREST();
			break;
		case 'autor':
			require_once './web-inf/conexion/conexion.inc.php';
            require_once 'web-inf/dao/autorDAO.inc.php';
            require_once 'web-inf/rest/autorRest.inc.php';
			$rest = new autorREST();
			break;
		case 'prestamo':
			require_once './web-inf/conexion/conexion.inc.php';
            require_once 'web-inf/dao/prestamoDAO.inc.php';
            require_once 'web-inf/rest/prestamoRest.inc.php';
			$rest = new prestamoREST();
			break;
    }
}