<?php

//MOSTRANDO POSSÍVEIS ERROS
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);


//CONECTANDO AO BANCO DE DADOS
$db_host = "localhost";
$db_name = "orquestrasinfo";
//    $db_user = "orquestrasinfo";
//    $db_password = "bd_osrn#93%0";
$db_user = "root";
$db_password = "RdIgL31/17:03&27";
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


//REALIZANDO CONSULTA NO BANCO DE DADOS

if ($connection != NULL):
    $ingressos = array();
    try {
        $processResult = $connection->query("SELECT name, cpf FROM orquestrasinfo.backupingressos WHERE idconcert = 41 ORDER BY name;");
        if ($processResult->rowCount() > 0):
            while ($row = $processResult->fetch(PDO::FETCH_ASSOC)):
                $ingresso = [
                    "name" => $row["name"],
                    "cpf" => $row["cpf"]
                ];
                array_push($ingressos, $ingresso);
            endwhile;
        endif;
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
else:
    echo 'ERRO DE CONEXÃO COM O BANCO DE DADOS';
endif;


//LISTANDO DADOS

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
        <img src="img/logos/fundacao.jpg" style="max-width: 150px"/>
        <img src="img/logos/governorn.png" style="max-width: 200px"/>
        <hr/>
        <h2>Orquestra Sinf&ocirc;nica do Rio Grande do Norte</h2>
        <p>' . date("d/m/Y H:i:s") . '</p>';


if ($connection != NULL):
    $agenda = array();
    try {
        $processResult = $connection->query("SELECT titulo, dataevento, local FROM orquestrasinfo.agenda WHERE idevento = 41;");
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
else:
    echo 'ERRO DE CONEXÃO COM O BANCO DE DADOS';
endif;

$concert = $agenda;
if ($concert != NULL):
    if (count($concert) > 0):
        $stringHtml .= '<p>Lista de pessoas que reservaram ingressos para o<br/>' . $concert["titulo"] . ',<br/>no ' . $concert["local"] . ' dia ' . $concert["dataevento"] . '</p>
        <table>
            <thead>
                <tr class="linhas">
                    <th>N&deg;</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <TH class="assinatura">Assinatura</TH>
                </tr>
            </thead>
            <tbody>';
    else:
        $stringHtml = 'Não existem ingressos reservados para este concerto!';
    endif;
else:
    $stringHtml = 'Erro de conexão com o banco de dados!';
endif;


if (count($ingressos) > 0):
    $i = 1;
    foreach ($ingressos as $ticket):
        $nameuppercase = strtoupper($ticket["name"]);
        $stringHtml .= '<tr class="linhas">
                    <td>' . $i . '</td>
                    <td>' . $nameuppercase . '</td>
                    <td>' . $ticket["cpf"] . '</td>
                    <td class="assinatura"> </td>
                    </tr>';
        $i ++;
    endforeach;
else:
    $stringHtml .= 'Não existem ingressos reservados para este concerto!';
endif;

$stringHtml .=
        ' </tbody>
        </table>
        </div>
    </body>
</html>';

echo $stringHtml;
