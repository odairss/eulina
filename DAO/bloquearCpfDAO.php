<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["origem"])) {
    if ($_SESSION["origem"] == "osrn1") {
        include_once '../persistencia/connectionFactory.php';
        include_once '../model/cpfBloqueado.php';
    } elseif ($_SESSION["origem"] == 2) {
        include_once 'persistencia/connectionFactory.php';
        include_once 'model/cpfBloqueado.php';
    }
}

class bloquearCpfDAO {

    public static function bloquear(cpfBloqueado $cpf) {

        $BloquearCpf = addslashes($cpf->getCpfBloqueado());
        $conexao = connectionFactory::connection();
        $conexao->beginTransaction();
        try {
            $stmt = $conexao->prepare("INSERT INTO orquestrasinfo.cpfbloqueado (cpfbloqueado) VALUES(:cpf);");
            $stmt->bindValue(':cpf', $BloquearCpf);

            $result = $stmt->execute();
            $conexao->commit();
            return $result;
        } catch (Exception $exc) {
            $conexao->rollBack();
        }
    }

    public static function editar(cpfBloqueado $cpf) {
        $conexao = connectionFactory::connection();
        $BloquearCpf = addslashes($cpf->getCpfBloqueado());
        $conexao->beginTransaction();
        try {
            $statement = $conexao->prepare("UPDATE orquestrasinfo.cpfbloqueado SET cpfbloqueado = :cpf WHERE idcpf = :cpfid;");
            $statement->bindValue(':cpf', $cpf->getCpfBloqueado());
            $statement->bindValue(':cpfid', $cpf->getIdCpf());
            $result = $statement->execute();
            $conexao->commit();
            return $result;
        } catch (Exception $exc) {
            $conexao->rollBack();
        }
    }

    public static function excluir($idCpf) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $stmt = $connection->prepare("DELETE FROM orquestrasinfo.cpfbloqueado WHERE idcpf = :cpfid;");
            $stmt->bindValue(':cpfid', $idCpf);
            $result = $stmt->execute();
            $connection->commit();
            return $result;
        } catch (Exception $exc) {
            $connection->rollBack();
        }
    }

    public static function listar() {
        $cpfsbloqueados = array();
        $connection = connectionFactory::connection();
        try {
            $processResult = $connection->query("SELECT idcpf, cpfbloqueado FROM orquestrasinfo.cpfbloqueado ORDER BY idcpf ASC;");
            if ($processResult->rowCount() > 0):
                while ($row = $processResult->fetch(PDO::FETCH_OBJ)):
                    $cpf = new cpfBloqueado();
                    $cpf->setIdCpf($row->idcpf);
                    $cpf->setCpfBloqueado($row->cpfbloqueado);
                    array_push($cpfsbloqueados, $cpf);
                endwhile;
            endif;
            return $cpfsbloqueados;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
