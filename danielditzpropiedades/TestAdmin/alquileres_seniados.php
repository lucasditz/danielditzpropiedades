<?php header('Content-Type: text/html; charset=utf-8');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

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
            <br />
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
                                <h2>Propiedades Señados</h2>
                                <ul class="nav navbar-right panel_toolbox" style="min-width:45px;"">
                                <!-- <button type="button" data-page="nuevo_alquiler.php" onclick="addPropiedad();" class="btn btn-primary" style="margin-left: 30px;">Nueva Propiedad</button>
                                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                 </li>
                                 <li><a class="close-link"><i class="fa fa-close"></i></a>
                                 </li>-->
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table id="table_content" class="table table-striped">
                                    <col width="10%">
                                    <col width="75%">
                                    <col width="5%">
                                    <col width="5%">
                                    <col width="5%">
                                    <thead>
                                    <tr>
                                        <th style="display: none"></th>
                                        <th style="display: none"></th>
                                        <th style="text-align: center;display: none;">Ver</th>
                                        <th style="text-align: center;display: none;">Editar</th>
                                        <th style="text-align: center;display: none;">Eliminar</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table_content_body">
                                    <tr>
                                        <td align="center">
                                            <img src="images/loading.gif"</img>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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
<!-- bootstrap-daterangepicker -->
<script src="js/moment/moment.min.js"></script>
<!-- <script src="js/datepicker/daterangepicker.js"></script>  -->
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.js"></script>

<script src="js/cookie_utils.js"></script>
<script src="js/utils.js"></script>
<script src="js/Base64.js"></script>
<script src="js/change_pass.js"></script>
<script src="js/edit_profile.js"></script>
<!-- Custom Global Scripts -->
<script src="js/custom_global.js"></script>
<script src="js/bootbox.js" type="text/javascript" ></script>
<script src="js/variables.js"></script>

<!-- Alquileres Disponibles JS-->
<script src="js/alquileres_seniados.js"></script>

<!------- END JS INCLDE ----------->

<!------------ JavaScript Controllers ----------->

<!-- Page Content refresh when SideMenu click -->
<script text="javascript">
    window.profileImage="images/default-profile.png";
    window.profileName="Matias";
    window.profileLastName="Ditz";
    if (window.profileImage != null && window.profileImage != undefined){
        $('#template_profile_image').attr("src",window.profileImage);
        $('#home_profile_image').attr("src",window.profileImage);
    }
    if (window.profileName != undefined && window.profileLastName != undefined){
        $('#template_profile_name').text(window.profileName+" "+window.profileLastName);
        $('#home_profile_name').text(window.profileName+" "+window.profileLastName+ " ");
    }

    var doc = $(document);
    doc.ready(function (){
        if (expiredCookie("USER_TOKEN")){
            window.location.href="login.php";
        }
    });
</script>
<!-- End Page Content refresh  -->

<!------------End JavaScript Controllers ----------->