<?php
require_once "class/c_sucursal.php";

$Sucursal = new Sucursal();

$tipo = $_POST['tipo'];
switch($tipo){
    case "CREAR":
        $cod_usuario = $_POST['cod_usuario'];
        
        $nombre    = htmlentities($_POST['nombre']);
        $direccion = htmlentities($_POST['direccion']);
        $telefono  = $_POST['telefono'];
        $correo    = $_POST['correo'];

        $return    = $Sucursal->crear($cod_usuario, $nombre, $direccion, $telefono, $correo);
        break;   
 
    case "LISTA":
        $limite       = $_POST['limite'];
        $pagina       = $_POST['pagina'];
        
        $return = $Sucursal->lista($limite,$pagina);
        break;   
    
    case "CONSULTAR":
        $codigo = $_POST['codigo'];
        $return = $Sucursal->consultar($codigo);

        break;   

    case "ACTUALIZAR":
        $cod_usuario  = $_POST['cod_usuario'];
        $codigo = $_POST['codigo'];
          
        $nombre    = htmlentities($_POST['nombre']);
        $direccion = htmlentities($_POST['direccion']);
        $telefono  = $_POST['telefono'];
        $correo    = $_POST['correo'];
    
        $return    = $Sucursal->actualizar($cod_usuario, $codigo, $nombre, $direccion, $telefono, $correo);
        break;   

    case "CAMBIAR_ESTADO":
        $cod_usuario  = $_POST['cod_usuario'];
        $codigo = $_POST['codigo'];
        $estado       = $_POST['estado'];
        
        $return    = $Sucursal->cambiarEstado($cod_usuario, $codigo, $estado);
        break;   
        
    case "ELIMINAR":
        $cod_usuario = $_POST['cod_usuario'];    
        $codigo = $_POST['codigo'];

        $return    = $Sucursal->eliminar($cod_usuario, $codigo);
        break;   
}

header("Content-Type:Application/json");
echo die(json_encode($return))
?>