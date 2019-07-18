<?php

/*
 * Autor: Odair Soares.
 * E-mail: odairsds@gmail.com
 * Cel.: 55 84 9467-9154
 */

/**
 * Description of ingressoDAO
 *
 * @author odair
 */
if (!isset($_SESSION)):
    session_start();
endif;
if (isset($_SESSION["origem"])) {
    if ($_SESSION["origem"] == "osrn1") {
        include_once '../persistencia/connectionFactory.php';
        include_once '../model/ingresso.php';
    } elseif ($_SESSION["origem"] == 2) {
        include_once 'persistencia/connectionFactory.php';
        include_once 'model/ingresso.php';
    }
}
//define("AMOUNTDEFAULT", 255);

class ingressoDAO {

    public static function criar(ingresso $ingresso) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $stmt = $connection->prepare('SET @result' . session_id() . ' = \'\';');
            $stmt->execute();
            $stmt = $connection->prepare('CALL insertTicket(@result' . session_id() . ',:dataingresso,:name,:email,:whatsapp,:cpf,:idconcert);');
            $stmt->bindValue(':dataingresso', $ingresso->getDataIngresso());
            $stmt->bindValue(':name', $ingresso->getName());
            $stmt->bindValue(':email', $ingresso->getEmail());
            $stmt->bindValue(':whatsapp', $ingresso->getTelefone());
            $stmt->bindValue(':cpf', $ingresso->getCpf());
            $stmt->bindValue(':idconcert', $ingresso->getIdConcert());
            $stmt->execute();
            $stmt = $connection->prepare('SELECT @result' . session_id() . ';');
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $str = $result["@result"];
            $connection->commit();
        } catch (Exception $ex) {
            $connection->rollBack();
        }
        return $str;
    }

    public static function editar(ingresso $ingresso) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $stmt = $connection->prepare("UPDATE orquestrasinfo.ingressos  SET name = :nameuser, telefone = :whatsapp, email = :emailuser, cpf = :cpfuser, dataingresso = :dateticket, idconcert = :concertid WHERE idingresso = :ticketid;");
            $stmt->bindValue(':nameuser', $ingresso->getName());
            $stmt->bindValue(':whatsapp', $ingresso->getTelefone());
            $stmt->bindValue(':emailuser', $ingresso->getEmail());
            $stmt->bindValue(':cpfuser', $ingresso->getCpf());
            $stmt->bindValue(':dateticket', $ingresso->getDataIngresso());
            $stmt->bindValue(':concertid', $ingresso->getIdConcert());
            $stmt->bindValue(':ticketid', $ingresso->getIdingresso());
            $result = $stmt->execute();
            $connection->commit();
        } catch (Exception $exc) {
            $connection->rollBack();
        }
        return $result;
    }

    public static function getTicket($idingresso) {
        $connection = connectionFactory::connection();
        try {
            $statement = $connection->query("SELECT * FROM orquestrasinfo.ingressos  WHERE idingresso = $idingresso;");
            $ticket = array_pop(self::processStatement($statement));
            return $ticket;
        } catch (Exception $exc) {
            $exc->getTraceAsString();
        }
    }

    public static function processStatement($statement) {
        $tickets = array();
        if ($statement):
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)):
                $ingresso = new ingresso();
                $ingresso->setCpf($row["cpf"]);
                $ingresso->setDataIngresso($row["dataingresso"]);
                $ingresso->setEmail($row["email"]);
                $ingresso->setIdConcert($row["idconcert"]);
                $ingresso->setIdingresso($row["idingresso"]);
                $ingresso->setName($row["name"]);
                $ingresso->setTelefone($row["telefone"]);
                array_push($tickets, $ingresso);
            endwhile;
        endif;
        return $tickets;
    }

    public static function buscar($idingresso) {
        $conexao = connectionFactory::connection();
        try {
            $sql = "SELECT * FROM orquestrasinfo.ingressos  WHERE idingresso = $idingresso;";
            $proccessstatement = $conexao->query($sql);
            $ingresso = NULL;
            if ($proccessstatement->rowCount() == 1):
                $object_ingresso = $proccessstatement->fetch(PDO::FETCH_OBJ);
                $ingresso = new ingresso();
                $ingresso->setName($object_ingresso->name);
                $ingresso->setEmail($object_ingresso->email);
                $ingresso->setIdingresso($object_ingresso->idingresso);
                $ingresso->setTelefone($object_ingresso->telefone);
                $ingresso->setCpf($object_ingresso->cpf);
                $ingresso->setDataIngresso($object_ingresso->dataingresso);
                $ingresso->setIdConcert($object_ingresso->idconcert);
            endif;
            return $ingresso;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function buscarTodos2($idconcert, $begin, $end) {
        $conexao = connectionFactory::connection();
        try {
            $sql = "SELECT * FROM orquestrasinfo.ingressos WHERE idconcert = $idconcert AND dataingresso >= '$begin' AND dataingresso <= '$end';";
            $proccessstatement = $conexao->query($sql);
            $ingressos = array();
            while ($array_ingressos = $proccessstatement->fetch(PDO::FETCH_ASSOC)):
                $ingresso = new ingresso();
                $ingresso->setIdingresso($array_ingressos["idingresso"]);
                $ingresso->setEmail($array_ingressos["email"]);
                $ingresso->setTelefone($array_ingressos["telefone"]);
                $ingresso->setName($array_ingressos["name"]);
                $ingresso->setCpf($array_ingressos["cpf"]);
                $ingresso->setDataIngresso($array_ingressos["dataingresso"]);
                $ingresso->setIdConcert($array_ingressos["idconcert"]);
                array_push($ingressos, $ingresso);
            endwhile;
            return $ingressos;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function getAll($idconcert, $begin, $end) {
        $connection = connectionFactory::connection();
        try {
            $statement = $connection->query("SELECT * FROM orquestrasinfo.ingressos WHERE idconcert = $idconcert AND dataingresso >= '$begin' AND dataingresso <= '$end';");
            $tickets = self::processStatement($statement);
            return $tickets;
        } catch (Exception $exc) {
            $exc->getTraceAsString();
        }
    }

    public static function delete($idingresso) {
        $connection = connectionFactory1::connection();
        $connection->beginTransaction();
        try {
            $statement = $connection->prepare("DELETE FROM orquestrasinfo.ingressos WHERE idingresso = :ticketid;");
            $statement->bindValue(':ticketid', $idingresso);
            $result = $statement->execute();
            $connection->commit();
            return $result;
        } catch (Exception $exc) {
            $connection->rollBack();
        }
    }

    public static function checkAmount($idconcert, $amountdefault) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $statement = $connection->query("SELECT COUNT(idingresso) AS amount FROM orquestrasinfo.ingressos WHERE idconcert = $idconcert;");
            $verify = FALSE;
            if ($statement):
                $amount_object = $statement->fetch(PDO::FETCH_OBJ);
                $amount = $amount_object->amount;
                if ($amount < $amountdefault):
                    $verify = TRUE;
                endif;
            endif;
            return $verify;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function checkIfExists($cpf, $begin, $end, $concert) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $stmt = $connection->prepare('SET @resultcpf' . session_id() . ' = \'\';');
            $stmt->execute();
            $stmt = $connection->prepare('CALL checkIfExistsCpf(@resultcpf' . session_id() . ',:cpfsearch, :datebegin,:dateend,:concert);');
            $stmt->bindParam(':cpfsearch', $cpf, PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':datebegin', $begin, PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':dateend', $end, PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':concert', $concert, PDO::PARAM_INPUT_OUTPUT);
            $stmt->execute();
            $stmt = $connection->prepare('SELECT @resultcpf' . session_id() . ';');
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $str = $result["@resultcpf"];
            $connection->commit();
        } catch (Exception $ex) {
            $connection->rollBack();
        }
        return $str;
    }

}
