<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioDAO
 *
 * @author odair
 */
include_once '../persistencia/connectionFactory.php';
include_once '../model/usuario.php';
include_once '../composer/vendor/autoload.php';

class UsuarioDAO {

    public static function criar(usuario $usuario) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $statement = $connection->prepare("INSERT INTO orquestrasinfo.usuario "
                    . "(nome, email,telefone,login,senha,profile) "
                    . "VALUES(:nameuser,:emailuser,:phoneuser,:loginuser,:password,:profileuser);");
            $statement->bindValue(':nameuser', $usuario->getNome());
            $statement->bindValue(':emailuser', $usuario->getEmail());
            $statement->bindValue(':phoneuser', $usuario->getTelefone());
            $statement->bindValue(':loginuser', $usuario->getLogin());
            $statement->bindValue(':password', $usuario->getSenha());
            $statement->bindValue(':profileuser', $usuario->getLogin());
            $result = $statement->execute();
            $connection->commit();
            return $result;
        } catch (Exception $exc) {
            $connection->rollBack();
        }
    }

    public static function editar(usuario $usuario) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $statement = $connection->prepare("UPDATE TABLE orquestrasinfo.usuario SET nome = :nameuser, email = :emailuser, "
                    . "telefone = :phoneuser, login = :loginuser, senha = :password, profile = :profileuser "
                    . "WHERE usuario.idusuario = :userid;");
            $statement->bindValue(':nameuser', $usuario->getNome());
            $statement->bindValue(':emailuser', $usuario->getEmail());
            $statement->bindValue(':phoneuser', $usuario->getTelefone());
            $statement->bindValue(':loginuser', $usuario->getLogin());
            $statement->bindValue(':password', $usuario->getSenha());
            $statement->bindValue(':profileuser', $usuario->getLogin());
            $statement->bindValue(':userid', $usuario->getIdusuario());
            $result = $statement->execute();
            $connection->commit();
            return $result;
        } catch (Exception $exc) {
            $connection->rollBack();
        }
    }

    public static function excluir($idusuario) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $statement = $connection->prepare("DELETE FROM orquestrasinfo.usuario WHERE idusuario = :userid;");
            $statement->bindValue(':userid', $idusuario);
            $result = $statement->execute();
            $connection->commit();
            return $result;
        } catch (Exception $exc) {
            $connection->rollBack();
        }
    }

    public static function listar() {
        $usuarios = array();
        $connection = connectionFactory::connection();
        try {
            $resultproccess = $connection->query("SELECT * FROM orquestrasinfo.usuario ORDER BY nome;");
            while ($array_usuarios = $resultproccess->fetch(PDO::FETCH_ASSOC)):
                $usuario = new usuario();
                $usuario->setNome($array_usuarios["nome"]);
                $usuario->setEmail($array_usuarios["email"]);
                $usuario->setTelefone($array_usuarios["telefone"]);
                $usuario->setSenha($array_usuarios["senha"]);
                $usuario->setLogin($array_usuarios["login"]);
                $usuario->setProfile($array_usuarios["profile"]);
                $usuario->setIdusuario($array_usuarios["idusuario"]);
                array_push($usuarios, $usuario);
            endwhile;
            return $usuarios;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function pesquisar($idusuario) {
        $connection = connectionFactory::connection();
        try {
            $resultproccess = $connection->query("SELECT * FROM orquestrasinfo.usuario WHERE idusuario = $idusuario;");
            $usuario = new usuario();
            if ($resultproccess->rowCount() != 0):
                $obj_usuario = $resultproccess->fetch(PDO::FETCH_OBJ);
                $usuario->setIdusuario($obj_usuario->idusuario);
                $usuario->setNome($obj_usuario->nome);
                $usuario->setEmail($obj_usuario->email);
                $usuario->setTelefone($obj_usuario->telefone);
                $usuario->setProfile($obj_usuario->profile);
                $usuario->setLogin($obj_usuario->login);
                $usuario->setSenha($obj_usuario->senha);
            endif;
            return $usuario;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function changepass(usuario $usuario) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $statement = $connection->prepare("UPDATE orquestrasinfo.usuario SET "
                    . "usuario.senha = :password WHERE usuario.login = :userlogin AND usuario.idusuario = :userid;");
            $statement->bindValue(':password', $usuario->getSenha());
            $statement->bindValue(':userlogin', $usuario->getLogin());
            $statement->bindValue('userid', $usuario->getIdusuario());
            $result = $statement->execute();
            return $result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function verifyPass(usuario $usuario) {
        $user = NULL;
        $connection = connectionFactory::connection();
        try {
            $strsql = "SELECT senha FROM orquestrasinfo.usuario WHERE"
                    . " login = '{$usuario->getLogin()}' AND idusuario = {$usuario->getIdusuario()};";
            $resultproccess = $connection->query($strsql);
            $test = FALSE;
            while ($arr_user = $resultproccess->fetch(PDO::FETCH_ASSOC)):
                if (password_verify($usuario->getSenha(), $arr_user["senha"]) == 1):
                    $test = TRUE;
                endif;
            endwhile;
            return $test;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function verifyPassword(usuario $usuario) {
        $user = NULL;
        $connection = connectionFactory::connection();
        try {
            $strsql = "SELECT login,nome,idusuario,senha FROM orquestrasinfo.usuario WHERE "
                    . "login = '{$usuario->getLogin()}' AND profile = {$usuario->getProfile()};";
            $resultproccess = $connection->query($strsql);
            while ($arr_user = $resultproccess->fetch(PDO::FETCH_ASSOC)):
                if (password_verify($usuario->getSenha(), $arr_user["senha"]) == 1) {
                    $user = new usuario();
                    $user->setNome($arr_user["nome"]);
                    $user->setLogin($arr_user["login"]);
                    $user->setIdusuario($arr_user["idusuario"]);
                }
            endwhile;
            return $user;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function login(usuario $usuario) {
        $connection = connectionFactory::connection();
        try {
            $sql = "SELECT nome, idusuario FROM orquestrasinfo.usuario WHERE login "
                    . "= '{$usuario->getLogin()}' AND senha = '{$usuario->getSenha()}' ;";
            $resultproccess = $connection->query($sql);
            if ($resultproccess->rowCount() == 1):
                $usuario = new usuario();
                $object_usuario = $resultproccess->fetch(PDO::FETCH_OBJ);
                $usuario->setNome($object_usuario->nome);
                $usuario->setIdusuario($object_usuario->idusuario);
                return $usuario;
            else:
                return NULL;
            endif;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
