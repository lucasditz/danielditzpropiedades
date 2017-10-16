<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 22/11/2016
 * Time: 20:12
 */



class Persona
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
    //Get all persons
    public function getAllPersona(){
        return $this->getPersons();
    }

    //Get person data by id
    public function getPersonaById($idPersona){
        return $this->getPersona($idPersona);
    }

    //Get person data by id
    public function isPersonRegister($dni) {
       return $this-> isRegister($dni);
    }

    //Add new person
    public function addPerson($nombre,$apellido,$dni,$fNacimiento,$telefono,$celular,$calle,$nro,$piso,$dpto,$ciudad,$provincia,$id_usuario){
        return $this->addNewPerson($nombre,$apellido,$dni,$fNacimiento,$telefono,$celular,$calle,$nro,$piso,$dpto,$ciudad,$provincia,$id_usuario);
    }

    //Edit registered person
    public function editPerson($id_persona,$nombre,$apellido,$dni,$fNacimiento,$telefonoId,$telefono,$celularId,$celular,$direccionId,$calle,$nro,$piso,$dpto,$ciudad,$provincia,$id_usuario){
        return $this->editRegisteredPerson($id_persona,$nombre,$apellido,$dni,$fNacimiento,$telefonoId,$telefono,$celularId,$celular,$direccionId,$calle,$nro,$piso,$dpto,$ciudad,$provincia,$id_usuario);
    }

    public function removePerson($id_persona){
        return $this->removeRegisteredPerson($id_persona);
    }

    /** PRIVATE FUNTIONS **/

    /** get funtions **/
    private function getPersons(){
        try{
            $query = $this->db->prepare("SELECT p.id,
                                            p.nombre,
                                            p.apellido,
                                            p.dni,
                                            DATE_FORMAT(p.fecha_nac,'%d/%m/%Y') as fecha_nac,
                                            tf.id as telefonoId,
                                            tf.nro as telefono,
                                            tc.id as celularId,
                                            tc.nro as celular,
                                            dp.id as dpid,
                                            dp.calle as dpCalle,
                                            dp.nro as dpNro,
                                            dp.piso as dpPiso,
                                            dp.dpto as dpDpto,
                                            dp.entre_calles as dpEntreCalles,
                                            dp.zona as dpZona,
                                            dp.ciudad as dpCiudad,
                                            dp.provincia as dpProvincia,
                                            dp.cod_postal as dpCodPostal
                                      FROM persona p
                                      LEFT JOIN telefono tf
                                      ON p.id_telefono = tf.id
                                      LEFT JOIN telefono tc
                                      ON p.id_celular = tc.id
                                      LEFT JOIN direccion dp
                                      ON p.id_direccion = dp.id
                                      where p.removed=0");
            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function getPersona($idPersona){
        try{
            $query = $this->db->prepare("SELECT p.id,
                                            p.nombre,
                                            p.apellido,
                                            p.dni,
                                            DATE_FORMAT(p.fecha_nac,'%d/%m/%Y') as fecha_nac,
                                            tf.id as telefonoId,
                                            tf.nro as telefono,
                                            tc.id as celularId,
                                            tc.nro as celular,
                                            dp.id as dpid,
                                            dp.calle as dpCalle,
                                            dp.nro as dpNro,
                                            dp.piso as dpPiso,
                                            dp.dpto as dpDpto,
                                            dp.ciudad as dpCiudad,
                                            dp.provincia as dpProvincia
                                      FROM persona p
                                      LEFT JOIN telefono tf
                                      ON p.id_telefono = tf.id
                                      LEFT JOIN telefono tc
                                      ON p.id_celular = tc.id
                                      LEFT JOIN direccion dp
                                      ON p.id_direccion = dp.id
                                      WHERE p.id = :idpersona && p.removed=0");

            $query->bindParam(':idpersona', $idPersona);
            $query->execute();
            if ($query->rowCount() === 0) return false;
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function isRegister($dni){
        try{
            $query = $this->db->prepare("SELECT p.id,
                                            p.nombre,
                                            p.apellido,
                                            p.dni,
                                            DATE_FORMAT(p.fecha_nac,'%d/%m/%Y') AS fecha_nac
                                    FROM persona p
                                    WHERE p.dni = :dni");

            $query->bindParam(':dni', $dni);
            $query->execute();
            if ($query->rowCount() === 0) return false;
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    /** add funtions **/
    private function addNewPerson($nombre,$apellido,$dni,$fNacimiento,$telefono,$celular,$calle,$nro,$piso,$dpto,$ciudad,$provincia,$id_usuario){
        try{
            $id_direccion= Direccion::getInstance()->addAddress($calle,$nro,$piso,$dpto,"","",$ciudad,$provincia,"",$id_usuario);

            $id_telefono=NULL;
            if ($telefono != "")
                $id_telefono=Telefono::getInstance()->addPhone(0,$telefono,$id_usuario);
            $id_celular=NULL;
            if ($celular != "")
                $id_celular=Telefono::getInstance()->addPhone(1,$celular,$id_usuario);

            if ($id_direccion!== false && $id_telefono!== false && $id_celular!== false) {
                $query = $this->db->prepare("INSERT INTO persona(nombre,apellido,dni,fecha_nac,id_direccion,id_telefono,id_celular,removed,created,modified,id_user_creation,id_user_modified)
                                        VALUES (:nombre,:apellido,:dni,STR_TO_DATE(:fNacimiento,'%d/%m/%Y'),:id_direccion,:id_telefono,:id_celular,0,NOW(),NOW(),:id_usuario,:id_usuario)");

                $query->bindParam(':nombre', $nombre);
                $query->bindParam(':apellido', $apellido);
                $query->bindParam(':dni', $dni);
                $query->bindParam(':fNacimiento', $fNacimiento);
                $query->bindParam(':id_direccion', $id_direccion);
                $query->bindParam(':id_telefono', $id_telefono);
                $query->bindParam(':id_celular', $id_celular);
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

    /** edit funtions **/
    private function editRegisteredPerson($id_persona,$nombre,$apellido,$dni,$fNacimiento,$telefonoId,$telefono,$celularId,$celular,$direccionId,$calle,$nro,$piso,$dpto,$ciudad,$provincia,$id_usuario){

        try{
            $edited_phone=true;
            $edited_mobile=true;
            if ($telefonoId != "") {
                $edited_phone = Telefono::getInstance()->editPhone($telefonoId, $telefono, $id_usuario);
            }else{
                $edited_phone=Telefono::getInstance()->addPhone(0,$telefono,$id_usuario);
            }
            if ($celularId != "") {
                $edited_mobile = Telefono::getInstance()->editPhone($celularId, $celular, $id_usuario);
            }else{
                $edited_mobile=Telefono::getInstance()->addPhone(0,$celular,$id_usuario);
            }

            $edited_direction=Direccion::getInstance()->editAddress($direccionId,$calle,$nro,$piso,$dpto,"","",$ciudad,$provincia,"",$id_usuario);


            $query = $this->db->prepare("UPDATE persona
                                         SET nombre=:nombre,apellido=:apellido,dni=:dni,fecha_nac=DATE(STR_TO_DATE(:fNacimiento,'%d/%m/%Y')),
                                             id_telefono=:idTelefono, id_celular=:idCelular,modified=NOW(),id_user_modified=:id_usuario
                                         WHERE id = :id_persona");


            $query->bindParam(':id_persona', $id_persona);
            $query->bindParam(':nombre', $nombre);
            $query->bindParam(':apellido', $apellido);
            $query->bindParam(':dni', $dni);
            $query->bindParam(':fNacimiento', $fNacimiento);
            $query->bindParam(':idCelular', $edited_mobile);
            $query->bindParam(':idTelefono', $edited_phone);
            $query->bindParam(':id_usuario', $id_usuario);

            $query->execute();

            if ($query->rowCount() <= 0) return false;
            return true;
        }catch(PDOException $e){
            return $e;
        }
    }

    /** Remove functions **/
    private function removeRegisteredPerson($id_persona){
        try{
            $query = $this->db->prepare("UPDATE persona
                                         SET removed=1
                                         WHERE id = :id_persona");


            $query->bindParam(':id_persona', $id_persona);
            $query->execute();

            if ($query->rowCount() <= 0) return false;
            return true;

        }catch(PDOException $e){
            return $e;
        }
    }
}