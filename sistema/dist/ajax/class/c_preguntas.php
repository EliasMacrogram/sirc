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
            $consulta = "INSERT INTO preguntas (nombre, fecha_creado, usuario_creado)  VALUES  ('$nombre',now(),'$cod_usuario')";
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = "Pregunta agregada";
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error al crear la pregunta, vuelve a intentarlo";
            }
        }
        return $respuesta;
    }

    function lista($limite, $pagina)
    {
        $dataTotal = Conexion::buscarRegistro("SELECT count(*) total FROM pregunta where in estado in ('A','I') ");
        require 'c_paginado.php';
        $paginado = Paginacion($dataTotal['total'], $limite, $pagina);

        $inicio  = (($pagina - 1) * $limite);
        $consulta = "SELECT * from pregunta where estado in ('A','I')";

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

    function actualizar($cod_usuario, $cod_pregunta, $nombre)
    {
        if ($cod_usuario == "") {
            $respuesta['status'] = "informacion";
            $respuesta['mensaje'] = "Por favor vuelve a iniciar sesion";
        } else {
            $consulta = "UPDATE pregunta set nombre = '$nombre', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_pregunta = $cod_pregunta ";
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = "Pregunta actualizada";
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error al actualizar, vuelve a intentarlo";
            }
        }
        return $respuesta;
    }

    function cambiarEstado($cod_usuario, $cod_pregunta, $estado)
    {
        if ($cod_usuario == "") {
            $respuesta['status'] = "informacion";
            $respuesta['mensaje'] = "Por favor vuelve a iniciar sesion";
        } else {
            $mensaje = "";
            if ($estado == 'A') {
                $estado = 'I';
                $mensaje = "La pregunta esta desactivada";
            } else {
                $estado = 'A';
                $mensaje = "La pregunta esta activada";
            }
            $consulta = "UPDATE tematica set estado = '$estado', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_pregunta = $cod_pregunta ";
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = $mensaje;
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error, no se pudo cambiar el estado de la pregunta, vuelve a intentarlo";
            }
        }
        return $respuesta;
    }

    function eliminar($cod_usuario, $cod_pregunta)
    {
        if ($cod_usuario == "") {
            $respuesta['status'] = "informacion";
            $respuesta['mensaje'] = "Por favor vuelve a iniciar sesion";
        } else {
            $consulta = "UPDATE pregunta set estado = 'D', fecha_eliminado = now(), usuario_eliminado = $cod_usuario where cod_pregunta = $cod_pregunta ";
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = "Pregunta eliminada";
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error al eliminar, vuelve a intentarlo";
            }
        }
        return $respuesta;
    }
}
