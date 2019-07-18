<?php

/*
 * Autor: Odair Soares.
 * E-mail: odairsds@gmail.com
 * Cel.: 55 84 9467-9154
 */

//namespace model;

/**
 * Description of season
 *
 * @author odair
 */
class season {

    private $id_season;
    private $ano;

    function getId_season() {
        return $this->id_season;
    }

    function getAno() {
        return $this->ano;
    }

    function setId_season($id_season) {
        $this->id_season = $id_season;
    }

    function setAno($ano) {
        $this->ano = $ano;
    }

}
