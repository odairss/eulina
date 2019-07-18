<?php

/*
 * Autor: Odair Soares.
 * E-mail: odairsds@gmail.com
 * Cel.: 55 84 9467-9154
 */

/**
 * Description of musico
 *
 * @author odair
 */
class musico {

    private $id_musico;
    private $nome;
    private $telefone;
    private $email;
    private $categoria;
    private $instrumento;
    private $historico;
    private $img;

    function getId_musico() {
        return $this->id_musico;
    }

    function getNome() {
        return $this->nome;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getInstrumento() {
        return $this->instrumento;
    }

    function getHistorico() {
        return $this->historico;
    }

    function getImg() {
        return $this->img;
    }

    function setId_musico($int_musico) {
        $this->id_musico = $int_musico;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setInstrumento($instrumento) {
        $this->instrumento = $instrumento;
    }

    function setHistorico($historico) {
        $this->historico = $historico;
    }

    function setImg($img) {
        $this->img = $img;
    }

}
