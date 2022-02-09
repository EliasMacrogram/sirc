<?php
require_once "../../conexion.php";
require_once "class/c_sucursal.php";

$Sucursal = new Sucursal();

$tipo = $_POST['tipo'];
switch($tipo){
    case "CREAR":
     
        $return    = $Sucursal->crear($_POST);
        break;   
 
    case "LISTA":
       
        $return = $Sucursal->lista($_POST);
        break;   
    
    case "CONSULTAR":
        
        $return = $Sucursal->consultar($_POST);

        break;   

    case "ACTUALIZAR":
    
        $return    = $Sucursal->actualizar($_POST);
        break;   

    case "CAMBIAR_ESTADO":
       
        
        $return    = $Sucursal->cambiarEstado($_POST);
        break;   
        
    case "ELIMINAR":

        $return    = $Sucursal->eliminar($_POST);
        break;   
}

header("Content-Type:Application/json");
echo die(json_encode($return))
?>