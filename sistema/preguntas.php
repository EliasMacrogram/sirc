<?php
require_once "conexion.php";
session_start();
if ($_SESSION['datos_login'] == "") {
    header("Location: ../sistema/");
}
$titulo = "Preguntas";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title> <?php echo $titulo ?> </title>

    <?php include 'estilos.php' ?>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
        <?php include 'menu.php' ?>
    </aside>

    <?php include 'barra.php' ?>



    <div class="col-lg-12 col-12">
        <div class="row">
            <div class="col-12">
                <button id="Agregar" class="btn btn-info"> Agregar</button>
                <button id="Lista" class="btn btn-primary"> Lista</button>

                <input type="button" value="Duplicar" class="btn btn-success" id="btnDuplicar">
                <input type="button" value="Eliminar" class="btn btn-danger" id="btnEliminarDuplicado">
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-12">
        <div class="card card-body">
            <div class="row">
                <div id="contenedorAgregar" class="col-12">

                    <div class="card-header pb-0"> </div>

                    <form class="form-control dropzone" id="formulario">
                        <div class="card-header pb-0"> </div>
                        <table>
                            <tbody id="formPr">
                                <tr>
                                    <td>
                                        <div id="frm1" class="row">

                                            <div class="col-6">
                                                <label class="form-label"> Pregunta </label>
                                                <input class="form-control" type="text" placeholder="Pregunta" id="pregunta" name="pregunta[]">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label"> Descripci&oacute;n </label>
                                                <input class="form-control" type="text" placeholder="Descripci&oacute;n" id="descripcion" name="descripcion[]">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label"> Tem&aacute;tica </label>
                                                <select name="tematica[]" id="tematica" class="form-control">
                                                    <option value="">Seleccione una tem&aacute;tica</option>
                                                    <?php
                                                    $consulta = "SELECT * from tematica where estado = 'A' ";
                                                    $data = Conexion::buscarVariosRegistro($consulta);
                                                    if ($data) {
                                                        foreach ($data as $d) { ?>
                                                            <option value="<?php echo $d['cod_tematica'] ?>"> <?php echo $d['nombre'] ?> </option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label"> M&oacute;dulo </label>
                                                <select name="modulo[]" id="modulo" class="form-control">
                                                    <option value="">Seleccione una m&oacute;dulo</option>
                                                    <?php
                                                    $consulta = "SELECT * from modulo where estado = 'A' ";
                                                    $data = Conexion::buscarVariosRegistro($consulta);
                                                    if ($data) {
                                                        foreach ($data as $d) { ?>
                                                            <option value="<?php echo $d['cod_modulo'] ?>"> <?php echo $d['nombre'] ?> </option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label"> Medici&oacute;n </label>
                                                <select name="medicion[]" id="medicion" class="form-control">
                                                    <option value="">Seleccione una medici&oacute;n </option>
                                                    <?php
                                                    $consulta = "SELECT * from medicion where estado = 'A' ";
                                                    $data = Conexion::buscarVariosRegistro($consulta);
                                                    if ($data) {
                                                        foreach ($data as $d) { ?>
                                                            <option value="<?php echo $d['cod_medicion'] ?>"> <?php echo $d['nombre'] ?> </option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>

                                        </div>
                                        <br>
                                        <hr><br>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" name="button" class="btn bg-gradient-primary m-0 ms-2"> Crear </button>
                        </div>
                    </form>

                    <div class="card-header pb-0"> </div>
                </div>

                <div style="display:none;" id="contenedorLista" class="col-12">
                    <div class="container-fluid py-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>Lista</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Direcci&oacute;n</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tem&aacute;tica</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">M&oacute;dulo</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Medici&oacute;n</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Editar</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Eliminar</th>
                                                        <th class="text-secondary opacity-7"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tabla"> </tbody>
                                            </table>
                                        </div>
                                        <!-- PAGINADO -->
                                        <div class="col-4">
                                            <ul class="justify-content-center m-4 paginacion pagination pagination-primary"></ul>
                                        </div>
                                        <!-- FIN PAGINADO -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- MODAL -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Datos </h5>
                    <button type="button" id="CerrarModalEditar" class="btn btn-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmActualizar">
                        <input type="hidden" id="codigo" name="codigo" value="">

                        <div class="row">
                            <div class="col-6">
                                <label for="" class="col-form-label"> Pregunta </label>
                                <input type="text" class="form-control" id="preguntaEditar" name="pregunta">
                            </div>
                            <div class="col-6">
                                <label for="" class="col-form-label"> Descripci&oacute;n </label>
                                <input type="text" class="form-control" id="descripcionEditar" name="descripcion">
                            </div>

                            <div class="col-6">
                                <label for="" class="col-form-label"> Tem&aacute;tica </label>
                                <select name="tematica" id="tematicaEditar" class="form-control">
                                    <option value="">Seleccionar tem&aacute;tica</option>
                                    <?php
                                    $consulta = "SELECT * from tematica where estado = 'A' ";
                                    $data = Conexion::buscarVariosRegistro($consulta);
                                    if ($data) {
                                        foreach ($data as $d) { ?>
                                            <option value="<?php echo $d['cod_tematica'] ?>"> <?php echo $d['nombre'] ?> </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="" class="col-form-label"> M&oacute;dulo </label>
                                <select name="modulo" id="moduloEditar" class="form-control">
                                    <option value="">Seleccionar m&oacute;dulo </option>
                                    <?php
                                    $consulta = "SELECT * from modulo where estado = 'A' ";
                                    $data = Conexion::buscarVariosRegistro($consulta);
                                    if ($data) {
                                        foreach ($data as $d) { ?>
                                            <option value="<?php echo $d['cod_modulo'] ?>"> <?php echo $d['nombre'] ?> </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="" class="col-form-label"> Medici&oacute;n </label>
                                <select name="medicion" id="medicionEditar" class="form-control">
                                    <option value="">Seleccionar medici&oacute;n </option>
                                    <?php
                                    $consulta = "SELECT * from medicion where estado = 'A' ";
                                    $data = Conexion::buscarVariosRegistro($consulta);
                                    if ($data) {
                                        foreach ($data as $d) { ?>
                                            <option value="<?php echo $d['cod_medicion'] ?>"> <?php echo $d['nombre'] ?> </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="button" class="btn bg-gradient-primary m-0 ms-2">Actualizar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <?php include 'footer.php' ?>

    <?php include 'script.php' ?>

    <script>
        $(document).ready(function() {
            tabla = $('#formPr');
            tr = $('tr:first', tabla);
            $('#btnDuplicar').on('click', function() {
                var disenoformulario = `<div id="frm1" class="row">

                        <div class="col-6">
                            <label class="form-label"> Pregunta </label>
                            <input class="form-control" type="text" placeholder="Pregunta" id="pregunta" name="pregunta[]">
                        </div>

                        <div class="col-6">
                            <label class="form-label"> Descripci&oacute;n </label>
                            <input class="form-control" type="text" placeholder="Descripci&oacute;n" id="descripcion" name="descripcion[]">
                        </div>

                        <div class="col-6">
                            <label class="form-label"> Tem&aacute;tica </label>
                            <select name="tematica[]" id="tematica" class="form-control">
                                <option value="">Seleccione una tem&aacute;tica</option>
                                <?php
                                $consulta = "SELECT * from tematica where estado = 'A' ";
                                $data = Conexion::buscarVariosRegistro($consulta);
                                if ($data) {
                                    foreach ($data as $d) { ?>
                                        <option value="<?php echo $d['cod_tematica'] ?>"> <?php echo $d['nombre'] ?> </option>
                                <?php }
                                } ?>
                            </select>
                        </div>

                        <div class="col-6">
                            <label class="form-label"> M&oacute;dulo </label>
                            <select name="modulo[]" id="modulo" class="form-control">
                                <option value="">Seleccione una m&oacute;dulo</option>
                                <?php
                                $consulta = "SELECT * from modulo where estado = 'A' ";
                                $data = Conexion::buscarVariosRegistro($consulta);
                                if ($data) {
                                    foreach ($data as $d) { ?>
                                        <option value="<?php echo $d['cod_modulo'] ?>"> <?php echo $d['nombre'] ?> </option>
                                <?php }
                                } ?>
                            </select>
                        </div>

                        <div class="col-6">
                            <label class="form-label"> Medici&oacute;n </label>
                            <select name="medicion[]" id="medicion" class="form-control">
                                <option value="">Seleccione una medici&oacute;n </option>
                                <?php
                                $consulta = "SELECT * from medicion where estado = 'A' ";
                                $data = Conexion::buscarVariosRegistro($consulta);
                                if ($data) {
                                    foreach ($data as $d) { ?>
                                        <option value="<?php echo $d['cod_medicion'] ?>"> <?php echo $d['nombre'] ?> </option>
                                <?php }
                                } ?>
                            </select>
                        </div>

                        </div>
                        <br><hr><br>
                        `;
                tr.clone().appendTo(tabla).find('td').html(disenoformulario);
            });

            $("#btnEliminarDuplicado").on('click', function() {
                $('#formPr tr:last').remove();
            });
        });

        // 

        var limite = "5";
        var pagina = "1";

        $('#Agregar').click(function() {
            $('#contenedorAgregar').show();
            $('#contenedorLista').hide();
        });

        $('#Lista').click(function() {
            $('#contenedorAgregar').hide();
            $('#contenedorLista').show();
            cargarLista(limite, pagina);
        });


        $("#formulario").submit(function(event) {
            event.preventDefault();
            var paso = true;
            try {
                $(this).find("input").each(function(index, item) {
                    if ($(item).val().length == 0) {
                        $(item).toggleClass("is-invalid");
                        throw 'Debe llenar correctamente los campos';
                    } else {
                        $(item).removeClass("is-invalid")
                    }
                });

                $(this).find("select#sucursal").each(function(index, item) {
                    if ($(item).val() == 0 || $(item).val() == null) {
                        throw 'Debes escoger opciones';
                    }
                })

            } catch (error) {
                swal("ERROR", error, "error");
                paso = !paso
            }

            if (paso) {
                // swal("ERROR", "oki", "success");
                var formData = new FormData(document.getElementById("formulario"));
                formData.append('tipo', "CREAR");
                formData.append('cod_usuario', $('#cod_usuario').val());

                for (let [key, value] of formData.entries()) {
                    console.log(key, ':', value);
                }
                $.ajax({
                    url: "dist/ajax/pregunta.php",
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    error: function(mensaje, exception) {
                        console.log(mensaje.responseText);
                        swal("ERROR", "Por favor recarga la pagina, si el problema persiste contacta con soporte", "error");
                    },
                    beforeSend: () => {
                        $("#formulario").find("button[type=submit]").prop({
                            disabled: true
                        }).html("Creando...");
                    },
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 'correcto') {
                            document.getElementById("formulario").reset();
                            swal("Buen trabajo!", response['mensaje'], "success");
                        } else if (response['status'] == 'informacion') {
                            swal("Hey!", response['mensaje'], "info");
                        } else {
                            swal("error!", response['mensaje'], "error");
                        }
                    },
                    complete: () => {
                        $("#formulario").find("button[type=submit]").prop({
                            disabled: false
                        }).html("Crear");
                    }

                });
            }
        });


        // LISTA
        function cargarLista(limite, pagina) {
            console.log(limite, pagina);
            var formData = new FormData();
            formData.append('tipo', "LISTA");
            formData.append('limite', limite);
            formData.append('pagina', pagina);

            ajax(formData);
        }

        function ajax(formData) {
            $.ajax({
                beforeSend: function() {},
                type: "POST",
                url: "dist/ajax/pregunta.php",
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                error: function(mensaje, exception) {
                    console.log(mensaje.responseText);
                    swal("ERROR", "Error con la consulta, contacta con soporte", "error");
                },
                success: function(response) {
                    if (response['status'] == 'correcto') {
                        dibujarTabla(response['datos'], response['paginado']);
                    } else if (response['status'] == 'informacion') {
                        swal("Hey!", response['mensaje'], "info");
                        $('#contenedorAgregar').show();
                        $('#contenedorLista').hide();
                    } else {
                        swal("error!", response['mensaje'], "error");
                        $('#contenedorAgregar').show();
                        $('#contenedorLista').hide();
                    }
                }
            });
        }

        function dibujarTabla(data, paginado) {
            var codigo = "";
            var nombre = "";
            var descripcion = "";
            var tematica = "";
            var modulo = "";
            var medicion = "";

            var dataBody = "";
            $.each(data, function(item, valor) {
                codigo = data[item]['cod_pregunta'];
                nombre = data[item]['pregunta'];
                descripcion = data[item]['descripcion'];
                tematica = data[item]['tematica'];
                modulo = data[item]['modulo'];
                medicion = data[item]['medicion'];

                dataBody += `
                        <tr>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${nombre} </p>   </td>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${descripcion} </p>   </td>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${tematica} </p>   </td>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${modulo} </p>   </td>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${medicion} </p>   </td>
                            <td class="align-middle text-center">   <button class="btn btn-info"   onclick="abrirModal(${codigo});"> <i class="fas fa-pencil-alt"></i> </button>   </td>
                            <td class="align-middle text-center">   <button class="btn btn-danger" onclick="eliminar(${codigo});"> <i class="fas fa-trash"></i>  </button>   </td>
                        </tr>
                    `;

            });
            $("#tabla").html(dataBody);
            $(".paginacion").html(paginado);
        }

        // DAR CLICK SOBRE CUALQUIER NUMERO DE PAGINADO
        $(".paginacion").on("click", "li > a", function() {
            const {
                pagina
            } = $(this).data();
            mostrarInfo(pagina);
        });

        function mostrarInfo(pag = 1, items = limite) {
            console.log("limite", items);
            console.log("pagina", pag);
            var formData = new FormData();
            formData.append('tipo', 'LISTA');
            formData.append('limite', items);
            formData.append('pagina', pag);

            ajax(formData);
        }

        function abrirModal(codigo) {
            var formData = new FormData();
            formData.append('tipo', 'CONSULTAR');
            formData.append('codigo', codigo);

            $.ajax({
                beforeSend: function() {},
                type: "POST",
                url: "dist/ajax/pregunta.php",
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                error: function(mensaje, exception) {
                    console.log(mensaje.responseText);
                    swal("ERROR", "Error con la consulta, contacta con soporte", "error");
                },
                success: function(response) {
                    console.log(response);
                    if (response['status'] == 'correcto') {
                        $('#modalEditar').modal('show');
                        $('#codigo').val(response['codigo']);
                        $('#preguntaEditar').val(response['pregunta']);
                        $('#descripcionEditar').val(response['descripcion']);
                        $('#tematicaEditar').val(response['tematica']);
                        $('#moduloEditar').val(response['modulo']);
                        $('#medicionEditar').val(response['medicion']);

                    } else if (response['status'] == 'informacion') {
                        $('#modalEditar').modal('hide');
                        swal("hey", response['mensaje'], "info");

                    } else {
                        $('#modalEditar').modal('hide');
                        swal("error", response['mensaje'], "error");
                    }
                }
            });
        }

        $("#frmActualizar").submit(function(event) {
            event.preventDefault();
            var paso = true;
            try {
                $(this).find("input").each(function(index, item) {
                    if ($(item).val().length == 0) {
                        $(item).toggleClass("is-invalid");
                        throw 'Debe llenar correctamente los campos';
                    } else {
                        $(item).removeClass("is-invalid")
                    }
                });

                $(this).find("select#sucursalEditar").each(function(index, item) {
                    if ($(item).val() == 0 || $(item).val() == null) {
                        throw 'Debes escoger opciones';
                    }
                });
            } catch (error) {
                swal("ERROR", error, "error");
                paso = !paso
            }

            if (paso) {
                var formData = new FormData(document.getElementById("frmActualizar"));
                formData.append('tipo', "ACTUALIZAR");
                formData.append('cod_usuario', $('#cod_usuario').val());

                $.ajax({
                    url: "dist/ajax/pregunta.php",
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    error: function(mensaje, exception) {
                        console.log(mensaje.responseText);
                        swal("ERROR", "Por favor recarga la pagina, si el problema persiste contacta con soporte", "error");
                    },
                    beforeSend: () => {
                        $("#frmActualizar").find("button[type=submit]").prop({
                            disabled: true
                        }).html("Actualizando...");
                    },
                    success: function(response) {
                        console.log(response);
                        cargarLista(limite, 1);
                        if (response['status'] == 'correcto') {
                            $('#modalEditar').modal('hide');
                            swal("Buen trabajo!", response['mensaje'], "success");

                        } else if (response['status'] == 'informacion') {
                            $('#modalEditar').modal('hide');
                            swal("hey", response['mensaje'], "info");

                        } else {
                            $('#modalEditar').modal('hide');
                            swal("error", response['mensaje'], "error");
                        }

                    },
                    complete: () => {
                        $("#frmActualizar").find("button[type=submit]").prop({
                            disabled: false
                        }).html("Actualizar");
                    }
                });
            }
        });

        $('#CerrarModalEditar').click(function() {
            $('#modalEditar').modal('hide');
        });


        function eliminar(codigo) {
            var formData = new FormData();
            formData.append('tipo', "ELIMINAR");
            formData.append('cod_usuario', $('#cod_usuario').val());
            formData.append('codigo', codigo);

            $.ajax({
                url: "dist/ajax/oficina.php",
                type: "POST",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                error: function(mensaje, exception) {
                    console.log(mensaje.responseText);
                    swal("ERROR", "Por favor recarga la pagina, si el problema persiste contacta con soporte", "error");
                },
                success: function(response) {
                    if (response['status'] == 'correcto') {
                        $('#modalEditar').modal('hide');
                        swal("Buen trabajo!", response['mensaje'], "success");

                    } else if (response['status'] == 'informacion') {
                        $('#modalEditar').modal('hide');
                        swal("hey", response['mensaje'], "info");

                    } else {
                        $('#modalEditar').modal('hide');
                        swal("error", response['mensaje'], "error");
                    }
                    cargarLista(limite, 1);
                }
            });
        }
    </script>
</body>

</html>