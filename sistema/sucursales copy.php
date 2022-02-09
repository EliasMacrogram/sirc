<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title> Inicio </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
        <?php include 'menu.php' ?>
    </aside>

    <?php include 'barra.php' ?>


    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card card-body">
                <div class="row">
                    <div class="col-4">
                        <button class="btn btn-info"> Agregar</button>
                        <button class="btn btn-primary"> Lista</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-9 col-12 mx-auto">
            <div class="card card-body mt-4">
                <h6 class="mb-0"></h6>
                <p class="text-sm mb-0">Create new project</p>
                <hr class="horizontal dark my-3">
                <label for="projectName" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="projectName">
                <div class="row mt-4">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>
                                Private Project
                            </label>
                            <p class="form-text text-muted text-xs ms-1">
                                If you are available for hire outside of the current situation, you can encourage others to hire you.
                            </p>
                            <div class="form-check form-switch ms-1">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onclick="notify(this)" data-type="warning" data-content="Once a project is made private, you cannot revert it to a public project." data-title="Warning" data-icon="ni ni-bell-55">
                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <label class="mt-4">Project Description</label>
                <p class="form-text text-muted text-xs ms-1">
                    This is how others will learn about the project, so make it good!
                </p>
                <div id="editor">
                    <p>Hello World!</p>
                    <p>Some initial <strong>bold</strong> text</p>
                    <p><br></p>
                </div>
                <label class="mt-4 form-label">Project Tags</label>
                <select class="form-control" name="choices-multiple-remove-button" id="choices-multiple-remove-button" multiple>
                    <option value="Choice 1" selected>Choice 1</option>
                    <option value="Choice 2">Choice 2</option>
                    <option value="Choice 3">Choice 3</option>
                    <option value="Choice 4">Choice 4</option>
                </select>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Start Date</label>
                        <input class="form-control datetimepicker" type="text" placeholder="Please select start date" data-input>
                    </div>
                    <div class="col-6">
                        <label class="form-label">End Date</label>
                        <input class="form-control datetimepicker" type="text" placeholder="Please select end date" data-input>
                    </div>
                </div>
                <label class="mt-4 form-label">Starting Files</label>
                <form action="/file-upload" class="form-control dropzone" id="dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </form>
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" name="button" class="btn btn-light m-0">Cancel</button>
                    <button type="button" name="button" class="btn bg-gradient-primary m-0 ms-2">Create Project</button>
                </div>
            </div>
        </div>
    </div>




    <?php include 'footer.php' ?>
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="assets/js/plugins/chartjs.min.js"></script>


    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>