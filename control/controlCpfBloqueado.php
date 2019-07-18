<?php

class controlCpfBloqueado {

    public static function start() {

        if (isset($_POST["opc"])):
            $opc = $_POST["opc"];
            unset($_POST["opc"]);
        elseif (isset($_GET["opc"])):
            $opc = $_GET["opc"];
            unset($_GET["opc"]);
        endif;

        switch ($opc) {
            case 1:
                self::bloquearCPF();
                break;
            case 2:
                self::editBloqueioCPF();
                break;
            case 3:
                self::desbloquearCPF();
        }
    }

    public static function bloquearCPF() {
        $cpfBloqueado = new cpfBloqueado();

        $cpfBloqueado->setCpfBloqueado($_POST["cpfBloqueado"]);
        if (bloquearCpfDAO::bloquear($cpfBloqueado)) {
            header("Location:../view/osrnAdmin.php?ctd_admin=bloquearcpf&action=1&rst=1");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=bloquearcpf&action=1&rst=0");
        }
    }

    public static function editBloqueioCPF() {
        $cpfBloqueado = new cpfBloqueado();

        $cpfBloqueado->setIdCpf($_POST["idCpf"]);
        $cpfBloqueado->setCpfBloqueado($_POST["cpfBloqueado"]);

        if (bloquearCpfDAO::editarBloqueioCpf($cpfBloqueado)) {
            header("Location:../view/osrnAdmin.php?ctd_admin=bloquearcpf&action=2&rst=1");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=bloquearcpf&action=2&rst=0");
        }
    }

    public static function desbloquearCPF() {
        $idcpf = 0;
        if (isset($_GET["idcpf"])):
            $idcpf = $_GET["idcpf"];
        endif;
        bloquearCpfDAO::excluir($idcpf);
        header("Location:../view/osrnAdmin.php?ctd_admin=bloquearcpf&action=1&rst=1");
    }

}

include_once '../DAO/bloquearCpfDAO.php';
include_once '../model/cpfBloqueado.php';

controlCpfBloqueado::start();
