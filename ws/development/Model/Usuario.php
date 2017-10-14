<?php

class Usuario
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
    function isValidToken($token){
        return $this->isUserValidToken($token);
    }

    function getProfile($idUser){
        return $this->getUserProfile($idUser);
    }

    function getIdUser($token){
        return $this->getIDUserToken($token)['id'];
    }

    function checkUser($username, $password){
        return $this->checkValidUser($username, $password);
    }

    function editProfile($idUser, $nombre,$apellido,$email){
        return $this->editUserProfile($idUser,$nombre,$apellido,$email);
    }

    function changePassword($token,$password,$newPassword){
        return $this->changeUserPassword($token,$password,$newPassword);
    }


    /** PRIVATE FUNTIONS **/
    /** get funtions **/
    private function getIDUserToken($token){
        try{
            $query = $this->db->prepare("SELECT id,
                                                password,
                                                temp_pass
                                        FROM usuario
                                        WHERE token = :token
                                        ");

            $query->bindParam(':token', $token);
            $query->execute();
            if($query->rowCount() <= 0)  return false;

            return $query->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function getUserProfile($idUser){
        try{
            $query = $this->db->prepare("SELECT u.id,
                                                u.email,
                                                u.nombre,
                                                u.apellido,
                                                u.id_foto
                                          FROM usuario u
                                          WHERE u.id = :idUser
                                        ");

            $query->bindParam(':idUser', $idUser);
            $query->execute();
            if($query->rowCount() <= 0)  return false;

            return $query->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function getHash($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /** add funtions **/


    /** edit funtions **/
    private function  updatePassword($id,$hashed_password){
        try{
            $query = $this->db->prepare("UPDATE usuario
                                        SET password = :password
                                        WHERE id = :id ");

            $query->bindParam(':id', $id);
            $query->bindParam(':password', $hashed_password,PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() <= 0) return false;
            return true;
        }catch(PDOException $e){
            return $e;
        }
    }

    private function changeUserPassword($token,$password,$newPassword){
        try{
            $user = $this->getIDUserToken($token);

            $db_password_hash = $user['password'];
            if($db_password_hash === false) return false;

            $db_temppassword_hash = $user['temp_pass'];

            $valid_password = $this->isValidPassword($password, $db_password_hash);
            if($valid_password === false){
                $valid_TempPassword = $this->isValidPassword($password, $db_temppassword_hash);
                if($valid_TempPassword === false){
                    return false;
                }
                $this->deleteTempPassword($user['id']);
            }
            $hashed_password = $this->getHash($newPassword);
            return $this->updatePassword($user['id'],$hashed_password);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function editUserProfile($idUser,$nombre,$apellido,$email){
        try{
            $query = $this->db->prepare("UPDATE usuario
                                        SET nombre = :nombre,apellido=:apellido,email=:email
                                        WHERE id = :idUser ");

            $query->bindParam(':idUser', $idUser);
            $query->bindParam(':nombre', $nombre);
            $query->bindParam(':apellido', $apellido);
            $query->bindParam(':email', $email);

            $query->execute();
            if ($query->rowCount() <= 0) return false;
            return true;
        }catch(PDOException $e){
            return $e;
        }
    }

    /** delate function **/
    private function deleteTempPassword($id){
        try{
            $query = $this->db->prepare("UPDATE usuario
                                        SET temp_pass = NULL
                                        WHERE id = :id ");

            $query->bindParam(':id', $id,PDO::PARAM_STR);

            $query->execute();
            return true;
        }catch(PDOException $e){
            return $e;
        }
    }

    /** verification functions */
    private function isUserValidToken($token){
        try{
            $query = $this->db->prepare("SELECT email
                                    FROM usuario
                                    WHERE token = :token");

            $query->bindParam(':token', $token, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {   //keep token alive
                $this->updateToken($token);
                return true;
            } else {
                return false;
            }
        }catch(PDOException $e){
            return $e;
        }
    }

    private function updateToken($token){
        try {
            $expire = date('Y-m-d H:i:s', strtotime('+5 year'));
            $query = $this->db->prepare("UPDATE usuario
                                        SET token_expire = :token_expire
                                        WHERE token = :token ");
            $query->bindParam(':token', $token);
            $query->bindParam(':token_expire', $expire);
            $query->execute();
        }catch(PDOException $e){
            return $e;
        }
    }

    private function checkValidUser($username, $password){
        try{
            $resultUserHash = $this->getUserHash($username);
            $db_password_hash = $resultUserHash['password'];
            $db_temppassword_hash = $resultUserHash['temp_pass'];
            $idUser = $resultUserHash['id'];

            if($db_password_hash === false) return false;

            $valid_password = $this->isValidPassword($password, $db_password_hash);

            if($valid_password === false){
                $valid_TempPassword = $this->isValidPassword($password, $db_temppassword_hash);
                if($valid_TempPassword === false){
                    return false;
                }
            }

            $token = bin2hex(openssl_random_pseudo_bytes(16));
            $this->updateUserToken($idUser, $token);

            $Array['id'] = $idUser;
            $Array['token'] = $token;
            return $Array;
        }catch(PDOException $e){
            return $e;
        }
    }

    private function getUserHash($nombre_usuario){
        try{
            $query = $this->db->prepare("SELECT password,temp_pass,id
                                         FROM usuario
                                         WHERE nombre_usuario = :nombre_usuario");

            $query->bindParam(':nombre_usuario', $nombre_usuario);

            $query->execute();
            if ($query->rowCount() === 0) return false;
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e;
        }
    }

    private function isValidPassword($password, $db_password_hash){
        return password_verify($password, $db_password_hash);
    }

    private function updateUserToken($idUser, $token){
        try{
            $query = $this->db->prepare("UPDATE usuario SET token = :token, token_expire = NOW() + INTERVAL 5 YEAR
                                        WHERE id = :idUser ");

            $query->bindParam(':idUser', $idUser);
            $query->bindParam(':token', $token);
            $query->execute();
        }catch(PDOException $e){
            return $e;
        }
    }
}