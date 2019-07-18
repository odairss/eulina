<?php
include_once 'DAO/ConvidadoDAO.php';
include_once 'DAO/seasonDAO.php';
include_once 'model/convidado.php';
include_once 'model/season.php';

if (isset($_GET['id_concert'])):
    $id_concerto = $_GET['id_concert'];

    $concerto = AgendaDAO::pesquisar($id_concerto);
    $date = new DateTime($concerto->getDataevento());
    $hours = new DateTime($date->format("Y-m-d") . ' ' . $concerto->getHora());
    $arrayEnviteds = ConvidadoDAO::buscarConvidadoEvento($concerto->getIdevento());
    ?>
    <section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-wrapper">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1><?php echo $concerto->getTitulo(); ?></h1>
        </div>
        <article class="container-text">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <p>
                    <span class="glyphicon glyphicon-calendar"></span>  <?php echo $date->format("d/m/Y") . '<br/>'; ?>
                    <span class="glyphicon glyphicon-time"></span> <?php echo $hours->format('H') . 'h<br/>'; ?>
                    <span class="glyphicon glyphicon-map-marker"></span> <?php echo $concerto->getLocal(); ?>
                </p>              

                <?php
                $convidado = new convidado();
                $maestro = "";
                $solistas = "";
                foreach ($arrayEnviteds as $key => $envited):
                    $convidado = $envited;
                    if (strtolower($convidado->getCateg_musico()) == "maestro"):
                        $maestro = '<p><strong>' . $convidado->getCateg_musico() . ': <a href="http://www.orquestrasinfonicadorn.com.br/convidado/' . $convidado->getId_convidado() . '" target="_self">' . $convidado->getNome() . '</a> (' . $convidado->getCountry() . ')</strong></p>';
                    else:
                        $solistas .= '<p><strong>Solista (' . $convidado->getCateg_musico() . '): <a href="http://www.orquestrasinfonicadorn.com.br/convidado/' . $convidado->getId_convidado() . '" target="_self">' . $convidado->getNome() . '</a> (' . $convidado->getCountry() . ')</strong></p>';
                    endif;
                endforeach;
                if ($maestro != ""):
                    echo $maestro;
                else:
                    echo '<p><strong>Maestro: <a href="http://www.orquestrasinfonicadorn.com.br/maestro" target="_self">' . $concerto->getMaestro() . '</a></strong></p>';
                endif;
                echo $solistas;
                ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 banner-concerto">
                <img src="<?php echo 'http://www.orquestrasinfonicadorn.com.br/' . substr($concerto->getArquivo(), 3); ?>"/>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <fieldset>
                    <legend>Programa</legend>
                    <?php echo $concerto->getDescricao(); ?>
                </fieldset>
                <p>
                    <strong>&ast;</strong> este programa poder&aacute; sofrer altera&ccedil;&otilde;es.
                </p>
            </div>
            <div id="comentplugin-facebook">
                <div class="fb-comments" data-href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/<?php echo $concerto->getIdevento(); ?>" data-width="100%" data-numposts="10"></div>
            </div>
        </article>
    </section>
    <?php
else:
    $currentYear = date("Y");
    $season = new season();
    $season = seasonDAO::getSeason($currentYear);
    $agenda = AgendaDAO::listToSeason($season->getId_season());
    $january = '';
    $february = '';
    $march = '';
    $april = '';
    $may = '';
    $june = '';
    $july = '';
    $august = '';
    $september = '';
    $october = '';
    $november = '';
    $december = '';
    foreach ($agenda as $evento):
        $date = new DateTime($evento->getDataevento());
        $hours = new DateTime($evento->getDataevento() . ' ' . $evento->getHora());
        $month = $date->format('m');
        switch ($month):
            case '01':
                $january .= '<h3>' . $date->format("d/m/Y") . '</h3><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $evento->getIdevento() . '" target="_self">' . strtoupper($evento->getTitulo()) . '</a><br/><span class="glyphicon glyphicon-time"></span> ' . $hours->format("H") . 'h <br/><span class="glyphicon glyphicon-map-marker"></span> ' . $evento->getLocal() . '<br/>';
                break;
            case '02':
                $february .= '<h3>' . $date->format("d/m/Y") . '</h3><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $evento->getIdevento() . '" target="_self">' . strtoupper($evento->getTitulo()) . '</a><br/><span class="glyphicon glyphicon-time"></span> ' . $hours->format("H") . 'h. <br/><span class="glyphicon glyphicon-map-marker"></span> ' . $evento->getLocal() . '<br/>';
                break;
            case '03':
                $march .= '<h3>' . $date->format("d/m/Y") . '</h3><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $evento->getIdevento() . '" target="_self">' . strtoupper($evento->getTitulo()) . '</a><br/><span class="glyphicon glyphicon-time"></span> ' . $hours->format("H") . 'h. <br/><span class="glyphicon glyphicon-map-marker"></span> ' . $evento->getLocal() . '<br/>';
                break;
            case '04':
                $april .= '<h3>' . $date->format("d/m/Y") . '</h3><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $evento->getIdevento() . '" target="_self">' . strtoupper($evento->getTitulo()) . '</a><br/><span class="glyphicon glyphicon-time"></span> ' . $hours->format("H") . 'h. <br/><span class="glyphicon glyphicon-map-marker"></span> ' . $evento->getLocal() . '<br/>';
                break;
            case '05':
                $may .= '<h3>' . $date->format("d/m/Y") . '</h3><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $evento->getIdevento() . '" target="_self">' . strtoupper($evento->getTitulo()) . '</a><br/><span class="glyphicon glyphicon-time"></span> ' . $hours->format("H") . 'h. <br/><span class="glyphicon glyphicon-map-marker"></span> ' . $evento->getLocal() . '<br/>';
                break;
            case '06':
                $june .= '<h3>' . $date->format("d/m/Y") . '</h3><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $evento->getIdevento() . '" target="_self">' . strtoupper($evento->getTitulo()) . '</a><br/><span class="glyphicon glyphicon-time"></span> ' . $hours->format("H") . 'h. <br/><span class="glyphicon glyphicon-map-marker"></span> ' . $evento->getLocal() . '<br/>';
                break;
            case '07':
                $july .= '<h3>' . $date->format("d/m/Y") . '</h3><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $evento->getIdevento() . '" target="_self">' . strtoupper($evento->getTitulo()) . '</a><br/><span class="glyphicon glyphicon-time"></span> ' . $hours->format("H") . 'h. <br/><span class="glyphicon glyphicon-map-marker"></span> ' . $evento->getLocal() . '<br/>';
                break;
            case '08':
                $august .= '<h3>' . $date->format("d/m/Y") . '</h3><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $evento->getIdevento() . '" target="_self">' . strtoupper($evento->getTitulo()) . '</a><br/><span class="glyphicon glyphicon-time"></span> ' . $hours->format("H") . 'h. <br/><span class="glyphicon glyphicon-map-marker"></span> ' . $evento->getLocal() . '<br/>';
                break;
            case '09':
                $september .= '<h3>' . $date->format("d/m/Y") . '</h3><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $evento->getIdevento() . '" target="_self">' . strtoupper($evento->getTitulo()) . '</a><br/><span class="glyphicon glyphicon-time"></span> ' . $hours->format("H") . 'h. <br/><span class="glyphicon glyphicon-map-marker"></span> ' . $evento->getLocal() . '<br/>';
                break;
            case '10':
                $october .= '<h3>' . $date->format("d/m/Y") . '</h3><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $evento->getIdevento() . '" target="_self">' . strtoupper($evento->getTitulo()) . '</a><br/><span class="glyphicon glyphicon-time"></span> ' . $hours->format("H") . 'h. <br/><span class="glyphicon glyphicon-map-marker"></span> ' . $evento->getLocal() . '<br/>';
                break;
            case '11':
                $november .= '<h3>' . $date->format("d/m/Y") . '</h3><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $evento->getIdevento() . '" target="_self">' . strtoupper($evento->getTitulo()) . '</a><br/><span class="glyphicon glyphicon-time"></span> ' . $hours->format("H") . 'h. <br/><span class="glyphicon glyphicon-map-marker"></span> ' . $evento->getLocal() . '<br/>';
                break;
            case '12':
                $december .= '<h3>' . $date->format("d/m/Y") . '</h3><a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $evento->getIdevento() . '" target="_self">' . strtoupper($evento->getTitulo()) . '</a><br/><span class="glyphicon glyphicon-time"></span> ' . $hours->format("H") . 'h. <br/><span class="glyphicon glyphicon-map-marker"></span> ' . $evento->getLocal() . '<br/>';
                break;
        endswitch;
    endforeach;
    ?>

    <section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-wrapper">
        <div>
            <h1>AGENDA <?php echo $season->getAno(); ?></h1>
        </div>
        <article class="container-text">
            <?php
            if ($january != ''):
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 months">
                    <div class="months-name">
                        <h2><span class="glyphicon glyphicon-calendar"></span> JANEIRO</h2>
                    </div>
                    <div class="concert-data">
                        <?php echo $january; ?> 
                    </div>
                </div>
                <?php
            endif;
            if ($february != ''):
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 months">
                    <div class="months-name">
                        <h2><span class="glyphicon glyphicon-calendar"></span> FEVEREIRO</h2>
                    </div>
                    <div class="concert-data">
                        <?php echo $february; ?>  
                    </div>
                </div>
                <?php
            endif;
            if ($march != ''):
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 months">
                    <div class="months-name">
                        <h2><span class="glyphicon glyphicon-calendar"></span> MAR&Ccedil;O</h2>
                    </div>
                    <div class="concert-data">
                        <?php echo $march; ?>  
                    </div>

                </div>
                <?php
            endif;
            if ($april != ''):
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 months">
                    <div class="months-name">
                        <h2><span class="glyphicon glyphicon-calendar"></span> ABRIL</h2>
                    </div>
                    <div class="concert-data">
                        <?php echo $april; ?>   
                    </div>
                </div>
                <?php
            endif;
            if ($may != ''):
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 months">
                    <div class="months-name">
                        <h2><span class="glyphicon glyphicon-calendar"></span> MAIO</h2>
                    </div>
                    <div class="concert-data">
                        <?php echo $may; ?> 
                    </div>
                </div>
                <?php
            endif;
            if ($june != ''):
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 months">
                    <div class="months-name">
                        <h2><span class="glyphicon glyphicon-calendar"></span> JUNHO</h2>
                    </div>
                    <div class="concert-data">
                        <?php echo $june; ?> 
                    </div>
                </div>
                <?php
            endif;
            if ($july != ''):
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 months">
                    <div class="months-name">
                        <h2><span class="glyphicon glyphicon-calendar"></span> JULHO</h2>
                    </div>
                    <div class="concert-data">
                        <?php echo $july; ?>  
                    </div>
                </div>
                <?php
            endif;
            if ($august != ''):
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 months">
                    <div class="months-name">
                        <h2><span class="glyphicon glyphicon-calendar"></span> AGOSTO</h2>
                    </div>
                    <div class="concert-data">
                        <?php echo $august; ?> 
                    </div>
                </div>
                <?php
            endif;
            if ($september != ''):
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 months">
                    <div class="months-name">
                        <h2><span class="glyphicon glyphicon-calendar"></span> SETEMBRO</h2>
                    </div>
                    <div class="concert-data">
                        <?php echo $september; ?>  
                    </div>
                </div>
                <?php
            endif;
            if ($october != ''):
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 months">
                    <div class="months-name">
                        <h2><span class="glyphicon glyphicon-calendar"></span> OUTUBRO</h2>
                    </div>
                    <div class="concert-data">
                        <?php echo $october; ?> 
                    </div>
                </div>
                <?php
            endif;
            if ($november != ''):
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 months">
                    <div class="months-name">
                        <h2><span class="glyphicon glyphicon-calendar"></span> NOVEMBRO</h2>
                    </div>
                    <div class="concert-data">
                        <?php echo $november; ?>  
                    </div>
                </div>
                <?php
            endif;
            if ($december != ''):
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 months">
                    <div class="months-name">
                        <h2><span class="glyphicon glyphicon-calendar"></span> DEZEMBRO</h2>
                    </div>
                    <div class="concert-data">
                        <?php echo $december; ?> 
                    </div>
                </div>
                <?php
            endif;
            ?>
        </article>
    </section>
<?php
endif;