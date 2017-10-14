<?php
ini_set('max_upload_filesize', 9999999999999999999);
$MAX_SIZE = 0;//1MB

$ftp_server = 'ftp.rapitiendas.com';
$ftp_port =21;
$ftp_timeOut = 90;
$ftp_user_name = 'rapitiendas@rapitiendas.com';
$ftp_user_pass = 'fNRp-yry@ul&';

$idusuario = $idUser;

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

// set up basic connection
$conn_id = ftp_connect($ftp_server);
//ftp_pasv($conn_id, true); 

// login with username and password
if($conn_id){
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
}
$result['login_result'] = $login_result;
//$result['file'] =  $_POST['file'];
$file = $_POST['file'];

$typeImage =  'jpeg';
if (isset($_POST['type']))
	$typeImage = $_POST['type'];

$urlFile;

$urlBase= "http://rapitiendas.com/public/upload_image/";
$paths = "/public_html/public/upload_image/";

set_time_limit(0);
if(!empty($file) && ($login_result === true)){
	/*if ($Error != UPLOAD_ERR_OK) {
		$hasError = 1;
		$result['error'] = $Error;
		$result['status'] = '10007';
		$result['message'] = 'Error en el archivo.';
	}else{*/
		
		//control de tamaño de archivo
		/*if ($MAX_SIZE > 0){
			if ($ImageSize > $MAX_SIZE){
				$hasError = 1;
			}
		}*/

		//if ($hasError == 0){//si no hay errores
			//$info = new SplFileInfo($ImageName);
			//$remoteFileName = $paths.$info->getBasename('.'.$info->getExtension()).'-img-111.'.$info->getExtension();
			$prefix = "profile";
			if (isset($_POST['prefijo'])){
				$prefix = $_POST['prefijo'];
			}
			
			//$imageNombre = $prefix.'-'.$idusuario.'.'.$info->getExtension();
			$imageNombre = $prefix.'-'.generateRandomName().'-'.$idusuario.'.'.$typeImage;
			$remoteFileName = $paths.$imageNombre;
			$urlFile = $urlBase.$imageNombre;
			$result['remoteFileName']= $remoteFileName;
			$result['typeImage']= $typeImage;

			$handle = fopen('data://image/jpeg;base64,'.$file, 'r');
			$upload = ftp_fput($conn_id, $remoteFileName , $handle, FTP_BINARY);
			
			
			// check upload status
			if ($upload===false) {  // check upload status
				$hasError = 1;
				$result['status'] = '10007';
				$result['message'] = 'Falla en subir archivo.';
			}
			else{
				if ($upload){
					$imageArray = array();
					$imageArray['name'] = $ImageName;
					$imageArray['size'] = $ImageSize;
					//$result['files_subidos'][]= $imageArray;
					$result['status'] = '10001';
					$result['url'] = $urlFile;
					$result['message'] = 'Archivo subido exitosamente.';
				}
			}
		/*}else{
			$result['status'] = '10007';
			$result['message'] = 'El archivo tiene un tamaño mayor al aceptado.';
			$result['size'] = $ImageSize ;
			
		}*/
	//}
}else{
	$result['status'] = '10007';
	$result['message'] = 'Fallo en la conexión.';
}

$resultArray['data'] = $result;
//echo json_encode($resultArray);
// close the FTP stream 
ftp_close($conn_id);

?>