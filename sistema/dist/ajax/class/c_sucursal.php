<?php
class Sucursal
{

    function crear($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $nombre    = htmlentities($_POST['nombre']);
        $direccion = htmlentities($_POST['direccion']);
        $telefono  = $_POST['telefono'];
        $correo    = $_POST['correo'];

        $consulta = "INSERT INTO sucursal (nombre, direccion, telefono, correo, estado, fecha_creado, usuario_creado)  VALUES  ('$nombre','$direccion','$telefono', '$correo', 'A', now(),'$cod_usuario')";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Sucursal agregada";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al crear la sucursal, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function lista($datos)
    {
        $limite       = $_POST['limite'];
        $pagina       = $_POST['pagina'];

        $dataTotal = Conexion::buscarRegistro("SELECT count(*) total FROM sucursal where estado in ('A','I') ");
        require 'paginado.php';
        $paginado = Paginacion($dataTotal['total'], $limite, $pagina);

        $inicio  = (($pagina - 1) * $limite);
        $consulta = "SELECT * from sucursal where estado in ('A','I') LIMIT " . $inicio . "," . $limite;

        $data = Conexion::buscarVariosRegistro($consulta);
        // $data = Conexion::buscarVariosRegistro($consulta . " LIMIT " . $inicio . "," . $limite);
        if ($data) {
            $respuesta['status']   = "correcto";
            $respuesta['datos']    = $data;
            $respuesta['paginado'] = $paginado;
            $respuesta['consulta'] = $consulta;
        } else {
            $respuesta['status'] = "error";
            $respuesta['consulta'] = $consulta;
            $respuesta['mensaje'] = "Error al consultar el listado, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function consultar($datos)
    {
        $codigo = $_POST['codigo'];

        $consulta = "SELECT * from sucursal where cod_sucursal = $codigo ";
        $data = Conexion::buscarRegistro($consulta);
        if ($data) {
            $respuesta['status']    = "correcto";
            $respuesta['codigo']    = $data['cod_sucursal'];
            $respuesta['nombre']    = html_entity_decode($data['nombre']);
            $respuesta['direccion'] = html_entity_decode($data['direccion']);
            $respuesta['telefono']  = $data['telefono'];
            $respuesta['correo']    = $data['correo'];
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Lo sentimos, no pudimos traer la informacion, vuelve a intentarlo o recarga la pagina";
        }
        return $respuesta;
    }

    function actualizar($datos)
    {
        $cod_usuario  = $_POST['cod_usuario'];
        $codigo = $_POST['codigo'];

        $nombre    = htmlentities($_POST['nombre']);
        $direccion = htmlentities($_POST['direccion']);
        $telefono  = $_POST['telefono'];
        $correo    = $_POST['correo'];

        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            if (is_numeric($telefono)) {
                $consulta = "UPDATE sucursal set nombre = '$nombre', direccion = '$direccion', telefono = '$telefono', correo = '$correo', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_sucursal = $codigo ";
                $query = Conexion::UpdateRegistro($consulta);
                if ($query) {
                    $respuesta['status'] = "correcto";
                    $respuesta['mensaje'] = "Sucursal actualizada";
                } else {
                    $respuesta['status'] = "error";
                    $respuesta['mensaje'] = "Error al actualizar, vuelve a intentarlo";
                }
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "No se aceptan letras en el campo del telefono";
            }
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "El correo no tiene el formato correcto";
        }
        return $respuesta;
    }

    function cambiarEstado($datos)
    {
        $cod_usuario  = $_POST['cod_usuario'];
        $codigo = $_POST['codigo'];
        $estado       = $_POST['estado'];

        $mensaje = "";
        if ($estado == 'A') {
            $estado = 'I';
            $mensaje = "La sucursal esta desactivada";
        } else {
            $estado = 'A';
            $mensaje = "La sucursal esta activada";
        }
        $consulta = "UPDATE  sucursal set estado = '$estado', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_sucursal = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = $mensaje;
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error, no se pudo cambiar el estado de la sucursal, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function eliminar($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $codigo = $_POST['codigo'];
        
        $consulta = "UPDATE  sucursal set estado = 'D', fecha_eliminado = now(), usuario_eliminado = $cod_usuario where cod_sucursal = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Sucursal eliminada";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al eliminar, vuelve a intentarlo";
        }
        return $respuesta;
    }
}
