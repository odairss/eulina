<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of agenda
 *
 * @author odair
 */
class agenda {

    private $idevento;
    private $arquivo;
    private $titulo;
    private $dataevento;
    private $hora;
    private $local;
    private $descricao;
    private $resume;
    private $temporada;
    private $maestro;
    private $fotoconvidados;
    private $amountticket;
    private $daysstartreserve;
    private $daysendreserve;
    private $reservetimes;
    private $firststarttimes;
    private $firstendtimes;
    private $secondestarttimes;
    private $secondeendtimes;
    private $thirdstarttimes;
    private $thirdendtimes;
    private $placetickets;
    private $placeticketaddress;
    private $boxofficelot;
    private $startwithdrawaltickets;
    private $endwithdrawaltickets;
    private $loteinternet;

    function getLoteinternet() {
        return $this->loteinternet;
    }

    function setLoteinternet($loteinternet) {
        $this->loteinternet = $loteinternet;
    }

    function getStartwithdrawaltickets() {
        return $this->startwithdrawaltickets;
    }

    function getEndwithdrawaltickets() {
        return $this->endwithdrawaltickets;
    }

    function setStartwithdrawaltickets($startwithdrawaltickets) {
        $this->startwithdrawaltickets = $startwithdrawaltickets;
    }

    function setEndwithdrawaltickets($endwithdrawaltickets) {
        $this->endwithdrawaltickets = $endwithdrawaltickets;
    }

    function getBoxofficelot() {
        return $this->boxofficelot;
    }

    function setBoxofficelot($boxofficelot) {
        $this->boxofficelot = $boxofficelot;
    }

    function getDaysstartreserve() {
        return $this->daysstartreserve;
    }

    function getDaysendreserve() {
        return $this->daysendreserve;
    }

    function getReservetimes() {
        return $this->reservetimes;
    }

    function getFirststarttimes() {
        return $this->firststarttimes;
    }

    function getFirstendtimes() {
        return $this->firstendtimes;
    }

    function getSecondestarttimes() {
        return $this->secondestarttimes;
    }

    function getSecondeendtimes() {
        return $this->secondeendtimes;
    }

    function getThirdstarttimes() {
        return $this->thirdstarttimes;
    }

    function getThirdendtimes() {
        return $this->thirdendtimes;
    }

    function getPlacetickets() {
        return $this->placetickets;
    }

    function getPlaceticketaddress() {
        return $this->placeticketaddress;
    }

    function setDaysstartreserve($daysstartreserve) {
        $this->daysstartreserve = $daysstartreserve;
    }

    function setDaysendreserve($daysendreserve) {
        $this->daysendreserve = $daysendreserve;
    }

    function setReservetimes($reservetimes) {
        $this->reservetimes = $reservetimes;
    }

    function setFirststarttimes($firststarttimes) {
        $this->firststarttimes = $firststarttimes;
    }

    function setFirstendtimes($firstendtimes) {
        $this->firstendtimes = $firstendtimes;
    }

    function setSecondestarttimes($secondestarttimes) {
        $this->secondestarttimes = $secondestarttimes;
    }

    function setSecondeendtimes($secondeendtimes) {
        $this->secondeendtimes = $secondeendtimes;
    }

    function setThirdstarttimes($thirdstarttimes) {
        $this->thirdstarttimes = $thirdstarttimes;
    }

    function setThirdendtimes($thirdendtimes) {
        $this->thirdendtimes = $thirdendtimes;
    }

    function setPlacetickets($placetickets) {
        $this->placetickets = $placetickets;
    }

    function setPlaceticketaddress($placeticketaddress) {
        $this->placeticketaddress = $placeticketaddress;
    }

    function getAmountticket() {
        return $this->amountticket;
    }

    function setAmountticket($amountticket) {
        $this->amountticket = $amountticket;
    }

    function getFotoconvidados() {
        return $this->fotoconvidados;
    }

    function setFotoconvidados($fotoconvidados) {
        $this->fotoconvidados = $fotoconvidados;
    }

    function getMaestro() {
        return $this->maestro;
    }

    function setMaestro($maestro) {
        $this->maestro = $maestro;
    }

    function getTemporada() {
        return $this->temporada;
    }

    function setTemporada($temporada) {
        $this->temporada = $temporada;
    }

    function getResume() {
        return $this->resume;
    }

    function setResume($resume) {
        $this->resume = $resume;
    }

    function getIdevento() {
        return $this->idevento;
    }

    function getArquivo() {
        return $this->arquivo;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDataevento() {
        return $this->dataevento;
    }

    function getHora() {
        return $this->hora;
    }

    function getLocal() {
        return $this->local;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setIdevento($idevento) {
        $this->idevento = $idevento;
    }

    function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDataevento($dataevento) {
        $this->dataevento = $dataevento;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setLocal($local) {
        $this->local = $local;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}
