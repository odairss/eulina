<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControlEmail
 *
 * @author odair
 */
include_once '../DAO/EmailDAO.php';
include_once '../model/email.php';

class ControlEmail {

    public static function start() {
        $opc = $_GET["opc"];
        switch ($opc) {
            case 1:
                self::criarEmail();
                break;
            case 2:
                self::editEmail();
                break;
        }
    }

    public static function criarEmail() {
        $email = new email();
        $email->setEmail($_GET["email"]);
        if (EmailDAO::criar($email)) {
            echo 'true';
//            header("Location:../index.php?ctd=1&rstmail=1");
        } else {
            echo 'false';
//            header("Location:../index.php?ctd=1&rstmail=0");
        }
    }

    public static function editEmail() {
        $email = new email();
        $email->setEmail($_POST["email"]);
        $email->setIdemail($_POST["id_email"]);
        if (EmailDAO::editar($email)) {
            header("Location:../view/osrnAdmin.php?ctd_admin=email&action=2&rst=1");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=email&action=2&rst=0");
        }
    }

}

ControlEmail::start();
