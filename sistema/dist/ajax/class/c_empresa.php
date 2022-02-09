<?php

class Empresa
{

    function crear($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $nombre       = htmlentities($_POST['nombre']);
        $direccion   = htmlentities($_POST['direccion']);
        $telefono     = $_POST['telefono'];
        $correo       = $_POST['correo'];

        $consulta = "INSERT INTO empresa (nombre, direccion, telefono, correo, estado, fecha_creado, usuario_creado)  VALUES  ('$nombre','$direccion','$telefono','$correo', 'A', now(),'$cod_usuario')";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Empresa agregada";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al crear la empresa, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function lista($datos)
    {
        $limite       = $_POST['limite'];
        $pagina       = $_POST['pagina'];

        $dataTotal = Conexion::buscarRegistro("SELECT count(*) total FROM empresa where estado in ('A','I') ");
        require 'paginado.php';
        $paginado = Paginacion($dataTotal['total'], $limite, $pagina);

        $inicio  = (($pagina - 1) * $limite);
        $consulta = "SELECT * empresa where estado in ('A','I') LIMIT " . $inicio . "," . $limite;

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
        $consulta = "SELECT * from empresa where cod_empresa = $codigo ";
        $data = Conexion::buscarRegistro($consulta);
        if ($data) {
            $respuesta['status']     = "correcto";
            $respuesta['codigo']     = $data['cod_empresa'];
            $respuesta['nombre']     = html_entity_decode($data['nombre']);
            $respuesta['direccion']  = html_entity_decode($data['direccion']);
            $respuesta['telefono']   = $data['telefono'];
            $respuesta['correo']     = $data['correo'];
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

        $nombre    = htmlentities($_POST['nombre']);
        $direccion = htmlentities($_POST['direccion']);
        $telefono  = $_POST['telefono'];
        $correo    = $_POST['correo'];

        $consulta = "UPDATE oficina set nombre = '$nombre', direccion = '$direccion', telefeono = '$telefono' correo = '$correo', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_empresa = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Empresa actualizada";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al actualizar, vuelve a intentarlo";
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
            $mensaje = "La empresa esta desactivada";
        } else {
            $estado = 'A';
            $mensaje = "La empresa esta activada";
        }
        $consulta = "UPDATE empresa set estado = '$estado', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_empresa = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = $mensaje;
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error, no se pudo cambiar el estado de la empresa, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function eliminar($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $codigo = $_POST['codigo'];

        $consulta = "UPDATE empresa set estado = 'D', fecha_eliminado = now(), usuario_eliminado = $cod_usuario where cod_empresa = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Empresa eliminada";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al eliminar, vuelve a intentarlo";
        }
        return $respuesta;
    }
}
