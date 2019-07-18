<?php

/*
 * Autor: Odair Soares.
 * E-mail: odairsds@gmail.com
 * Cel.: 55 84 9467-9154
 */

class controlSeason {

    static function start() {
        $opc = $_POST["opc"];
        switch ($opc) {
            case 1:
                self::criarTemporada();
                break;
            case 2:
                self::editTemporada();
                break;
        }
    }

    static function criarTemporada() {
        $temporada = new season();
        $temporada->setAno($_POST["ano"]);
        if (seasonDAO::criar($temporada)) {
            header("Location:../view/osrnAdmin.php?ctd_admin=season&action=1&rst=1");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=season&action=1&rst=0");
        }
    }

    static function editTemporada() {
        $temporada = new season();
        $temporada->setId_season($_POST["id_season"]);
        $temporada->setAno($_POST["ano"]);
        if (seasonDAO::editar($temporada)) {
            header("Location:../view/osrnAdmin.php?ctd_admin=season&action=2&rst=1");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=season&action=2&rst=0");
        }
    }

}

include_once '../DAO/seasonDAO.php';
include_once '../model/season.php';

controlSeason::start();
