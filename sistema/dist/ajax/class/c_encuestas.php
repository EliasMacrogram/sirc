<?php
require_once "../conexion.php";
class Tematica
{

    function crear($cod_usuario, $nombre)
    {
        if ($cod_usuario == "") {
            $respuesta['status'] = "informacion";
            $respuesta['mensaje'] = "Por favor vuelve a iniciar sesion";
        } else {
            $consulta = "INSERT INTO encuestas (nombre, fecha_creado, usuario_creado)  VALUES  ('$nombre',now(),'$cod_usuario')";
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = "Encuesta agregada";
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error al crear la encuesta, vuelve a intentarlo";
            }
        }
        return $respuesta;
    }

    function lista($limite, $pagina)
    {
        $dataTotal = Conexion::buscarRegistro("SELECT count(*) total FROM encuestas where in estado in ('A','I') ");
        require 'c_paginado.php';
        $paginado = Paginacion($dataTotal['total'], $limite, $pagina);

        $inicio  = (($pagina - 1) * $limite);
        $consulta = "SELECT * from encuestas where estado in ('A','I')";

        $data = Conexion::buscarVariosRegistro($consulta . " LIMIT " . $inicio . "," . $limite);
        if ($data) {
            $respuesta['status']   = "correcto";
            $respuesta['datos']    = $data;
            $respuesta['paginado'] = $paginado;
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al consultar el listado, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function actualizar($cod_usuario, $cod_encuesta, $nombre)
    {
        if ($cod_usuario == "") {
            $respuesta['status'] = "informacion";
            $respuesta['mensaje'] = "Por favor vuelve a iniciar sesion";
        } else {
            $consulta = "UPDATE encuestas set nombre = '$nombre', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_encuesta = $cod_encuesta ";
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = "Encuesta actualizada";
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error al actualizar, vuelve a intentarlo";
            }
        }
        return $respuesta;
    }

    function cambiarEstado($cod_usuario, $cod_encuesta, $estado)
    {
        if ($cod_usuario == "") {
            $respuesta['status'] = "informacion";
            $respuesta['mensaje'] = "Por favor vuelve a iniciar sesion";
        } else {
            $mensaje = "";
            if ($estado == 'A') {
                $estado = 'I';
                $mensaje = "La encuesta esta desactivada";
            } else {
                $estado = 'A';
                $mensaje = "La encuesta esta activada";
            }
            $consulta = "UPDATE encuestas set estado = '$estado', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_encuesta = $cod_encuesta ";
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = $mensaje;
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error, no se pudo cambiar el estado de la encuesta, vuelve a intentarlo";
            }
        }
        return $respuesta;
    }

    function eliminar($cod_usuario, $cod_encuesta)
    {
        if ($cod_usuario == "") {
            $respuesta['status'] = "informacion";
            $respuesta['mensaje'] = "Por favor vuelve a iniciar sesion";
        } else {
            $consulta = "UPDATE encuestas set estado = 'D', fecha_eliminado = now(), usuario_eliminado = $cod_usuario where cod_encuesta = $cod_encuesta ";
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = "Encuesta eliminada";
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error al eliminar, vuelve a intentarlo";
            }
        }
        return $respuesta;
    }
}
