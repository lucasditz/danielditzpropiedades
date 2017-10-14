<?php

class Inmueble
{
    private $db;
    private static $instance = NULL;

    public function __construct($db){
        $this->db=$db;
        self::$instance = $this;
    }

    public static function getInstance(){
        if (self::$instance === NULL) {
            self::$instance = new self(db::getInstance());
        }
        return self::$instance;
    }

    /** PUBLIC FUNTIONS **/
    public function getAllInmuebles(){
        return $this->getInmuebles();
    }

    public function getInmuebleById($id){
        return $this->getInmueble($id);
    }

    public function isInmuebleRegister($calle,$nro,$piso,$dpto,$ciudad,$provincia){
        return $this->isRegister($calle,$nro,$piso,$dpto,$ciudad,$provincia);
    }

    public function addInmueble($medidas_lote,$mts2,$comodidades,$papeles,$id_direccion,$id_usuario){
        return $this->addNewInmueble($medidas_lote,$mts2,$comodidades,$papeles,$id_direccion,$id_usuario);
    }

    public function editInmueble($id_inmueble,$medidas_lote,$mts2,$comodidades,$papeles,$id_usuario){
        return $this->editRegisteredInmueble($id_inmueble,$medidas_lote,$mts2,$comodidades,$papeles,$id_usuario);
    }

    public function removeInmueble($id_inmueble){
        return $this->removeRegisteredInmueble($id_inmueble);
    }

    /** PRIVATE FUNTIONS **/
    /** get funtions **/
    private function getInmuebles(){
        try{
            $query = $this->db->prepare("SELECT *
                                      FROM inmueble i
                                      INNER JOIN direccion d
                                      ON i.id_direccion= d.id

		    ");
            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            return $e;
        }
    }

    private function getInmueble($id){
        try{
            $query = $this->db->prepare("SELECT i.id,
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
                                            di.cod_postal as diCodPostal,
                                      FROM inmueble i
                                      INNER JOIN direccion d
                                      ON i.id_direccion= d.id
                                      WHERE i.id=:id

		    ");

            $query->bindParam(':id', $id);
            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
     }

    private function isRegister($calle,$nro,$piso,$dpto,$ciudad,$provincia){
        try {
            $query = $this->db->prepare("SELECT i.id
                                          FROM inmueble i
                                          LEFT JOIN direccion d
                                          ON i.id_direccion = d.id
                                          where d.calle=:calle AND d.nro=:nro AND
                                                d.piso=:piso AND d.dpto=:dpto AND
                                                d.ciudad=:ciudad AND d.provincia=:provincia;

            ");

            $query->bindParam(':calle', $calle);
            $query->bindParam(':nro', $nro);
            $query->bindParam(':piso', $piso);
            $query->bindParam(':dpto', $dpto);
            $query->bindParam(':ciudad', $ciudad);
            $query->bindParam(':provincia', $provincia);

            $query->execute();
            if($query->rowCount() <= 0)
                return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }
    /** add funtions **/
    private function addNewInmueble($medidas_lote,$mts2,$comodidades,$papeles,$id_direccion,$id_usuario){
        try{
            $query = $this->db->prepare("INSERT INTO inmueble(medidas_lote,mts2,comodidades,papeles,id_direccion,created,modified,id_user_creation,id_user_modified)
                                     VALUES(:medidas_lote,:mts2,:comodidades,:papeles,:id_direccion,NOW(),NOW(),:id_usuario,:id_usuario);");

            $query->bindParam(':medidas_lote', $medidas_lote);
            $query->bindParam(':mts2', $mts2,PDO::PARAM_STR);
            $query->bindParam(':comodidades', $comodidades);
            $query->bindParam(':papeles', $papeles);
            $query->bindParam(':id_direccion', $id_direccion);
            $query->bindParam(':id_usuario', $id_usuario);
            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return $this->db->lastInsertId();

        }catch(PDOException $e){
            return $e;
        }
    }

    /** edit funtions **/
    private function editRegisteredInmueble($id_inmueble,$medidas_lote,$mts2,$comodidades,$papeles,$id_usuario){
        try{
            $query = $this->db->prepare("UPDATE inmueble
                                         SET medidas_lote=:medidas_lote,mts2=:mts2,comodidades=:comodidades,
                                             papeles=:papeles,modified=NOW(),id_user_modified=:id_usuario
                                         WHERE id=:id_inmueble);");

            $query->bindParam(':id_inmueble', $id_inmueble);
            $query->bindParam(':medidas_lote', $medidas_lote,PDO::PARAM_STR);
            $query->bindParam(':mts2', $mts2,PDO::PARAM_STR);
            $query->bindParam(':comodidades', $comodidades,PDO::PARAM_STR);
            $query->bindParam(':papeles', $papeles,PDO::PARAM_STR);
            $query->bindParam(':id_usuario', $id_usuario);
            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return true;

        }catch(PDOException $e){
            return $e;
        }
    }

    /** remove funtions **/
    private function removeRegisteredInmueble($id_inmueble){
        /*try{
            $query = $this->db->prepare("UPDATE inmueble
                                         SET eliminado=1
                                         WHERE id=:id_inmueble);");

            $query->bindParam(':id_inmueble', $id_inmueble);
            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            return $e;
        }*/
        return true;
    }
}