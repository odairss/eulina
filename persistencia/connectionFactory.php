<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of connectionFactory
 *
 * @author odair
 */
class connectionFactory {

//
//    public static function createConnection() {
//        $connection = mysqli_connect("localhost:3306", "root", "");
//        mysqli_select_db($connection, "orquestrasinfo") or die(mysqli_error($connection));
//        return $connection;
//    }
//
//    public static function closeConnection($connection, $result) {
//        mysqli_close($connection);
//        mysqli_free_result($result);
//    }

    protected static $instance;

    private function __construct() {
        $db_host = "localhost";
        $db_name = "orquestrasinfo";
        $db_user = "root";
        $db_password = "RdIgL31/17:03&27";
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
            new connectionFactory();
        endif;
        return self::$instance;
    }

}
