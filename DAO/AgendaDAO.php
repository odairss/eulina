<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AgendaDAO
 *
 * @author odair
 */
if (!isset($_SESSION)):
    session_start();
endif;
if (isset($_SESSION["origem"])) {
    if ($_SESSION["origem"] == "osrn1") {
        include_once '../persistencia/connectionFactory.php';
        include_once '../model/agenda.php';
    } elseif ($_SESSION["origem"] == 2) {
        include_once 'persistencia/connectionFactory.php';
        include_once 'model/agenda.php';
    } elseif ($_SESSION["origem"] == "ticket") {
        include_once '../../persistencia/connectionFactory.php';
        include_once '../../model/agenda.php';
    }
}


class AgendaDAO {

    public static function criar(agenda $agenda) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $dataevento = implode("-", array_reverse(explode("/", $agenda->getDataevento())));
            $resume = addslashes($agenda->getResume());
            $descricao = addslashes($agenda->getDescricao());
            $titulo = addslashes($agenda->getTitulo());
            $stmt = $connection->prepare("INSERT INTO orquestrasinfo.agenda (arquivo, amountticket, titulo,dataevento,"
                    . "temporada, hora,local,descricao,resume, maestro, fotoconvidados, "
                    . "daysstartreserve, daysendreserve, reservetimes, firststarttimes, firstendtimes, "
                    . "secondestarttimes, secondeendtimes, thirdstarttimes, thirdendtimes, placetickets, "
                    . "placeticketaddress, boxofficelot, startwithdrawaltickets, endwithdrawaltickets, loteinternet) "
                    . "VALUES(:archive,:amount,:title, :eventdate,:seasom,:hours,:place,:description, "
                    . ":resume,:conductor,:guestphoto, :daysstart, :daysend, :reservetim, :firststart,"
                    . ":firstend, :secondestart, :secondeend, :thirdstart, :thirdend, :placetick, "
                    . ":ticketaddress, :boxofficel, :startwithdrawal, :endwithdrawal, :loteweb);");
            $stmt->bindValue(':archive', $agenda->getArquivo());
            $stmt->bindValue(':amount', $agenda->getAmountticket());
            $stmt->bindValue(':title', $titulo);
            $stmt->bindValue(':eventdate', $dataevento);
            $stmt->bindValue(':seasom', $agenda->getTemporada());
            $stmt->bindValue(':hours', $agenda->getHora());
            $stmt->bindValue(':place', $agenda->getLocal());
            $stmt->bindValue(':description', $descricao);
            $stmt->bindValue(':resume', $resume);
            $stmt->bindValue(':conductor', $agenda->getMaestro());
            $stmt->bindValue(':guestphoto', $agenda->getFotoconvidados());
            $stmt->bindValue(':daysstart', $agenda->getDaysstartreserve());
            $stmt->bindValue(':daysend', $agenda->getDaysendreserve());
            $stmt->bindValue(':reservetim', $agenda->getReservetimes());
            $stmt->bindValue(':firststart', $agenda->getFirststarttimes());
            $stmt->bindValue(':firstend', $agenda->getFirstendtimes());
            $stmt->bindValue(':secondestart', $agenda->getSecondestarttimes());
            $stmt->bindValue(':secondeend', $agenda->getSecondeendtimes());
            $stmt->bindValue(':thirdstart', $agenda->getThirdstarttimes());
            $stmt->bindValue(':thirdend', $agenda->getThirdendtimes());
            $stmt->bindValue(':placetick', $agenda->getPlacetickets());
            $stmt->bindValue(':ticketaddress', $agenda->getPlaceticketaddress());
            $stmt->bindValue(':boxofficel', $agenda->getBoxofficelot());
            $stmt->bindValue(':startwithdrawal', $agenda->getStartwithdrawaltickets());
            $stmt->bindVAlue(':endwithdrawal', $agenda->getEndwithdrawaltickets());
            $stmt->bindValue(':loteweb', $agenda->getLoteinternet());
            $result = $stmt->execute();
            $connection->commit();
            return $result;
        } catch (Exception $exc) {
            $connection->rollBack();
        }
    }

    public static function editar(agenda $agenda) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $dataevento = implode("-", array_reverse(explode("/", $agenda->getDataevento())));
            $resume = addslashes($agenda->getResume());
            $descricao = addslashes($agenda->getDescricao());
            $titulo = addslashes($agenda->getTitulo());
            $stmt = $connection->prepare("UPDATE TABLE orquestrasinfo.agenda  SET arquivo = :archive, "
                    . "amountticket = :amount, titulo = :title,dataevento = :eventdate, "
                    . "temporada = :seasom, hora = :hours,local = :place,descricao = :description, "
                    . "resume = :resume, maestro = :conductor, fotoconvidados = :guestphoto, "
                    . "daysstartreserve = :daysstart, daysendreserve = :daysend, reservetimes = :reservetim, "
                    . "firststarttimes = :firststart, firstendtimes = :firstend, secondestarttimes = :secondestart, "
                    . "secondeendtimes = :secondeend, thirdstarttimes = :thirdstart, thirdendtimes = :thirdend, "
                    . "placetickets = :placetick, placeticketaddress = :ticketaddress, boxofficelot = :boxofficel, "
                    . "startwithdrawaltickets = :startwithdrawal, endwithdrawaltickets = :endwithdrawal, loteinternet = :loteweb);");
            $stmt->bindValue(':archive', $agenda->getArquivo());
            $stmt->bindValue(':amount', $agenda->getAmountticket());
            $stmt->bindValue(':title', $titulo);
            $stmt->bindValue(':eventdate', $dataevento);
            $stmt->bindValue(':seasom', $agenda->getTemporada());
            $stmt->bindValue(':hours', $agenda->getHora());
            $stmt->bindValue(':place', $agenda->getLocal());
            $stmt->bindValue(':description', $descricao);
            $stmt->bindValue(':resume', $resume);
            $stmt->bindValue(':conductor', $agenda->getMaestro());
            $stmt->bindValue(':guestphoto', $agenda->getFotoconvidados());
            $stmt->bindValue(':daysstart', $agenda->getDaysstartreserve());
            $stmt->bindValue(':daysend', $agenda->getDaysendreserve());
            $stmt->bindValue(':reservetim', $agenda->getReservetimes());
            $stmt->bindValue(':firststart', $agenda->getFirststarttimes());
            $stmt->bindValue(':firstend', $agenda->getFirstendtimes());
            $stmt->bindValue(':secondestart', $agenda->getSecondestarttimes());
            $stmt->bindValue(':secondeend', $agenda->getSecondeendtimes());
            $stmt->bindValue(':thirdstart', $agenda->getThirdstarttimes());
            $stmt->bindValue(':thirdend', $agenda->getThirdendtimes());
            $stmt->bindValue(':placetick', $agenda->getPlacetickets());
            $stmt->bindValue(':ticketaddress', $agenda->getPlaceticketaddress());
            $stmt->bindValue(':boxofficel', $agenda->getBoxofficelot());
            $stmt->bindValue(':startwithdrawal', $agenda->getStartwithdrawaltickets());
            $stmt->bindVAlue(':endwithdrawal', $agenda->getEndwithdrawaltickets());
            $stmt->bindValue(':loteweb', $agenda->getLoteinternet());
            $result = $stmt->execute();
            $connection->commit();
            return $result;
        } catch (Exception $exc) {
            $connection->rollBack();
        }
    }

    public static function excluir($idEvento) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $stmt = $connection->prepare("DELETE FROM orquestrasinfo.agenda WHERE idevento = :eventId;");
            $stmt->bindValue(':eventId', $idEvento);
            $result = $stmt->execute();
            $connection->commit();
            return $result;
        } catch (Exception $exc) {
            $connection->rollBack();
        }
    }

    public static function getDate($idevento) {
        $connection = connectionFactory::connection();
        try {
            $result = $connection->query("SELECT dataevento FROM orquestrasinfo.agenda WHERE idevento = $idevento;");
            $dataevento = "";
            if ($result->rowCount() > 0):
                while ($row = $result->fetch(PDO::FETCH_OBJ)):
                    $dataevento = implode("/", array_reverse(explode("-", $row->dataevento)));
                endwhile;
            endif;
            return $dataevento;
        } catch (Exception $exc) {
            $exc->getMessage();
        }
    }

    public static function listar() {
        $agendas = array();
        $connection = connectionFactory::connection();
        try {
            $processResult = $connection->query("SELECT arquivo, amountticket, dataevento, temporada, "
                    . "descricao, resume, maestro, hora, idevento, local, fotoconvidados, titulo FROM orquestrasinfo.agenda ORDER BY dataevento DESC;");
            if ($processResult->rowCount() > 0):
                while ($row = $processResult->fetch(PDO::FETCH_OBJ)):
                    $agenda = new agenda();
                    $agenda->setArquivo($row->arquivo);
                    $agenda->setAmountticket($row->amountticket);
                    $dataevento = implode("/", array_reverse(explode("-", $row->dataevento)));
                    $agenda->setDataevento($dataevento);
                    $agenda->setTemporada($row->temporada);
                    $agenda->setDescricao($row->descricao);
                    $agenda->setResume($row->resume);
                    $agenda->setMaestro($row->maestro);
                    $agenda->setHora($row->hora);
                    $agenda->setIdevento($row->idevento);
                    $agenda->setLocal($row->local);
                    $agenda->setFotoconvidados($row->fotoconvidados);
                    $agenda->setTitulo($row->titulo);
                    array_push($agendas, $agenda);
                endwhile;
            endif;
            return $agendas;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function listToSeason($id_season) {
        $agendas = array();
        $connection = connectionFactory::connection();
        try {
            $processResult = $connection->query("SELECT arquivo, amountticket, dataevento, temporada, descricao, resume, "
                    . "maestro, hora, idevento, local, fotoconvidados, titulo"
                    . " FROM orquestrasinfo.agenda WHERE temporada = $id_season ORDER BY dataevento DESC;");
            if ($processResult->rowCount() > 0):
                while ($row = $processResult->fetch(PDO::FETCH_OBJ)):
                    $agenda = new agenda();
                    $agenda->setArquivo($row->arquivo);
                    $agenda->setAmountticket($row->amountticket);
//                    $dataevento = implode("/", array_reverse(explode("-", $row->dataevento)));
                    $agenda->setDataevento($row->dataevento);
                    $agenda->setTemporada($row->temporada);
                    $agenda->setDescricao($row->descricao);
                    $agenda->setResume($row->resume);
                    $agenda->setMaestro($row->maestro);
                    $agenda->setHora($row->hora);
                    $agenda->setIdevento($row->idevento);
                    $agenda->setLocal($row->local);
                    $agenda->setFotoconvidados($row->fotoconvidados);
                    $agenda->setTitulo($row->titulo);
                    array_push($agendas, $agenda);
                endwhile;
            endif;
            return $agendas;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function pesquisar($idevento) {
        $connection = connectionFactory::connection();
        try {
            $processResult = $connection->query("SELECT * FROM orquestrasinfo.agenda WHERE idevento = $idevento;");
            $agenda = new agenda();
            if ($processResult->rowCount() > 0):
                while ($row = $processResult->fetch(PDO::FETCH_OBJ)):
                    $agenda->setArquivo($row->arquivo);
                    $agenda->setAmountticket($row->amountticket);
                    $agenda->setDataevento($row->dataevento);
                    $agenda->setTemporada($row->temporada);
                    $agenda->setDescricao($row->descricao);
                    $agenda->setResume($row->resume);
                    $agenda->setMaestro($row->maestro);
                    $agenda->setHora($row->hora);
                    $agenda->setIdevento($row->idevento);
                    $agenda->setLocal($row->local);
                    $agenda->setFotoconvidados($row->fotoconvidados);
                    $agenda->setTitulo($row->titulo);
                    $agenda->setDaysstartreserve($row->daysstartreserve);
                    $agenda->setDaysendreserve($row->daysendreserve);
                    $agenda->setReservetimes($row->reservetimes);
                    $agenda->setFirststarttimes($row->firststarttimes);
                    $agenda->setFirstendtimes($row->firstendtimes);
                    $agenda->setSecondestarttimes($row->secondestarttimes);
                    $agenda->setSecondeendtimes($row->secondeendtimes);
                    $agenda->setThirdstarttimes($row->thirdstarttimes);
                    $agenda->setThirdendtimes($row->thirdendtimes);
                    $agenda->setPlacetickets($row->placetickets);
                    $agenda->setPlaceticketaddress($row->placeticketaddress);
                    $agenda->setBoxofficelot($row->boxofficelot);
                    $agenda->setStartwithdrawaltickets($row->startwithdrawaltickets);
                    $agenda->setEndwithdrawaltickets($row->endwithdrawaltickets);
                    $agenda->setLoteinternet($row->loteinternet);
                endwhile;
            endif;
            return $agenda;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function getNextConcert() {
        $conn = connectionFactory::connection();
        $dataAtual = date("Y-m-d");
        $concerto = NULL;
        $resp = self::getNext1($conn, $dataAtual);
        if ($resp->rowCount() > 0):
            $concerto = self::convertMySqlToPHP1($resp);
        endif;
        return $concerto;
    }

//    public static function getConcertForTicket($id_concert) {
//        $conn = connectionFactory::Connection();
//        
//    }

    public static function getConcert() {
        $conn = connectionFactory::Connection();
        $dataAtual = date("Y-m-d");
        $resp = self::getNext($conn, $dataAtual);
        $agenda = new agenda();
        if ($resp->rowCount() > 0):
            $agenda = self::convertMySqlToPHP($resp);
        else:
            $resp = self::getPrevious($conn, $dataAtual);
            if ($resp->rowCount() > 0):
                $agenda = self::convertMySqlToPHP($resp);
            endif;
        endif;
        return $agenda;
    }

    static function getNext1($link, $today) {
        $resp = $link->query("SELECT idevento, dataevento FROM orquestrasinfo.agenda WHERE dataevento >= '$today'  ORDER BY dataevento limit 1;");
        return $resp;
    }

    static function getNext($link, $today) {
        $resp = $link->query("SELECT descricao, arquivo,hora, idevento, titulo,dataevento,temporada, resume, maestro, fotoconvidados, daysstartreserve, daysendreserve FROM orquestrasinfo.agenda WHERE dataevento >= '$today'  ORDER BY dataevento limit 1;");
        return $resp;
    }

    static function getPrevious($link, $today) {
        $resp = $link->query("SELECT descricao, arquivo,hora, idevento, titulo,dataevento,temporada, resume, maestro, fotoconvidados, daysstartreserve, daysendreserve FROM orquestrasinfo.agenda WHERE dataevento < '$today'  ORDER BY dataevento DESC limit 1;");
        return $resp;
    }

    static function convertMySqlToPHP1($result) {
        $agenda = new agenda();
        $obj = $result->fetch(PDO::FETCH_OBJ);
        $agenda->setDataevento($obj->dataevento);
        $agenda->setIdevento($obj->idevento);
        return $agenda;
    }

    static function convertMySqlToPHP($result) {
        $agenda = new agenda();
        $obj = $result->fetch(PDO::FETCH_OBJ);
        $agenda->setTitulo($obj->titulo);
        $agenda->setArquivo($obj->arquivo);
        $agenda->setDataevento($obj->dataevento);
        $agenda->setResume($obj->resume);
        $agenda->setMaestro($obj->maestro);
        $agenda->setIdevento($obj->idevento);
        $agenda->setTemporada($obj->temporada);
        $agenda->setHora($obj->hora);
        $agenda->setDescricao($obj->descricao);
        $agenda->setFotoconvidados($obj->fotoconvidados);
        $agenda->setDaysstartreserve($obj->daysstartreserve);
        $agenda->setDaysendreserve($obj->daysendreserve);
        return $agenda;
    }

    public static function getConcertsMonth() {
        $linkdb = connectionFactory::connection();
        $month = new DateTime();
        try {
            $resultproccess = $linkdb->query("SELECT idevento, dataevento, local, loteinternet FROM orquestrasinfo.agenda WHERE dataevento >= '" . $month->format("Y-m") . "-01' AND dataevento <= '" . $month->format("Y-m") . "-31'  ORDER BY dataevento ASC;");
            $concertosarray = array();
            while ($array_concerts = $resultproccess->fetch(PDO::FETCH_ASSOC)):
                $concerto = [
                    "idevento" => $array_concerts["idevento"],
                    "dataevento" => $array_concerts["dataevento"],
                    "local" => $array_concerts["local"],
                    "loteinternet"=>$array_concerts["loteinternet"]
                ];
                array_push($concertosarray, $concerto);
            endwhile;
            return $concertosarray;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public static function getConcerts() {
        $linkdb = connectionFactory::connection();
        $today = new DateTime();
        $today->add(new DateInterval('P8D'));
        try {
            $resultProccess = $linkdb->query("SELECT idevento, dataevento FROM orquestrasinfo.agenda WHERE dataevento <= '" . $today->format("Y-m-d") . "'  ORDER BY dataevento DESC;");
            $concertosarray = array();
            while ($array_concerts = $resultProccess->fetch(PDO::FETCH_ASSOC)):
                $concerto = [
                    "idevento" => $array_concerts["idevento"],
                    "dataevento" => $array_concerts["dataevento"]
                ];
                array_push($concertosarray, $concerto);
            endwhile;
            return $concertosarray;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

}
