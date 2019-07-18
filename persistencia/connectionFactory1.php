<?php

class connectionFactory1 {

    protected static $instance;
 
    private function __construct() {
        $db_host = "localhost";
        $db_name = "orquestrasinfo";
        $db_user = "orquestrasinfo";
        $db_password = "bd_osrn#93%0";
        $db_driver = "mysql";
        $title_system = "OSRN";
        $email_system = "odairsds@gmail.com";
        try {
            self::$instance = new PDO("$db_driver:host=$db_host;dbname=$db_name", $db_user, $db_password, array(PDO::ATTR_PERSISTENT => true));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->exec("SET NAMES utf8");
        } catch (PDOException $e) {
            mail($email_system, "PDOException em $title_system", $e->getMessage());
            die("Connection Error: " . $e->getMessage());
        }
    }

    public static function connection() {
        if (!self::$instance):
            new connectionFactory1();
        endif;
        return self::$instance;
    }

}
