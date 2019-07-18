<?php

session_start();
$n = "";
$qt = "";
include_once '../persistencia/connectionFactory.php';
include_once '../model/agenda.php';
$connection = connectionFactory::connection();

if (empty($_GET['data'])) {//navegação entre os meses
    date_default_timezone_set('America/Fortaleza');
    $dia = date('d');
    $month = date('m');
    $ano = date('Y');
} else {
    $data = explode('/', $_GET['data']); //nova data
    $dia = $data[0];
    $month = $data[1];
    $ano = $data[2];
}
if ($month == 1) {//mês anterior se janeiro mudar valor
    $mes_ant = 12;
    $ano_ant = $ano - 1;
} else {
    $mes_ant = $month - 1;
    $ano_ant = $ano;
}
if ($month == 12) {//proximo mês se dezembro tem que mudar
    $mes_prox = 1;
    $ano_prox = $ano + 1;
} else {
    $mes_prox = $month + 1;
    $ano_prox = $ano;
}
//if (($dia >= 1) && ($dia <= 9)) {
//    $dia = "0" . $dia;
//}
if (($mes_ant >= 1) && ($mes_ant <= 9)) {
    $mes_ant = "0" . $mes_ant;
}
if (($mes_prox >= 1) && ($mes_prox <= 9)) {
    $mes_prox = "0" . $mes_prox;
}
$display_string = $dia . "/" . $mes_ant . "/" . $ano_ant;

$display_string .= $dia . "/" . $mes_prox . "/" . $ano_prox;

$hoje = date('j'); //função importante pego o dia corrente
if (isset($_SESSION["language"])):
    if ($_SESSION["language"] == "pt"):
        switch ($month . $n) {/* notem duas variaveis para o switch para identificar dia e limitar numero de dias */
            case 1:
                $mes = "JANEIRO";
                $n = 31;
                break;
            case 2:
                $mes = "FEVEREIRO"; // todo ano bixesto fev tem 29 dias
                $bi = $ano % 4; //anos multiplos de 4 são bixestos
                if ($bi == 0) {
                    $n = 29;
                } else {
                    $n = 28;
                }
                break;
            case 3:
                $mes = "MAR&Ccedil;O";
                $n = 31;
                break;
            case 4:
                $mes = "ABRIL";
                $n = 30;
                break;
            case 5:
                $mes = "MAIO";
                $n = 31;
                break;
            case 6:
                $mes = "JUNHO";
                $n = 30;
                break;
            case 7:
                $mes = "JULHO";
                $n = 31;
                break;
            case 8:
                $mes = "AGOSTO";
                $n = 31;
                break;
            case 9:
                $mes = "SETEMBRO";
                $n = 30;
                break;
            case 10:
                $mes = "OUTUBRO";
                $n = 31;
                break;
            case 11:
                $mes = "NOVEMBRO";
                $n = 30;
                break;
            case 12:
                $mes = "DEZEMBRO";
                $n = 31;
                break;
        }
        $display_string .= "<h4>" . $mes . "/" . $ano . "</h4>";
    else:
        switch ($month . $n) {/* notem duas variaveis para o switch para identificar dia e limitar numero de dias */
            case 1:
                $mes = "JANUARY";
                $n = 31;
                break;
            case 2:
                $mes = "FEBRUARY"; // todo ano bixesto fev tem 29 dias
                $bi = $ano % 4; //anos multiplos de 4 são bixestos
                if ($bi == 0) {
                    $n = 29;
                } else {
                    $n = 28;
                }
                break;
            case 3:
                $mes = "MARCH";
                $n = 31;
                break;
            case 4:
                $mes = "APRIL";
                $n = 30;
                break;
            case 5:
                $mes = "MAY";
                $n = 31;
                break;
            case 6:
                $mes = "JUNE";
                $n = 30;
                break;
            case 7:
                $mes = "JULY";
                $n = 31;
                break;
            case 8:
                $mes = "AUGUST";
                $n = 31;
                break;
            case 9:
                $mes = "SEPTEMBER";
                $n = 30;
                break;
            case 10:
                $mes = "OCTOBER";
                $n = 31;
                break;
            case 11:
                $mes = "NOVEMBER";
                $n = 30;
                break;
            case 12:
                $mes = "DECEMBER";
                $n = 31;
                break;
        }
        $display_string .= "<h4>" . $mes . " " . $ano . "</h4>";
    endif;
else:
    switch ($month . $n) {/* notem duas variaveis para o switch para identificar dia e limitar numero de dias */
        case 1:
            $mes = "JANEIRO";
            $n = 31;
            break;
        case 2:
            $mes = "FEVEREIRO"; // todo ano bixesto fev tem 29 dias
            $bi = $ano % 4; //anos multiplos de 4 são bixestos
            if ($bi == 0) {
                $n = 29;
            } else {
                $n = 28;
            }
            break;
        case 3:
            $mes = "MAR&Ccedil;O";
            $n = 31;
            break;
        case 4:
            $mes = "ABRIL";
            $n = 30;
            break;
        case 5:
            $mes = "MAIO";
            $n = 31;
            break;
        case 6:
            $mes = "JUNHO";
            $n = 30;
            break;
        case 7:
            $mes = "JULHO";
            $n = 31;
            break;
        case 8:
            $mes = "AGOSTO";
            $n = 31;
            break;
        case 9:
            $mes = "SETEMBRO";
            $n = 30;
            break;
        case 10:
            $mes = "OUTUBRO";
            $n = 31;
            break;
        case 11:
            $mes = "NOVEMBRO";
            $n = 30;
            break;
        case 12:
            $mes = "DEZEMBRO";
            $n = 31;
            break;
    }
    $display_string .= "<h4>" . $mes . "/" . $ano . "</h4>";
endif;

$pdianu = mktime(0, 0, 0, $month, 1, $ano); //primeiros dias do mes
$dialet = date('D', $pdianu); //escolhe pelo dia da semana
switch ($dialet) {//verifica que dia cai
    case "Sun":
        $branco = 0;
        break;
    case "Mon":
        $branco = 1;
        break;
    case "Tue":
        $branco = 2;
        break;
    case "Wed":
        $branco = 3;
        break;
    case "Thu":
        $branco = 4;
        break;
    case "Fri":
        $branco = 5;
        break;
    case "Sat":
        $branco = 6;
        break;
}

$display_string .= "<table class = \"table\">"
        . "<tr><td><b>D</b></td><td>"
        . "<b>S</b></td><td><b>T</b></td><td><b>Q</b></td>"
        . "<td><b>Q</b></td><td><b>S</b></td><td><b>S</b>"
        . "</td></tr><tr>";
$dt = 1;
/* * Estrutura condicional (if) para pular os dias da semana que não fazem parte do corrente mês. * */
if ($branco > 0) {
    for ($x = 0; $x < $branco; $x++) {
        $display_string .= "<td>&nbsp;</td>";
        $dt++;
    }
}
/** Laço de repetição para mostrar dentro do calendário os dias em que ocorrerão concertos.* */
for ($i = 1; $i <= $n; $i++):
    $dtevento = $ano . "-" . $month . "-" . $i;

    $resultproccess = $connection->query("SELECT * FROM orquestrasinfo.agenda WHERE dataevento = '$dtevento';");
    if ($resultproccess->rowCount() > 0):
        $object_event = $resultproccess->fetch(PDO::FETCH_OBJ);
        $concerto = new agenda();
        $concerto->setTitulo($object_event->titulo);
        $concerto->setDataevento($object_event->dataevento);
        $display_string .= '<td class="evt">'
                . '<form name="evento' . $i . '">'
                . '<input id="button-event" type="button" name="btn_evento" onclick="listarEventos(\'' . $concerto->getDataevento() . '\');" value="' . $i . '"/>'
                . '</form>'
                . '</td>';
        $dt++;
        $qt++;
    elseif ($i == $hoje):
        $mes_atual = date("m");
        $ano_atual = date("Y");
        if (($month == $mes_atual) && ($ano_atual == $ano)):
            $display_string .= "<td class=\"hj\">$i</td>";
        else:
            $display_string .= "<td>$i</td>";
        endif;
        $dt++;
    else:
        $display_string .= "<td>$i</td>";
        $dt++;
    endif;

    if ($dt > 7):
        $display_string .= "</tr><tr>";
        $dt = 1;
    endif;
endfor;
$display_string .= "</tr></table>";
if ($qt > 0):
    if (isset($_SESSION["language"])):
        if ($_SESSION["language"] == "pt"):
            $display_string .= "Temos $qt evento(s) em " . strtolower($mes) . "!<br/>"; /* mudar para caixa baixa as letras do mes */
        else:
            $display_string .= "We have $qt event(s) in " . strtolower($mes) . "!<br/>"; /* mudar para caixa baixa as letras do mes */
        endif;
    else:
        $display_string .= "Temos $qt evento(s) em " . strtolower($mes) . "!<br/>"; /* mudar para caixa baixa as letras do mes */
    endif;
endif;
echo $display_string;
