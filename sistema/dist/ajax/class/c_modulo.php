<?php
class Modulo
{

    function crear($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $nombre    = htmlentities($_POST['nombre']);

        $consulta = "INSERT INTO modulo (nombre, fecha_creado, usuario_creado)  VALUES  ('$nombre',now(),'$cod_usuario')";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Modulo agregado";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al crear la modulo, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function lista($datos)
    {
        $limite       = $_POST['limite'];
        $pagina       = $_POST['pagina'];

        $dataTotal = Conexion::buscarRegistro("SELECT count(*) total FROM modulo where estado in ('A','I') ");
        require 'paginado.php';
        $paginado = Paginacion($dataTotal['total'], $limite, $pagina);

        $inicio  = (($pagina - 1) * $limite);
        $consulta = "SELECT * from modulo where estado in ('A','I')";

        $data = Conexion::buscarVariosRegistro($consulta . " LIMIT " . $inicio . "," . $limite);
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
        $consulta = "SELECT * from modulo where cod_modulo = $codigo ";
        $data = Conexion::buscarRegistro($consulta);
        if ($data) {
            $respuesta['status']       = "correcto";
            $respuesta['codigo']       = $data['cod_modulo'];
            $respuesta['nombre']       = html_entity_decode($data['nombre']);
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Lo sentimos, no pudimos traer la informacion, vuelve a intentarlo o recarga la pagina";
        }
        return $respuesta;
    }

    function actualizar($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $codigo      = $_POST['codigo'];
        $nombre      = htmlentities($_POST['nombre']);

        $consulta = "UPDATE modulo set nombre = '$nombre', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_modulo = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Modulo actualizado";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al actualizar, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function cambiarEstado($datos)
    {
        $cod_usuario  = $_POST['cod_usuario'];
        $codigo       = $_POST['codigo'];
        $estado       = $_POST['estado'];

        $mensaje = "";
        if ($estado == 'A') {
            $estado = 'I';
            $mensaje = "La modulo esta desactivado";
        } else {
            $estado = 'A';
            $mensaje = "La modulo esta activado";
        }
        $consulta = "UPDATE modulo set estado = '$estado', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_modulo = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = $mensaje;
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error, no se pudo cambiar el estado de la modulo, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function eliminar($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $codigo      = $_POST['codigo'];

        $consulta = "UPDATE modulo set estado = 'D', fecha_eliminado = now(), usuario_eliminado = $cod_usuario where cod_modulo = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Modulo eliminado";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al eliminar, vuelve a intentarlo";
        }
        return $respuesta;
    }
}
