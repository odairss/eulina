<?php

class cpfBloqueado {

    private $idCpf;
    private $cpfBloqueado;

    function getIdCpf() {
        return $this->idCpf;
    }

    function setIdCpf($idcpf) {
        $this->idCpf = $idcpf;
    }

    function getCpfBloqueado() {
        return $this->cpfBloqueado;
    }

    function setCpfBloqueado($cpfbloqueado) {
        $this->cpfBloqueado = $cpfbloqueado;
    }

}
