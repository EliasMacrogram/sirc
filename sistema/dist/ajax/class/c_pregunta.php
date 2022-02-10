<?php

class Pregunta
{

    function crear($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $pregunta    = $_POST['pregunta'];
        $descripcion = $_POST['descripcion'];
        $tematica    = $_POST['tematica'];
        $modulo      = $_POST['modulo'];
        $medicion    = $_POST['medicion'];
        $i = 0;
        for ($i; $i < sizeof($pregunta); $i++) {
            $consulta = "INSERT INTO pregunta (pregunta, descripcion, cod_tematica, cod_modulo, cod_medicion, estado, fecha_creado, usuario_creado)  VALUES  
            ('" . htmlentities($pregunta[$i]) . "','" . htmlentities($descripcion[$i]) . "','" . htmlentities($tematica[$i]) . "','" . htmlentities($modulo[$i]) . "','" . htmlentities($medicion[$i]) . "','A', now(),'$cod_usuario')";
            $query = Conexion::UpdateRegistro($consulta);
        }

        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Preguntas agregadas";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al crear las preguntas, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function lista($datos)
    {
        $limite       = $_POST['limite'];
        $pagina       = $_POST['pagina'];

        $dataTotal = Conexion::buscarRegistro("SELECT count(*) total FROM pregunta where estado in ('A','I') ");
        require 'paginado.php';
        $paginado = Paginacion($dataTotal['total'], $limite, $pagina);

        $inicio  = (($pagina - 1) * $limite);
        $consulta = "SELECT 
                    pr.cod_pregunta, pr.pregunta, pr.descripcion, 
                    te.nombre as tematica,
                    mo.nombre as modulo,
                    me.nombre as medicion
                    from pregunta pr 
                    INNER JOIN tematica as te on te.cod_tematica = pr.cod_tematica
                    INNER JOIN modulo   as mo on mo.cod_modulo   = pr.cod_modulo
                    INNER JOIN medicion as me on me.cod_medicion = pr.cod_medicion
                    where pr.estado in ('A','I') ORDER BY pr.cod_pregunta desc";

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
        $consulta = "SELECT 
                    pr.cod_pregunta, pr.pregunta, pr.descripcion, 
                    te.cod_tematica as tematica,
                    mo.cod_modulo   as modulo,
                    me.cod_medicion as medicion
                    from pregunta pr 
                    INNER JOIN tematica as te on te.cod_tematica = pr.cod_tematica
                    INNER JOIN modulo   as mo on mo.cod_modulo   = pr.cod_modulo
                    INNER JOIN medicion as me on me.cod_medicion = pr.cod_medicion
                    where pr.cod_pregunta = $codigo ";
        $data = Conexion::buscarRegistro($consulta);
        if ($data) {
            $respuesta['status']       = "correcto";
            $respuesta['codigo']       = $data['cod_pregunta'];
            $respuesta['pregunta']     = html_entity_decode($data['pregunta']);
            $respuesta['descripcion']  = html_entity_decode($data['descripcion']);
            $respuesta['tematica']     = $data['tematica'];
            $respuesta['modulo']       = $data['modulo'];
            $respuesta['medicion']    = $data['medicion'];
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
        $pregunta    = htmlentities($_POST['pregunta']);
        $descripcion = htmlentities($_POST['descripcion']);
        $tematica    = $_POST['tematica'];
        $modulo      = $_POST['modulo'];
        $medicion    = $_POST['medicion'];

        $consulta = "UPDATE pregunta set pregunta = '$pregunta', descripcion = '$descripcion', cod_tematica = '$tematica', cod_modulo = '$modulo', cod_medicion = '$medicion', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_pregunta = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Pregunta actualizado";
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
            $mensaje = "La pregunta esta desactivado";
        } else {
            $estado = 'A';
            $mensaje = "La pregunta esta activado";
        }
        $consulta = "UPDATE pregunta set estado = '$estado', fecha_actualizado = now(), usuario_actualizado = $cod_usuario where cod_pregunta = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = $mensaje;
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error, no se pudo cambiar el estado de la pregunta, vuelve a intentarlo";
        }
        return $respuesta;
    }

    function eliminar($datos)
    {
        $cod_usuario = $_POST['cod_usuario'];
        $codigo      = $_POST['codigo'];

        $consulta = "UPDATE pregunta set estado = 'D', fecha_eliminado = now(), usuario_eliminado = $cod_usuario where cod_pregunta = $codigo ";
        $query = Conexion::UpdateRegistro($consulta);
        if ($query) {
            $respuesta['status'] = "correcto";
            $respuesta['mensaje'] = "Pregunta eliminado";
        } else {
            $respuesta['status'] = "error";
            $respuesta['mensaje'] = "Error al eliminar, vuelve a intentarlo";
        }
        return $respuesta;
    }
}
