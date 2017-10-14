<?php header('Content-Type: text/html; charset=UTF-8');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="http://inmoba.com.ar/danielditzpropiedades/favicon.ico" type="image/x-icon" />

    <title>Gestión Inmobiliaria </title>

    <!------- CSS INCLUDE----------->
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
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
                <div id="page_content" class="right_col" role="main">
                    <!--<br />-->
                    <div class="row">
                        <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
                            <div class="col-lg-4 col-md-5 col-sm-4"></div>
                            <img id="loadingImage" class="col-lg-4 col-md-7 col-sm-4" src="images/loading.gif" style="text-align: center; display: none"/>
                            <div class="row">
                            </div>
                            <div class="row">
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
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<script src="js/variables.js"></script>
<script src="js/cookie_utils.js"></script>
<script src="js/Base64.js"></script>
<script src="js/utils.js"></script>


<!-- bootstrap-daterangepicker -->
<script src="js/moment/moment.min.js"></script>
<!-- <script src="js/datepicker/daterangepicker.js"></script>  -->

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.js"></script>

<!-- Custom Global Scripts -->
<script src="js/change_pass.js"></script>
<script src="js/edit_profile.js"></script>
<script src="js/custom_global.js"></script>
<script src="js/bootbox.js" type="text/javascript" ></script>

<!------- END JS INCLDE ----------->

<!------------ JavaScript Controllers ----------->

<!-- Page Content refresh when SideMenu click -->
<script text="javascript">

    setUserProfile();

    function loadingPage(){
        $.ajax({
            url: "loading_page.php",
            type: 'POST',
            success: function (data){
                $('#page_content').empty();
                $('#page_content').append(data);
            }
        });
    }

    function loadPageContent(htmlElement,params){

        if (!expiredCookie(window.USER_TOKEN)){
            var url = htmlElement.attr('data-page');

            $.ajax({
                url: url,
                type: 'POST',
                data: params,
                success: function (data){
                    $('#page_content').empty();
                    $('#page_content').append(data);
                    /*if (url != "home.php"){
                     $('#page_content').css("background", "url(images/home_sin_logo.png) no-repeat");
                     }
                     else{
                     $('#page_content').css("background", "url(images/home.jpg) no-repeat");
                     }*/
                }
            });
        }
        else {
            window.location.replace("index.php");
        }
    }

</script>
<!-- End Page Content refresh  -->

<!------------End JavaScript Controllers ----------->