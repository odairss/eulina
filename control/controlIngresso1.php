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
$_SESSION["origem"] = "osrn1";

include_once '../DAO/ingressoDAO1.php';
include_once '../DAO/ingressoDAO.php';
include_once '../model/ingresso.php';
define("VERIFICADOR", 11);

class controlIngresso {

    public static function start() {

        $opc = $_POST["opc"];
        switch ($opc) {
            case 1:
                self::validaCpf();
                break;
            case 2:
                self::editIngresso();
                break;
        }
    }

    static function insertIngresso() {
        $ingresso = new ingresso();
        $ingresso->setName($_POST["name"]);
        $ingresso->setEmail($_POST["email"]);
        $ingresso->setTelefone($_POST["telefone"]);
        $ingresso->setCpf($_POST["cpf"]);
        $ingresso->setDataIngresso($_POST["currentDate"]);
        $ingresso->setIdConcert($_POST["idconcert"]);
        $result = ingressoDAO1::criar($ingresso);
        if ($result == 'success') {
            header("Location:../index.php?ctd=10&rst=success");
        } elseif ($result == 'dennied') {
            header("Location:../index.php?ctd=10&rst=dennied");
        }
    }

    static function validaCpf() {
        $cpf = $_POST["cpf"];
        if (is_numeric($cpf)):
            $datebegin = $_POST["date_begin"];
            $dateend = $_POST["date_end"];
            $checked_cpf = ingressoDAO::checkIfExists($cpf, $datebegin, $dateend);
            if ($checked_cpf):
                $cpf_verify = "";
                $array_verify = array();
                $array_verify = self::firstDigit($cpf);
                $cpf_verify = self::secondDigit($array_verify);
                if ($cpf == $cpf_verify):
                    self::insertIngresso();
                else:
                    header("Location:../index.php?ctd=10&rst=invalidCpf");
                endif;
            else:
                header("Location:../index.php?ctd=10&rst=arealdyExists");
            endif;

        else:
            header("Location:../index.php?ctd=10&rst=invalidCharCpf");
        endif;
    }

    static function firstDigit($cpf) {
        $array_cpf = str_split($cpf);
        $array_cpf_verif = array();
        $i = 0;
        $j = 0;
        for ($i = 0; $i <= 8; $i ++):
            array_push($array_cpf_verif, $array_cpf[$i]);
        endfor;
        $array_auxiliar = [10, 9, 8, 7, 6, 5, 4, 3, 2];
        $array_sum = array();
        for ($i = 0, $j = 0; $i <= 8, $j <= 8; $i++, $j ++):
            array_push($array_sum, $array_cpf[$i] * $array_auxiliar[$j]);
        endfor;
        $sum = array_sum($array_sum);
        $temp = (string) $sum / VERIFICADOR;
        $resto = explode(".", $temp);
        $temp = substr($resto[1], 0, 1);
        $temp = $temp . ".";
        $temp = $temp . substr($resto[1], 1);
        $temp = ceil($temp);
        if ($temp >= 2):
            $digito = VERIFICADOR - $temp;
            array_push($array_cpf_verif, $digito);
        else:
            array_push($array_cpf_verif, 0);
        endif;

        return $array_cpf_verif;
    }

    static function secondDigit(array $array_verif) {
        $array_auxiliar2 = [11, 10, 9, 8, 7, 6, 5, 4, 3, 2];
        $array_sum2 = array();
        for ($i = 0, $j = 0; $i <= 9, $j <= 9; $i++, $j ++):
            array_push($array_sum2, $array_verif[$i] * $array_auxiliar2[$j]);
        endfor;
        $sum2 = array_sum($array_sum2);
        $temp = (string) $sum2 / VERIFICADOR;
        $resto2 = explode(".", $temp);
        $temp = substr($resto2[1], 0, 1);
        $temp = $temp . ".";
        $temp = $temp . substr($resto2[1], 1);
        $temp = ceil($temp);
        if ($temp >= 2):
            $digito2 = VERIFICADOR - $temp;
            array_push($array_verif, $digito2);
        else:
            array_push($array_verif, 0);
        endif;

        $cpf_verif = implode($array_verif);
        return $cpf_verif;
    }

}

controlIngresso::start();
