<?php
class Database {

    const ROW_COUNT      = 'ROW_COUNT';
    const LAST_INSERT_ID = 'LAST_INSERT_ID';
    const FETCH_ALL      = 'FETCH_ALL';
    const FETCH_COLUMN   = 'FETCH_COLUMN';
    const FETCH          = 'FETCH';
    const FETCH_OBJ      = 5;
    const FETCH_ASSOC    = 2;

    private static $connect = null;

    private function __construct(){}

    private static function connect(){

        $dsn = DB_TYPE.':host='.HOST_NAME.';dbname='.DB_NAME.';charset='.DB_CHARSET;

        try {

            $con = new PDO($dsn, DB_USER, DB_PASS);
            
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 

            // echo "Connection successful!";

            return $con;

        } catch (PDOException $e) {

            // echo "Connection failed: " . $e->getMessage();

            return NULL;

        }
    }

    protected function query($query,$data=[],$result_type = self::ROW_COUNT ,$fetch_type=5){
        
        if(is_null(self::$connect)){
            
            self::$connect = self::connect();
            
        }

        $stmt = self::$connect->prepare($query);

       if($stmt->execute($data)){

        switch($result_type):

            case self::FETCH_ALL:

                return $stmt->fetchAll($fetch_type);

            case self::FETCH:

                return $stmt->fetch($fetch_type);

            case self::FETCH_COLUMN:

                return $stmt->fetchColumn();

            case self::LAST_INSERT_ID:

                return self::$connect->lastInsertId();

            default :

                return $stmt->rowCount();

        endswitch;

       }

       return false;

    }

}