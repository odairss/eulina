<?php
include_once 'persistencia/connectionFactory.php';
include_once 'model/convidado.php';
include_once 'seasonDAO.php';
include_once 'model/season.php';

class convidadoMesDAO {

    public static function getConcertoDoMes() {
        $con = connectionFactory::connection();
        $inicioMes = self::getComecoMes();
        $fimMes = self::getFimMes();
        try {
            $resultQuery = $con->query("SELECT idevento FROM orquestrasinfo.agenda WHERE "
                    . "dataevento >= '$inicioMes' AND  dataevento <= '$fimMes';");
            $events = array();
            if ($resultQuery->rowCount() > 0):
                while ($eventos = $resultQuery->fetch(PDO::FETCH_ASSOC)):
                    array_push($events, $eventos["idevento"]);
                endwhile;
            endif;
            return $events;
        } catch (Exception $exc) {
            $exc->getMessage();
        }
    }

    public static function getNextConcert($concerts) {
        $con = connectionFactory::connection();
        $dataAtual = date("Y-m-d");
        try {
            $sql = "SELECT idevento FROM orquestrasinfo.agenda WHERE (";
            foreach ($concerts as $key => $value) :
                $sql .= " idevento =  $value OR";
            endforeach;
            $sql = rtrim($sql, "OR");
            $sql = $sql . ") AND  dataevento >= '$dataAtual';";

            $resultQuery = $con->query($sql);
            if ($resultQuery->rowCount() > 0):
                while ($arrayConcert = $resultQuery->fetch(PDO::FETCH_ASSOC)):
                    return $arrayConcert["idevento"];
                endwhile;
            else:
//            se o mês tem dois ou mais concertos e todos já ocorreram retorna o último:
                return $concerts[count($concerts) - 1];
            endif;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    static function getCurrentSeason() {
        $ano = date("Y");
        $currentSeason = new season();
        $currentSeason = seasonDAO::getSeasonPerYear($ano);
        return $currentSeason;
    }

    static function nextConcertOfCurrentSeason() {
        $link_db = connectionFactory::connection();
        $date = date("Y-m-d");
        try {
            $result = $link_db->query("SELECT idevento FROM orquestrasinfo.agenda WHERE dataevento >= '$date' LIMIT 1;");
            $concert = 0;
            if ($result->rowCount() == 1):
                $obj_concert = $result->fetch(PDO::FETCH_OBJ);
                $concert = $obj_concert->idevento;
                return $concert;
            else:
                return NULL;
            endif;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    static function getInvited($idconcert) {
        if (count(self::convidado($idconcert)) > 0):
            $array_convidados = self::convidado($idconcert);
        else:
            $array_convidados = self::getlastInvited();
        endif;
        return $array_convidados;
    }

    static function invitedFound($id) {
        $invitees = array();
        if (count(self::getInvited($id)) > 0):
            $invitees = self::getInvited($id);
        endif;
        return $invitees;
    }

    static function nextInvitedOfCurrentSeason() {
        $season = self::getCurrentSeason();
        $invitees_arr = array();
        if ($season != NULL):
            $id_concert = self::nextConcertOfCurrentSeason();
            if (is_null($id_concert)):
                return $invitees_arr;
            else:
                $invitees_arr = self::invitedFound($id_concert);
                return $invitees_arr;
            endif;
        else:
            return $invitees_arr;
        endif;
    }

    public static function getConvidadoMes() {
        $array_convidados = self::nextInvitedOfCurrentSeason();
        if (count($array_convidados) > 0):
            return $array_convidados;
        else:
            $concertos = array();
            $idconcert = 0;
            $concertos = self::getConcertoDoMes();
            if (count($concertos) > 0):
                if (count($concertos) > 1):
                    $idconcert = self::getNextConcert($concertos);
                else:
                    $idconcert = array_pop($concertos);
                endif;
            else:
                $idconcert = self::getId_lastConcert();
            endif;
            if (count(self::convidado($idconcert)) > 0):
                $array_convidados = self::convidado($idconcert);
            else:
                $array_convidados = self::getlastInvited();
            endif;
            return $array_convidados;
        endif;
    }

    //em caso existir um concerto cadastrado para o corrente mês, mas não haver nenhum convidado cadastrado para o concerto,
//este método pega o último convidado cadastrado no banco de dados.
    public static function getlastInvited() {
        $con = connectionFactory::connection();
        try {
            $resultQuery = $con->query("SELECT nome, country, foto, categ_musico, "
                    . "categ_en_us, sexo FROM orquestrasinfo.convidados ORDER BY id_convidado "
                    . "DESC LIMIT 1;");
            $convidados = array();
            if ($resultQuery->rowCount() > 0):
                $array = $resultQuery->fetch(PDO::FETCH_ASSOC);
                $convidado = new convidado();
                $convidado->setCateg_musico($array["categ_musico"]);
                $convidado->setCateg_en_us($array["categ_en_us"]);
                $convidado->setNome($array["nome"]);
                $convidado->setFoto($array["foto"]);
                $convidado->setCountry($array["country"]);
                $convidado->setSexo($array["sexo"]);
                array_push($convidados, $convidado);
            endif;
            return $convidados;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    //    Em caso de não haver concertos cadastrados para o período atual,
//            este método pega o último concerto cadastrado no banco de dados.
    public static function getId_lastConcert() {
        $con = connectionFactory::connection();
        $dataAtual = date("Y-m-d");
        try {
            $resultQuery = $con->query("SELECT max(idevento) as lastId FROM "
                    . "orquestrasinfo.agenda WHERE dataevento <= '$dataAtual';");
            $id = 0;
            if ($resultQuery->rowCount() > 0):
                $concert = $resultQuery->fetch(PDO::FETCH_OBJ);
                $id = $concert->lastId;
            endif;
            return $id;
        } catch (Exception $exc) {
            $exc->getMessage();
        }
    }

    public static function convidado($id_concerto) {
        $con = connectionFactory::connection();
        try {
            $resultquery = $con->query("SELECT nome, country, foto, categ_musico, "
                    . "categ_en_us, sexo FROM orquestrasinfo.convidados WHERE "
                    . "id_evento = $id_concerto;");
            $convidados = array();
            if ($resultquery->rowCount() > 0):
                while ($array = $resultquery->fetch(PDO::FETCH_ASSOC)):
                    $convidado = new convidado();
                    $convidado->setCateg_musico($array["categ_musico"]);
                    $convidado->setCateg_en_us($array["categ_en_us"]);
                    $convidado->setNome($array["nome"]);
                    $convidado->setFoto($array["foto"]);
                    $convidado->setCountry($array["country"]);
                    $convidado->setSexo($array["sexo"]);
                    array_push($convidados, $convidado);
                endwhile;
            endif;
            return $convidados;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public static function getComecoMes() {
        $dia1 = '01';
        $mes = date("m");
        $ano = date("Y");
        $inicio_mes = $ano . '-' . $mes . '-' . $dia1;
        return $inicio_mes;
    }

    public static function getFimMes() {
        $mes = date("m");
        $ano = date("Y");
        if ($mes <= '07') {
            if ($mes != "02") {
                if ($mes % 2 == 0) {
                    $dia_ultimo = 30;
                } else {
                    $dia_ultimo = 31;
                }
            } else {
                if ($ano % 4 == 0) {
                    if ($ano % 100 == 0) {
                        if ($ano % 400 == 0) {
                            $dia_ultimo = 29;
                        } else {
                            $dia_ultimo = 28;
                        }
                    } else {
                        $dia_ultimo = 29;
                    }
                } else {
                    $dia_ultimo = 28;
                }
            }
        } else {
            if ($mes % 2 == 0) {
                $dia_ultimo = 31;
            } else {
                $dia_ultimo = 30;
            }
        }
        $fim_mes = $ano . '-' . $mes . '-' . $dia_ultimo;
        return $fim_mes;
    }

}
