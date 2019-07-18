<?php

/*
 * Autor: Odair Soares.
 * E-mail: odairsds@gmail.com
 * Cel.: 55 84 9467-9154
 */

/**
 * Description of controlMusicos
 *
 * @author odair
 */

class controlMusicos {

    public static function start() {
        $opc = $_POST["opc"];
        switch ($opc) {
            case 1:
                self::criarMusico();
                break;
            case 2:
                self::editMusico();
                break;
        }
    }

    public static function criarMusico() {
        $musico = new musico();
        $name_file = "";
        if (empty($_FILES["foto"])) {
            $name_file = self::uploadFileMusico();
        }
        $musico->setNome($_POST["nome"]);
        $musico->setEmail($_POST["email"]);
        $musico->setTelefone($_POST["telefone"]);
        $musico->setCategoria($_POST["categoria"]);
        $musico->setHistorico($_POST["historico"]);
        $musico->setImg($name_file);
        $musico->setInstrumento($_POST["instrumento"]);
        if (MusicoDAO::criar($musico)) {
            header("Location:../view/osrnAdmin.php?ctd_admin=musico&action=1&rst=1");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=musico&action=1&rst=0");
        }
    }

    public static function editMusico() {
        $musico = new musico();
        $musico->setNome($_POST["nome"]);
        $musico->setEmail($_POST["email"]);
        $musico->setTelefone($_POST["telefone"]);
        $musico->setCategoria($_POST["categoria"]);
        $musico->setHistorico($_POST["historico"]);
        $musico->setImg($_POST["img"]);
        $musico->setInstrumento($_POST["instrumento"]);
        $musico->setId_musico($_POST["id_musico"]);
        if (MusicoDAO::editar($musico)) {
            header("Location:../view/osrnAdmin.php?ctd_admin=musico&action=2&rst=1");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=musico&action=2&rst=0");
        }
    }

    public static function uploadFileMusico() {
        if (isset($_FILES["foto"])) {//se existir o arquivo
            $arquivo = $_FILES["foto"];
            $pasta_dir = "../files/musicos/"; //diretorio dos arquivos
            if (!file_exists($pasta_dir)) {//se nao existir a pasta ele cria uma
                mkdir($pasta_dir);
            }
            $arquivo_nome = $pasta_dir . $arquivo["name"];
            move_uploaded_file($arquivo["tmp_name"], $arquivo_nome); // Faz o upload da imagem
            return $arquivo_nome;
        }
    }

}

include_once '../DAO/MusicoDAO.php';
include_once '../model/musico.php';

controlMusicos::start();
