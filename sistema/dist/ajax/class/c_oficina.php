<?php

class Oficina
{

    function crear($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $nombre       = htmlentities($_POST['nombre']);
        $descripcion  = htmlentities($_POST['descripcion']);
        $correo       = $_POST['correo'];
        $sucursal = $_POST['sucursal'];

        $consulta = "INSERT INTO oficina (nombre, descripcion, correo, cod_sucursal, estado, fecha_creado, usuario_creado)  VALUES  ('$nombre','$descripcion','$correo', '$sucursal', 'A', now(),'$cod_usuario')";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Oficina agregada";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al crear la oficina, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function lista($datos)
    {
        $limite       = $_POST['limite'];
        $pagina       = $_POST['pagina'];

        $dataTotal = Conexion::buscarRegistro("SELECT count(*) total FROM oficina where estado in ('A','I') ");
        require 'paginado.php';
        $paginado = Paginacion($dataTotal['total'], $limite, $pagina);

        $inicio  = (($pagina - 1) * $limite);
        $consulta = "SELECT 
        of.cod_oficina, of.nombre as oficina, of.descripcion, of.correo, 
        su.nombre as sucursal
        from oficina of 
        INNER JOIN sucursal as su on su.cod_sucursal = of.cod_sucursal
        where of.estado in ('A','I') LIMIT " . $inicio . "," . $limite;

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
        $consulta = "SELECT * from oficina where cod_oficina = $codigo ";
        $data = Conexion::buscarRegistro($consulta);
        if ($data) {
            $respuesta['status']       = "correcto";
            $respuesta['codigo']       = $data['cod_oficina'];
            $respuesta['nombre']       = html_entity_decode($data['nombre']);
            $respuesta['descripcion']  = html_entity_decode($data['descripcion']);
            $respuesta['cod_sucursal'] = $data['cod_sucursal'];
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

        $nombre       = htmlentities($_POST['nombre']);
        $descripcion  = htmlentities($_POST['descripcion']);
        $correo       = $_POST['correo'];
        $sucursal = $_POST['sucursal'];

        $consulta = "UPDATE oficina set nombre = '$nombre', descripcion = '$descripcion', correo = '$correo', cod_sucursal = $sucursal, fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_oficina = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Oficina actualizada";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al actualizar, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function cambiarEstado($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $cod_oficina = $_POST['cod_oficina'];
        $estado      = $_POST['estado'];

        $mensaje = "";
        if ($estado == 'A') {
            $estado = 'I';
            $mensaje = "La oficina esta desactivada";
        } else {
            $estado = 'A';
            $mensaje = "La oficina esta activada";
        }
        $consulta = "UPDATE oficina set estado = '$estado', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_oficina = $cod_oficina ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = $mensaje;
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error, no se pudo cambiar el estado de la oficina, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function eliminar($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $codigo = $_POST['codigo'];

        $consulta = "UPDATE oficina set estado = 'D', fecha_eliminado = now(), usuario_eliminado = $cod_usuario where cod_oficina = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Oficina eliminada";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al eliminar, vuelve a intentarlo";
        }
        return $respuesta;
    }
}
