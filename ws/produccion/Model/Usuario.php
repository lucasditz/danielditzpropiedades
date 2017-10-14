<?php

class Usuario
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    private function updateToken($token)
    {
        $expire = date('Y-m-d H:i:s', strtotime('+5 year'));
        $query = $this->db->prepare("UPDATE usuario
                                    SET token_expire = :token_expire
                                    WHERE token = :token ");
        $query->bindParam(':token', $token);
        $query->bindParam(':token_expire', $expire);
        $query->execute();
    }

    function isValidToken($token)
    {
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
    }

    private function getUserHash($email)
    {

        $query = $this->db->prepare("SELECT password,temp_pass,id
                                FROM usuario
                                WHERE email = :email");

        $query->bindParam(':email', $email, PDO::PARAM_STR);

        $query->execute();
        if ($query->rowCount() === 0) return false;
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    private function isValidPassword($password, $db_password_hash)
    {
        return password_verify($password, $db_password_hash);
    }

    public function getAllRoles()
    {
        $query = $this->db->prepare("SELECT *
									   FROM rol

		");
        $query->execute();
        if ($query->rowCount() <= 0) return false;
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    private function updateUserToken($idUser, $token)
    {
        // $expire = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $query = $this->db->prepare("UPDATE usuario SET token = :token, token_expire = NOW() + INTERVAL 5 YEAR
                                    WHERE id = :idUser ");

        $query->bindParam(':idUser', $idUser);
        $query->bindParam(':token', $token);
        $query->execute();
    }

    function checkUser($username, $password,$userType)
    {
        $resultUserHash = $this->getUserHash($username,$userType);
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
        //  return $idUser;

        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $this->updateUserToken($idUser, $token);

        $Array['id'] = $idUser;
        $Array['token'] = $token;
        return $Array;
    }

    function getUser($username)
    {
        $query = $this->db->prepare("SELECT nombre_usuario,password
                                    FROM usuario
                                    WHERE nombre_usuario = :username");

        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() === 0) return false;
        return $query->fetch(PDO::FETCH_ASSOC);

    }

    /* public function getRol($rol){
         $query = $this->db->prepare("SELECT *
                                        FROM jos_categories

         ");
         $query->execute();
         if($query->rowCount() <= 0)  return false;
         return $query->fetchAll(PDO::FETCH_ASSOC);
     }*/

}