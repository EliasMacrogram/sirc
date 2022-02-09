<?php
require_once "../../conexion.php";
class Login
{

    function iniciarSesion($usuario, $password)
    {
        $query = Conexion::buscarRegistro("SELECT * from usuarios where usuario = '$usuario' and password = '$password' ");
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "";
            $_SESSION['datos_login'] = array(
                // 'iduser'      => $query['id_usuario'],
                'cod_usuario' => $query['cod_usuario'],
                'cod_rol'     => $query['cod_rol'],
                'cod_empresa' => $query['cod_empresa'],
                'usuario'     => $query['usuario'],
                'nombres'     => $query['nombres'],
                'correo'      => $query['correo']
            );
        } else {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Este usuario no existe en el sistema";
        }
        return $respuesta;
    }

    function recuperarPassword($correo)
    {
        $data = Conexion::buscarRegistro("SELECT * from usuarios where correo = '$correo' ");
        if ($data) {
            $password = rand(50, 10000);
            $passwordTemporal = sha1($password);

            $consulta = "UPDATE usuarios set password = '$passwordTemporal', fecha_actualizado = now(), usuario_actualizado = 'RECUPERAR_PASSWORD' where cod_usuario = " . $data['cod_usuario'];
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = "Tu contraseña temporal es " . $password;
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error al generar clave temporal, vuelve a intentarlo";
            }
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Ese correo no existe en el sistema";
        }
        return $respuesta;
    }

    function crear($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $rol = $_POST['rol'];
        // $empresa = $_POST['empresa'];
        $usuario = htmlentities($_POST['usuario']);
        $rijndael = new RijndaelOpenSSL();
        $password = base64_encode($rijndael->encrypt($_POST['password'], "F@R_pa$$"));
        $nombres = htmlentities($_POST['nombres']);
        $correo  = $_POST['correo'];

        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $data = Conexion::buscarRegistro("SELECT * from usuarios where usuario = '$usuario' or correo = '$correo'  ");
            if ($data) {
                if($data['usuario'] == $usuario){
                    $respuesta['status'] = "informacion";
                    $respuesta['mensaje'] = "Ese usuario ya existe en el sistema";
                }else{
                    $respuesta['status'] = "informacion";
                    $respuesta['mensaje'] = "Ese correo ya existe en el sistema";
                }
            } else {
                // $consulta = "INSERT INTO usuarios (cod_usuario, cod_rol, cod_empresa, usuario, password, nombres, correo, correoConfirmado, estado, fecha_creado, usuario_creado)  VALUES  ('$nombre',now(),'$cod_usuario')";
                $consulta = "INSERT INTO usuarios (cod_rol, usuario, password, nombres, correo, correoConfirmado, estado, fecha_creado, usuario_creado)  VALUES 
                 ('$rol','$usuario','$password','$nombres','$correo','1','A',now(),'$cod_usuario')";
                $query = Conexion::UpdateRegistro($consulta);
                if ($query) {
                    $respuesta['status'] = "correcto";
                    $respuesta['mensaje'] = "Usuario creado";
                } else {
                    $respuesta['status'] = "error";
                    $respuesta['mensaje'] = "Error al crear el usario, vuelve a intentarlo";
                }
            }
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "El correo no tiene el formato correcto";
        }
        return $respuesta;
    }
}
