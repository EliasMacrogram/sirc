<?php
// error_reporting(0);
require_once "class/c_login.php";
require_once "cryptDecrypt.php";

$objeto = new Login();

$tipo = $_POST['tipo'];
switch($tipo){
    case "INICIAR_SESION":
        $usuario  = $_POST['usuario'];
        $password = $_POST['password'];
        $return   = $objeto->iniciarSesion($usuario,$password);
        break;   
        
    case "RECUPERAR_PASSWORD":
        $correo = $_POST['correo'];
        $return = $objeto->recuperarPassword($correo);
        break;   

    case "CREAR":
        $return = $objeto->crear($_POST);
        break;   
}

header("Content-Type:Application/json");
echo die(json_encode($return))
?>