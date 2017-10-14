<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 21/11/2016
 * Time: 20:14
 */

class Alquileres_Disponibles
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
    public function getPropiedadesDisponibles(){
        return $this->getAllPropiedades();
    }

    public function getPropiedadDisponibleByID($id){
        return $this->getPropiedadByID($id);
    }

    public function addAlquilerDisponible($calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                          $valor,$id_propietario,$id_usuario){

        return $this->addInmuebleAlquiler($calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $valor,$id_propietario,$id_usuario);
    }

    public function editAlquilerDisponible($id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                           $valor,$propietario,$id_usuario){

        return $this->editInmuebleAlquiler($id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                           $valor,$propietario,$id_usuario);
    }

    public function removeAlquilerDisponible($idInmuebleAlquiler){
        /*try{
            $query = $this->db->prepare("");

            $query->bindParam(':idInmuebleAlquiler', $idInmuebleAlquiler,PDO::PARAM_STR);


            $query->execute();

            $last_id = $this->db->lastInsertId();
            return $last_id;
            // return true;
        }
        catch(PDOException $e){
            return $e;
        }*/
    }

    public function generateAlquilerContract($id_inmuebleAlquiler,$deposito,$honorarios,$alquilerPeriodos,$id_inquilino,$id_garante,$id_usuario){
       return $this->generateInmuebleContract($id_inmuebleAlquiler,$deposito,$honorarios,$alquilerPeriodos,$id_inquilino,$id_garante,$id_usuario);
    }

    /** PRIVATE FUNTIONS **/
    /** get funtions **/
    private function getAllPropiedades(){
        try {
            $query = $this->db->prepare("SELECT
                                            ia.id,
                                            ia.valor as valor,
                                            a.contenido as foto_perfil,
                                            p.nombre,
                                            p.apellido,
                                            d.calle,
                                            d.nro,
                                            d.piso,
                                            d.dpto,
                                            d.entre_calles,
                                            d.zona,
                                            d.ciudad,
                                            d.provincia,
                                            d.cod_postal
                                      FROM inm_alquiler ia
                                      LEFT JOIN persona p
                                      ON ia.id_propietario = p.id
                                      LEFT JOIN inmueble i
                                      ON ia.id_inmueble = i.id
                                      LEFT JOIN archivo a
                                      ON i.id_foto = a.id
                                      LEFT JOIN direccion d
                                      ON i.id_direccion = d.id
                                      WHERE ia.disponibilidad=1
		    ");

            $query->execute();
            if ($query->rowCount() <= 0) return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function getPropiedadByID($id){
        try{
            $query = $this->db->prepare("SELECT ia.id as idInmuebleAlquiler,
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

                                      FROM inm_alquiler ia
                                      LEFT JOIN inmueble i
                                      ON ia.id_inmueble = i.id
                                      LEFT JOIN direccion di
                                      ON i.id_direccion = di.id
                                      WHERE ia.disponibilidad=1 &&
                                            ia.id=:id

		    ");

            $query->bindParam(':id', $id);

            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    /** add functions **/
    //ADD IMUEBLE DISPONIBLE
    private function addInmuebleAlquiler($calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2, $valor, $id_propietario,$id_usuario){
        try{
            $id_direccion= Direccion::getInstance()->addAddress($calle,$nro,$piso,$dpto,$entre_calles,$zona,$ciudad,$provincia,$cod_postal,$id_usuario);

           if ($id_direccion !== false) {
               $id_inmueble = Inmueble::getInstance()->addInmueble('', $mts2, $comodidades, "OK", $id_direccion, $id_usuario);
               if ($id_inmueble !== false) {
                   $query = $this->db->prepare("INSERT INTO inm_alquiler(id_inmueble,id_propietario,valor,disponibilidad,created,modified,id_user_creation,id_user_modified)
                                            VALUES (:id_inmueble,:id_propietario,:valor,1,NOW(),NOW(),:id_usuario,:id_usuario)");

                   $query->bindParam(':id_inmueble', $id_inmueble);
                   $query->bindParam(':id_propietario', $id_propietario);
                   $query->bindParam(':valor', $valor);
                   $query->bindParam(':id_usuario', $id_usuario);

                   $query->execute();

                   if ($query->rowCount() <= 0) return false;
                   return $this->db->lastInsertId();
               }
           }
           return false;
        }catch(PDOException $e){
            return $e;
        }
    }

    /** edit funtions **/
    //EDIT INMUEBLE DISPONIBLE PRIVATE FUNCTIONS
    private function editInmuebleAlquiler($id_inmuebleAlquiler,$id_inmueble,$id_direccion,$calle, $nro, $piso, $dpto, $entre_calles, $zona, $ciudad, $provincia, $cod_postal, $comodidades, $mts2,
                                          $valor,$propietario,$id_usuario){
        try{
            $direccion= new Direccion(db::getInstance());
            $edited_direction= $direccion->editAddress($id_direccion,$calle,$nro,$piso,$dpto,$entre_calles,$zona,$ciudad,$provincia,$cod_postal,$id_usuario);

            $inmueble= new Inmueble(db::getInstance());
            $edited_inmueble= $inmueble->editInmueble($id_inmueble,"",$mts2,$comodidades,"OK",$id_usuario);

            if ($edited_direction!==false && $edited_inmueble!==false) {

                $query = $this->db->prepare("UPDATE inm_alquiler
                                             SET id_inmueble=:id_inmueble,id_propietario=:id_propietario,valor=:valor,
                                             modified=NOW(),id_user_modified=:id_usuario
                                             WHERE id = :id_inmuebleAlquiler");


                $query->bindParam(':id_inmuebleAlquiler', $id_inmuebleAlquiler);
                $query->bindParam(':id_inmueble', $id_inmueble);
                $query->bindParam(':id_propietario', $propietario);
                $query->bindParam(':valor', $valor);
                $query->bindParam(':id_usuario', $id_usuario);

                $query->execute();

                if ($query->rowCount() <= 0) return false;
                return $this->db->lastInsertId();
            }
            return false;
        }
        catch(PDOException $e)
        {
            return $e;
        }
    }

    /** GENERATE CONTRACT funtions **/
    //GENERATE CONTRACT PRIVATE FUNTIONS
    private function generateInmuebleContract($id_inmuebleAlquiler,$deposito,$honorarios,$alquilerPeriodos,$id_inquilino,$id_garante,$id_usuario){
        return $this->addInmuebleContratoPeriodos($id_inmuebleAlquiler,$deposito,$honorarios,$alquilerPeriodos,$id_inquilino,$id_garante,$id_usuario);

    }

    private function addInmuebleContratoPeriodos($id_inmuebleAlquiler,$deposito,$honorarios,$alquilerPeriodos,$id_inquilino,$id_garante,$id_usuario){
        try{

            $id_inm_alquiler_contrato= $this->addInmuebleAlquilerContrato($id_inmuebleAlquiler,$deposito,$honorarios,$id_inquilino,$id_garante,$id_usuario);

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
        }
        catch(PDOException $e)
        {
            return $e;
        }
    }

    private function addInmuebleAlquilerContrato($id_inmuebleAlquiler,$deposito,$honorarios,$id_inquilino,$id_garante,$id_usuario){
        try {
            $this->updateInmuebleAlquilerAvability($id_inmuebleAlquiler,0,$id_usuario);

            $query = $this->db->prepare("INSERT INTO inm_alquiler_contrato(id_inm_alquiler,deposito,honorarios,id_inquilino,id_garante,created,modified,id_user_creation,id_user_modified)
                                            VALUES (:id_inmuebleAlquiler,:deposito,:honorarios,:id_inquilino,:id_garante,NOW(),NOW(),:id_usuario,:id_usuario)");

            $query->bindParam(':id_inmuebleAlquiler', $id_inmuebleAlquiler);
            $query->bindParam(':deposito', $deposito);
            $query->bindParam(':honorarios', $honorarios);
            $query->bindParam(':id_inquilino', $id_inquilino);
            $query->bindParam(':id_garante', $id_garante);
            $query->bindParam(':id_usuario', $id_usuario);

            $query->execute();

            if ($query->rowCount() <= 0) return false;
            return $this->db->lastInsertId();
        }
        catch(PDOException $e)
        {
            return $e;
        }
    }

    private function updateInmuebleAlquilerAvability($id_inmuebleAlquiler,$disponibilidad,$id_usuario){
        try{
            $query = $this->db->prepare("UPDATE inm_alquiler
                                         SET disponibilidad=:disponibilidad,modified=NOW(),id_user_modified=:id_usuario
                                         WHERE id = :id_inmuebleAlquiler");


            $query->bindParam(':id_inmuebleAlquiler', $id_inmuebleAlquiler);
            $query->bindParam(':disponibilidad', $disponibilidad);
            $query->bindParam(':id_usuario', $id_usuario);

            $query->execute();

            return true;
        }
        catch(PDOException $e)
        {
            return $e;
        }
    }
}