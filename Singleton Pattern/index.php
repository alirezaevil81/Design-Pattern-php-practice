<?php

class ConnectDB {
    private static $instance = null;

    private $conn;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db_name = 'laravel';

    private function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name};" , $this->user , $this->pass);
    }

    public static function getInstacne() {
        if(self::$instance == null) {
            self::$instance = new ConnectDB();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

$instance = ConnectDB::getInstacne();
var_dump($instance->getConnection());

$instance1 = ConnectDB::getInstacne();
var_dump($instance1->getConnection());

$instance2 = ConnectDB::getInstacne();
var_dump($instance2->getConnection());

$instance3 = ConnectDB::getInstacne();
var_dump($instance3->getConnection());





//class Singleton {
//    private static $instance = null;
//
//    private function __construct() { }
//
//    public static function getInstacne() {
//        if(self::$instance == null) {
//            self::$instance = new Singleton();
//        }
//
//        return self::$instance;
//    }
//
//    public function method(){
//        return 'something';
//    }
//}
//
//$instance = Singleton::getInstacne();
//var_dump($instance->method());
//
//$instance = Singleton::getInstacne();
//var_dump($instance->method());
//
//$instance = Singleton::getInstacne();
//var_dump($instance->method());
//
//$instance = Singleton::getInstacne();
//var_dump($instance->method());










