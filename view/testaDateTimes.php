<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dataEnglish = "2019-02-23";
$hoursEnglish = "09:00:00";
$data = new DateTime($dataEnglish . " " . $hoursEnglish);
$day = $data->format("l");

echo $data->format("F");

function translateWeekDaysName($day) {
    if ($day == "Sunday"):
        echo 'domingo';
    elseif ($day == "Saturday"):
        echo 'sábado';
    elseif ($day == "Monday"):
        echo 'segunda-feira';
    elseif ($day == "Tuesday"):
        echo "terça-feira";
    elseif ($day == "Wednesday"):
        echo 'quarta-feira';
    elseif ($day == "Thursday"):
        echo "quinta-feira";
    elseif ($day == "Friday"):
        echo 'sexta-feira';
    endif;
}

translateWeekDaysName($day);
