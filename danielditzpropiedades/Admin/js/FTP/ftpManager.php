<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 01/02/2017
 * Time: 16:12
 */


$ftp_server = "LocalHost";
$ftp_user_name = "admin";
$ftp_user_pass = "admin";
$destination_file = "Alquileres/";
$source_files = $_POST['files'];

alert ($source_files);
// set up basic connection
$conn_id = ftp_connect($ftp_server);
ftp_pasv($conn_id, true);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// check connection
if ((!$conn_id) || (!$login_result)) {
    echo "FTP connection has failed!";
    echo "Attempted to connect to $ftp_server for user $ftp_user_name";
    exit;
} else {
    echo "Connected to $ftp_server, for user $ftp_user_name";
}

// upload the file
foreach ($source_files as &$file) {
    echo ($file);
    $ftp_put($conn_id, $destination_file, $file, FTP_BINARY);
}


// check upload status
/*if (!$upload) {
    echo "FTP upload has failed!";
} else {
    echo "Uploaded $source_file to $ftp_server as $destination_file";
}*/

// close the FTP stream
ftp_close($conn_id);
?>