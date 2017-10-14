<?php
$cookie_name = "USER_TOKEN";
if(!isset($_COOKIE[$cookie_name])) {
    //echo "Cookie named '" . $cookie_name . "' does not exist!";
    header('Location: '.'login.php');
} else {
    header('Location: '.'home.php');
}
?>
