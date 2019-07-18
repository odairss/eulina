<?php
session_start();
include_once '../persistencia/connectionFactory.php';
//include_once '../model/agenda.php';
if (isset($_GET['d'])) {
    $connection = connectionFactory::connection();
    try {
        $idev = $_GET['d'];
        $sql_result = $connection->query("SELECT * FROM orquestrasinfo.agenda WHERE dataevento = '$idev' ORDER BY hora ASC");
        $string_eventos = "<div class=\"evento\">";
        if (isset($_SESSION["language"])):
            if ($_SESSION["language"] == "pt"):
                while ($array_events = $sql_result->fetch(PDO::FETCH_ASSOC)) {
                    $dataevento = implode("/", array_reverse(explode("-", $array_events["dataevento"])));
                    $string_eventos .= "<p><a href=\"index.php?ctd=2&id_concert=" . $array_events['idevento'] . "\" target=\"_self\">" . $array_events["titulo"] . "</a><br/>";
                    $string_eventos .= "<strong>Data: </strong>" . $dataevento . "<br/>";
                    $string_eventos .= "<strong>Hora: </strong>" . $array_events["hora"] . "hs.<br/>";
                    $string_eventos .= "<strong>Local: </strong>" . $array_events["local"] . "</p>";
                }
            else:
                while ($array_events = $sql_result->fetch(PDO::FETCH_ASSOC)) {
                    $dataevento = new DateTime($array_events["dataevento"]);
                    $dateTime = new DateTime($array_events["dataevento"] . " " . $array_events["hora"]);
                    $string_eventos .= "<p><a href=\"index.php?ctd=2&id_concert=" . $array_events['idevento'] . "\" target=\"_self\">" . $array_events["titulo"] . "</a><br/>";
                    $string_eventos .= "<strong>Date: </strong>" . $dataevento->format("F d, Y") . "<br/>";
                    $string_eventos .= "<strong>Time: </strong>" . $dateTime->format("h:i a") . "<br/>";
                    $string_eventos .= "<strong>Place: </strong>" . $array_events["local"] . "</p>";
                }
            endif;
        else:
            while ($array_events = $sql_result->fetch(PDO::FETCH_ASSOC)) {
                $dataevento = implode("/", array_reverse(explode("-", $array_events["dataevento"])));
                $string_eventos .= "<p><a href=\"index.php?ctd=2&id_concert=" . $array_events['idevento'] . "\" target=\"_self\">" . $array_events["titulo"] . "</a><br/>";
                $string_eventos .= "<strong>Data: </strong>" . $dataevento . "<br/>";
                $string_eventos .= "<strong>Hora: </strong>" . $array_events["hora"] . "hs.<br/>";
                $string_eventos .= "<strong>Local: </strong>" . $array_events["local"] . "</p>";
            }
        endif;
        $string_eventos .= "</div>";
        echo $string_eventos;
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
}
