<?php
// error_reporting(0);
require_once "../../conexion.php";
require_once "class/c_login.php";
require_once "cryptDecrypt.php";
require_once "correo.php";

$objeto = new Login();

$tipo = $_POST['tipo'];
switch($tipo){
    case "INICIAR_SESION":
        $return   = $objeto->iniciarSesion($_POST);
        break;   
        
    case "RECUPERAR_PASSWORD":
        $return = $objeto->recuperarPassword($_POST);
        break;   

    case "CREAR":
        $return = $objeto->crear($_POST);
        break;  

    case "CERRAR_SESION":     
        $return = $objeto->cerrarSesion();
        break;  
}

header("Content-Type:Application/json");
echo die(json_encode($return))
?>