<?php
error_reporting(0);
require_once "class/c_modulo.php";

$Tematica = new Tematica();

$tipo = $_POST['tipo'];
switch($tipo){
    case "CREAR":
        $cod_usuario = $_POST['cod_usuario'];        
        $nombre    = htmlentities($_POST['nombre']);

        $return    = $Tematica->crear($cod_usuario, $nombre);
        break;   

    case "LISTA":
        $limite       = $_POST['limite'];
        $pagina       = $_POST['pagina'];
        
        $return = $Tematica->lista($limite,$pagina);
        break;   

    case "ACTUALIZAR":
        $cod_usuario = $_POST['cod_usuario'];
        $cod_modulo = $_POST['cod_modulo'];
        $nombre    = htmlentities($_POST['nombre']);
    
        $return    = $Tematica->actualizar($cod_usuario, $cod_modulo, $nombre);
        break;   

    case "CAMBIAR_ESTADO":
        $cod_usuario  = $_POST['cod_usuario'];
        $cod_modulo = $_POST['cod_modulo'];
        $estado       = $_POST['estado'];
        
        $return    = $Tematica->cambiarEstado($cod_usuario, $cod_modulo, $estado);
        break;   
        
    case "ELIMINAR":
        $cod_usuario = $_POST['cod_usuario'];    
        $cod_modulo = $_POST['cod_modulo'];

        $return    = $Tematica->eliminar($cod_usuario, $cod_modulo);
        break;   
}

header("Content-Type:Application/json");
echo die(json_encode($return))
?>