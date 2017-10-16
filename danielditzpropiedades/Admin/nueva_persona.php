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
                        <h1>Personas</h1>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Nueva Persona</h2>
                                <div class="clearfix"></div>
                                <div class="x_content" style="text-align: center;">
                                <br>

                                <div id="personaInputContent" class="x_panel" style="width:80%;">
                                    <div class="x_content" align="center" id="personViewContent">
                                        <div class="container" style="margin: 0 auto;width:80%;">
                                            <div class="row" style="margin: 0 auto;width:80%;">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="short-div" style="text-align: left;">
                                                        <label for="nombrePersona_input" class="control-label">Nombre<span class="required">*</span></label>
                                                    </div>
                                                    <div class="short-div">
                                                        <input type="text" id="nombrePersona_input" required="required" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin: 0 auto;width:80%;">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="short-div" style="text-align: left;">
                                                        <label for="apellidoPersona_input" class="control-label">Apellido<span class="required">*</span></label>
                                                    </div>
                                                    <div class="short-div">
                                                        <input type="text" id="apellidoPersona_input" required="required" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin: 0 auto;width:80%;">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="short-div" style="text-align: left;">
                                                        <label for="dniPersona_input" class="control-label">D.N.I.<span class="required">*</span></label>
                                                    </div>
                                                    <div class="short-div">
                                                        <input type="text" id="dniPersona_input" required="required" class="form-control" onfocus="openPersonDatePicker()">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin: 0 auto;width:80%;">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="short-div" style="text-align: left;">
                                                        <label for="fNacimientoPersona" class="control-label">Fecha Nacimiento</label>
                                                    </div>
                                                    <div id="DivfNacimientoPersona" class="short-div input-prepend input-group">
                                                        <input type="text" id="fNacimientoPersona" class="form-control">
                                                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin: 0 auto;width:80%;">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="short-div" style="text-align: left;">
                                                        <label for="telefonoPersona_input" class="control-label">Teléfono</label>
                                                    </div>
                                                    <div class="short-div">
                                                        <input type="text" id="telefonoPersona_input" class="form-control" onfocus="openPersonDatePicker()">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin: 0 auto;width:80%;">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="short-div" style="text-align: left;">
                                                        <label for="celularPersona_input" class="control-label">Celular</label>
                                                    </div>
                                                    <div class="short-div">
                                                        <input type="text" id="celularPersona_input" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container" style="margin: 0 auto;width:80%;">
                                            <div class="row" style="margin: 0 auto;width:80%;">
                                                <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-5">
                                                    <div class="short-div" style="text-align: left;">
                                                        <label for="callePersona_input" class="control-label">Calle</label>
                                                    </div>
                                                    <div class="short-div">
                                                        <input type="text" id="callePersona_input" class="form-control" list='calleListid'>
                                                        <datalist id='calleListid'>
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                                    <div class="short-div" style="text-align: left;">
                                                        <label class="control-label" for="nroPersona_input">Nro</label>
                                                    </div>
                                                    <div class="short-div">
                                                        <input type="text" id="nroPersona_input" class="form-control" list='nroListid'>
                                                        <datalist id='nroListid'>
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                                                    <div class="short-div" style="text-align: left;">
                                                        <label class="control-label" for="pisoPersona_input">Piso</label>
                                                    </div>
                                                    <div class="short-div">
                                                        <input type="text" id="pisoPersona_input" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                                                    <div class="short-div" style="text-align: left;">
                                                        <label class="control-label" for="dptoPersona_input">Dpto</label>
                                                    </div>
                                                    <div class="short-div">
                                                        <input type="text" id="dptoPersona_input" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin: 0 auto;width:80%;">
                                                <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="short-div" style="text-align: left;">
                                                        <label for="ciudadPersona_input" class="control-label">Ciudad</label>
                                                    </div>
                                                    <div class="short-div">
                                                        <input type="text" id="ciudadPersona_input" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="short-div" style="text-align: left;">
                                                        <label class="control-label" for="provinciaPersona_input">Provincia</label>
                                                    </div>
                                                    <div class="short-div">
                                                        <input type="text" id="provinciaPersona_input" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="container" style="margin: 0 auto;width:80%;">
                                            <button id="personaSaveBtn" type="button"  onclick="checkDatosPersona();" class="btn btn-primary" style="float:right;">Guardar</button>
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
</div>
</body>
</html>

<script type="text/javascript">
    if(typeof jQuery == 'undefined'){
        document.write('<script type="text/javascript" src="../vendors/jquery/dist/jquery.min.js"></'+'script>');
    }
</script>

<!------------End JavaScript Controllers ----------->

<!------- JS INCLUDE ----------->
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Data Table paginado-->
<script src="../vendors/datatables.net/js/jquery.dataTables.js"></script>
<!-- Data Table pages select dynamic style when hover and select-->
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- jQuery Smart Wizard -->
<script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="js/moment/moment.min.js"></script>
<!-- <script src="js/datepicker/daterangepicker.js"></script>  -->
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.js"></script>

<script src="js/cookie_utils.js"></script>
<script src="js/utils.js"></script>
<script src="js/Base64.js"></script>
<!-- Custom Global Scripts -->
<script src="js/change_pass.js"></script>
<script src="js/edit_profile.js"></script>
<script src="js/custom_global.js"></script>
<script src="js/bootbox.js" type="text/javascript" ></script>
<script src="js/variables.js"></script>
<script src="js/datepicker/daterangepicker.js"></script>

<!-- Alquileres Disponibles JS-->
<script src="js/personas_add.js"></script>

<!------- END JS INCLDE ----------->