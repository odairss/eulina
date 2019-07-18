<?php

/*
 * Autor: Odair Soares.
 * E-mail: odairsds@gmail.com
 * Cel.: 55 84 9467-9154
 */

/**
 * Description of convertDateToString
 *
 * @author odair
 */
class convertDateToString {

    public function convert($date) {
        $arrayDate = explode("-", $date);
        $month = "";
        switch ($arrayDate[1]) {
            case '1':
                $month = "janeiro";
                break;
            case '2':
                $month = "fevereiro";
                break;
            case '3':
                $month = "mar&ccedil;o";
                break;
            case '4':
                $month = "abril";
                break;
            case '5':
                $month = "maio";
                break;
            case '6':
                $month = "junho";
                break;
            case '7':
                $month = "julho";
                break;
            case '8':
                $month = "agosto";
                break;
            case '9':
                $month = "setembro";
                break;
            case '10':
                $month = "outubro";
                break;
            case '11':
                $month = "novembro";
                break;
            case '12':
                $month = "dezembro";
                break;
        }
        return $arrayDate[2] . " de " . $month . " de " . $arrayDate[0];
    }

    public function convertMonthToPortuguese($numerous) {
        $month = "";
        switch ($numerous) {
            case '1':
                $month = "janeiro";
                break;
            case '2':
                $month = "fevereiro";
                break;
            case '3':
                $month = "mar&ccedil;o";
                break;
            case '4':
                $month = "abril";
                break;
            case '5':
                $month = "maio";
                break;
            case '6':
                $month = "junho";
                break;
            case '7':
                $month = "julho";
                break;
            case '8':
                $month = "agosto";
                break;
            case '9':
                $month = "setembro";
                break;
            case '10':
                $month = "outubro";
                break;
            case '11':
                $month = "novembro";
                break;
            case '12':
                $month = "dezembro";
                break;
        }
        return $month;
    }

    public function translateWeekDaysName($day) {
        $convertedDay = "";
        if ($day == "Sunday"):
            $convertedDay = 'domingo';
        elseif ($day == "Saturday"):
            $convertedDay = 'sábado';
        elseif ($day == "Monday"):
            $convertedDay = 'segunda-feira';
        elseif ($day == "Tuesday"):
            $convertedDay = "terça-feira";
        elseif ($day == "Wednesday"):
            $convertedDay = 'quarta-feira';
        elseif ($day == "Thursday"):
            $convertedDay = "quinta-feira";
        elseif ($day == "Friday"):
            $convertedDay = 'sexta-feira';
        endif;
        return $convertedDay;
    }

}
