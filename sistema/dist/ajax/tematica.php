<?php
require_once "../../conexion.php";
require_once "class/c_tematica.php";

$objeto = new Tematica();

$tipo = $_POST['tipo'];
switch($tipo){
    case "CREAR":

        $return    = $objeto->crear($_POST);
        break;   
    case "LISTA":
        
        $return = $objeto->lista($_POST);
        break;   
        
    case "CONSULTAR":

        $return = $objeto->consultar($_POST);
        break;   

    case "ACTUALIZAR":
    
        $return    = $objeto->actualizar($_POST);
        break;   

    case "CAMBIAR_ESTADO":
        
        $return    = $objeto->cambiarEstado($_POST);
        break;   
        
    case "ELIMINAR":

        $return    = $objeto->eliminar($_POST);
        break;   
}

header("Content-Type:Application/json");
echo die(json_encode($return))
?>