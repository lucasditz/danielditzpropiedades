<?php

class db{

    private static $instance = NULL;

    private function __construct() 
    {
    }
    private function __clone()
    {
    }

    public static function getInstance() 
    {
        if(!self::$instance)
        {
			$dbhost="localhost";
			$dbuser="sftp-inmoba";
			$dbpass="1nmob4.db.pass";
			$dbname="sftp_inmoba";
            self::$instance = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
						
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
			//self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
		//	self::$instance->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, FALSE);
        }
		
		return self::$instance;
    }

    public static function getEngine($table)
    {   
        $query = self::getInstance()->prepare("SHOW TABLE STATUS WHERE `Name` = :table");
        $query->bindParam(':table', $table);
        $query->execute();
        $status = $query->fetchAll(PDO::FETCH_ASSOC);
        return $status[0]['Engine'];
    }
    
    

}
