<?php

/*
 * Autor: Odair Soares.
 * E-mail: odairsds@gmail.com
 * Cel.: 55 84 9467-9154
 */

/**
 * Description of seasonDAO
 *
 * @author odair
 */
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["origem"])) {
    if ($_SESSION["origem"] == "osrn1") {
        include_once '../persistencia/connectionFactory.php';
        include_once '../model/season.php';
    } elseif ($_SESSION["origem"] == 2) {
        include_once 'persistencia/connectionFactory.php';
        include_once 'model/season.php';
    }
}

class seasonDAO {

    public static function criar(season $temporada) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $ano = $temporada->getAno();
            $statement = $connection->prepare("INSERT INTO orquestrasinfo.season (ano) "
                    . "VALUES(:ano);");
            $statement->bindValue(':ano', $ano);
            $result = $statement->execute();
            $connection->commit();
            return $result;
        } catch (Exception $exc) {
            $connection->rollBack();
        }
    }

    public static function editar(season $temporada) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $ano = $temporada->getAno();
            $id_season = $temporada->getId_season();
            $statement = $connection->prepare("UPDATE TABLE orquestrasinfo.season SET ano = :year WHERE id_season = :seasonid;");
            $statement->bindValue(':year', $ano);
            $statement->bindValue(':seasonid', $id_season);
            $result = $statement->execute();
            return $result;
            $connection->commit();
        } catch (Exception $exc) {
            $connection->rollBack();
        }
    }

    public static function excluir($id_season) {
        $connection = connectionFactory::connection();
        $connection->beginTransaction();
        try {
            $statement = $connection->prepare("DELETE FROM orquestrasinfo.season WHERE id_season = :seasonid;");
            $statement->bindValue(':seasonid', $id_season);
            $result = $statement->execute();
            $connection->commit();
            return $result;
        } catch (Exception $exc) {
            $connection->rollBack();
        }
    }

    public static function listar() {
        $temporadas = array();
        $connection = connectionFactory::connection();
        try {
            $resultProccess = $connection->query("SELECT id_season, ano FROM orquestrasinfo.season ORDER BY ano DESC;");
            while ($array_temporadas = $resultProccess->fetch(PDO::FETCH_ASSOC)):
                $temporada = new season();
                $temporada->setId_season($array_temporadas["id_season"]);
                $temporada->setAno($array_temporadas["ano"]);
                array_push($temporadas, $temporada);
            endwhile;
            return $temporadas;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public static function pesquisar($id_season) {
        $connection = connectionFactory::connection();
        try {
            $resultproccess = $connection->query("SELECT ano FROM orquestrasinfo.season WHERE id_season = $id_season;");
            if ($resultproccess->rowCount() > 0):
                $obj_temp = $resultproccess->fetch(PDO::FETCH_OBJ);
                $temporada = new season();
                $temporada->setAno($obj_temp->ano);
            endif;
            return $temporada;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    static function getSeasonPerYear($ano) {
        $connection = connectionFactory::connection();
        try {
            $resultproccess = $connection->query("SELECT id_season, ano FROM orquestrasinfo.season WHERE ano = $ano;");
            $temporada = NULL;
            if ($resultproccess->rowCount() != 0):
                $temporada = new season();
                $obj_temp = $resultproccess->fetch(PDO::FETCH_OBJ);
                $temporada->setAno($obj_temp->ano);
                $temporada->setId_season($obj_temp->id_season);
            endif;
            return $temporada;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    static function getLastSeason($ano) {
        $connection = connectionFactory::connection();
        try {
            $previousYear = ($ano - 1);
            $resultproccess = $connection->query("SELECT id_season, ano FROM orquestrasinfo.season WHERE ano = $previousYear;");
            $temporada = NULL;
            if ($resultproccess->rowCount() != 0):
                $temporada = new season();
                $obj_temp = $resultproccess->fetch(PDO::FETCH_OBJ);
                $temporada->setAno($obj_temp->ano);
                $temporada->setId_season($obj_temp->id_season);
            endif;
            return $temporada;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public static function getSeason($ano) {
        $season = new season();
        $season = self::getSeasonPerYear($ano);
        if ($season == NULL):
            $season = self::getLastSeason($ano);
        endif;
        return $season;
    }

}
