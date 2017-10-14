<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 28/09/2016
 * Time: 19:32
 */

class Direccion
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

    public function getAllAddress(){
        return $this->getAddresses();
    }

    public function getAddressByID($id_direccion){
        return $this->getAddress($id_direccion);
    }

    public function existsAddress($calle,$nro,$piso,$dpto,$ciudad,$provincia){
        return $this->isRegister($calle,$nro,$piso,$dpto,$ciudad,$provincia);
    }

    public function addAddress($calle,$nro,$piso,$dpto,$entre_calles,$zona,$ciudad,$provincia,$cod_postal,$id_usuario){
        return $this->addNewAddress($calle,$nro,$piso,$dpto,$entre_calles,$zona,$ciudad,$provincia,$cod_postal,$id_usuario);
    }

    public function editAddress($direccionId,$calle,$nro,$piso,$dpto,$entre_calles,$zona,$ciudad,$provincia,$cod_postal,$id_usuario){
        return $this->editRegisteredAddress($direccionId,$calle,$nro,$piso,$dpto,$entre_calles,$zona,$ciudad,$provincia,$cod_postal,$id_usuario);
    }

    public function getAllDiferentsInputs(){
        return $this->getAllDiferentsProperties();
    }


    /** PRIVATE FUNTIONS **/

    /** get funtions **/
    private function getAddresses(){
        try{
            $query = $this->db->prepare("SELECT d.calle,
                                                d.nro,
                                                d.piso,
                                                d.dpto,
                                                d.entre_calles,
                                                d.zona,
                                                d.ciudad,
                                                d.provincia,
                                                d.cod_postal
                                         FROM direccion d;

		                        ");
            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function getAddress($id_direccion){
        try{
            $query = $this->db->prepare("SELECT d.calle,
                                                d.nro,
                                                d.piso,
                                                d.dpto,
                                                d.entre_calles,
                                                d.zona,
                                                d.ciudad,
                                                d.provincia,
                                                d.cod_postal
                                          FROM direccion d
                                          where d.id = $id_direccion;

		");
            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function isRegister($calle,$nro,$piso,$dpto,$ciudad,$provincia){
        try{
            $query = $this->db->prepare("SELECT d.id
                                                d.calle,
                                                d.nro,
                                                d.piso,
                                                d.dpto,
                                                d.entre_calles,
                                                d.zona,
                                                d.ciudad,
                                                d.provincia,
                                                d.cod_postal
                                          FROM direccion d
                                          where d.calle=:calle AND d.nro=:nro AND
                                                d.piso=:piso AND d.dpto=:dpto AND
                                                d.ciudad=:ciudad AND d.provincia=:provincia;

            ");

            $query->bindParam(':calle', $calle,PDO::PARAM_STR);
            $query->bindParam(':nro', $nro,PDO::PARAM_STR);
            $query->bindParam(':piso', $piso,PDO::PARAM_STR);
            $query->bindParam(':dpto', $dpto,PDO::PARAM_STR);
            $query->bindParam(':ciudad', $ciudad,PDO::PARAM_STR);
            $query->bindParam(':provincia', $provincia,PDO::PARAM_STR);

            $query->execute();
            if($query->rowCount() <= 0)   return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function getAllDiferentsProperties(){
        try{
            $data_json['Calles']=$this->Calle_getAllDiferents();
            $data_json['Nros']=$this->Nros_getAllDiferents();

            $data_json['EntreCalles']=$this->EntreCalles_getAllDiferents();
            $data_json['Zonas']=$this->Zonas_getAllDiferents();
            $data_json['Ciudades']=$this->Ciudades_getAllDiferents();
            $data_json['Provincias']=$this->Provincias_getAllDiferents();
            $data_json['CodigosPostales']=$this->CodigosPostales_getAllDiferents();

            return $data_json;
        }catch(PDOException $e){
            return $e;
        }
    }
    private function Calle_getAllDiferents(){
        try{
            $query = $this->db->prepare("SELECT DISTINCT d.calle
                                          FROM direccion d;

            ");
            $query->execute();
            if($query->rowCount() <= 0)  return undefined;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function Nros_getAllDiferents(){
        try{
            $query = $this->db->prepare("SELECT DISTINCT d.nro
                                          FROM direccion d;

            ");
            $query->execute();
            if($query->rowCount() <= 0)  return undefined;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function EntreCalles_getAllDiferents(){
        try{
            $query = $this->db->prepare("SELECT DISTINCT d.entre_calles
                                          FROM direccion d;

            ");
            $query->execute();
            if($query->rowCount() <= 0)  return undefined;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function Zonas_getAllDiferents(){
        try{
            $query = $this->db->prepare("SELECT DISTINCT d.zona
                                          FROM direccion d;

            ");
            $query->execute();
            if($query->rowCount() <= 0)  return undefined;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function Ciudades_getAllDiferents(){
        try{
            $query = $this->db->prepare("SELECT DISTINCT d.ciudad
                                      FROM direccion d;

            ");
            $query->execute();
            if($query->rowCount() <= 0)  return undefined;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function Provincias_getAllDiferents(){
        try{
            $query = $this->db->prepare("SELECT DISTINCT d.provincia
                                          FROM direccion d;

            ");
            $query->execute();
            if($query->rowCount() <= 0)  return undefined;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function CodigosPostales_getAllDiferents(){
        try{
            $query = $this->db->prepare("SELECT DISTINCT d.cod_postal
                                      FROM direccion d;

		    ");
            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    /** add funtions **/
    private function addNewAddress($calle,$nro,$piso,$dpto,$entre_calles,$zona,$ciudad,$provincia,$cod_postal,$id_usuario){
        try{
            $query = $this->db->prepare("INSERT INTO direccion(calle,nro,piso,dpto,entre_calles,zona,ciudad,provincia,cod_postal,created,modified,id_user_creation,id_user_modified)
                                     VALUES(:calle,:nro,:piso,:dpto,:entre_calles,:zona,:ciudad,:provincia,:cod_postal,NOW(),NOW(),:id_usuario,:id_usuario);");

            $query->bindParam(':calle', $calle);
            $query->bindParam(':nro', $nro);
            $query->bindParam(':piso', $piso);
            $query->bindParam(':dpto', $dpto);
            $query->bindParam(':entre_calles', $entre_calles);
            $query->bindParam(':zona', $zona);
            $query->bindParam(':ciudad', $ciudad);
            $query->bindParam(':provincia', $provincia);
            $query->bindParam(':cod_postal', $cod_postal);
            $query->bindParam(':id_usuario', $id_usuario);

            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return $this->db->lastInsertId();
        }catch(PDOException $e){
            return $e;
        }
    }

    /** edit funtions **/
    private function editRegisteredAddress($direccionId,$calle,$nro,$piso,$dpto,$entre_calles,$zona,$ciudad,$provincia,$cod_postal,$id_usuario){
        try{
            $query = $this->db->prepare("UPDATE direccion
                                         SET calle=:calle,nro=:nro,piso=:piso,dpto=:dpto,entre_calles=:entre_calles,zona=:zona,
                                         ciudad=:ciudad,provincia=:provincia,cod_postal=:cod_postal,modified=NOW(),id_user_modified=:id_usuario
                                         WHERE id = :direccionId");


            $query->bindParam(':direccionId', $direccionId);
            $query->bindParam(':calle', $calle);
            $query->bindParam(':nro', $nro);
            $query->bindParam(':piso', $piso);
            $query->bindParam(':dpto', $dpto);
            $query->bindParam(':entre_calles', $entre_calles);
            $query->bindParam(':zona', $zona);
            $query->bindParam(':ciudad', $ciudad);
            $query->bindParam(':provincia', $provincia);
            $query->bindParam(':cod_postal', $cod_postal);
            $query->bindParam(':id_usuario', $id_usuario);

            $query->execute();

            if ($query->rowCount() <= 0) return false;
            return true;

        }catch(PDOException $e){
            return $e;
        }
    }
}