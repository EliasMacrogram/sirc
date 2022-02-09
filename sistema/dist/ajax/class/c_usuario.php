<?php
class Usuarios
{

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
                $objetoCorreo = new Correo();
                $validar = $objetoCorreo->crearUsuario($correo);
                // $consulta = "INSERT INTO usuarios (cod_usuario, cod_rol, cod_empresa, usuario, password, nombres, correo, correoConfirmado, estado, fecha_creado, usuario_creado)  VALUES  ('$nombre',now(),'$cod_usuario')";
                if($validar){
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
                }else{
                    $respuesta['status'] = "error";
                    $respuesta['mensaje'] = "Error al enviar el correo, por lo que no se pudo crear el usuario, vuelve a intentarlo";
                }
            }
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "El correo no tiene el formato correcto";
        }
        return $respuesta;
    }

    function lista($datos)
    {
        $limite       = $_POST['limite'];
        $pagina       = $_POST['pagina'];

        $dataTotal = Conexion::buscarRegistro("SELECT count(*) total FROM usuarios where estado in ('A','I') ");
        require 'paginado.php';
        $paginado = Paginacion($dataTotal['total'], $limite, $pagina);

        $inicio  = (($pagina - 1) * $limite);
        $consulta = "SELECT 
        us.cod_usuario, us.usuario, us.password, us.nombres, us.correo, us.correoConfirmado,
        r.nombre as nombreRol
        from usuarios us
        INNER JOIN rol as r on r.cod_rol = us.cod_rol
        where us.estado in ('A','I')  LIMIT " . $inicio . "," . $limite;
        // $consulta = "SELECT 
        // of.cod_oficina, of.nombre as oficina, of.descripcion, of.correo, 
        // su.nombre as sucursal
        // from oficina of 
        // INNER JOIN sucursal as su on su.cod_sucursal = of.cod_sucursal
        // where of.estado in ('A','I') LIMIT " . $inicio . "," . $limite;

        $data = Conexion::buscarVariosRegistro($consulta);
        if ($data) {
            $respuesta['status']   = "correcto";
            $respuesta['datos']    = $data;
            $respuesta['paginado'] = $paginado;
        } else {
            $respuesta['status'] = "informacion";
            $respuesta['mensaje'] = "No hay informacion";
        }
        return $respuesta;
    }


    function consultar($datos)
    {
        $codigo = $_POST['codigo'];
        $consulta = "SELECT 
        us.cod_usuario, us.usuario, us.password, us.nombres, us.correo, us.correoConfirmado,
        r.cod_rol
        from usuarios us
        INNER JOIN rol as r on r.cod_rol = us.cod_rol
        where us.cod_usuario = $codigo ";
        $data = Conexion::buscarRegistro($consulta);
        if ($data) {
            $respuesta['status']       = "correcto";
            $respuesta['codigo']       = $data['cod_usuario'];
            $respuesta['cod_rol']      = $data['cod_rol'];
            $respuesta['usuario']      = html_entity_decode($data['usuario']);
            $respuesta['password']      = $data['password'];
            $respuesta['nombres']      = html_entity_decode($data['nombres']);
            $respuesta['correo']       = $data['correo'];
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Lo sentimos, no pudimos traer la informacion, vuelve a intentarlo o recarga la pagina";
        }
        return $respuesta;
    }

    function actualizar($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $codigo = $_POST['codigo'];
        $rol = $_POST['rol'];
        // $empresa = $_POST['empresa'];
        $usuario = htmlentities($_POST['usuario']);
        // $rijndael = new RijndaelOpenSSL();
        // $password = base64_encode($rijndael->encrypt($_POST['password'], "F@R_pa$$"));
        $nombres = htmlentities($_POST['nombres']);
        $correo  = $_POST['correo'];


        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $data = Conexion::buscarRegistro("SELECT * from usuarios where usuario = '$usuario' or correo = '$correo'  ");
            $consulta = "UPDATE usuarios set cod_rol = '$rol', usuario = '$usuario', nombres = '$nombres', correo = '$correo', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_usuario = $codigo ";
            if ($data) {
                if($codigo == $data['cod_usuario']){
                    $query = Conexion::UpdateRegistro($consulta);
                    if ($query) {
                        $respuesta['status'] = "correcto";
                        $respuesta['mensaje'] = "Usuario actualizado";
                    } else {
                        $respuesta['status'] = "error";
                        $respuesta['mensaje'] = "Error al actualizar, vuelve a intentarlo";
                    }
                }else{
                    if($data['usuario'] == $usuario){
                        $respuesta['status'] = "informacion";
                        $respuesta['mensaje'] = "Ese usuario ya existe en el sistema";
                    }else{
                        $respuesta['status'] = "informacion";
                        $respuesta['mensaje'] = "Ese correo ya existe en el sistema";
                    }
                }
            } else {
                $query = Conexion::UpdateRegistro($consulta);
                if ($query) {
                    $respuesta['status'] = "correcto";
                    $respuesta['mensaje'] = "Usuario actualizado";
                } else {
                    $respuesta['status'] = "error";
                    $respuesta['mensaje'] = "Error al actualizar, vuelve a intentarlo";
                }
            }
        }else{
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "El correo no tiene el formato correcto";
        }
        return $respuesta;
    }

    function cambiarEstado($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $codigo = $_POST['codigo'];
        $estado      = $_POST['estado'];

        $mensaje = "";
        if ($estado == 'A') {
            $estado = 'I';
            $mensaje = "El usuario esta desactivado";
        } else {
            $estado = 'A';
            $mensaje = "El usuario esta activado";
        }
        $consulta = "UPDATE usuarios set estado = '$estado', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_usuario = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = $mensaje;
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error, no se pudo cambiar el estado del usuario, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function eliminar($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $codigo = $_POST['codigo'];

        $consulta = "UPDATE usuarios set estado = 'D', fecha_eliminado = now(), usuario_eliminado = $cod_usuario where cod_usuario = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Usuario eliminado";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al eliminar, vuelve a intentarlo";
        }
        return $respuesta;
    }
}
