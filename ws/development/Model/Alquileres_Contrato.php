<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 21/11/2016
 * Time: 20:03
 */

class Alquileres_Contrato
{
    private $db;
    private static $instance = NULL;

    public function __construct($db)
    {
        $this->db = $db;
        self::$instance = $this;
    }

    public static function getInstance(){
        if (self::$instance === NULL) {
            self::$instance = new self(db::getInstance());
        }
        return self::$instance;
    }

    /** PUBLIC FUNTIONS **/
    public function getPropiedadesContrato(){
        return $this->getAllPropiedades();
    }

    public function getPropiedadContratoByID($id){
        return $this->getInmuebleAlquilerContratoByID($id);
    }

    public function getPeriodosContrato($id){
        return $this->getPeriododsAlquilerContrato($id);
    }

    public function getServiciosContrato($id){
        return $this->getServiciosAlquilerContrato($id);
    }

    public function addAlquilerContrato($calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                          $valor,$propietario,$deposito,$honorarios,$alquilerPeriodos,$alquilerServicios,$id_inquilino,$id_garante,$id_usuario){

        return $this->addInmuebleContratoPeriodos($deposito,$honorarios,$alquilerPeriodos,$alquilerServicios,$id_inquilino,$id_garante,$propietario,$valor,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $id_usuario);
    }

    public function editAlquilerContrato($id_inm_alquiler_contrato,$id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                         $valor,$propietario,$deposito,$honorarios,$alquilerPeriodos,$alquilerServicios,$id_inquilino,$id_garante,$id_usuario){

        return $this->editInmuebleContratoPeriodos($id_inm_alquiler_contrato,$id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                                   $valor,$propietario,$deposito,$honorarios,$alquilerPeriodos,$alquilerServicios,$id_inquilino,$id_garante,$id_usuario);
    }

    public function removeAlquilerContrato($idInmuebleAlquilerContrato){
        return $this->removeInmuebleAlquilerContrato($idInmuebleAlquilerContrato);
    }

    /** PRIVATE FUNTIONS **/

    /** get funtions **/
    //GET ALL ALQUILER CONTRATO DATA BY ID
    private function getInmuebleAlquilerContratoByID($id){
        try {
            $query = $this->db->prepare("SELECT iac.id as idInmAlquilerContrato,
                                                iac.deposito as deposito,
                                                iac.honorarios as honorarios,
                                                iac.id_inquilino as idInquilino,
                                                iac.id_garante as idGarante,
                                                ia.id as idInmuebleAlquiler,
                                                ia.valor as valor,
                                                ia.id_propietario as idPropietario,
                                                i.id as idInmueble,
                                                i.comodidades,
                                                i.mts2,
                                                di.id as diId,
                                                di.calle as diCalle,
                                                di.nro as diNro,
                                                di.piso as diPiso,
                                                di.dpto as diDpto,
                                                di.entre_calles as diEntreCalles,
                                                di.zona as diZona,
                                                di.ciudad as diCiudad,
                                                di.provincia as diProvincia,
                                                di.cod_postal as diCodPostal

                                          FROM inm_alquiler_contrato iac
                                          LEFT JOIN inm_alquiler ia
                                          on iac.id_inm_alquiler = ia.id
                                          LEFT JOIN inmueble i
                                          ON ia.id_inmueble = i.id
                                          LEFT JOIN direccion di
                                          ON i.id_direccion = di.id
                                          WHERE ia.disponibilidad=0 &&
                                                iac.id=:id && iac.removed=0

            ");

            $query->bindParam(':id', $id);

            $query->execute();
            if ($query->rowCount() <= 0) return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            return $e;
        }
    }

    private function getAllPropiedades(){
        try {
            $query = $this->db->prepare("SELECT
                                            iac.id as id_inmAlquiler_contrato,
                                            ia.id as id_inmAlquiler,
                                            ia.valor as valor,
                                            pp.nombre as nombrePropietario,
                                            pp.apellido as apellidoPropietario,
                                            pi.nombre as nombreInquilino,
                                            pi.apellido as apellidoInquilino,
                                            d.calle,
                                            d.nro,
                                            d.piso,
                                            d.dpto,
                                            d.entre_calles,
                                            d.zona,
                                            d.ciudad,
                                            d.provincia,
                                            d.cod_postal
                                      FROM inm_alquiler_contrato iac
                                      LEFT JOIN persona pi
                                      ON iac.id_inquilino = pi.id
                                      LEFT JOIN inm_alquiler ia
                                      ON iac.id_inm_alquiler = ia.id
                                      LEFT JOIN persona pp
                                      ON ia.id_propietario = pp.id
                                      LEFT JOIN inmueble i
                                      ON ia.id_inmueble = i.id
                                      LEFT JOIN direccion d
                                      ON i.id_direccion = d.id
                                      WHERE ia.disponibilidad=0 &&
                                            iac.removed=0
		    ");
            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    //GET ALL ALQUILER CONTRATO DATA BY ID
    private function getPeriododsAlquilerContrato($id){
        try {
            $query = $this->db->prepare("SELECT pc.id,
                                                DATE_FORMAT(pc.fecha_inicio,'%d/%m/%Y') AS fechaInicio,
                                                DATE_FORMAT(pc.fecha_fin,'%d/%m/%Y') AS fechaFin,
                                                pc.valor
                                          FROM periodos_contrato pc
                                          WHERE pc.id_inm_alquiler_contrato=:id

            ");

            $query->bindParam(':id', $id);

            $query->execute();
            if ($query->rowCount() <= 0) return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function getServiciosAlquilerContrato($id_inm_alquiler_contrato){
        try {
            $query = $this->db->prepare("SELECT sc.id as id_servicios_contrato,
                                                sc.id_servicio as id_servicio,
                                                s.nombre as nombre_servicio
                                          FROM servicios_contrato sc
                                          LEFT JOIN servicios s
                                          ON sc.id_servicio = s.id
                                          WHERE sc.id_inm_alquiler_contrato=:id

            ");

            $query->bindParam(':id', $id_inm_alquiler_contrato);

            $query->execute();
            if ($query->rowCount() <= 0) return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    /** add functions **/
    // ADD INMUEBLE CONTRATO PRIVATE FUNCTIONS
    private function addInmuebleContratoPeriodos($deposito,$honorarios,$alquilerPeriodos,$alquilerServicios,$id_inquilino,$id_garante,$propietario,$valor,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $id_usuario){
        try{

            $id_inm_alquiler_contrato= $this->addInmuebleAlquilerContrato($deposito,$honorarios,$id_inquilino,$id_garante, $propietario,$valor,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $id_usuario);

            if ($id_inm_alquiler_contrato != false) {
                $this->addInmuebleAlquilerServicios($id_inm_alquiler_contrato, $alquilerServicios, $id_usuario);
                for ($x = 0; $x < count($alquilerPeriodos); $x++) {
                    $fechaInicio = $alquilerPeriodos[$x]['startDate'];
                    $fechaFin = $alquilerPeriodos[$x]['endDate'];
                    $valor = $alquilerPeriodos[$x]['value'];

                    $query = $this->db->prepare("INSERT INTO periodos_contrato(id_inm_alquiler_contrato,fecha_inicio,fecha_fin,valor,created,modified,id_user_creation,id_user_modified)
                                                VALUES (:id_inm_alquiler_contrato,STR_TO_DATE(:fechaInicio,'%d/%m/%Y'),STR_TO_DATE(:fechaFin,'%d/%m/%Y'),:valor,NOW(),NOW(),:id_usuario,:id_usuario)");


                    $query->bindParam(':id_inm_alquiler_contrato', $id_inm_alquiler_contrato);
                    $query->bindParam(':fechaInicio', $fechaInicio);
                    $query->bindParam(':fechaFin', $fechaFin);
                    $query->bindParam(':valor', $valor);
                    $query->bindParam(':id_usuario', $id_usuario);

                    $query->execute();

                    if ($query->rowCount() <= 0) return false;
                }
            }

            return $id_inm_alquiler_contrato;
        }catch(PDOException $e){
            return $e;
        }
    }

    private function addInmuebleAlquilerServicios($id_inm_alquiler_contrato,$alquilerServicios,$id_usuario){
        try{

            for ($x = 0; $x < count($alquilerServicios); $x++) {
                $idServicio=$alquilerServicios[$x];

                $query = $this->db->prepare("INSERT INTO servicios_contrato(id_inm_alquiler_contrato,id_servicio,created,modified,id_user_creation,id_user_modified)
                                            VALUES (:id_inm_alquiler_contrato,:idServicio,NOW(),NOW(),:id_usuario,:id_usuario)");


                $query->bindParam(':id_inm_alquiler_contrato', $id_inm_alquiler_contrato);
                $query->bindParam(':idServicio', $idServicio);
                $query->bindParam(':id_usuario', $id_usuario);

                $query->execute();
            }

            return true;
        }catch(PDOException $e){
            return $e;
        }
    }

    private function addInmuebleAlquilerContrato($deposito,$honorarios,$id_inquilino,$id_garante, $propietario,$valor,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $id_usuario){
        try{

            $id_inm_alquiler= $this->addInmuebleAlquiler($propietario,$valor,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $id_usuario);

            if ($id_garante == ""){
                $id_garante=NULL;
            }

            $query = $this->db->prepare("INSERT INTO inm_alquiler_contrato(id_inm_alquiler,deposito,honorarios,id_inquilino,id_garante,removed,created,modified,id_user_creation,id_user_modified)
                                            VALUES (:id_inmuebleAlquiler,:deposito,:honorarios,:id_inquilino,:id_garante,0,NOW(),NOW(),:id_usuario,:id_usuario)");


            $query->bindParam(':id_inmuebleAlquiler', $id_inm_alquiler);
            $query->bindParam(':deposito', $deposito);
            $query->bindParam(':honorarios', $honorarios);
            $query->bindParam(':id_inquilino', $id_inquilino);
            $query->bindParam(':id_garante', $id_garante);
            $query->bindParam(':id_usuario', $id_usuario);

            $query->execute();

            if($query->rowCount() <= 0)  return false;
            return $this->db->lastInsertId();
        }catch(PDOException $e){
            return $e;
        }
    }

    private function addInmuebleAlquiler($propietario,$valor,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $id_usuario){
        try{

            $id_direccion= Direccion::getInstance()->addAddress($calle,$nro,$piso,$dpto,$entre_calles,$zona,$ciudad,$provincia,$cod_postal,$id_usuario);

            $id_inmueble= Inmueble::getInstance()->addInmueble("",$mts2,$comodidades,"OK",$id_direccion,$id_usuario);

            $query = $this->db->prepare("INSERT INTO inm_alquiler(id_inmueble,id_propietario,valor,disponibilidad,removed,created,modified,id_user_creation,id_user_modified)
                                        VALUES (:id_inmueble,:id_propietario,:valor,0,0,NOW(),NOW(),:id_usuario,:id_usuario)");

            $query->bindParam(':id_inmueble', $id_inmueble);
            $query->bindParam(':id_propietario', $propietario);
            $query->bindParam(':valor', $valor);
            $query->bindParam(':id_usuario', $id_usuario);

            $query->execute();

            if($query->rowCount() <= 0)  return false;
            return $this->db->lastInsertId();
        }catch(PDOException $e){
            return $e;
        }
    }

    /** edit funtions **/
    //EDIT INMUEBLE CONTRATO PRIVATE FUNCTIONS
    private function editInmuebleContratoPeriodos($id_inm_alquiler_contrato,$id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                                  $valor,$propietario,$deposito,$honorarios,$alquilerPeriodos,$alquilerServicios,$id_inquilino,$id_garante,$id_usuario){

        try{
            $id_inm_alquiler_contrato= $this->editInmuebleAlquilerContrato($id_inm_alquiler_contrato,$id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                                                           $valor,$propietario,$deposito,$honorarios,$id_inquilino,$id_garante,$id_usuario);

            $this->editInmuebleContratoServicios($id_inm_alquiler_contrato,$alquilerServicios,$id_usuario);

            for ($x = 0; $x < count($alquilerPeriodos); $x++) {
                $id=$alquilerPeriodos[$x]['id'];
                $fechaInicio=$alquilerPeriodos[$x]['startDate'];
                $fechaFin=$alquilerPeriodos[$x]['endDate'];
                $valor= $alquilerPeriodos[$x]['value'];

                $query = $this->db->prepare("UPDATE periodos_contrato
                                             SET fecha_inicio=STR_TO_DATE(:fechaInicio,'%d/%m/%Y'),fecha_fin=STR_TO_DATE(:fechaFin,'%d/%m/%Y'),
                                             valor=:valor,modified=NOW(),id_user_modified=:id_usuario
                                             WHERE id = :id");


                $query->bindParam(':id', $id);
                $query->bindParam(':fechaInicio', $fechaInicio);
                $query->bindParam(':fechaFin', $fechaFin);
                $query->bindParam(':valor', $valor);
                $query->bindParam(':id_usuario', $id_usuario);

                $query->execute();

                if($query->rowCount() <= 0)  return false;
            }

            return $id_inm_alquiler_contrato;
        }catch(PDOException $e){
            return $e;
        }
    }

    private function editInmuebleContratoServicios($id_inm_alquiler_contrato,$alquilerServicios,$id_usuario){
        try {
            $servicios = $this->getServiciosAlquilerContrato($id_inm_alquiler_contrato);
            for ($j = 0; $j < sizeof($servicios); $j++) {
                if (!in_array($servicios[$j]['id_servicio'], $alquilerServicios)) {
                    $query = $this->db->prepare("delete from servicios_contrato
                                                 where id_inm_alquiler_contrato=:id_inm_alquiler_contrato and id_servicio=:id_servicio");

                    $query->bindParam(':id_inm_alquiler_contrato', $id_inm_alquiler_contrato);
                    $query->bindParam(':id_servicio', $servicios[$j]['id_servicio']);

                    $query->execute();
                }
            }

            for ($i = 0; $i < sizeof($alquilerServicios); $i++) {
                $query = $this->db->prepare("INSERT INTO servicios_contrato(id_inm_alquiler_contrato,id_servicio,created,modified,id_user_creation,id_user_modified)
                                             SELECT :id_inm_alquiler_contrato,:id_servicio,NOW(),NOW(),:id_usuario,:id_usuario
                                             FROM dual
                                             WHERE NOT EXISTS (SELECT *
                                                               FROM servicios_contrato
                                                               WHERE id_inm_alquiler_contrato=:id_inm_alquiler_contrato &&
                                                               id_servicio=:id_servicio)
                                             ");

                $query->bindParam(':id_inm_alquiler_contrato', $id_inm_alquiler_contrato);
                $query->bindParam(':id_servicio', $alquilerServicios[$i]);
                $query->bindParam(':id_usuario', $id_usuario);

                $query->execute();
            }
            return true;
        }catch(PDOException $e){
            return $e;
        }
    }

    private function editInmuebleAlquilerContrato($id_inm_alquiler_contrato,$id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                                  $valor,$propietario,$deposito,$honorarios,$id_inquilino,$id_garante,$id_usuario){
        try{
            $this->editInmuebleAlquiler($id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                        $valor,$propietario,$id_usuario);

            if ($id_garante == ""){
                $id_garante=NULL;
            }

            $query = $this->db->prepare("UPDATE inm_alquiler_contrato
                                         SET deposito=:deposito,honorarios=:honorarios,id_inquilino=:id_inquilino,id_garante=:id_garante,
                                         modified=NOW(),id_user_modified=:id_usuario
                                         WHERE id = :id_inm_alquiler_contrato");


            $query->bindParam(':id_inm_alquiler_contrato', $id_inm_alquiler_contrato);
            $query->bindParam(':deposito', $deposito);
            $query->bindParam(':honorarios', $honorarios);
            $query->bindParam(':id_inquilino', $id_inquilino);
            $query->bindParam(':id_garante', $id_garante);
            $query->bindParam(':id_usuario', $id_usuario);

            $query->execute();

            if ($query->rowCount() <= 0) return false;
            return $this->db->lastInsertId();

        }catch(PDOException $e){
            return $e;
        }
    }

    private function editInmuebleAlquiler($id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                          $valor,$propietario,$id_usuario){
        try{
            $edited_direction= Direccion::getInstance()->editAddress($id_direccion,$calle,$nro,$piso,$dpto,$entre_calles,$zona,$ciudad,$provincia,$cod_postal,$id_usuario);

            $edited_inmueble= Inmueble::getInstance()->editInmueble($id_inmueble,"",$mts2,$comodidades,"OK",$id_usuario);

            if ($edited_direction && $edited_inmueble) {
                $query = $this->db->prepare("UPDATE inm_alquiler
                                         SET id_propietario=:id_propietario,valor=:valor,
                                         modified=NOW(),id_user_modified=:id_usuario
                                         WHERE id = :id_inmuebleAlquiler");


                $query->bindParam(':id_inmuebleAlquiler', $id_inmuebleAlquiler);
                $query->bindParam(':id_propietario', $propietario);
                $query->bindParam(':valor', $valor);
                $query->bindParam(':id_usuario', $id_usuario);

                $query->execute();

                if ($query->rowCount() <= 0) return false;
                return $this->db->lastInsertId();
            }
            return false;

        }catch(PDOException $e){
            return $e;
        }
    }

    /** Remove funtions **/
    private function removeInmuebleAlquilerContrato($idInmuebleAlquilerContrato){
        try{
            $query = $this->db->prepare("UPDATE inm_alquiler_contrato
                                         SET removed=1
                                         WHERE id = :idInmuebleAlquilerContrato");

            $query->bindParam(':idInmuebleAlquilerContrato', $idInmuebleAlquilerContrato);
            $query->execute();

            if ($query->rowCount() <= 0) return false;
            return true;
        }
        catch(PDOException $e){
            return $e;
        }
    }
}