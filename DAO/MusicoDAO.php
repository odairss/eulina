<?php

/*
 * Autor: Odair Soares.
 * E-mail: odairsds@gmail.com
 * Cel.: 55 84 9467-9154
 */

/**
 * Description of MusicoDAO
 *
 * @author odair
 */
if (!$_SESSION) {
    session_start();
}
if (isset($_SESSION["origem"])) {
    if ($_SESSION["origem"] == "osrn1") {
        include_once '../persistencia/connectionFactory.php';
        include_once '../model/musico.php';
    } elseif ($_SESSION["origem"] == 2) {
        include_once 'persistencia/connectionFactory.php';
        include_once 'model/musico.php';
    }
}

class MusicoDAO {

    public static function criar(musico $musico) {
        $conexao = connectionFactory::connection();
        $conexao->beginTransaction();
        try {
            $statement = $conexao->prepare("INSERT INTO orquestrasinfo.musicos "
                    . "(nome,telefone,email,categoria,instrumento,historico,img)"
                    . " VALUES(:name,:cellphone,:email, :category, :instrument,:historical, :image);");
            $statement->bindValue(':name', $musico->getNome());
            $statement->bindValue(':cellphone', $musico->getTelefone());
            $statement->bindValue(':email', $musico->getEmail());
            $statement->bindValue(':category', $musico->getCategoria());
            $statement->bindValue(':instrument', $musico->getInstrumento());
            $statement->bindValue(':historical', $musico->getHistorico());
            $statement->bindValue(':image', $musico->getImg());
            $result = $statement->execute();
            $conexao->commit();
            return $result;
        } catch (Exception $exc) {
            $conexao->rollBack();
        }
    }

    public static function editar(musico $musico) {
        $conexao = connectionFactory::connection();
        $conexao->beginTransaction();
        try {
            $statement = $conexao->prepare("UPDATE orquestrasinfo.musicos  SET nome = :name, "
                    . "telefone = :cellphone, email = :email, categoria = :category, instrumento = :instrument, "
                    . "historico = :historical, img = :image WHERE id_musico = :musicianid;");
            $statement->bindValue(':name', $musico->getNome());
            $statement->bindValue(':cellphone', $musico->getTelefone());
            $statement->bindValue(':email', $musico->getEmail());
            $statement->bindValue(':category', $musico->getCategoria());
            $statement->bindValue(':instrument', $musico->getInstrumento());
            $statement->bindValue(':historical', $musico->getHistorico());
            $statement->bindValue(':image', $musico->getImg());
            $statement->bindValue(':musicianid', $musico->getId_musico());
            $result = $statement->execute();
            $conexao->commit();
            return $result;
        } catch (Exception $exc) {
            $conexao->rollBack();
        }
    }

    public static function buscar($id_musico) {
        $conexao = connectionFactory::connection();
        try {
            $resultproccess = $conexao->query("SELECT * FROM orquestrasinfo.musicos  WHERE id_musico = $id_musico;");
            $musico = NULL;
            if ($resultproccess->rowCount() == 1):
                $object_musico = $resultproccess->fetch(PDO::FETCH_OBJ);
                $musico = new musico();
                $musico->setCategoria($object_musico->categoria);
                $musico->setEmail($object_musico->email);
                $musico->setHistorico($object_musico->historico);
                $musico->setId_musico($object_musico->id_musico);
                $musico->setImg($object_musico->img);
                $musico->setInstrumento($object_musico->instrumento);
                $musico->setNome($object_musico->nome);
                $musico->setTelefone($object_musico->telefone);
            endif;
            return $musico;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function buscarTodos() {
        $conexao = connectionFactory::connection();
        try {
            $resultproccess = $conexao->query("SELECT * FROM orquestrasinfo.musicos;");
            $musicos = array();
            while ($array_musicos = $resultproccess->fetch(PDO::FETCH_ASSOC)):
                $musico = new musico();
                $musico->setCategoria($array_musicos["categoria"]);
                $musico->setEmail($array_musicos["email"]);
                $musico->setHistorico($array_musicos["historico"]);
                $musico->setId_musico($array_musicos["id_musico"]);
                $musico->setImg($array_musicos["img"]);
                $musico->setInstrumento($array_musicos["instrumento"]);
                $musico->setNome($array_musicos["nome"]);
                $musico->setTelefone($array_musicos["telefone"]);
                array_push($musicos, $musico);
            endwhile;
            return $musicos;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
