<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControlUsuario
 *
 * @author odair
 */
include_once '../DAO/UsuarioDAO.php';
include_once '../model/usuario.php';

class ControlUsuario {

    public static function start() {
        $opc = $_POST["opc"];
        switch ($opc) {
            case 1:
                self::criarUsuario();
                break;
            case 2:
                self::editUsuario();
                break;
            case 3:
                self::logoff();
                break;
            case 5:
                self::login();
                break;
            case 6:
                self::changePassword();
                break;
        }
    }

    static function logoff() {
        session_start();
        unset($_SESSION["name_user"]);
        unset($_SESSION["id_user"]);
        unset($_SESSION["login_user"]);
        unset($_SESSION["status_user"]);
        unset($_SESSION["origem"]);
        unset($_SESSION);
        session_destroy();
        header("Location:../view/login.php");
    }

    public static function login() {
        $usuario = new usuario();
        $usuario->setLogin($_POST["login"]);
        $usuario->setSenha($_POST["senha"]);
        $usuario->setProfile($_POST["profile"]);
        $user = UsuarioDAO::verifyPassword($usuario);
        if ($user != NULL) {
            session_start();
            $_SESSION["name_user"] = $user->getNome();
            $_SESSION["login_user"] = $user->getLogin();
            $_SESSION["id_user"] = $user->getIdusuario();
            $_SESSION["status_user"] = "logado";
            $_SESSION["origem"] = "osrn1";
            if ($_POST["profile"] == 1) {
                header("Location:../view/osrnAdmin.php?ctd_admin=agenda&action=1");
            } elseif ($_POST["profile"] == 2) {
                header("Location:../view/ensaios.php");
            } elseif ($_POST["profile"] == 3) {
                header("Location:../view/osrnAdmin.php?ctd_admin=ingressos&action=1");
            }
        } else {
            header("Location:../view/login.php?resp=0");
        }
    }

    private static function changePassword() {
        $current = $_POST["currentpass"];
        $newpass = $_POST["newpass"];
        $confirmpass = $_POST["confirmpass"];
        $teste = self::confirmCurrentPass($current);
        if ($teste):
            $teste2 = self::confirmpass($newpass, $confirmpass);
            if ($teste2):
                $newpassencripted = self::geraPassword($newpass);
                $user = new usuario();
                $user->setIdusuario($_SESSION["id_user"]);
                $user->setLogin($_SESSION["login_user"]);
                $user->setSenha($newpassencripted);
                $teste3 = UsuarioDAO::changepass($user);
                if ($teste3):
                    self::logoff();
                else:
                    header("Location:../view/osrnAdmin.php?ctd_admin=changepassword&rst=4");
                endif;
            else:
                header("Location:../view/osrnAdmin.php?ctd_admin=changepassword&rst=3");
            endif;
        else:
            header("Location:../view/osrnAdmin.php?ctd_admin=changepassword&rst=2");
        endif;
    }

    private static function confirmCurrentPass($current) {
        session_start();
        $usuario = new usuario();
        $usuario->setLogin($_SESSION["login_user"]);
        $usuario->setIdusuario($_SESSION["id_user"]);
        $usuario->setSenha($current);
        $test = UsuarioDAO::verifyPass($usuario);
        if ($test):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    private static function confirmpass($new, $confirm) {
        if ($new == $confirm):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    private static function geraPassword($senha) {
        $options = [
            "salt" => "O cara mais foi quem cedinho amanha quem vai",
            "cost" => 10];
        $pass = password_hash($senha, PASSWORD_DEFAULT, $options);
        return $pass;
    }

    public static function criarUsuario() {
        $usuario = new usuario();
        $senha = self::geraPassword($_POST["senha"]);
        $usuario->setProfile($_POST["profile"]);
        $usuario->setNome($_POST["nome"]);
        $usuario->setEmail($_POST["email"]);
        $usuario->setTelefone($_POST["telefone"]);
        $usuario->setSenha($senha);
        $usuario->setLogin($_POST["login"]);
        if (UsuarioDAO::criar($usuario)) {
            header("Location:../view/osrnAdmin.php?ctd_admin=user&action=1&rst=1");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=user&action=1&rst=0");
        }
    }

    public static function editUsuario() {
        $usuario = new usuario();
        $usuario->setNome($_POST["nome"]);
        $usuario->setEmail($_POST["email"]);
        $usuario->setTelefone($_POST["telefone"]);
        $usuario->setProfile($_POST["profile"]);
        $usuario->setSenha($_POST["senha"]);
        $usuario->setLogin($_POST["login"]);
        $usuario->setIdusuario($_POST["idusuario"]);
        if (EventoDAO::editar($usuario)) {
            header("Location:../view/osrnAdmin.php?ctd_admin=user&action=2&rst=1");
        } else {
            header("Location:../view/osrnAdmin.php?ctd_admin=user&action=2&rst=0");
        }
    }

}

ControlUsuario::start();
