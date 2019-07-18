<?php
include_once 'DAO/seasonDAO.php';
include_once 'model/season.php';
include_once 'DAO/convidadoMesDAO.php';
include_once 'DAO/ConvidadoDAO.php';
include_once 'model/convidado.php';
include_once 'DAO/AgendaDAO.php';
include_once 'model/agenda.php';
include_once 'DAO/seasonDAO.php';
date_default_timezone_set('America/Fortaleza');
$proximoConcert = new agenda();
$proximoConcert = AgendaDAO::getConcert();
$prox_convidado = ConvidadoDAO::buscarConvidadoEvento($proximoConcert->getIdevento());
$timedate = new DateTime($proximoConcert->getDataevento() . " " . $proximoConcert->getHora());
$dateTck_begin = new DateTime($proximoConcert->getDataevento() . " 09:00:00");
$dateTck_begin->sub(new DateInterval('P' . $proximoConcert->getDaysstartreserve() . 'D'));
$dateTck_end = new DateTime($proximoConcert->getDataevento() . " 23:59:59");
$dateTck_end->sub(new DateInterval('P' . $proximoConcert->getDaysendreserve() . 'D'));
$foto = "";
if ($proximoConcert->getFotoconvidados() != NULL):
    $foto = substr($proximoConcert->getFotoconvidados(), 3);
endif;
$array_conv = convidadoMesDAO::getConvidadoMes();
$convidado = new convidado();
$string_convidados = "";
$amount = count($array_conv);
if ($amount > 1):
    $count = 1;
    foreach ($array_conv as $key => $conv) {
        $convidado = $conv;
        if ($convidado->getSexo() == 'M'):
            $string_convidados .= ' the ';
        elseif ($convidado->getSexo() == 'F'):
            $string_convidados .= ' the ';
        endif;
        if ($count < $amount - 1):
            $string_convidados .= $convidado->getCateg_en_us() . ' ' . $convidado->getNome() . ', ';
        else :
            $string_convidados .= $convidado->getCateg_en_us() . ' ' . $convidado->getNome() . ' and';
        endif;
        if ($foto == ""):
            $foto = substr($convidado->getFoto(), 3);
        endif;
        $count++;
    }
    $string_convidados = rtrim($string_convidados, ' and');
else:
    $convidado = array_pop($array_conv);
    if ($convidado->getSexo() == 'M'):
        $string_convidados .= ' the ';
    elseif ($convidado->getSexo() == 'F'):
        $string_convidados .= ' the ';
    endif;
    $string_convidados .= $convidado->getCateg_en_us() . ' ' . $convidado->getNome();
    if ($foto == ""):
        $foto = substr($convidado->getFoto(), 3);
    endif;
endif;

$ano = date("Y");
$season = seasonDAO::getSeason($ano);
?>
<section id="trigger5" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-home-one">
    <article id="orquestra" class="col-xs-12 col-sm-6 col-md-3 col-lg-3 articles">
        <div>
            <h1><a href="http://www.orquestrasinfonicadorn.com.br/orquestra" target="_self">THE ORCHESTRA</a></h1>   
        </div>
        <div id="color1">
            <div>
                <img src="http://www.orquestrasinfonicadorn.com.br/img/Orquestra-Sinfonica-do-Rio-Grande-do-Norte.jpg"/>                                    
            </div>
            <div>
                <p>The Symphony Orchestra of RN - OSRN was established in 1976 and continues with all hard to do a much educational work with the formation of new audiences, the quality of music broadcast, be it classical or popular.</p>                                    
            </div>
        </div>
    </article>

    <article id="maestro"  class="col-xs-12 col-sm-6 col-md-3 col-lg-3 articles">
        <div>
            <h1><a href="http://www.orquestrasinfonicadorn.com.br/maestro" target="_self">THE MAESTRO</a></h1>
        </div> 
        <div id="color2">
            <div>
                <img src="http://www.orquestrasinfonicadorn.com.br/img/linus-lerner.JPG"/>
            </div>
            <div>
                <p>Linus Lerner is praised for his musical influence and charisma, he conducted several groups in the United States, Brazil, Bulgaria, China, Czech Republic, Mexico, Spain and Turkey. Conductor Linus is regent of OSRN since 2012.</p>     
            </div>

        </div>
    </article>                       
    <article id="convidados" class="col-xs-12 col-sm-6 col-md-3 col-lg-3 articles">
        <div>
            <h1><a href="http://www.orquestrasinfonicadorn.com.br/convidados/<?php echo $convidado->getCateg_en_us(); ?>/<?php echo $convidado->getNome(); ?>/<?php echo $foto; ?>" target="_self" target="_self">THE GUESTS</a></h1>    
        </div>
        <div id="color3">
            <div>
                <img alt="<?php echo $convidado->getNome(); ?>" src="<?php echo 'http://www.orquestrasinfonicadorn.com.br/' . $foto; ?>"/>
            </div>
            <div>
                <p>The <?php echo $season->getAno(); ?> season of OSRN includes greats invitees as <?php echo $string_convidados; ?>.</p>                                    
            </div>
        </div>

    </article>
    <article id="musicos" class="col-xs-12 col-sm-6 col-md-3 col-lg-3 articles">
        <div>
            <h1><a href="http://www.orquestrasinfonicadorn.com.br/musicos" target="_self">THE MUSICIANS</a></h1>                               
        </div>
        <div id="color4">
            <div>
                <img src="http://www.orquestrasinfonicadorn.com.br/img/musicos.JPG"/>                                    
            </div>
            <div>
                <p>Currently the orchestra has 60 musicians who rehearsing daily in the Children's Town, the OSRN headquarters and continues with all hard to carry out educational work for the formation of young musicians.</p>     
            </div>

        </div>
    </article>               
</section>
<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-wrapper">
    <div>
        <h1>
            <a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/<?php echo $proximoConcert->getIdevento(); ?>" target="_self">
                NEXT CONCERT
            </a>
        </h1>
    </div>
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container-text">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p><a href = "http://www.orquestrasinfonicadorn.com.br/agenda/concerto/<?php echo $proximoConcert->getIdevento(); ?>" target = "_self"><?php echo $proximoConcert->getTitulo(); ?></a><br/>
                <?php
                echo $timedate->format("F d, Y");
                ?>
            </p>
            <p>
                <?php
                $convidado_do_concertoAtual = new convidado();
                $stringconvidados = "";
                $conductor = "";
                $amount_invitees = count($prox_convidado);
                if ($amount_invitees > 1):
                    $counter = 1;
                    foreach ($prox_convidado as $convid):
                        $convidado_do_concertoAtual = $convid;
                        if (strtolower($convidado_do_concertoAtual->getCateg_musico()) == "maestro"):
                            $conductor = '<a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $convidado_do_concertoAtual->getId_convidado() . '" target="_self">' . $convidado_do_concertoAtual->getNome() . '</a>';
                        else:
                            if ($convidado_do_concertoAtual->getSexo() == 'M'):
                                $stringconvidados .= ' of ';
                            elseif ($convidado_do_concertoAtual->getSexo() == 'F'):
                                $stringconvidados .= ' of ';
                            endif;
                            if ($counter < $amount_invitees - 1):
                                $stringconvidados .= $convidado_do_concertoAtual->getCateg_en_us() . ' <a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $convidado_do_concertoAtual->getId_convidado() . '" target="_self">' . $convidado_do_concertoAtual->getNome() . '</a>,';
                            else:
                                $stringconvidados .= $convidado_do_concertoAtual->getCateg_en_us() . ' <a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $convidado_do_concertoAtual->getId_convidado() . '" target="_self">' . $convidado_do_concertoAtual->getNome() . '</a> and';
                            endif;
                        endif;

                        $counter++;
                    endforeach;
                    $stringconvidados = rtrim($stringconvidados, 'and');
                    $stringconvidados . ". ";

                elseif (count($prox_convidado) == 1):
                    $convidado_do_concertoAtual = $prox_convidado[0];
                    if (strtolower($convidado_do_concertoAtual->getCateg_musico()) == "maestro"):
                        $conductor = '<a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $convidado_do_concertoAtual->getId_convidado() . '" target="_self">' . $convidado_do_concertoAtual->getNome() . '</a>';
                    else:
                        if ($convidado_do_concertoAtual->getSexo() == 'M'):
                            $stringconvidados .= ' of ';
                        elseif ($convidado_do_concertoAtual->getSexo() == 'F'):
                            $stringconvidados .= ' of ';
                        endif;
                        $stringconvidados .= $convidado_do_concertoAtual->getCateg_en_us() . ' <a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/' . $convidado_do_concertoAtual->getId_convidado() . '" target="_self">' . $convidado_do_concertoAtual->getNome() . '</a>.';
                    endif;
                else:
                    $stringconvidados .= ' soloists musicians as special guests.';
                endif;

                if ($conductor == ""):
                    $conductor = '<a href="http://www.orquestrasinfonicadorn.com.br/maestro" target="_self">' . $proximoConcert->getMaestro() . '</a>';
                else:

                endif;
                ?>
                The &OpenCurlyDoubleQuote;Ter&ccedil;as Cl&aacute;ssicas&CloseCurlyDoubleQuote; project shows in <?php echo strtolower($timedate->format("F")); ?>, another concert of the season in 
                <?php echo $season->getAno(); ?> the Symphony Orchestra of Rio Grande do Norte (OSRN) at the 
                Teatro Riachuelo, in Natal,<!-- Metropolitan Cathedral of Natal,  --> Brazil. Under the baton of <?php echo $conductor; ?> conductor, the presentation will 
                include the participation <?php echo $stringconvidados; ?> The show is scheduled for <?php echo strtolower($timedate->format("F d Y")); ?>, from <?php echo $timedate->format("h a"); ?>, with free admission with prior removal of tickets.
            </p>
            <p>
                <b>LOT FIRST 500 tickets</b> will be distributed freely by prior reservation between <?php echo $dateTck_begin->format("d"); ?> and <?php echo strtolower($dateTck_end->format("d F")); ?> <b><a href="http://www.orquestrasinfonicadorn.com.br/en/ingressos" target="_self">the form available right here on the website of OSRN</a></b>. Each registered CPF is entitled to two (2) tickets. Read <b><a href="http://www.orquestrasinfonicadorn.com.br/en/ingressos" target="_self">here</a></b> the information relating to the period for withdrawal of the tickets and the necessary procedure.
            </p>
            <p>
                <b>Obs.:</b> Tickets that are not removed during this period, even though it was registered here on the website of OSRN, will become part of the second batch.
            </p>
            <p>
                <b>SECOND LOT</b> will have <b>300 tickets</b> and will be distributed to the public on <b><?php echo strtolower($timedate->format("F d")) ?>  starting at 10 am</b> in the gallery <b>Fernando Chiriboga</b>. Interested customers must present their CPF at the box office along with a photo ID and will have the right to withdraw a maximum of 2 tickets. Tickets will be printed unmarked. There will be no queue after distribution of all tickets and only customers with tickets can enter the theater.
            </p>
    
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 banner-concerto">
            <img alt="Pr&oacute;ximo Conserto" src = "<?php echo 'http://www.orquestrasinfonicadorn.com.br/' . substr($proximoConcert->getArquivo(), 3); ?>"/>
        </div>
    </article>

</section>
<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-wrapper">
    <div>
        <h1>            
            <a href="http://www.orquestrasinfonicadorn.com.br/performances" target = "_self">
                PERFORMANCES
            </a>
        </h1>
    </div>
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container-text">
        <div>
            <p>The Symphony Orchestra of RN performs a useful work presenting
                official concerts at the Teatro Riachuelo, external popular concerts, 
                educational concerts for the entire school system and special concerts within the state.
            </p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 banner-concerto">
            <img alt="Performances da OSRN" src="http://www.orquestrasinfonicadorn.com.br/img/DSC_2143.jpg"/>    
        </div>
    </article>
</section>
<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-wrapper">
    <article class="container-text margintop">
        <div class="form_feed ">
            <h3>Register your e-mail to receive news about OSRN</h3>
            <form name="form_newsletter" action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=OSRN', 'popupwindow', 'scrollbars=yes,width=550,height=520');
                    return true">
                <div id="inputemail">
                    <input id="email_news" placeholder="Your e-mail" type="email" name="email"/>
                    <input type="hidden" name="opc_newsletter" id="opc_newsletter" value="1"/>
                    <input type="hidden" value="OSRN" name="uri"/>
                    <input type="hidden" name="loc" value="pt_BR"/>
                </div>
                <div id="inputsubmit">
                    <input type="submit" name="submeter" value="Register" />
                </div>
            </form>
        </div>
    </article>
</section>




