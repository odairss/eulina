<?php
include_once 'DAO/seasonDAO.php';
include_once 'model/season.php';
include_once 'model/agenda.php';
include_once 'model/convidado.php';
include_once 'DAO/AgendaDAO.php';
include_once 'DAO/ConvidadoDAO.php';
$count = 0;
$yearCurrent = date("Y");
$season = seasonDAO::getSeason($yearCurrent);
$temporada = new season();
$agenda = new agenda();
$convidado = new convidado();

$concertos = AgendaDAO::listToSeason($season->getId_season());
?>
<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-wrapper">
    <div>
        <h1>OS CONVIDADOS</h1>
    </div>
    <article class="container-text">
        <div class="col-xs-12 col-sm-12 col-md-12 page_convidados">
            <div>
                <h4>Temporada <?php echo $season->getAno(); ?></h4>
            </div>
            <?php
            foreach ($concertos as $concert) {
                $agenda = $concert;
                $dateConcert = implode("-", array_reverse(explode("/", $agenda->getDataevento())));
                $monthOfEnvite = new DateTime($dateConcert);
                $convidados = ConvidadoDAO::buscarConvidadoEvento($agenda->getIdevento());
                foreach ($convidados as $convid) {
                    $convidado = $convid;
                    ?>
                    <article <?php
                    if (($count % 2) == 0) {
                        echo 'class="col-xs-12 col-sm-12 col-md-12 convidado1"';
                    } else {
                        echo 'class="col-xs-12 col-sm-12 col-md-12 convidado2"';
                    }
                    ?> >
                        <div class="col-xs-12 col-sm-12 name-conv-mobile">
                            <h4>
                                <a  href="http://www.orquestrasinfonicadorn.com.br/convidado/<?php echo $convidado->getId_convidado(); ?>" target="_self"><?php echo $convidado->getNome(); ?></a>
                            </h4>
                            <h6><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/<?php echo $agenda->getIdevento(); ?>" target="_self"><?php echo $monthOfEnvite->format("F Y"); ?></a></h6>
                        </div>
                        <div <?php
                        if (($count % 2) == 0) {
                            echo 'class="col-sm-3 col-md-3 convidado_photo1"';
                        } else {
                            echo 'class="col-sm-3 col-md-3 convidado_photo2"';
                        }
                        ?> >
                            <img src="http://www.orquestrasinfonicadorn.com.br/<?php echo substr($convidado->getFoto(), 3); ?>"/>
                        </div>
                        <div <?php
                        if (($count % 2) == 0) {
                            echo 'class="col-sm-9 col-md-9 convidado_text1"';
                        } else {
                            echo 'class="col-sm-9 col-md-9 convidado_text2"';
                        }
                        ?> >
                            <h4>
                                <a  href="http://www.orquestrasinfonicadorn.com.br/convidado/<?php echo $convidado->getId_convidado(); ?>" target="_self"><?php echo $convidado->getNome(); ?></a>
                            </h4>
                            <h6>
                                <a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/<?php echo $agenda->getIdevento(); ?>" target="_self"><?php echo $monthOfEnvite->format("F Y"); ?></a>
                            </h6>
                            <?php echo $convidado->getResume(); ?> <a href="http://www.orquestrasinfonicadorn.com.br/convidado/<?php echo $convidado->getId_convidado(); ?>" target="_self">[Saiba mais]</a>
                        </div>
                    </article>
                    <?php
                    $count++;
                }
            }
            ?>
        </div>
    </article>
</section>