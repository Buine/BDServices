<?php
if(array_key_exists("recurso", $_GET)){
    switch ($_GET['recurso']){
        case 'paciente':
            require_once './web-inf/conexion/conexion.inc.php';
            require_once './web-inf/dao/pacienteDAO.inc.php';
            require_once './web-inf/rest/pacienteRest.inc.php';
            $rest = new pacienteREST();
            
            break;
    }
}