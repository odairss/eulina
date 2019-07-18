<?php

/*
 * Autor: Odair Soares.
 * E-mail: odairsds@gmail.com
 * Cel.: 55 84 9467-9154
 */

/**
 * Description of ConvidadoDAO
 *
 * @author odair
 */
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["origem"])) {
    if ($_SESSION["origem"] == "osrn1") {
        include_once '../persistencia/connectionFactory.php';
        include_once '../model/convidado.php';
        include_once 'AgendaDAO.php';
        include_once 'seasonDAO.php';
    } elseif ($_SESSION["origem"] == 2) {
        include_once 'persistencia/connectionFactory.php';
        include_once 'model/convidado.php';
        include_once 'DAO/AgendaDAO.php';
        include_once 'DAO/seasonDAO.php';
        include_once 'model/season.php';
    }
}

class ConvidadoDAO {

    public static function criar(convidado $convidado) {
        $historico = addslashes($convidado->getHistorico());
        $resume = addslashes($convidado->getResume());
        $bio_en_us = addslashes($convidado->getBio_en_us());
        $res_en_us = addslashes($convidado->getRes_en_us());
        $nome = addslashes($convidado->getNome());
        $conexao = connectionFactory::connection();
        $conexao->beginTransaction();
        try {
            $stmt = $conexao->prepare("INSERT INTO orquestrasinfo.convidados "
                    . "(nome,id_evento,historico, bio_en_us, resume, res_en_us, "
                    . "foto, categ_musico, categ_en_us, country, sexo, dateinsert)"
                    . " VALUES(:name,:eventid,:historic,:bios_en,:resume,:resume_en,:photo,"
                    . ":category,:category_en,:country,:sexo,:dateinsert);");
            $stmt->bindValue(':name', $nome);
            $stmt->bindValue(':eventid', $convidado->getId_evento());
            $stmt->bindValue(':historic', $historico);
            $stmt->bindValue(':bios_en', $bio_en_us);
            $stmt->bindValue(':resume', $resume);
            $stmt->bindValue(':resume_en', $res_en_us);
            $stmt->bindValue(':photo', $convidado->getFoto());
            $stmt->bindValue(':category', $convidado->getCateg_musico());
            $stmt->bindValue(':category_en', $convidado->getCateg_en_us());
            $stmt->bindValue(':country', $convidado->getCountry());
            $stmt->bindValue(':sexo', $convidado->getSexo());
            $stmt->bindValue(':dateinsert', $convidado->getDateinsert());
            $result = $stmt->execute();
            $conexao->commit();
            return $result;
        } catch (Exception $exc) {
            $conexao->rollBack();
        }
    }

    public static function editar(convidado $convidado) {
        $conexao = connectionFactory::connection();
        $historico = addslashes($convidado->getHistorico());
        $resume = addslashes($convidado->getResume());
        $bio_en_us = addslashes($convidado->getBio_en_us());
        $res_en_us = addslashes($convidado->getRes_en_us());
        $nome = addslashes($convidado->getNome());
        $conexao->beginTransaction();
        try {
            $statement = $conexao->prepare("UPDATE orquestrasinfo.convidados  SET "
                    . "nome = :name, id_evento = :eventid, historico = :historic, "
                    . "bio_en_us = :bios_en, resume = :resume, res_en_us = :resume_en, "
                    . "foto = :photo, categ_musico = :category, "
                    . "categ_en_us = :category_en, country = :country, "
                    . "sexo = :sexo, dateinsert = :insertdate "
                    . "WHERE id_convidado = :guestid;");
            $result = $statement->execute();
            $conexao->commit();
            return $result;
        } catch (Exception $exc) {
            $conexao->rollBack();
        }
    }

    public static function buscar($id_convidado) {
        $conexao = connectionFactory::connection();
        try {
            $convidado = NULL;
            $resultProccess = $conexao->query("SELECT * FROM orquestrasinfo.convidados  WHERE id_convidado = $id_convidado;");
            if ($resultProccess->rowCount() == 1):
                while ($object_convidado = $resultProccess->fetch(PDO::FETCH_OBJ)):
                    $convidado = new convidado();
                    $convidado->setId_convidado($object_convidado->id_convidado);
                    $convidado->setNome($object_convidado->nome);
                    $convidado->setHistorico($object_convidado->historico);
                    $convidado->setBio_en_us($object_convidado->bio_en_us);
                    $convidado->setResume($object_convidado->resume);
                    $convidado->setRes_en_us($object_convidado->res_en_us);
                    $convidado->setId_evento($object_convidado->id_evento);
                    $convidado->setFoto($object_convidado->foto);
                    $convidado->setCateg_musico($object_convidado->categ_musico);
                    $convidado->setCateg_en_us($object_convidado->categ_en_us);
                    $convidado->setCountry($object_convidado->country);
                    $convidado->setSexo($object_convidado->sexo);
                    $convidado->setDateinsert($object_convidado->dateinsert);
                endwhile;
            endif;
            return $convidado;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public static function buscarConvidadoEvento($idevento) {
        $conexao = connectionFactory::connection();
        try {
            $proccessResult = $conexao->query("SELECT * FROM orquestrasinfo.convidados  WHERE id_evento = $idevento;");
            $arrayConvidado = array();
            $convidado = NULL;
            if ($proccessResult->rowCount() > 0):
                while ($object_convidado = $proccessResult->fetch(PDO::FETCH_OBJ)):
                    $convidado = new convidado();
                    $convidado->setId_convidado($object_convidado->id_convidado);
                    $convidado->setNome($object_convidado->nome);
                    $convidado->setHistorico($object_convidado->historico);
                    $convidado->setBio_en_us($object_convidado->bio_en_us);
                    $convidado->setRes_en_us($object_convidado->res_en_us);
                    $convidado->setResume($object_convidado->resume);
                    $convidado->setId_evento($object_convidado->id_evento);
                    $convidado->setFoto($object_convidado->foto);
                    $convidado->setCateg_musico($object_convidado->categ_musico);
                    $convidado->setCateg_en_us($object_convidado->categ_en_us);
                    $convidado->setCountry($object_convidado->country);
                    $convidado->setSexo($object_convidado->sexo);
                    array_push($arrayConvidado, $convidado);
                endwhile;
            endif;
            return $arrayConvidado;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public static function buscarTodos() {
        $conexao = connectionFactory::connection();
        try {
            $processResult = $conexao->query("SELECT * FROM orquestrasinfo.convidados ORDER BY id_convidado DESC;");
            $convidados = array();
            if ($processResult->rowCount() > 0):
                while ($array_convidados = $processResult->fetch(PDO::FETCH_ASSOC)):
                    $convidado = new convidado();
                    $convidado->setId_convidado($array_convidados["id_convidado"]);
                    $convidado->setNome($array_convidados["nome"]);
                    $convidado->setHistorico($array_convidados["historico"]);
                    $convidado->setBio_en_us($array_convidados["bio_en_us"]);
                    $convidado->setResume($array_convidados["resume"]);
                    $convidado->setRes_en_us($array_convidados["res_en_us"]);
                    $convidado->setId_evento($array_convidados["id_evento"]);
                    $convidado->setFoto($array_convidados["foto"]);
                    $convidado->setCateg_musico($array_convidados["categ_musico"]);
                    $convidado->setCateg_en_us($array_convidados["categ_en_us"]);
                    $convidado->setCountry($array_convidados["country"]);
                    $convidado->setSexo($array_convidados["sexo"]);
                    array_push($convidados, $convidado);
                endwhile;
            endif;
            return $convidados;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    static function concertsSeason(season $seasonCurrent) {
        $concerts_season = array();
        if (is_null($seasonCurrent)):
            return $concerts_season;
        else:
            $concerts_season = AgendaDAO::listToSeason($seasonCurrent->getId_season());
        endif;
        return $concerts_season;
    }

    static function inviteesConcerts(season $season_current) {
        $concerts = self::concertsSeason($season_current);
        $concerto = new agenda();
        $invitees_concerts = array();
        if (count($concerts) > 0):
            foreach ($concerts as $values):
                $concerto = $values;
                $temp_invitees = self::invitees($concerto->getIdevento());
                if (count($temp_invitees) > 0):
                    foreach ($temp_invitees as $inv):
                        array_push($invitees_concerts, $inv);
                    endforeach;
                endif;
            endforeach;
        else:
            return $invitees_concerts;
        endif;
        return $invitees_concerts;
    }

//método invitees retorna um array com todos os convidados do concerto indicado pela variável $idconcert;
    static function invitees($idconcert) {
        $convidados = array();
        $connection = connectionFactory::connection();
        try {
            $proccessStatement = $connection->query("SELECT nome,resume,country, id_evento,foto, "
                    . "id_convidado, dateinsert FROM orquestrasinfo.convidados "
                    . "WHERE id_evento = $idconcert ORDER BY id_convidado DESC;");
            if ($proccessStatement->rowCount() > 0):
                while ($conv = $proccessStatement->fetch(PDO::FETCH_OBJ)):
                    $convidado = new convidado();
                    $convidado->setNome($conv->nome);
                    $convidado->setResume($conv->resume);
                    $convidado->setCountry($conv->country);
                    $convidado->setId_evento($conv->id_evento);
                    $convidado->setFoto($conv->foto);
                    $convidado->setId_convidado($conv->id_convidado);
                    $convidado->setDateinsert($conv->dateinsert);
                    array_push($convidados, $convidado);
                endwhile;
            endif;
            return $convidados;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public static function feed_update() {
        $corpo = "";
        $season = seasonDAO::getSeason(date("Y"));
        $convid = new convidado();
        $convids = self::inviteesConcerts($season);
        foreach ($convids as $conv_object) {
            $convid = $conv_object;
            $dateinsert = new DateTime($convid->getDateinsert());
            $month = self::getMonth($convid->getId_evento());
            $resume = strip_tags($convid->getResume());
            $resume = str_replace("&", "&amp;", $resume);
            $resume = str_replace("<", "&lt;", $resume);
            $resume = str_replace(">", "&gt;", $resume);
            $foto = "http://www.orquestrasinfonicadorn.com.br/";
            $foto .= substr($convid->getFoto(), 3);
            $corpo .= '<item>';
            $corpo .= '<pubDate>' . $dateinsert->format('D, d M Y H:i:s') . ' GMT</pubDate>';
            $corpo .= '<title>' . $convid->getNome() . ' (' . $convid->getCountry() . '), convidado de ' . $month . ' da  Temporada ' . $season->getAno() . ' da OSRN</title>';
            $corpo .= '<description>&lt;div id="foto"&gt; &lt;img src="' . $foto . '" width="144px"/&gt; &lt;/div&gt; &lt;div id="descr"&gt;' . $resume . '&lt;/div&gt;</description>';
            $corpo .= '<link>http://www.orquestrasinfonicadorn.com.br/index.php?ctd=17&amp;id_convidado=' . $convid->getId_convidado() . '</link>';
            $corpo .= '<guid isPermaLink="true">http://www.orquestrasinfonicadorn.com.br/index.php?ctd=17&amp;id_convidado=' . $convid->getId_convidado() . '</guid>';
            $corpo .= '<author>orquestrasinfonicarn@gmail.com (OSRN)</author>';
            $corpo .= '</item>';
        }
        return $corpo;
    }

    static function getMonth($idevento) {
        $date = AgendaDAO::getDate($idevento);
        $arrayDate = explode("/", $date);
        $mes = $arrayDate[1];
        switch ($mes) {
            case "12":
                return 'dezembro';
                break;
            case "11":
                return 'novembro';
                break;
            case "10":
                return 'outubro';
                break;
            case "09":
                return 'setembro';
                break;
            case "08":
                return 'agosto';
                break;
            case "07":
                return 'julho';
                break;
            case "06":
                return 'junho';
                break;
            case "05":
                return 'maio';
                break;
            case "04":
                return 'abril';
                break;
            case "03":
                return 'março';
                break;
            case "02":
                return 'fevereiro';
                break;
            case "01":
                return 'janeiro';
                break;
            default :
                break;
        }
    }

}
