<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 28/09/2016
 * Time: 19:33
 */

class Telefono{
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
    public function getAllPhones(){
        return $this->getPhones();
    }

    public function addPhone($tipo,$nro,$id_user){
        return $this->addNewPhone($tipo,$nro,$id_user);
    }

    public function editPhone($telefonoId,$nro,$id_user){
        return $this->editRegisteredPhone($telefonoId,$nro,$id_user);
    }

    /** PRIVATE FUNTIONS **/
    /** get funtions **/
    private function getPhones(){
        try{
            $query = $this->db->prepare("SELECT t.id,
                                                t.nro
                                         FROM telefono t

		    ");
            $query->execute();
            if ($query->rowCount() <= 0) return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    /** add funtions **/
    private function addNewPhone($tipo,$nro,$id_user){
        try{

            $query = $this->db->prepare("INSERT INTO telefono(tipo,nro,created,modified,id_user_creation,id_user_modified)
                                         VALUES (:tipo,:nro,NOW(),NOW(),:id_user,:id_user");

            $query->bindParam(':tipo', $tipo);
            $query->bindParam(':nro', $nro);
            $query->bindParam(':id_user', $id_user);

            $query->execute();
            if ($query->rowCount() <= 0) return false;
            return $this->db->lastInsertId();
        }catch(PDOException $e)
        {
            return $e;
        }
    }

    /** edit funtions **/
    private function editRegisteredPhone($telefonoId,$nro,$id_user){
        try{
            $query = $this->db->prepare("UPDATE telefono
                                         SET nro=:nro,modified=NOW(),id_user_modified=:id_user
                                         WHERE id = :telefonoId");


            $query->bindParam(':telefonoId', $telefonoId);
            $query->bindParam(':nro', $nro);
            $query->bindParam(':id_user', $id_user);

            $query->execute();

            if ($query->rowCount() <= 0) return false;
            return true;

        }catch(PDOException $e){
            return $e;
        }
    }

    /** remove funtions **/
    private function removeRegisteredPhone($id_inmueble){

    }
}