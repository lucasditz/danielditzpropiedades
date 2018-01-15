<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 15/01/2018
 * Time: 17:24
 */

class Inmueble_Propietario
{
    private $db;
    private static $instance = NULL;

    public function __construct($db)
    {
        $this->db = $db;
        self::$instance = $this;
    }

    public static function getInstance()
    {
        if (self::$instance === NULL) {
            self::$instance = new self(db::getInstance());
        }
        return self::$instance;
    }

    /** PUBLIC FUNTIONS **/
    //Get all propietarios
    public function getAllPropietarios($idPropiedad) {
        return $this->getPropietarios($idPropiedad);
    }

    /** PRIVATE FUNTIONS **/
    private function getPropietarios($idPropiedad){
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
                                      FROM inm_alquiler_propietario iap
                                      LEFT JOIN persona p
                                      ON iap.id_propietario = p.id
                                      LEFT JOIN telefono tf
                                      ON p.id_telefono = tf.id
                                      LEFT JOIN telefono tc
                                      ON p.id_celular = tc.id
                                      LEFT JOIN direccion dp
                                      ON p.id_direccion = dp.id
                                      where iap.id_inm_alquiler = :idPropiedad
                                      order by p.nombre, p.apellido ASC");

            $query->bindParam(':idPropiedad', $idPropiedad);
            $query->execute();
            if($query->rowCount() <= 0)  return false;
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }
}