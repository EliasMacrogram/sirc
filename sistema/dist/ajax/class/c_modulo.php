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
            $consulta = "INSERT INTO modulo (nombre, fecha_creado, usuario_creado)  VALUES  ('$nombre',now(),'$cod_usuario')";
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = "Modulo agregado";
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error al crear el modulo, vuelve a intentarlo";
            }
        }
        return $respuesta;
    }

    function lista($limite, $pagina)
    {
        $dataTotal = Conexion::buscarRegistro("SELECT count(*) total FROM modulo where in estado in ('A','I') ");
        require 'c_paginado.php';
        $paginado = Paginacion($dataTotal['total'], $limite, $pagina);

        $inicio  = (($pagina - 1) * $limite);
        $consulta = "SELECT * from modulo where estado in ('A','I')";

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

    function actualizar($cod_usuario, $cod_modulo, $nombre)
    {
        if ($cod_usuario == "") {
            $respuesta['status'] = "informacion";
            $respuesta['mensaje'] = "Por favor vuelve a iniciar sesion";
        } else {
            $consulta = "UPDATE modulo set nombre = '$nombre', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_modulo = $cod_modulo ";
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = "Modulo actualizado";
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error al actualizar, vuelve a intentarlo";
            }
        }
        return $respuesta;
    }

    function cambiarEstado($cod_usuario, $cod_modulo, $estado)
    {
        if ($cod_usuario == "") {
            $respuesta['status'] = "informacion";
            $respuesta['mensaje'] = "Por favor vuelve a iniciar sesion";
        } else {
            $mensaje = "";
            if ($estado == 'A') {
                $estado = 'I';
                $mensaje = "El modulo esta desactivado";
            } else {
                $estado = 'A';
                $mensaje = "El modulo esta activado";
            }
            $consulta = "UPDATE modulo set estado = '$estado', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_modulo = $cod_modulo ";
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = $mensaje;
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error, no se pudo cambiar el estado del modulo, vuelve a intentarlo";
            }
        }
        return $respuesta;
    }

    function eliminar($cod_usuario, $cod_modulo)
    {
        if ($cod_usuario == "") {
            $respuesta['status'] = "informacion";
            $respuesta['mensaje'] = "Por favor vuelve a iniciar sesion";
        } else {
            $consulta = "UPDATE modulo set estado = 'D', fecha_eliminado = now(), usuario_eliminado = $cod_usuario where cod_modulo = $cod_modulo ";
            $query = Conexion::UpdateRegistro($consulta);
            if ($query) {
                $respuesta['status'] = "correcto";
                $respuesta['mensaje'] = "Modulo eliminado";
            } else {
                $respuesta['status'] = "error";
                $respuesta['mensaje'] = "Error al eliminar, vuelve a intentarlo";
            }
        }
        return $respuesta;
    }
}
