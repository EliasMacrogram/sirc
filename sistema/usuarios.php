<?php
require_once "conexion.php";
$titulo = "Usuarios";
$cod_usuario = 1;
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
                            <div class="col-4">
                                <label class="form-label"> Tipo de usuario </label>
                                <select name="rol" id="rol" class="form-control">
                                    <option value="">Seleccione tipo de usuario</option>
                                    <?php
                                    $consulta = "SELECT * from rol where estado = 'A' ";
                                    $data = Conexion::buscarVariosRegistro($consulta);
                                    if ($data) {
                                        foreach ($data as $d) { ?>
                                            <option value="<?php echo $d['cod_rol'] ?>"> <?php echo $d['nombre'] ?> </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>

                            <div style="display:none;" id="contenedorEmpresa" class="col-4">
                                <label class="form-label"> Empresa </label>
                                <select name="empresa" id="empresa" class="form-control">
                                    <option value="">Seleccione empresa</option>
                                    <?php
                                    $consulta = "SELECT * from rol where estado = 'A' ";
                                    $data = Conexion::buscarVariosRegistro($consulta);
                                    if ($data) {
                                        foreach ($data as $d) { ?>
                                            <option value="<?php echo $d['cod_rol'] ?>"> <?php echo $d['nombre'] ?> </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>

                            <div class="col-4">
                                <label class="form-label"> Usuario </label>
                                <input class="form-control" type="text" placeholder="usuario" id="usuario" name="usuario">
                            </div>

                            <div class="col-4">
                                <label class="form-label"> Contrase&ntilde;a </label>
                                <input class="form-control" type="password" placeholder="Contrase&ntilde;a" id="password" name="password">
                            </div>

                            <div class="col-4">
                                <label class="form-label"> Nombre y Apellidos </label>
                                <input class="form-control" type="text" placeholder="Nombres y apellidos" id="nombres" name="nombres">
                            </div>

                            <div class="col-4">
                                <label class="form-label"> Correo </label>
                                <input class="form-control" type="email" placeholder="Correo" id="correo" name="correo">
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" id="Crear" name="button" class="btn bg-gradient-primary m-0 ms-2"> Crear </button>
                            </div>
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
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo usuario</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 "> Usuario </th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Correo </th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Correo confirmado </th>
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
                                <label for="" class="col-form-label"> Tipo de usuario </label>
                                <select name="rol" id="rolEditar" class="form-control">
                                    <option value="">Seleccionar tipo de usuario</option>
                                    <?php
                                    $consulta = "SELECT * from rol where estado = 'A' ";
                                    $data = Conexion::buscarVariosRegistro($consulta);
                                    if ($data) {
                                        foreach ($data as $d) { ?>
                                            <option value="<?php echo $d['cod_rol'] ?>"> <?php echo $d['nombre'] ?> </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="" class="col-form-label"> Usuario </label>
                                <input type="text" class="form-control" id="usuarioEditar" name="usuario">
                            </div>

                            <div style="display:none;" class="col-6">
                                <label for="" class="col-form-label"> Contrase&ntilde;a </label>
                                <input type="password" class="form-control" id="passwordEditar" name="password">
                            </div>

                            <div class="col-6">
                                <label for="" class="col-form-label"> Nombres y Apellidos </label>
                                <input type="text" class="form-control" id="nombresEditar" name="nombres">
                            </div>

                            <div class="col-6">
                                <label for="" class="col-form-label"> Correo </label>
                                <input type="text" class="form-control" id="correoEditar" name="correo">
                            </div>


                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="Actualizar" data-dismiss="modal">Actualizar</button>
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

        $('#Crear').click(function() {
            if ($('#rol').val() == "" || $('#usuario').val() == "" || $('#password').val() == "" || $('#nombres').val() == "" || $('#correo').val() == "") {
                swal("Alerta!", "Los campos son obligatorios", "warning");
                return false;
            }
            var formData = new FormData(document.getElementById("formulario"));
            formData.append('tipo', "CREAR");
            formData.append('cod_usuario', $('#cod_usuario').val());

            for (let [key, value] of formData.entries()) {
                console.log(key, ':', value);
            }

            $.ajax({
                url: "dist/ajax/usuario.php",
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
        });


        // LISTA
        function cargarLista(limite, pagina) {
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
                url: "dist/ajax/usuario.php",
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
                    // console.log(response);
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
            var rol = "";
            var usuario = "";
            var correo = "";
            var correoConfirmado = "";

            var dataBody = "";
            $.each(data, function(item, valor) {
                codigo = data[item]['cod_usuario'];
                rol = data[item]['nombreRol'];
                usuario = data[item]['usuario'];
                correo = data[item]['correo'];
                correoConfirmado = data[item]['correoConfirmado'];
                if (correoConfirmado == 1) {
                    correoConfirmado = "ENVIADO";
                } else {
                    correoConfirmado = "PENDIENTE";
                }
                dataBody += `
                        <tr>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${rol} </p>   </td>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${usuario} </p>   </td>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${correo} </p>   </td>
                            <td class="align-middle text-center"> <p class="text-secondary text-xxs font-weight-bolder"> ${correoConfirmado} </p>   </td>
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
                url: "dist/ajax/usuario.php",
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
                        $('#rolEditar').val(response['cod_rol']);
                        $('#usuarioEditar').val(response['usuario']);
                        $('#passwordEditar').val(response['password']);
                        $('#nombresEditar').val(response['nombres']);
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

        $('#Actualizar').click(function() {
            if ($('#rolEditar').val() == "" || $('#usuarioEditar').val() == "" || $('#nombresEditar').val() == "" || $('#correoEditar').val() == "") {
                swal("Alerta!", "Los campos son obligatorios", "warning");
                return false;
            }
            var formData = new FormData(document.getElementById("frmActualizar"));
            formData.append('tipo', "ACTUALIZAR");
            formData.append('cod_usuario', $('#cod_usuario').val());

            $.ajax({
                url: "dist/ajax/usuario.php",
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
                url: "dist/ajax/usuario.php",
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