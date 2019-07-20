<?php
if(array_key_exists("recurso", $_GET)){
    switch ($_GET['recurso']){
        case 'libro':
            require_once './web-inf/conexion/conexion.inc.php';
            require_once 'web-inf/dao/libroDAO.inc.php';
            require_once 'web-inf/rest/libroRest.inc.php';
            $rest = new libroREST();
            
            break;
    }
}