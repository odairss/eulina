<?php

/*
 * Autor: Odair Soares.
 * E-mail: odairsds@gmail.com
 * Cel.: 55 84 9467-9154
 */

/**
 * Description of convidado
 *
 * @author odair
 */
class convidado {

    private $id_convidado;
    private $nome;
    private $id_evento;
    private $historico;
    private $foto;
    private $categ_musico;
    private $resume;
    private $country;
    private $sexo;
    private $dateinsert;
    private $bio_en_us;
    private $res_en_us;
    private $categ_en_us;

    function getCateg_en_us() {
        return $this->categ_en_us;
    }

    function setCateg_en_us($categ_en_us) {
        $this->categ_en_us = $categ_en_us;
    }

    function getBio_en_us() {
        return $this->bio_en_us;
    }

    function getRes_en_us() {
        return $this->res_en_us;
    }

    function setBio_en_us($bio_en_us) {
        $this->bio_en_us = $bio_en_us;
    }

    function setRes_en_us($res_en_us) {
        $this->res_en_us = $res_en_us;
    }

    function getDateinsert() {
        return $this->dateinsert;
    }

    function setDateinsert($dateinsert) {
        $this->dateinsert = $dateinsert;
    }

    function getSexo() {
        return $this->sexo;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function getCountry() {
        return $this->country;
    }

    function setCountry($country) {
        $this->country = $country;
    }

    function getResume() {
        return $this->resume;
    }

    function setResume($resume) {
        $this->resume = $resume;
    }

    function getCateg_musico() {
        return $this->categ_musico;
    }

    function setCateg_musico($categ_musico) {
        $this->categ_musico = $categ_musico;
    }

    function getId_convidado() {
        return $this->id_convidado;
    }

    function getNome() {
        return $this->nome;
    }

    function getId_evento() {
        return $this->id_evento;
    }

    function getHistorico() {
        return $this->historico;
    }

    function getFoto() {
        return $this->foto;
    }

    function setId_convidado($id_convidado) {
        $this->id_convidado = $id_convidado;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setId_evento($id_evento) {
        $this->id_evento = $id_evento;
    }

    function setHistorico($historico) {
        $this->historico = $historico;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

}
