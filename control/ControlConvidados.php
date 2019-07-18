<?php

/*
 * Autor: Odair Soares.
 * E-mail: odairsds@gmail.com
 * Cel.: 55 84 9467-9154
 */

/**
 * Description of ControlConvidados
 *
 * @author odair
 */
date_default_timezone_set('America/Sao_Paulo');

class ControlConvidados {

    public static function start() {
        $opc = $_POST["opc"];
        switch ($opc) {
            case 1:
                self::criarConvidado();
                break;
            case 2:
                self::editConvidado();
                break;
        }
    }

    public static function criarConvidado() {
        $convidado = new convidado();
        $datetime = new DateTime();
        $name_file = "";
        if (!empty($_FILES["foto"])) {
            $name_file = self::uploadFileConvidado();
        }
        $convidado->setDateinsert($datetime->format("Y-m-d H:i:s"));
        $convidado->setNome($_POST["nome"]);
        $convidado->setId_evento($_POST["id_evento"]);
        $convidado->setHistorico($_POST["historico"]);
        $convidado->setBio_en_us($_POST["bio_en_us"]);
        $convidado->setResume($_POST["resume"]);
        $convidado->setRes_en_us($_POST["res_en_us"]);
        $convidado->setFoto($name_file);
        $convidado->setCateg_musico($_POST["categ_musico"]);
        $convidado->setCateg_en_us($_POST["categ_en_us"]);
        $convidado->setCountry($_POST["country"]);
        $convidado->setSexo($_POST["sexo"]);
        if (ConvidadoDAO::criar($convidado)) {
//            self::atualizar_feed();
            header("Location:../view/osrnAdmin.php?ctd_admin=convidado&action=1&rst=1");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=convidado&action=1&rst=0");
        }
    }

    public static function editConvidado() {
        $convidado = new convidado();
        $convidado->setNome($_POST["nome"]);
        $convidado->setId_evento($_POST["id_evento"]);
        $convidado->setHistorico($_POST["historico"]);
        $convidado->setBio_en_us($_POST["bio_en_us"]);
        $convidado->setResume($_POST["resume"]);
        $convidado->setRes_en_us($_POST["res_en_us"]);
        $convidado->setFoto($_POST["foto"]);
        $convidado->setCateg_musico($_POST["categ_musico"]);
        $convidado->setCateg_en_us($_POST["categ_en_us"]);
        $convidado->setId_convidado($_POST["id_convidado"]);
        $convidado->setCountry($_POST["country"]);
        $convidado->setSexo($_POST["sexo"]);
        if (ConvidadoDAO::editar($convidado)) {
            header("Location:../view/osrnAdmin.php?ctd_admin=convidado&action=2&rst=1");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=convidado&action=2&rst=0");
        }
    }

    public static function uploadFileConvidado() {
        if (isset($_FILES["foto"])) {//se existir o arquivo
            $arquivo = $_FILES["foto"];
            $pasta_dir = "../img/convidados/"; //diretorio dos arquivos
            if (!file_exists($pasta_dir)) {//se nao existir a pasta ele cria uma
                mkdir($pasta_dir);
            }
            $arquivo_nome = $pasta_dir . $arquivo["name"];
            move_uploaded_file($arquivo["tmp_name"], $arquivo_nome); // Faz o upload da imagem
            return $arquivo_nome;
        }
    }

    public static function atualizar_feed() {
        $arquivo = '<?xml version="1.0" encoding="UTF-8"?>';
        $arquivo .= '<rss version="2.0">';
        $arquivo .= '<channel>';
        $arquivo .= '<title>Orquestra Sinfônica do  Rio Grande do Norte</title>';
        $arquivo .= '<description>Últimas novidades e notícias sobre os convidados, concertos e agenda da OSRN</description>';
        $arquivo .= '<managingEditor>osrn@hotmail.com</managingEditor>';
        $arquivo .= '<webMaster>odairsds@gmail.com</webMaster>';
        $arquivo .= '<pubDate>Sat, 09 Mar 2015 14:30 GMT</pubDate>';
        $dateAndtTime = date('D, d M Y H:i:s');
        $arquivo .= '<lastBuildDate>' . $dateAndtTime . ' GMT</lastBuildDate>';
        $arquivo .= '<docs>http://cyber.law.harvard.edu/rss/rss.html</docs>';
        $arquivo .= '<link>http://www.orquestrasinfonicadorn.com.br/index.php</link>';
        $arquivo .= '<language>pt-BR</language>';
        $arquivo .= '<image>';
        $arquivo .= '<url>http://www.orquestrasinfonicadorn.com.br/img/logos/logoosrn.png</url>';
        $arquivo .= '<title>Orquestra Sinfônica do  Rio Grande do Norte</title>';
        $arquivo .= '<link>http://www.orquestrasinfonicadorn.com.br/index.php</link>';
        $arquivo .= '</image>';
        $corpo = ConvidadoDAO::feed_update();
        $rss = $arquivo . $corpo;
        $rss .= '</channel></rss>';
        $arq = fopen("../rss/news_osrn.rss", "w+");
        fwrite($arq, $rss);
        fclose($arq);
    }

}
include_once '../DAO/ConvidadoDAO.php';
include_once '../model/convidado.php';

ControlConvidados::start();
