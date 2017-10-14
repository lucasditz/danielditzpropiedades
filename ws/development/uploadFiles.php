<?php
include_once 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->config('debug', true);

// $app->headers->set('Content-Type', 'application/json');
$app->request->headers->set('Content-Type', 'application/json; charset=utf8');


function isValidToken($app) {
    $hasToken = $app->request->headers->get('X-Auth');
    if ($hasToken != null)
    {
        $token = $hasToken;
        $user = new Usuario(db::getInstance());
        return $user->isValidToken($token);
    }
    return false;
}

/****************** PERSONAS *********************/
$app->post('/uploadFiles', function () use ($app) {
    try {
       // if (isValidToken($app)) {
            if (isset($idUser)){
                $idusuario = $idUser;
            }else{
                $idusuario = 'unidentified';
            }

            $typeImage =  'png';
            if (isset($_POST['type']))
                $typeImage = $_POST['type'];

            $file =  $_POST['file'];

            $prefix = "profile";
            if (isset($_POST['prefijo'])){
                $prefix = $_POST['prefijo'];
            }

            $resultArray= loadFiles($idusuario,$file,$typeImage,$prefix);
            echo json_encode($resultArray);
        //}
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});


function generateRandomName() {
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}

function loadFiles($idusuario,$file,$typeImage,$prefix){
    ini_set('max_upload_filesize', 9999999999999999999);
    $MAX_SIZE = 0;//1MB

    $ftp_server = 'sftp.dokkogroup.com.ar';
    $ftp_port =48234;
    $ftp_timeOut = 90;
    $ftp_user_name = 'sftp-inmoba';
    $ftp_user_pass = '1nmob4.pass';
    $urlBase= "http://inmoba.com.ar/ws/images/";
    $paths = "/public_html/ws/images/";

    // set up basic connection
    $conn_id = ftp_connect($ftp_server,$ftp_port);
    // login with username and password
    if($conn_id){
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
    }
    $resultFiles['login_result'] = $login_result;
    $resultFiles['file'] = $file;

    set_time_limit(0);
    if(!empty($file) && ($login_result === true)){

        $imageNombre = $prefix.'-'.$idusuario.'.'.generateRandomName().'.'.$typeImage;
        $remoteFileName = $paths.$imageNombre;
        $urlFile = $urlBase.$imageNombre;
        $resultFiles['remoteFileName']= $remoteFileName;
        $resultFiles['typeImage']= $typeImage;

        $handle = fopen('data://image/jpeg;base64,'.$file, 'r');

        $upload = ftp_fput($conn_id, $remoteFileName , $handle, FTP_BINARY);

        // check upload status
        if ($upload===false) {  // check upload status
            $hasError = 1;
            $resultFiles['status'] = '10007';
            $resultFiles['message'] = 'Falla en subir archivo.';
        }
        else{
            if ($upload){
                $imageArray = array();
                $resultFiles['status'] = '10001';
                $resultFiles['url'] = $urlFile;
                $resultFiles['message'] = 'Archivo subido exitosamente.';
            }
        }
    }else{
        $resultFiles['status'] = '10007';
        $resultFiles['message'] = 'Fallo en la conexión 2.';
    }

    $resultArray['data'] = $resultFiles;

    //
    // close the FTP stream
    ftp_close($conn_id);

    return $resultArray;
}
?>