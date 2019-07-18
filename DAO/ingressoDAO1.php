<?php

if (!isset($_SESSION)):
    session_start();
endif;
if (isset($_SESSION["origem"])) {
    if ($_SESSION["origem"] == "osrn1") {
        include_once '../persistencia/connectionFactory1.php';
        include_once '../model/ingresso.php';
    } elseif ($_SESSION["origem"] == 2) {
        include_once 'persistencia/connectionFactory1.php';
        include_once 'model/ingresso.php';
    }
}
define("AMOUNTDEFAULT", 255);

class ingressoDAO1 {

    public static function criar(ingresso $ingresso) {
        $connection = connectionFactory1::connection();
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
        $connection = connectionFactory1::connection();
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
        $connection = connectionFactory1::connection();
        $connection->beginTransaction();
        try {
            $statement = $connection->query("SELECT * FROM orquestrasinfo.ingressos  WHERE idingresso = $idingresso;");
            $ticket = array_pop(self::processStatement($statement));
            $connection->commit();
            return $ticket;
        } catch (Exception $exc) {
            $connection->rollBack();
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

    public static function getAll($idconcert, $begin, $end) {
        $connection = connectionFactory1::connection();
        $connection->beginTransaction();
        try {
            $statement = $connection->query("SELECT * FROM orquestrasinfo.ingressos WHERE idconcert = $idconcert AND dataingresso >= '$begin' AND dataingresso <= '$end';");
            $tickets = self::processStatement($statement);
            $connection->commit();
            return $tickets;
        } catch (Exception $exc) {
            $connection->rollBack();
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

    public static function checkAmount($idconcert) {
        $connection = connectionFactory1::connection();
        $connection->beginTransaction();
        try {
            $statement = $connection->query("SELECT COUNT(idingresso) AS amount FROM orquestrasinfo.ingressos WHERE idconcert = $idconcert;");
            $verify = FALSE;
            if ($statement):
                $amount_object = $statement->fetch(PDO::FETCH_OBJ);
                $amount = $amount_object->amount;
                if ($amount < AMOUNTDEFAULT):
                    $verify = TRUE;
                endif;
            endif;
            return $verify;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function checkIfExists($cpf, $begin, $end) {
        $connection = connectionFactory1::connection();
        $connection->beginTransaction();
        try {
            $statement = $connection->query("SELECT cpf FROM orquestrasinfo.ingressos WHERE cpf = '$cpf' AND (dataingresso >= '$begin' AND dataingresso <= '$end');");
            $verify = TRUE;
            if ($statement):
                $cpf_object = $statement->fetch(PDO::FETCH_OBJ);
                $checked_cpf = $cpf_object->cpf;
                if ($checked_cpf == $cpf):
                    $verify = FALSE;
                endif;
            endif;
            return $verify;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
