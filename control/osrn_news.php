<?php

include '../persistencia/connectionFactory.php';
$arquivo = '<?xml version="1.0" encoding="UTF-8"?>';
$arquivo .= '<rss version="0.91">';
$arquivo .= '<channel>';
$arquivo .= '<title>OSRN News</title>';
$arquivo .= '<description>Orquestra Sinfônica do  Rio grande do Norte</description>';
$arquivo .= '<link>http://www.orquestrasinfonicadorn.com.br/index.php</link>';
$arquivo .= '<language>pt-BR</language>';
$connection = connectionFactory::createConnection();
$sql = "SELECT * FROM orquestrasinfo.convidados ORDER BY nome DESC LIMIT 4";
$result = mysqli_query($connection, $sql);
$corpo = "";
while ($conv = mysqli_fetch_object($result)) {
    $corpo .= '<item>';
    $corpo .= '<title>Convidado OSRN temporada 2015</title>';
    $corpo .= '<description>' . $conv->nome . '</description>';
    $corpo .= '<link>http://www.orquestrasinfonicadorn.com.br/index.php?ctd=12</link>';
    $corpo .= '</item>';
}
$rss = $arquivo . $corpo;
$rss .= '</channel></rss>';
$arq = fopen("../rss/news_osrn.rss", "w+");
fwrite($arq, $rss);
fclose($arq);
//http://www.orquestrasinfonicadorn.com.br/index.php?ctd=17&id_convidado=1