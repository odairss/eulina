<?php

date_default_timezone_set('America/Fortaleza');
$today = date("d/m/Y H:i:s");
$idconcert = 0;
if (isset($_GET["idconcert"])):
    $idconcert = $_GET["idconcert"];
endif;

$stringHtml = '
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
        <style>
body{
text-align: center;
}
table{
width: 100%;
font-size: 15px;
}
table tr{
border: 1px solid black;
padding-top: 10px;
padding-bottom: 10px;
margin: 0;
text-align: center;
}
table tr td, table tr th{
border: 1px solid black;
padding-top: 10px;
padding-bottom: 10px;
}
.assinatura{
width: 400px;
}
</style>
    </head>
    <title>
        Ingressos reservados
    </title>
    <body>
    <div>
        <img src="../img/logos/fundacao.jpg" style="max-width: 150px"/>
        <img src="../img/logos/bn-logo-gov-rn.png" style="max-width: 200px"/>
        <hr/>
        <h2>Orquestra Sinf&ocirc;nica do Rio Grande do Norte</h2>
        <p>' . $today . '</p>';
$concert = getNameConcert($idconcert);
if (count($concert) > 0):
    $stringHtml .= '<p>Lista de pessoas que reservaram ingressos para o<br/>' . $concert["titulo"] . ',<br/>no ' . $concert["local"] . ' dia ' . $concert["dataevento"] . '</p>';
else:
    $stringHtml .= '<p>N&atilde;o existem ingressos reservados para este concerto!</p>';
endif;

$stringHtml .= '<table>
            <thead>
                <tr class="linhas">
                    <th>N&deg;</th>
                    <th>Nome</th>
                    <th>WhatsApp</th>
                </tr>
            </thead>
            <tbody>';

$ingressos = buscarTodos($idconcert);
if (count($ingressos) > 0):
    $i = 1;
    foreach ($ingressos as $ticket):
        $nameuppercase = strtoupper($ticket["name"]);
        $stringHtml .= '<tr class="linhas">
                    <td>' . $i . '</td>
                    <td>' . $nameuppercase . '</td>
                    <td>' . $ticket["telefone"] . '</td>
                    </tr>';
        $i ++;
    endforeach;
else:
    $stringHtml .= '<tr class="linhas"><td colspan="4">N&atilde;o existem ingressos reservados para este concerto!</td></tr>';
endif;


$stringHtml .=
        ' </tbody>
        </table>
        </div>
    </body>
</html>';

require_once '../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236], 'tempDir' => __DIR__ . '/tmp']);


$mpdf->WriteHTML($stringHtml);
$mpdf->simpleTables = true;
// Output a PDF file directly to the browser
$mpdf->Output();

function getNameConcert($idevento) {
    $connection = createConnection();
    $agenda = array();
    if ($connection != NULL):
        try {
            $processResult = $connection->query("SELECT titulo, dataevento, local FROM orquestrasinfo.agenda WHERE idevento = $idevento;");
            if ($processResult->rowCount() > 0):
                $obj_agenda = $processResult->fetch(PDO::FETCH_OBJ);
                $dataevento = implode("/", array_reverse(explode("-", $obj_agenda->dataevento)));
                $agenda = [
                    "dataevento" => $dataevento,
                    "titulo" => $obj_agenda->titulo,
                    "local" => $obj_agenda->local
                ];
            endif;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    endif;
    return $agenda;
}

function createConnection() {
    $db_host = "localhost";
    $db_name = "orquestrasinfo";
    $db_user = "orquestrasinfo";
    $db_password = "bd_osrn#93%0";
//    $db_user = "root";
//    $db_password = "RdIgL31/17:03&27";
    $db_driver = "mysql";
    $title_system = "OSRN";
    $email_system = "odairsds@gmail.com";
    $connection = NULL;
    try {
        $connection = new PDO("$db_driver:host=$db_host;dbname=$db_name", $db_user, $db_password, array(PDO::ATTR_PERSISTENT => true));
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec("SET NAMES utf8");
    } catch (PDOException $e) {
        mail($email_system, "PDOException em $title_system", $e->getMessage());
        die("Connection Error: " . $e->getMessage());
    }
    return $connection;
}

function buscarTodos($idconcert) {
    $connection = createConnection();
    $ingressos = array();
    if ($connection != NULL):
        try {
            $processResult = $connection->query("SELECT name, telefone FROM orquestrasinfo.ingressos WHERE idconcert = $idconcert ORDER BY name;");
            if ($processResult->rowCount() > 0):
                while ($row = $processResult->fetch(PDO::FETCH_ASSOC)):
                    $ingresso = [
                        "name" => $row["name"],
                        "telefone" => $row["telefone"]
                    ];
                    array_push($ingressos, $ingresso);
                endwhile;
            endif;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    endif;
    return $ingressos;
}
