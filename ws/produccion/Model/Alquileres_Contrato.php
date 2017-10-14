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


    public function addAlquilerContrato($calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                          $valor,$propietario,$deposito,$honorarios,$alquilerPeriodos,$id_inquilino,$id_garante,$id_usuario){

        return $this->addInmuebleContratoPeriodos($deposito,$honorarios,$alquilerPeriodos,$id_inquilino,$id_garante,$propietario,$valor,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $id_usuario);
    }

    public function editAlquilerContrato($id_inm_alquiler_contrato,$id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                         $valor,$propietario,$deposito,$honorarios,$alquilerPeriodos,$id_inquilino,$id_garante,$id_usuario){

        return $this->editInmuebleContratoPeriodos($id_inm_alquiler_contrato,$id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                                   $valor,$propietario,$deposito,$honorarios,$alquilerPeriodos,$id_inquilino,$id_garante,$id_usuario);
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
                                                iac.id=:id

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
                                      WHERE ia.disponibilidad=0
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


    /** add functions **/
    // ADD INMUEBLE CONTRATO PRIVATE FUNCTIONS
    private function addInmuebleContratoPeriodos($deposito,$honorarios,$alquilerPeriodos,$id_inquilino,$id_garante,$propietario,$valor,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $id_usuario){
        try{

            $id_inm_alquiler_contrato= $this->addInmuebleAlquilerContrato($deposito,$honorarios,$id_inquilino,$id_garante, $propietario,$valor,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $id_usuario);

            for ($x = 0; $x < count($alquilerPeriodos); $x++) {
                $fechaInicio=$alquilerPeriodos[$x]['startDate'];
                $fechaFin=$alquilerPeriodos[$x]['endDate'];
                $valor= $alquilerPeriodos[$x]['value'];

                $query = $this->db->prepare("INSERT INTO periodos_contrato(id_inm_alquiler_contrato,fecha_inicio,fecha_fin,valor,created,modified,id_user_creation,id_user_modified)
                                            VALUES (:id_inm_alquiler_contrato,STR_TO_DATE(:fechaInicio,'%d/%m/%Y'),STR_TO_DATE(:fechaFin,'%d/%m/%Y'),:valor,NOW(),NOW(),:id_usuario,:id_usuario)");


                $query->bindParam(':id_inm_alquiler_contrato', $id_inm_alquiler_contrato);
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

    private function addInmuebleAlquilerContrato($deposito,$honorarios,$id_inquilino,$id_garante, $propietario,$valor,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $id_usuario){
        try{

            $id_inm_alquiler= $this->addInmuebleAlquiler($propietario,$valor,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $id_usuario);


            $query = $this->db->prepare("INSERT INTO inm_alquiler_contrato(id_inm_alquiler,deposito,honorarios,id_inquilino,id_garante,created,modified,id_user_creation,id_user_modified)
                                            VALUES (:id_inmuebleAlquiler,:deposito,:honorarios,:id_inquilino,:id_garante,NOW(),NOW(),:id_usuario,:id_usuario)");


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

            $direccion= new Direccion(db::getInstance());
            $id_direccion= $direccion->addAddress($calle,$nro,$piso,$dpto,$entre_calles,$zona,$ciudad,$provincia,$cod_postal,$id_usuario);

            $Inmueble= new Inmueble(db::getInstance());
            $id_inmueble= $Inmueble->addInmueble("",$mts2,$comodidades,"OK",$id_direccion,$id_usuario);

            $query = $this->db->prepare("INSERT INTO inm_alquiler(id_inmueble,id_propietario,valor,disponibilidad,created,modified,id_user_creation,id_user_modified)
                                        VALUES (:id_inmueble,:id_propietario,:valor,2,NOW(),NOW(),:id_usuario,:id_usuario)");

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
                                                  $valor,$propietario,$deposito,$honorarios,$alquilerPeriodos,$id_inquilino,$id_garante,$id_usuario){

        try{
            $id_inm_alquiler_contrato= $this->editInmuebleAlquilerContrato($id_inm_alquiler_contrato,$id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                                                           $valor,$propietario,$deposito,$honorarios,$id_inquilino,$id_garante,$id_usuario);

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

    private function editInmuebleAlquilerContrato($id_inm_alquiler_contrato,$id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                                  $valor,$propietario,$deposito,$honorarios,$id_inquilino,$id_garante,$id_usuario){
        try{
            $this->editInmuebleAlquiler($id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                        $valor,$propietario,$id_usuario);


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
            $direccion= new Direccion(db::getInstance());
            $edited_direction= $direccion->editAddress($id_direccion,$calle,$nro,$piso,$dpto,$entre_calles,$zona,$ciudad,$provincia,$cod_postal,$id_usuario);

            $inmueble= new Inmueble(db::getInstance());
            $edited_inmueble= $inmueble->editInmueble($id_inmueble,"",$mts2,$comodidades,"OK",$id_usuario);

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
}