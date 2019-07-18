<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controlAgenda
 *
 * @author odair
 */
class controlAgenda {

    public static function start() {
        $opc = $_POST["opc"];
        switch ($opc) {
            case 1:
                self::criarAgenda();
                break;
            case 2:
                self::editAgenda();
                break;
        }
    }

    public static function criarAgenda() {
        $agenda = new agenda();
        $name_file = self::uploadFileAgenda();
        $agenda->setArquivo($name_file);

        $fotoconvidados = "";
        if (!empty($_FILES["fotoconvidados"])) {
            $fotoconvidados = self::uploadFileInvities();
        }

        $agenda->setDataevento($_POST["dataevento"]);
        $agenda->setTemporada($_POST["temporada"]);
        $agenda->setDescricao($_POST["descricao"]);
        $agenda->setResume($_POST["resume"]);
        $agenda->setMaestro($_POST["maestro"]);
        $agenda->setHora($_POST["hora"]);
        $agenda->setLocal($_POST["local"]);
        $agenda->setTitulo($_POST["titulo"]);
        $agenda->setAmountticket($_POST["amountticket"]);
        $agenda->setFotoconvidados($fotoconvidados);
        $agenda->setDaysstartreserve($_POST["daysstartreserve"]);
        $agenda->setDaysendreserve($_POST["daysendreserve"]);
        $agenda->setReservetimes($_POST["reservetimes"]);
        $agenda->setFirststarttimes($_POST["firststarttimes"]);
        $agenda->setFirstendtimes($_POST["firstendtimes"]);
        $agenda->setSecondestarttimes($_POST["secondestarttimes"]);
        $agenda->setSecondeendtimes($_POST["secondeendtimes"]);
        $agenda->setThirdstarttimes($_POST["thirdstarttimes"]);
        $agenda->setThirdendtimes($_POST["thirdendtimes"]);
        $agenda->setPlacetickets($_POST["placetickets"]);
        $agenda->setPlaceticketaddress($_POST["placeticketaddress"]);
        $agenda->setBoxofficelot($_POST["boxofficelot"]);
        $agenda->setStartwithdrawaltickets($_POST["startwithdrawaltickets"]);
        $agenda->setEndwithdrawaltickets($_POST["endwithdrawaltickets"]);
        $agenda->setLoteinternet($_POST["loteinternet"]);
        if (AgendaDAO::criar($agenda)) {
            header("Location:../view/osrnAdmin.php?ctd_admin=agenda&action=1&rst=1&file=$name_file");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=agenda&action=1&rst=0");
        }
    }

    public static function editAgenda() {
        $agenda = new agenda();
        $name_file = self::uploadFileAgenda();

        $fotoconvidados = "";
        if (!empty($_FILES["fotoconvidados"])) {
            $fotoconvidados = self::uploadFileInvities();
        }

        $agenda->setArquivo($name_file);
        $agenda->setDataevento($_POST["dataevento"]);
        $agenda->setTemporada($_POST["temporada"]);
        $agenda->setDescricao($_POST["descricao"]);
        $agenda->setResume($_POST["resume"]);
        $agenda->setMaestro($_POST["maestro"]);
        $agenda->setHora($_POST["hora"]);
        $agenda->setLocalevento($_POST["local"]);
        $agenda->setFotoconvidados($fotoconvidados);
        $agenda->setTitulo($_POST["titulo"]);
        $agenda->setAmountticket($_POST["amountticket"]);
        $agenda->setIdevento($_POST["id"]);
        $agenda->setDaysstartreserve($_POST["daysstartreserve"]);
        $agenda->setDaysendreserve($_POST["daysendreserve"]);
        $agenda->setReservetimes($_POST["reservetimes"]);
        $agenda->setFirststarttimes($_POST["firststarttimes"]);
        $agenda->setFirstendtimes($_POST["firstendtimes"]);
        $agenda->setSecondestarttimes($_POST["secondestarttimes"]);
        $agenda->setSecondeendtimes($_POST["secondeendtimes"]);
        $agenda->setThirdstarttimes($_POST["thirdstarttimes"]);
        $agenda->setThirdendtimes($_POST["thirdendtimes"]);
        $agenda->setPlacetickets($_POST["placetickets"]);
        $agenda->setPlaceticketaddress($_POST["placeticketaddress"]);
        $agenda->setBoxofficelot($_POST["boxofficelot"]);
        $agenda->setStartwithdrawaltickets($_POST["startwithdrawaltickets"]);
        $agenda->setEndwithdrawaltickets($_POST["endwithdrawaltickets"]);
        $agenda->setLoteinternet($_POST["loteinternet"]);
        if (EventoDAO::editar($event)) {
            header("Location:../view/osrnAdmin.php?ctd_admin=agenda&action=2&rst=1&file=$name_file");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=agenda&action=2&rst=0");
        }
    }

    public static function uploadFileAgenda() {
        if (isset($_FILES["arquivo"])) {//se existir o arquivo
            $arquivo = $_FILES["arquivo"];
            $pasta_dir = "../files/agenda/"; //diretorio dos arquivos
            if (!file_exists($pasta_dir)) {//se nao existir a pasta ele cria uma
                mkdir($pasta_dir);
            }
            $arquivo_nome = $pasta_dir . $arquivo["name"];
            move_uploaded_file($arquivo["tmp_name"], $arquivo_nome); // Faz o upload da imagem
            return $arquivo_nome;
        }
    }

    public static function uploadFileInvities() {
        if (isset($_FILES["fotoconvidados"])) {//se existir o arquivo
            $arquivoconvidados = $_FILES["fotoconvidados"];
            $pasta_dir = "../files/agenda/"; //diretorio dos arquivos
            if (!file_exists($pasta_dir)) {//se nao existir a pasta ele cria uma
                mkdir($pasta_dir);
            }
            $arquivo_nome = $pasta_dir . $arquivoconvidados ["name"];
            move_uploaded_file($arquivoconvidados ["tmp_name"], $arquivo_nome); // Faz o upload da imagem
            return $arquivo_nome;
        }
    }

}

include_once '../DAO/AgendaDAO.php';
include_once '../model/agenda.php';

controlAgenda::start();
