<?php header('Content-Type: text/html; charset=utf-8');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />-->

    <title>Gestión Inmobiliaria </title>

    <!------- CSS INCLUDE----------->

    <!------------  CSS ------------>
    <!-- Alquileres_Disponibles -->
    <link href="css/alquileres.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- Custom Global Personal Style -->
    <link href="css/custom_global.css" rel="stylesheet">
    <!------- END CSS INCLUDE----------->

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <!-- page template -->
        <?php include 'template.php'; ?>
        <!-- /page template -->

        <!-- top navigation -->
        <?php include 'nav_bar.php'; ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div id="page_content" class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h1>Alquileres</h1>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>EDITAR Propiedad Disponible</h2>
                                <div class="clearfix"></div>
                                <div class="x_content">
                                    <br>
                                    <!-- Smart Wizard -->
                                    <div id="wizard" class="form_wizard wizard_horizontal">
                                        <ul id="wizardNodes" class="wizard_steps anchor">
                                            <li>
                                                <a href="#step-1">
                                                    <span class="step_no">1</span>
                                                    <span class="step_descr">Datos Inmueble</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#step-2">
                                                    <span class="step_no">2</span>
                                                    <span class="step_descr">Fotos Inmueble</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#step-3">
                                                    <span class="step_no">3</span>
                                                    <span class="step_descr">Datos Propietario</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!--<div style="height: 433px;" class="stepContainer" align="center" style="display: none;">-->
                                        <!-------- DATOS INMUEBLES ------------>
                                        <div align="center" id="step-1" class="content" style="width: 80%; text-align: center; display: none; height: auto;">
                                            <?php include_once "components/inmueble_input.php" ?>
                                        </div>
                                        <!--------- FOTOS INMUEBLES ---------------->
                                        <div align="center" id="step-2" class="content" style="width: 80%; text-align: center; display: none;">
                                            <form class="form-horizontal form-label-left" novalidate>
                                                <div class="container" style="margin: 0 auto;width:80%;">
                                                    <div class="row" style="margin: 0 auto;width:80%;">
                                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                            <!--<input type="file" style="display: none;"  id="file" onchange="readURL(this.files);" multiple="" accept=".jpg,.jpeg,.png"/>-->
                                                            <label for="file" class="btn btn-primary"><span class="fa fa-upload" style="color: #fff;"></span> Próximamnete</label>
                                                            <br>
                                                            <label id="countFotos" class="control-label">(0 de 5) Fotos Seleccionadas</label>
                                                            <br>
                                                            <table id="table_content" class="table table-striped table-bordered" style="width: 80% !important;">
                                                                <thead>
                                                                <tr>
                                                                    <th style="display: none"></th>
                                                                    <th style="display: none"></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="table_content_body">
                                                                <tr>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-------------- DATOS PROPIETARIO ------------------>
                                        <div align="center" id="step-3" class="content" style="width: 80%; text-align: center; display: none;">
                                            <?php include_once "components/propietario_form.php" ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<!------- JS INCLUDE ----------->
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Data Table paginado-->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<!-- Data Table pages select dynamic style when hover and select-->
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- jQuery Smart Wizard -->
<script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="js/moment/moment.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.js"></script>
<script src="js/datepicker/daterangepicker.js"></script>

<script src="js/cookie_utils.js"></script>
<script src="js/utils.js"></script>
<script src="js/Base64.js"></script>
<!-- Custom Global Scripts -->
<script src="js/change_pass.js"></script>
<script src="js/edit_profile.js"></script>
<script src="js/custom_global.js"></script>
<script src="js/bootbox.js" type="text/javascript" ></script>
<script src="js/variables.js"></script>

<script src="components/js/inmueble_input.js"></script>
<script src="components/js/person_form.js"></script>
<script src="components/js/propietario_form.js"></script>
<script src="js/alquileres_disponibles_edit.js"></script>

<!------- END JS INCLDE ----------->

<!------------ JavaScript Controllers ----------->

<!-- Page Content refresh when SideMenu click -->
<script text="javascript">
    if(typeof jQuery == 'undefined'){
        document.write('<script type="text/javascript" src="../vendors/jquery/dist/jquery.min.js"></'+'script>');
    }
</script>
<!-- End Page Content refresh  -->

<!------------End JavaScript Controllers ----------->