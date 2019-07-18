<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailDAO
 *
 * @author odair
 */
session_start();
if (isset($_SESSION["origem"])) {
    if ($_SESSION["origem"] == "osrn1") {
        include_once '../persistencia/connectionFactory.php';
        include_once '../model/email.php';
    } elseif ($_SESSION["origem"] == 2) {
        include_once '../persistencia/connectionFactory.php';
        include_once '../model/email.php';
    }
}

class EmailDAO {

    public static function criar(email $email) {
        $connection = connectionFactory::createConnection();
        $sql = "INSERT INTO orquestrasinfo.newsletter (email)"
                . "VALUES('{$email->getEmail()}');";
        $result = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $result;
    }

    public static function editar(email $email) {
        $connection = connectionFactory::createConnection();
        $sql = "UPDATE TABLE orquestrasinfo.newsletter SET email = '{$email->getEmail()}' WHERE newsletter.id_email = {$email->getIdemail()};";
        $result = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $result;
    }

    public static function excluir($id_email) {
        $connection = connectionFactory::createConnection();
        $sql = "DELETE FROM orquestrasinfo.newsletter WHERE id_email = $id_email;";
        $result = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $result;
    }

    public static function listar() {
        $emails = array();
        $connection = connectionFactory::createConnection();
        $sql = "SELECT * FROM orquestrasinfo.newsletter ORDER BY email ASC;";
        $result = mysqli_query($connection, $sql);
        while ($array_emails = mysqli_fetch_assoc($result)) {
            $email = new email();
            $email->setEmail($array_emails["email"]);
            $email->setIdemail($array_emails["id_email"]);
            $emails[] = $email;
        }
        connectionFactory::closeConnection($connection, $result);
        return $emails;
    }

    public static function pesquisar($id_email) {
        $connection = connectionFactory::createConnection();
        $sql = "SELECT * FROM orquestrasinfo.newsletter WHERE id_email = $id_email;";
        $result = mysqli_query($connection, $sql);
        $email = new email();
        if (mysqli_num_rows($result) != 0) {
            $obj_email = mysqli_fetch_object($result);
            $email->setEmail($obj_email->email);
            $email->setIdemail($obj_email->id_email);
        }
        connectionFactory::closeConnection($connection, $result);
        return $email;
    }

}
