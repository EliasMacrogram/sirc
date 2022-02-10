<?php 
require_once "conexion.php";
session_start();
if ($_SESSION['datos_login'] == "") {
  header("Location: ../sistema/");
}
$titulo = "Sucursales";
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
            <div class="col-4">
                <button id="Agregar" class="btn btn-info"> Agregar</button>
                <button id="Lista" class="btn btn-primary"> Lista</button>
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
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label"> Nombre </label>
                                <input class="form-control" type="text" placeholder="Nombre" id="nombre" name="nombre">
                            </div>
                            <div class="col-6">
                                <label class="form-label"> Direcci&oacute;n </label>
                                <input class="form-control" type="text" placeholder="Direcci&oacute;n" id="direccion" name="direccion">
                            </div>
                            <div class="col-6">
                                <label class="form-label"> Tel&eacute;fono </label>
                                <input class="form-control" type="text" placeholder="Tel&eacute;fono" id="telefono" name="telefono">
                            </div>
                            <div class="col-6">
                                <label class="form-label"> Correo </label>
                                <input class="form-control" type="email" placeholder="Correo" id="correo" name="correo">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <!-- <button type="button" name="button" class="btn btn-light m-0">Cancel</button> -->
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
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Tel&eacute;fono </th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Correo</th>
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
                                <label for="" class="col-form-label"> Nombre </label>
                                <input type="text" class="form-control" id="nombreEditar" name="nombre">
                            </div>
                            <div class="col-6">
                                <label for="" class="col-form-label"> Direcci&oacute;n </label>
                                <input type="text" class="form-control" id="direccionEditar" name="direccion">
                            </div>
                            <div class="col-6">
                                <label for="" class="col-form-label"> Tel&eacute;fono </label>
                                <input type="text" class="form-control" id="telefonoEditar" name="telefono">
                            </div>
                            <div class="col-6">
                                <label for="" class="col-form-label"> Correo </label>
                                <input type="text" class="form-control" id="correoEditar" name="correo">
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
            } catch (error) {
                swal("ERROR", error, "error");
                paso = !paso
            }

            if (paso) {

                $.ajax({
                    url: "dist/ajax/sucursal.php",
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
                        console.log(response);
                        if (response['status'] == 'correcto') {
                            document.getElementById("formulario").reset();
                            swal("Buen trabajo!", response['mensaje'], "success");
                        } else if (response['status'] == 'informacion') {
                            swal("Hey!", response['mensaje'], "info");
                        } else {
                            swal("error!", response['mensaje'], "error");
                        }
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
                url: "dist/ajax/sucursal.php",
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
                        dibujarTabla(response['datos'], response['paginado']);
                    } else if (response['status'] == 'informacion') {
                        swal("Hey!", response['mensaje'], "info");
                    } else {
                        swal("error!", response['mensaje'], "error");
                    }
                }
            });
        }

        function dibujarTabla(data, paginado) {
            var codigo = "";
            var nombre = "";
            var direccion = "";
            var telefono = "";
            var correo = "";

            var dataBody = "";
            $.each(data, function(item, valor) {
                codigo = data[item]['cod_sucursal'];
                nombre = data[item]['nombre'];
                direccion = data[item]['direccion'];
                telefono = data[item]['telefono'];
                correo = data[item]['correo'];

                dataBody += `
                        <tr>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${nombre} </p>   </td>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${direccion} </p>   </td>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${telefono} </p>   </td>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${correo} </p>   </td>
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
                url: "dist/ajax/sucursal.php",
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
                        $('#nombreEditar').val(response['nombre']);
                        $('#direccionEditar').val(response['direccion']);
                        $('#telefonoEditar').val(response['telefono']);
                        $('#correoEditar').val(response['correo']);

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
            } catch (error) {
                swal("ERROR", error, "error");
                paso = !paso
            }

            if (paso) {
                var formData = new FormData(document.getElementById("frmActualizar"));
                formData.append('tipo', "ACTUALIZAR");
                formData.append('cod_usuario', $('#cod_usuario').val());

                $.ajax({
                    url: "dist/ajax/sucursal.php",
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
                        console.log(response);
                        cargarLista(limite, 1);
                        if (response['status'] == 'correcto') {
                            // document.getElementById("frmActualizar").reset();
                            $('#modalEditar').modal('hide');
                            swal("Buen trabajo!", response['mensaje'], "success");

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
        });

        $('#CerrarModalEditar').click(function() {
            $('#modalEditar').modal('hide');
        });
    </script>
</body>

</html>