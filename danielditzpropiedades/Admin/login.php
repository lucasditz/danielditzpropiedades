<?php
header('Content-Type: text/html; charset=utf-8');
?>


<!DOCTYPE html>
<html lang="en">
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ditz Propiedades </title>

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form>
                <div>
                    <img id="logo-img" src="images/logo.png" width="200px" />
                </div>
                <div style="margin-top: 20px">
                    <input id="userImput" type="text" class="form-control" placeholder="Nombre de usuario" required="" />
                </div>
                <div>
                    <input id="passImput" type="password" class="form-control" placeholder="Contraseña" required="" />
                </div>
                <div>
                    <a class="btn btn-success  submit" id="loginBtn" onclick="checkUser();">Log in</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                </div>
                <a style="cursor: pointer;color:#ffffff" class="reset_pass" id="lostPassBtn" onclick="lostPass();">Recuperar contraseña</a>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.js"></script>
<script src="js/Base64.js"></script>
<script src="js/bootbox.js" type="text/javascript" ></script>
<script src="js/cookie_utils.js"></script>
<script src="js/Base64.js"></script>
<script src="js/variables.js"></script>
<script src="js/utils.js"></script>
<!-- Login js include -->
<script src="js/login.js"></script>

<script>
    if (!expiredCookie(window.USER_TOKEN)){
        window.location.href="home.php";
    }
</script>