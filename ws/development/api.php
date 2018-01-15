<?php
include_once 'Slim/Slim.php';
require 'Model/password.php';
include_once 'Model/Persona.php';
include_once 'Model/Usuario.php';
include_once 'Model/Telefono.php';
include_once 'Model/Direccion.php';
include_once 'Model/Inmueble.php';
include_once 'Model/Inmueble_Propietario.php';
include_once 'Model/Alquileres_Disponibles.php';
include_once 'Model/Alquileres_Contrato.php';

require 'Model/db.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->config('debug', true);

// $app->headers->set('Content-Type', 'application/json');
$app->request->headers->set('Content-Type', 'application/json; charset=utf8');

/************************************************************************************/
/*
 *
 * Author: Intermedia Interactive Labs
 * 
 *
 */
/************************************************************************************/ 

// status response:
/*
* 10001 -> success
* 10002 -> token expired
* 10003 -> data error
* 10004 -> user already exists
* 10008 -> new rol user added (profile already completed)
*/


function isValidToken($app) {
	$hasToken = $app->request->headers->get('X-Auth');
    if ($hasToken != null) 
    {        
        $token = $hasToken;
        return Usuario::getInstance()->isValidToken($token);
    }
    return false;
}

/****************** PERSONAS *********************/
$app->post('/personas', function () use ($app) {
    try {
        if (isValidToken($app)){
            $result = Persona::getInstance()->getAllPersona();
            if($result === false)
            {
                $data_json['data']['message'] = 'No existen personas registradas';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Personas registradas obtenidas con éxito.';
                $data_json['data']['status'] = '10001';
                $i = 0;
                for ($i = 0; $i < sizeof($result); $i++) {
                    $data_json['data']['personas'][$i]["id"] = $result[$i]['id'];
                    $data_json['data']['personas'][$i]["nombre"] = $result[$i]['nombre'];
                    $data_json['data']['personas'][$i]["apellido"] = $result[$i]['apellido'];
                    $data_json['data']['personas'][$i]["dni"] = $result[$i]['dni'];
                    $data_json['data']['personas'][$i]["fecha_nac"] = $result[$i]['fecha_nac'];
                    $data_json['data']['personas'][$i]["telefono"]["id"] = $result[$i]['telefonoId'];
                    $data_json['data']['personas'][$i]["telefono"]["nro"] = $result[$i]['telefono'];
                    $data_json['data']['personas'][$i]["celular"]["id"] = $result[$i]['celularId'];
                    $data_json['data']['personas'][$i]["celular"]["nro"] = $result[$i]['celular'];

                    $data_json['data']['personas'][$i]["direccion"]["id"] = $result[$i]['dpid'];
                    $data_json['data']['personas'][$i]["direccion"]["calle"] = $result[$i]['dpCalle'];
                    $data_json['data']['personas'][$i]["direccion"]["nro"] = $result[$i]['dpNro'];
                    $data_json['data']['personas'][$i]["direccion"]["piso"] = $result[$i]['dpPiso'];
                    $data_json['data']['personas'][$i]["direccion"]["dpto"] = $result[$i]['dpDpto'];
                    $data_json['data']['personas'][$i]["direccion"]["entre_calles"] = $result[$i]['dpEntreCalles'];
                    $data_json['data']['personas'][$i]["direccion"]["zona"] = $result[$i]['dpZona'];
                    $data_json['data']['personas'][$i]["direccion"]["ciudad"] = $result[$i]['dpCiudad'];
                    $data_json['data']['personas'][$i]["direccion"]["provincia"] = $result[$i]['dpProvincia'];
                    $data_json['data']['personas'][$i]["direccion"]["cod_postal"] = $result[$i]['dpCodPostal'];
                }
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

$app->post('/persona/getByID', function () use ($app) {
    try {
        if (isValidToken($app)){
            $result = Persona::getInstance()->getPersonaById($_POST['id']);
            if($result === false)
            {
                $data_json['data']['message'] = 'No existe la personas seleccionada';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Persona obtenidas con éxito.';
                $data_json['data']['status'] = '10001';

                $data_json['data']['persona']["id"] = $result['id'];
                $data_json['data']['persona']["nombre"] = $result['nombre'];
                $data_json['data']['persona']["apellido"] = $result['apellido'];
                $data_json['data']['persona']["dni"] = $result['dni'];
                $data_json['data']['persona']["fecha_nac"] = $result['fecha_nac'];
                $data_json['data']['persona']["telefono"]["id"] = $result['telefonoId'];
                $data_json['data']['persona']["telefono"]["nro"] = $result['telefono'];
                $data_json['data']['persona']["celular"]["id"] = $result['celularId'];
                $data_json['data']['persona']["celular"]["nro"] = $result['celular'];

                $data_json['data']['persona']["direccion"]["id"] = $result['dpid'];
                $data_json['data']['persona']["direccion"]["calle"] = $result['dpCalle'];
                $data_json['data']['persona']["direccion"]["nro"] = $result['dpNro'];
                $data_json['data']['persona']["direccion"]["piso"] = $result['dpPiso'];
                $data_json['data']['persona']["direccion"]["dpto"] = $result['dpDpto'];
                $data_json['data']['persona']["direccion"]["ciudad"] = $result['dpCiudad'];
                $data_json['data']['persona']["direccion"]["provincia"] = $result['dpProvincia'];

            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

$app->post('/persona/isRegister',  function () use ($app) {
    try {
        if (isValidToken($app)) {
            $result = Persona::getInstance()->isPersonRegister($_POST['dni']);
            if ($result === false) {
                $data_json['data']['message'] = 'La persona ingresada no existe.';
                $data_json['data']['status'] = '10003';
           } else {
                $data_json['data']['message'] = 'Ya existe una persona registrada con el mismo D.N.I.';
                $data_json['data']['status'] = '10001';
                $data_json['data']['persona'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

$app->post('/persona/add',  function () use ($app) {
    try {
        if (isValidToken($app)) {
            $result = Persona::getInstance()->addPerson($_POST['nombre'],$_POST['apellido'],$_POST['dni'],$_POST['fecha_nac'],$_POST['telefono'],
                $_POST['celular'],$_POST['calle'],$_POST['nro'],$_POST['piso'],$_POST['dpto'],$_POST['ciudad'],$_POST['provincia'],$_POST['id_usuario']);

            if ($result === false) {
                $data_json['data']['message'] = 'Error al registrar la nueva persona. Inténtelo nuevamente.';
                $data_json['data']['status'] = '10003';
            } else {
                $data_json['data']['message'] = 'Persona agregada exitosamente';
                $data_json['data']['status'] = '10001';
                $data_json['data']['persona'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

$app->post('/persona/edit',  function () use ($app) {
    try {
        if (isValidToken($app)) {
            $result = Persona::getInstance()->editPerson($_POST['id_persona'],$_POST['nombre'],$_POST['apellido'],$_POST['dni'],$_POST['fecha_nac'],$_POST['telefonoId'],$_POST['telefono'],$_POST['celularId'],$_POST['celular'],
                $_POST['id_direccion'],$_POST['calle'], $_POST['nro'],$_POST['piso'],$_POST['dpto'],$_POST['ciudad'],$_POST['provincia'],$_POST['id_usuario']);
            if ($result === false) {
                $data_json['data']['message'] = 'Error al editar la persona. Inténtelo nuevamente.';
                $data_json['data']['status'] = '10003';
            } else {
                $data_json['data']['message'] = 'Persona editada exitosamente';
                $data_json['data']['status'] = '10001';
                $data_json['data']['persona'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

$app->post('/persona/remove',  function () use ($app) {
    try {
        if (isValidToken($app)) {
            $result = Persona::getInstance()->removePerson($_POST['id_persona']);
            if ($result === false) {
                $data_json['data']['message'] = 'Error al eliminar la persona. Inténtelo nuevamente.';
                $data_json['data']['status'] = '10003';
            } else {
                $data_json['data']['message'] = 'Persona eliminada exitosamente';
                $data_json['data']['status'] = '10001';
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});
//************************************************/
	
/****************** USUARIOS *********************/
$app->post('/user/signin', function () use ($app) {
    //echo 'Current PHP version: ' . phpversion();
    $authentication = $app->request->headers->get('X-Auth');
    $auth = explode(":",base64_decode($authentication));

    $result = Usuario::getInstance()->checkUser($auth[0],$auth[1]);

    if($result === false)
    {
        $code = -1;//usuario o pass incorrectas
        $data_json['data']['message'] = 'Usuario y/o contraseña incorrectos.';
        $data_json['data']['status'] = '10003';
    }else {
        $data_json['data']['message'] = 'Usuario identificado exitosamente.';
        $data_json['data']['token'] = $result['token'];
        $data_json['data']['status'] = '10001';
    }

    echo json_encode($data_json);
});


$app->post('/user/profile', function () use ($app) {
    try {
        if (isValidToken($app)){
            $token = $app->request->headers->get('X-Auth');

            if (isset($_POST['user_id'])){
                $idUser = $_POST['user_id'];
            }else{
                $idUser = Usuario::getInstance()->getIdUser($token);
            }
           $result = Usuario::getInstance()->getProfile($idUser);

            if($result === false){
                $data_json['data']['message'] = 'Fallo en obtener el perfil.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'datos del perfil';
                $data_json['data']['profile'] = $result;
                $data_json['data']['status'] = '10001';
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

/**  Change userMobile/Admin pass (Token,oldPass,newPass) **/
$app->post('/user/changePassword', function () use ($app) {
    try{
        //if (isValidToken($app)){
            $authentication = $app->request->headers->get('X-Auth');
            $auth = explode(":",base64_decode($authentication));

            $result = Usuario::getInstance()->changePassword($auth[0],$auth[1],$auth[2]);
            if($result === false){
                $data_json['data']['message'] = 'Fallo en cambio de contraseña. Verifique las contraseñas ingresadas';
                $data_json['data']['status'] = '10004';
            }
            else{
                $data_json['data']['message'] = 'Contraseña cambiada exitosamente.';
                $data_json['data']['status'] = '10001';
            }
            echo json_encode($auth);
        /*}else{
             $data_json['data']['message']  = "Sesión no válida o expirada";
             $data_json['data']['status'] = '10002';
             echo json_encode($data_json);
         }*/
    } catch(PDOException $e) {
        //error.log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

$app->post('/user/profile/edit', function () use ($app) {
    try {
        if (isValidToken($app)){
            $token = $app->request->headers->get('X-Auth');

            $idUser = Usuario::getInstance()->getIdUser($token);

            $result = Usuario::getInstance()->editProfile($idUser, $_POST['nombre'], $_POST['apellido'], $_POST['email']);

            if($result === false)
            {
                $data_json['data']['message'] = 'fallo en editar el perfil.';
                $data_json['data']['status'] = '10007';
            }else{
                $data_json['data']['message'] = 'Perfil editado exitosamente';
                $data_json['data']['status'] = '10001';
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        //error.log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});
//************************************************/

/****************** TELEFONO *********************/
$app->post('/phone/getAll', function () use ($app) {
    try {
        if (isValidToken($app)){
            $result = Telefono::getInstance()->getAllPhones();
            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible hacer el cambio.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Cambio realizado exitosamente';
                $data_json['data']['status'] = '10001';
                $data_json['data']['id'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

$app->post('/phone/add', function () use ($app) {
    try {
        if (isValidToken($app)){
            $result = Telefono::getInstance()->addPhone($_POST['tipo'],$_POST['numero'],$_POST['id_user']);
            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible hacer el cambio.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Cambio realizado exitosamente';
                $data_json['data']['status'] = '10001';
                $data_json['data']['id'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});
/****************** DIRECCION *********************/
//Get all address
$app->post('/address/getAll', function () use ($app) {
    try {
        if (isValidToken($app)){
            $result = Direccion::getInstance()->getAllAddress();
            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible obtener las direcciones.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Direcciones';
                $data_json['data']['status'] = '10001';
                $data_json['data']['Direcciones'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }

});

//Get all diferent input of address to suggest input
$app->post('/address/Inputs/getAll', function () use ($app) {
    try {
        if (isValidToken($app)){
            $result = Direccion::getInstance()->getAllDiferentsInputs();
            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible obtener las direcciones.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Direcciones Inputs';
                $data_json['data']['status'] = '10001';
                $data_json['data']['inputs'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }

});

//get an address
$app->post('/address/get', function () use ($app) {
    try {
        if (isValidToken($app)){
            $result=Direccion::getInstance()->getAddressByID($_POST['id_direccion']);
            if($result === false)
            {
                $data_json['data']['message'] = 'La dirección ingresada no existe.';
                $data_json['data']['status'] = '10003';
            }else{

                $data_json['data']['message'] = 'Direccion';
                $data_json['data']['status'] = '10001';
                $data_json['data']['Direccion'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }

});

//get an address
$app->post('/address/exist', function () use ($app) {
    try {
        if (isValidToken($app)){
            $result = Direccion::getInstance()->existsAddress($_POST['calle'],$_POST['nro'],$_POST['piso'],$_POST['dpto'],$_POST['ciudad'],$_POST['provincia']);
            if($result === false)
            {
                $data_json['data']['message'] = 'La dirección ingresada no existe.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Direccion';
                $data_json['data']['status'] = '10001';
                $data_json['data']['Direcciones'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }

});

/****************** INMUEBLES ********************/
//GET ALL INMUEBLES
$app->post('/inmobiliaria/inmuebles',  function () use ($app) {
    try {
        $result = Inmueble::getInstance()->getAllInmuebles();
        $data_json['data'] = $result;

        echo json_encode($data_json);
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

//GET INMUEBLE BY ID
$app->post('/inmobiliaria/inmueble/getByID',  function () use ($app) {
    try {
        $result = Inmueble::getInstance()->getInmuebleById($_POST[id]);
        $data_json['data'] = $result;

        echo json_encode($data_json);
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

//INMUEBLE REGISTRADO?
$app->post('/inmobiliaria/inmueble/isRegister',  function () use ($app) {
    try {
        if (isValidToken($app)) {
            $result = Inmueble::getInstance()->isInmuebleRegister($_POST['calle'], $_POST['nro'], $_POST['piso'], $_POST['dpto'], $_POST['ciudad'], $_POST['provincia']);

            if ($result === false) {
                $data_json['data']['message'] = 'No existe inmueble registrado en la dirección ingresada.';
                $data_json['data']['status'] = '10003';
            } else {
                $data_json['data']['message'] = 'Ya existe un inmueble registrado en la dirección ingresada';
                $data_json['data']['status'] = '10001';
                $data_json['data']['idInmueble'] = $result[0];
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});
//************************************************/

/****************** ALQUILERES DISPONIBLES********************/
//GET ALL ALQUILERES DISPONIBLES
$app->post('/alquileres/alquileresDisponibles',  function () use ($app) {
    try {
        if (isValidToken($app)) {
            $result = Alquileres_Disponibles::getInstance()->getPropiedadesDisponibles();
            if($result === false)
            {
                $data_json['data']['message'] = 'No se encontraron alquileres disponibles.';
                $data_json['data']['status'] = '10003';
            }else {
                $data_json['data']['message'] = 'Alquileres Disponibles';
                $data_json['data']['status'] = '10001';
                // $data_json['data']['propiedades'] = $result;
                for ($i = 0; $i < sizeof($result); $i++) {
                    $data_json['data']['propiedades'][$i]["id"] = $result[$i]['id'];
                    $data_json['data']['propiedades'][$i]["valor"] = $result[$i]['valor'];
                    $data_json['data']['propiedades'][$i]["foto_perfil"] = $result[$i]['foto_perfil'];
                    /** PROPIETARIOS **/
                    $propietarios = Inmueble_Propietario::getInstance()->getAllPropietarios($result[$i]['id']);
                    for ($j = 0; $j < sizeof($propietarios); $j++){
                        $data_json['data']['propiedades'][$i]["propietarios"][$j]["apellido"] = $propietarios[$j]['apellido'];
                        $data_json['data']['propiedades'][$i]["propietarios"][$j]["nombre"] = $propietarios[$j]['nombre'];
                    }
                    /** Direccion **/
                    $data_json['data']['propiedades'][$i]["direccion"]["calle"] = $result[$i]['calle'];
                    $data_json['data']['propiedades'][$i]["direccion"]["nro"] = $result[$i]['nro'];
                    $data_json['data']['propiedades'][$i]["direccion"]["piso"] = $result[$i]['piso'];
                    $data_json['data']['propiedades'][$i]["direccion"]["dpto"] = $result[$i]['dpto'];
                    $data_json['data']['propiedades'][$i]["direccion"]["entre_calles"] = $result[$i]['entre_calles'];
                    $data_json['data']['propiedades'][$i]["direccion"]["ciudad"] = $result[$i]['ciudad'];
                    $data_json['data']['propiedades'][$i]["direccion"]["provincia"] = $result[$i]['provincia'];
                    $data_json['data']['propiedades'][$i]["direccion"]["cod_postal"] = $result[$i]['cod_postal'];
                }
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

//GET ALL ALQUILERES DISPONIBLES
$app->post('/alquileres/alquilerDisponibleByID',  function () use ($app) {
    try {
        if (isValidToken($app)) {
            $result = Alquileres_Disponibles::getInstance()->getPropiedadDisponibleByID($_POST['id']);
            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible obtener los alquileres disponibles.';
                $data_json['data']['status'] = '10003';
            }else {
                $data_json['data']['message'] = 'Alquiler Disponible';
                $data_json['data']['status'] = '10001';
                $i = 0;
                for ($i = 0; $i < sizeof($result); $i++) {
                    /** Inmueble **/
                    $data_json['data']['propiedades'][$i]["idInmueble"] = $result[$i]['idInmueble'];
                    $data_json['data']['propiedades'][$i]["comodidades"] = $result[$i]['comodidades'];
                    $data_json['data']['propiedades'][$i]["mts2"] = $result[$i]['mts2'];
                    /** Direccion **/
                    $data_json['data']['propiedades'][$i]["direccion"]["id"] = $result[$i]['diId'];
                    $data_json['data']['propiedades'][$i]["direccion"]["calle"] = $result[$i]['diCalle'];
                    $data_json['data']['propiedades'][$i]["direccion"]["nro"] = $result[$i]['diNro'];
                    $data_json['data']['propiedades'][$i]["direccion"]["piso"] = $result[$i]['diPiso'];
                    $data_json['data']['propiedades'][$i]["direccion"]["dpto"] = $result[$i]['diDpto'];
                    $data_json['data']['propiedades'][$i]["direccion"]["entre_calles"] = $result[$i]['diEntreCalles'];
                    $data_json['data']['propiedades'][$i]["direccion"]["zona"] = $result[$i]['diZona'];
                    $data_json['data']['propiedades'][$i]["direccion"]["ciudad"] = $result[$i]['diCiudad'];
                    $data_json['data']['propiedades'][$i]["direccion"]["provincia"] = $result[$i]['diProvincia'];
                    $data_json['data']['propiedades'][$i]["direccion"]["cod_postal"] = $result[$i]['diCodPostal'];

                    /** Propietario **/
                    $data_json['data']['propiedades'][$i]["propietario"]["id"] = $result[$i]['idPropietario'];

                    /** Inmueble Alquiler **/
                    $data_json['data']['propiedades'][$i]["idInmuebleAlquiler"] = $result[$i]['idInmuebleAlquiler'];
                    $data_json['data']['propiedades'][$i]["valor"] = $result[$i]['valor'];
                }
            }
            //echo json_encode($result);
           echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});


//ADD ALQUILER DISPONIBLE
$app->post('/alquileres/alquileresDisponibles/add',  function () use ($app) {
    try {
        if (isValidToken($app)) {
            $result = Alquileres_Disponibles::getInstance()->addAlquilerDisponible($_POST['calle'],$_POST['nro'],$_POST['piso'],$_POST['dpto'],$_POST['entre_calles'],$_POST['zona'],$_POST['ciudad'],
                                                         $_POST['provincia'],$_POST['cod_postal'],$_POST['comodidades'],$_POST['mts2'],$_POST['valor'],$_POST['propietario'],
                                                         $_POST['id_usuario']);
            if($result === false){
                $data_json['data']['message'] = 'No fue posible registrar la nueva propiedad.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Nueva propiedad para alquiler registrada con éxito.';
                $data_json['data']['status'] = '10001';
                $data_json['data']['propiedad'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

//EDIT ALQUILER DISPONIBLE
$app->post('/alquileres/alquileresDisponibles/edit',  function () use ($app) {
    try {
        if (isValidToken($app)) {

            $result = Alquileres_Disponibles::getInstance()->editAlquilerDisponible($_POST['id_inmuebleAlquiler'],$_POST['id_inmueble'],$_POST['id_direccion'],$_POST['calle'],$_POST['nro'],
                $_POST['piso'],$_POST['dpto'],$_POST['entre_calles'],$_POST['zona'],$_POST['ciudad'],$_POST['provincia'],$_POST['cod_postal'],$_POST['comodidades'],$_POST['mts2'],
                                                          $_POST['valor'],$_POST['propietario'],$_POST['id_usuario']);

            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible editar la propiedad.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Propiedad para alquiler editada con éxito.';
                $data_json['data']['status'] = '10001';
                $data_json['data']['propiedad'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

//REMOVE ALQUILER DISPONIBLE
$app->post('/alquileres/alquileresDisponibles/remove',  function () use ($app) {
    try {
        if (isValidToken($app)) {

            $result = Alquileres_Disponibles::getInstance()->removeAlquilerDisponible($_POST['id_inmuebleAlquiler']);

            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible eliminar la propiedad.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Propiedad para alquiler eliminada con éxito.';
                $data_json['data']['status'] = '10001';
                $data_json['data']['propiedad'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

//SET ALQUILER DISPONIBLE TO CONTRATO
$app->post('/alquileres/alquileresDisponibles/contrato',  function () use ($app) {
    try {
        if (isValidToken($app)) {
            $result = Alquileres_Disponibles::getInstance()->generateAlquilerContract($_POST['id_inmuebleAlquiler'],$_POST['deposito'],$_POST['honorarios'],$_POST['alquilerPeriodos'],
                $_POST['alquilerServicios'],$_POST['id_inquilino'],$_POST['id_garante'],$_POST['id_usuario']);
            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible generar el contrato. Verifique los datos ingresados.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Contrato generado con éxito';
                $data_json['data']['status'] = '10001';
                $data_json['data']['propiedades'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

//SET ALQUILER DISPONIBLE TO SENIADO
$app->post('/alquileres/alquileresDisponibles/seniado',  function () use ($app) {
    try {
        if (isValidToken($app)) {

            /*$Alq_dispon = new Alquileres_Disponibles(db::getInstance());
            $result = $Alq_dispon->getPropiedadesDisponibles();
            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible obtener los alquileres disponibles.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Alquileres Disponibles';
                $data_json['data']['status'] = '10001';
                $data_json['data']['propiedades'] = $result;
            }
            echo json_encode($data_json);*/
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});
//************************************************/

/****************** ALQUILERES CONTRATO********************/
//GET ALL ALQUILERES CONTRATO
$app->post('/alquileres/alquileresContrato',  function () use ($app) {
    try {
        if (isValidToken($app)) {
            $result = Alquileres_Contrato::getInstance()->getPropiedadesContrato();
            if($result === false)
            {
                $data_json['data']['message'] = 'No se encontraron alquileres en contrato.';
                $data_json['data']['status'] = '10003';
            }else {
                $data_json['data']['message'] = 'Alquileres Contrato';
                $data_json['data']['status'] = '10001';
                //$data_json['data']['propiedades'] = $result;
                for ($i = 0; $i < sizeof($result); $i++) {
                    $data_json['data']['propiedades'][$i]["idInmAlquilerContrato"] = $result[$i]['id_inmAlquiler_contrato'];
                    $data_json['data']['propiedades'][$i]["idInmAlquiler"] = $result[$i]['id_inmAlquiler'];
                    $data_json['data']['propiedades'][$i]["valor"] = $result[$i]['valor'];
                    //$data_json['data']['propiedades'][$i]["foto_perfil"] = $result[$i]['foto_perfil'];
                    /** Propietario **/
                    $data_json['data']['propiedades'][$i]["propietario"]["apellido"] = $result[$i]['apellidoPropietario'];
                    $data_json['data']['propiedades'][$i]["propietario"]["nombre"] = $result[$i]['nombrePropietario'];
                    /** Inquilino **/
                    $data_json['data']['propiedades'][$i]["inquilino"]["apellido"] = $result[$i]['apellidoInquilino'];
                    $data_json['data']['propiedades'][$i]["inquilino"]["nombre"] = $result[$i]['nombreInquilino'];
                    /** Direccion **/
                    $data_json['data']['propiedades'][$i]["direccion"]["calle"] = $result[$i]['calle'];
                    $data_json['data']['propiedades'][$i]["direccion"]["nro"] = $result[$i]['nro'];
                    $data_json['data']['propiedades'][$i]["direccion"]["piso"] = $result[$i]['piso'];
                    $data_json['data']['propiedades'][$i]["direccion"]["dpto"] = $result[$i]['dpto'];
                    $data_json['data']['propiedades'][$i]["direccion"]["entre_calles"] = $result[$i]['entre_calles'];
                    $data_json['data']['propiedades'][$i]["direccion"]["ciudad"] = $result[$i]['ciudad'];
                    $data_json['data']['propiedades'][$i]["direccion"]["provincia"] = $result[$i]['provincia'];
                    $data_json['data']['propiedades'][$i]["direccion"]["cod_postal"] = $result[$i]['cod_postal'];
                }
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

//GET ALQUILERES CONTRATO BY ID
$app->post('/alquileres/alquilerContratoByID',  function () use ($app) {
    try {
        if (isValidToken($app)) {
            $result = Alquileres_Contrato::getInstance()->getPropiedadContratoByID($_POST['id']);
            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible obtener los alquileres disponibles.';
                $data_json['data']['status'] = '10003';
            }else {
                $data_json['data']['message'] = 'Alquiler Disponible';
                $data_json['data']['status'] = '10001';
                $i = 0;
                for ($i = 0; $i < sizeof($result); $i++) {
                    /** Inmueble **/
                    $data_json['data']['propiedades'][$i]["idInmueble"] = $result[$i]['idInmueble'];
                    $data_json['data']['propiedades'][$i]["comodidades"] = $result[$i]['comodidades'];
                    $data_json['data']['propiedades'][$i]["mts2"] = $result[$i]['mts2'];
                    /** Direccion **/
                    $data_json['data']['propiedades'][$i]["direccion"]["id"] = $result[$i]['diId'];
                    $data_json['data']['propiedades'][$i]["direccion"]["calle"] = $result[$i]['diCalle'];
                    $data_json['data']['propiedades'][$i]["direccion"]["nro"] = $result[$i]['diNro'];
                    $data_json['data']['propiedades'][$i]["direccion"]["piso"] = $result[$i]['diPiso'];
                    $data_json['data']['propiedades'][$i]["direccion"]["dpto"] = $result[$i]['diDpto'];
                    $data_json['data']['propiedades'][$i]["direccion"]["entre_calles"] = $result[$i]['diEntreCalles'];
                    $data_json['data']['propiedades'][$i]["direccion"]["zona"] = $result[$i]['diZona'];
                    $data_json['data']['propiedades'][$i]["direccion"]["ciudad"] = $result[$i]['diCiudad'];
                    $data_json['data']['propiedades'][$i]["direccion"]["provincia"] = $result[$i]['diProvincia'];
                    $data_json['data']['propiedades'][$i]["direccion"]["cod_postal"] = $result[$i]['diCodPostal'];

                    /** Propietario **/
                    $data_json['data']['propiedades'][$i]["propietario"]["id"] = $result[$i]['idPropietario'];

                    /** Inmueble Alquiler **/
                    $data_json['data']['propiedades'][$i]["idInmuebleAlquiler"] = $result[$i]['idInmuebleAlquiler'];
                    $data_json['data']['propiedades'][$i]["valor"] = $result[$i]['valor'];

                    /** INMUEBLE ALQUILER CONTRARO **/
                    $data_json['data']['propiedades'][$i]["idInmAlquilerContrato"] = $result[$i]['idInmAlquilerContrato'];
                    $data_json['data']['propiedades'][$i]["deposito"] = $result[$i]['deposito'];
                    $data_json['data']['propiedades'][$i]["honorarios"] = $result[$i]['honorarios'];

                    /** Inquilino **/
                    $data_json['data']['propiedades'][$i]["inquilino"]["id"] = $result[$i]['idInquilino'];

                    /** Garante **/
                    $data_json['data']['propiedades'][$i]["garante"]["id"] = $result[$i]['idGarante'];

                    /** Periodos **/
                    $periodos = Alquileres_Contrato::getInstance()->getPeriodosContrato($result[$i]['idInmAlquilerContrato']);
                    for ($j = 0; $j < sizeof($periodos); $j++) {
                        $data_json['data']['propiedades'][$i]["periodos"][$j]["id"] = $periodos[$j]['id'];
                        $data_json['data']['propiedades'][$i]["periodos"][$j]["fechaInicio"] = $periodos[$j]['fechaInicio'];
                        $data_json['data']['propiedades'][$i]["periodos"][$j]["fechaFin"] = $periodos[$j]['fechaFin'];
                        $data_json['data']['propiedades'][$i]["periodos"][$j]["valor"] = $periodos[$j]['valor'];
                    }

                    /** Servicios **/
                    $servicios = Alquileres_Contrato::getInstance()->getServiciosContrato($result[$i]['idInmAlquilerContrato']);
                    for ($j = 0; $j < sizeof($servicios); $j++) {
                        $data_json['data']['propiedades'][$i]["servicios"][$j]["idServiciosContrato"] = $servicios[$j]['id_servicios_contrato'];
                        $data_json['data']['propiedades'][$i]["servicios"][$j]["idServicio"] = $servicios[$j]['id_servicio'];
                        $data_json['data']['propiedades'][$i]["servicios"][$j]["nombreServicio"] = $servicios[$j]['nombre_servicio'];
                    }

                }
            }
            //echo json_encode($result);
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

//ADD ALQUILER CONTRATO
$app->post('/alquileres/alquileresContrato/add',  function () use ($app) {
    try {
        if (isValidToken($app)) {

            $result = Alquileres_Contrato::getInstance()->addAlquilerContrato($_POST['calle'],$_POST['nro'],$_POST['piso'],$_POST['dpto'],$_POST['entre_calles'],$_POST['zona'],$_POST['ciudad'],
                $_POST['provincia'],$_POST['cod_postal'],$_POST['comodidades'],$_POST['mts2'],$_POST['valor'],$_POST['propietario'],$_POST['deposito'],$_POST['honorarios'],$_POST['alquilerPeriodos'],$_POST['alquilerServicios'],
                $_POST['id_inquilino'],$_POST['id_garante'],$_POST['id_usuario']);

            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible registrar la nueva propiedad.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Nueva propiedad para alquiler registrada con éxito.';
                $data_json['data']['status'] = '10001';
                $data_json['data']['propiedad'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

//EDIT ALQUILER CONTRATO
$app->post('/alquileres/alquileresContrato/edit',  function () use ($app) {
    try {
        if (isValidToken($app)) {

            $result = Alquileres_Contrato::getInstance()->editAlquilerContrato($_POST['id_inm_alquiler_contrato'],$_POST['id_inmuebleAlquiler'],$_POST['id_inmueble'],$_POST['id_direccion'],$_POST['calle'],$_POST['nro'],
                $_POST['piso'],$_POST['dpto'],$_POST['entre_calles'],$_POST['zona'],$_POST['ciudad'],$_POST['provincia'],$_POST['cod_postal'],$_POST['comodidades'],$_POST['mts2'],
                $_POST['valor'],$_POST['propietario'],$_POST['deposito'],$_POST['honorarios'],$_POST['alquilerPeriodos'],$_POST['alquilerServicios'],
                $_POST['id_inquilino'],$_POST['id_garante'],$_POST['id_usuario']);

            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible editar la propiedad.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Propiedad en contrato editada con éxito.';
                $data_json['data']['status'] = '10001';
                $data_json['data']['propiedad'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

$app->post('/alquileres/alquileresContrato/remove',  function () use ($app) {
    try {
        if (isValidToken($app)) {

            $result = Alquileres_Contrato::getInstance()->removeAlquilerContrato($_POST['id_inmuebleAlquilerContrato']);

            if($result === false)
            {
                $data_json['data']['message'] = 'No fue posible eliminar la propiedad.';
                $data_json['data']['status'] = '10003';
            }else{
                $data_json['data']['message'] = 'Propiedad en contrato eliminada con éxito.';
                $data_json['data']['status'] = '10001';
                $data_json['data']['propiedad'] = $result;
            }
            echo json_encode($data_json);
        }else{
            $data_json['data']['message']  = "Sesión no válida o expirada";
            $data_json['data']['status'] = '10002';
            echo json_encode($data_json);
        }
    } catch(PDOException $e) {
        $data_json['error'] = $e->getMessage();
        echo json_encode($data_json);
    }
});

$app->run();
