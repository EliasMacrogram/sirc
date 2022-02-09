$(document).ready(function () {

    ObtenerNoticias()

    $("#noticias").submit(function (event) {
        event.preventDefault();

        var guardar = false,
            descre = []

        try {
            $(this).find("input[type=text]").each(function (index, item) {

                if ($(item).val().length == 0) {
                    $(item).toggleClass("is-invalid")
                    throw 'Debe llenar correctamente los campos'
                } else {
                    $(item).removeClass("is-invalid")
                }
            })

            $(this).find("textarea#descripcion1").each(function (index, item) {
                var editorText = CKEDITOR.instances[item.id].getData()

                if (editorText == "") {
                    throw 'Debe llenar la descripciÃ³n de la noticia'
                } else {
                    descre.push(editorText);
                }
            })

            if (Number($("#idnoticia").val()) == 0) {
                $(this).find("input[type=file]").each(function (index, item) {
                    if ($(item).val().length == 0) {
                        throw 'Debe seleccionar la imagen'
                    }
                })
            }

            $(this).find("input[type=checkbox]#flexSwitchCheckDefault").each(function (index, item) {
                var padre = $(this).parent().parent().parent().parent().parent().parent()

                var valor = $(padre).find("input.datepicker").val()

                if ($(item).is(':checked') && valor == "") {
                    throw 'Debe seleccionar la duraciï¿½ï¿½n de la noticia'
                }
            })

            $(this).find("select#empresa").each(function (index, item) {
                if ($(item).val() == 0 || $(item).val() == null) {
                    throw 'Debe seleccionar la empresa'
                }
            })

            guardar = !guardar
        } catch (error) {
            Swal.fire({
                icon: 'warning',
                html: `${error}`,
                confirmButtonText: 'Cerrar'
            })
        }

        if (guardar) {
            var formData = new FormData($(this)[0])
            // GUARDAR NOTICIA => GN
            formData.append("metodo", "GN")
            formData.append("descripcion", JSON.stringify(descre))


            $.ajax({
                type: 'POST',
                url: 'dist/ajax/noticias.php',
                dataType: 'json',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                error: function (err) { console.log(err) },
                beforeSend: function () {
                    $("button.bg-gradient-atm").prop({ disabled: true }).html("Procesando....")
                },
                success: function (response) {

                    var { success, mensaje, data } = response

                    switch (success) {
                        case 1:
                            ObtenerNoticias()
                            $('#v-pills-tab a[href="#v-pills-home"]').tab('show')
                            $(".moving-tab").css({ 'transform': 'translate3d(0px, 0px, 0px)' })
                            $(".fechaLimite").empty()
                            $("button.bg-gradient-atm").prop({ disabled: false }).html("Guardar")
                            break;

                        default:
                            Swal.fire({
                                icon: 'warning',
                                html: `${mensaje}`,
                                confirmButtonText: 'Cerrar'
                            })
                            $("button.bg-gradient-atm").prop({ disabled: false }).html("Actualizar")

                            break;
                    }
                }
            })
        }

        return false
    })

    $(".paginacion").on("click", "li > a", function () {
        var { pagina } = $(this).data();

        ObtenerNoticias(pagina)
    })

    $("#noticias").on("click", ".form-check-input", function () {
        var padre = $(this).parent().parent().parent().parent().parent().parent()

        if ($(this).is(':checked')) {
            var limite = `
                <div class="mt-2">
                    <div class="align-items-center">
                        <div>
                            <input class="form-control datepicker" placeholder="Seleccione la fecha de caducidad" type="text" name="duracion[]" />
                        </div>
                    </div>
                </div>
            `
            $(padre).find(".fechaLimite").html(limite)
        } else {
            $(padre).find(".fechaLimite").empty()
        }
        if (document.querySelector('.datepicker')) {
            flatpickr('.datepicker', {
                // mode: "range",
                locale: 'es',
                minDate: new Date()
            }); // flatpickr
        }
    })

    $(".agregarmas").click(function () {
        $("#Noticias .noticia:last").clone().appendTo("#Noticias")

        var total = Number($("#Noticias").find(".noticia").length)

        $("#Noticias").find(".noticia").each(function (index, item) {

            if (total == (index + 1)) {
                $(item).find("input,textarea").val("")
                $(item).find('img').attr({ src: `https://svgsilh.com/svg_v2/2112207.svg?v=${new Date().getSeconds()}` })

                $(item).find("textarea").addClass("editor")
            }
        })
    })

    $("#noticias").on('change', 'input[type=file]', function () {
        var extencion = ['png', 'jpeg', 'jpg'];

        CargarImage(this, extencion, 1080, 720)
    })

    // $("input[type=file]").change(function () {
    //     var extencion = ['png', 'jpeg', 'jpg'];

    //     CargarImage(this, extencion, 1080, 720)
    //     console.log(this)
    // })

    // EDITAR NOTICIA
    $("#tbodyNoticias").on("click", ".editarNoticia", function () {
        var { noticia } = $(this).data(),
            boton = this

        // OBTENER NOTICIA SELECCIONADA => ONS
        var data = { noticia, metodo: 'ONS' }

        $.ajax({
            type: 'POST',
            url: 'dist/ajax/noticias.php',
            dataType: 'json',
            data,
            error: function (err) { console.log(err) },
            beforeSend: function () {
                $(boton).html("Obteniendo");
                $("#tbodyNoticias .editarNoticia").attr("disabled", true);
                // LimparFormulario()
            },
            success: function (response) {
                var { success, mensaje, data } = response
                switch (success) {
                    case 1:
                        $(".editarNoticia").prop({ disabled: false });
                        $(boton).html("Editar");
                        var { id_noticias, id_empresa, imagen, nombre, autor, breve_descripcion, descripcion, valida_time, orden } = data;

                        $("#orden").val(orden)
                        $("#titulo").val(nombre)
                        $("#brebeDesc").val(breve_descripcion)
                        $("#autor").val(autor)
                        $(`#empresa option[value=${id_empresa}]`).prop({ 'selected': true })
                        $("#img").attr({ src: `${imagen}` })
                        CKEDITOR.instances['descripcion1'].setData(descripcion)
                        $("#idnoticia").val(id_noticias)

                        if (valida_time != "") {
                            $("input:checkbox#flexSwitchCheckDefault").prop({ checked: true })

                            var limite = `
                                    <div class="mt-2">
                                        <div class="align-items-center">
                                            <div>
                                                <input class="form-control datepicker" placeholder="Seleccione la fecha de caducidad" type="text" name="duracion[]" value="${valida_time}" />
                                            </div>
                                        </div>
                                    </div>
                                `
                            $(".fechaLimite").html(limite)

                            if (document.querySelector('.datepicker')) {
                                flatpickr('.datepicker', {
                                    // mode: "range",
                                    locale: 'es',
                                    minDate: new Date()
                                }); // flatpickr
                            }
                        }

                        $('#v-pills-tab a[href="#v-pills-profile"]').tab('show')
                        $(".moving-tab").css({ 'transform': 'translate3d(514px, 0px, 0px)' })
                        $("button.bg-gradient-atm").prop({ disabled: false }).html("Actualizar")
                        break;
                }
            }

        })
    })

    // ACTUALIZAR NOTICIA
    $("#tbodyNoticias").on("click", "input:checkbox", function () {
        var data = $(this).data()
        data.metodo = "AEN"

        if (data.estado == 1) {
            data.estado = 0
        } else {
            data.estado = 1
        }

        $.ajax({
            type: 'POST',
            url: 'dist/ajax/noticias.php',
            dataType: 'Json',
            data,
            error: function (err) { console.log(err) },
            success: function (response) {
                const { success, mensaje, data } = response

                switch (success) {
                    case 1:
                        ObtenerNoticias()
                        LimparFormulario()
                        break;
                    case 2:
                        alert(mensaje);
                        break;
                }
            }
        })
    })
});

function ObtenerNoticias(pagina = 1, items = 10) {
    $.ajax({
        type: 'POST',
        url: 'dist/ajax/noticias.php',
        dataType: 'json',
        data: {
            // OBTENER TODAS LAS NOTICIAS => OTN
            metodo: "OTN",
            pagina,
            items

        },
        error: function (err) { console.log(err) },
        beforeSend: function () {
            OpenLoadtext()
        },
        success: function (response) {
            // console.log(response)
            var { success, mensaje, data } = response, tbody = ""

            switch (success) {
                case 1:
                    var { noticias, paginacion, orden } = data
                    

                    $("#orden").val(parseInt(orden) + 1)

                    noticias.map(function (item) {
                        var nombre = item['nombre'],
                            breve = item['breve_descripcion'],
                            detalle = item['descripcion']


                        if (item['nombre'].length > 20 && item['nombre'] != null) {
                            nombre = item['nombre'].substring(0, 20) + "...."
                        }

                        if (item['breve_descripcion'].length > 20 && item['breve_descripcion'] != null) {
                            breve = item['breve_descripcion'].substring(0, 20) + "...."
                        }

                        if (item['descripcion'].length > 20 && item['descripcion'] != null) {
                            detalle = item['descripcion'].substring(0, 20) + "...."
                        }


                        //     <td class="align-middle text-center text-sm">
                        //     <div class="text-xs font-weight-bold mb-0">${detalle}</div>
                        // </td>

                        var img = item['imagen'];
                        //                         var img = `${item['columnaImg']+item['columnaImg2']+item['columnaImg3']+item['columnaImg4']+item['columnaImg5']+item['columnaImg6']+item['columnaImg7']}`
                        // console.log(img.length)
                        tbody += `
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="data:${img}" class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">ATM</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">${nombre}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <div class="text-xs font-weight-bold mb-0">${item['orden']}</div>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">${item['fechaPublicacion']}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-auto" type="checkbox" data-id=${item['id_noticias']} data-estado=${item['estado']} id="flexSwitchCheckDefault_${item['cont']}" ${item['estado'] == 1 ? 'checked' : ''}>
                                    <label class="form-check-label mb-0 text-body text-truncate" for="flexSwitchCheckDefault_${item['cont']}">${item['estado'] == 1 ? 'Activo' : 'Inactivo'
                            }</label>
                                </div>
                                </td>
                                <td class="align-middle text-center">
                                    <button class="btn btnAtm btn-sm editarNoticia" data-noticia=${Number(item['id_noticias'])} data-toggle="tooltip" data-original-title="Editar noticia">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        `
                    })

                    $(".paginacion").html(paginacion)
                    break;
                case 2:
                    tbody = "<tr> <td class='text-center p-3' colspan=10>No hoy noticias para mostrar</td> </tr>";
                    $(".paginacion").empty()
                    break
            }

            $("#tbodyNoticias").html(tbody)

        },
        complete: function () {
            ListarEmpresas()
            // LimparFormulario()
            CloseLoad()
        }
    })
}

function ListarEmpresas() {
    $.ajax({
        type: 'POST',
        url: 'dist/ajax/empresas.php',
        dataType: 'json',
        data: {
            // OBTENER TODAS LAS EMPRESAS ACTIVA => OEA
            metodo: "OEA",

        },
        // error: function(err){ console.log(err) },
        success: function (response) {
            // console.log(response)
            var { success, mensaje, data } = response
            switch (success) {
                case 1:
                    var { empresas } = data, option = ""

                    empresas.map(function (item) {
                        option += `<option value='${item['id_empresa']}' ${Number(item['id_empresa']) == 0 ? 'disabled selected' : ''}>${item['nombre']}</option>`
                    })
                    $("#empresa").html(option);
                    break
                case 2:
                    var option = ""

                    option += `<option >No hay empresas para mostrar</option>`
                    $("#empresa").attr({ disabled: true }).html(option);
                    break
            }
        }
    })
}

function LimparFormulario() {
    $("#idnoticia").val(0)
    $("#noticias").trigger("reset")
    $("#img").attr({ "src": `img/camara.png?v=${new Date().getSeconds()}` })
    CKEDITOR.instances["descripcion1"].setData("");
    $("button[type=submit]").html("Guardar")


    $(".fechaLimite").empty()
}