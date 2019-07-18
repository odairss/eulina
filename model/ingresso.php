<?php

/*
 * Autor: Odair Soares.
 * E-mail: odairsds@gmail.com
 * Cel.: 55 84 9467-9154
 */

/**
 * Description of ingresso
 *
 * @author odair
 */
class ingresso {

    private $idingresso;
    private $name;
    private $email;
    private $telefone;
    private $cpf;
    private $dataIngresso;
    private $idConcert;

    function getDataIngresso() {
        return $this->dataIngresso;
    }

    function getIdConcert() {
        return $this->idConcert;
    }

    function setDataIngresso($dataIngresso) {
        $this->dataIngresso = $dataIngresso;
    }

    function setIdConcert($idConcert) {
        $this->idConcert = $idConcert;
    }

    function getCpf() {
        return $this->cpf;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function getIdingresso() {
        return $this->idingresso;
    }

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function setIdingresso($idingresso) {
        $this->idingresso = $idingresso;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

}
