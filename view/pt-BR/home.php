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
//$hours = new DateTime($proximoConcert->getDataevento().' '.$proximoConcert->getHora());
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
    foreach ($array_conv as $key => $conv):
        $convidado = $conv;
        if ($convidado->getSexo() == 'M'):
            $string_convidados .= ' o ';
        elseif ($convidado->getSexo() == 'F'):
            $string_convidados .= ' a ';
        endif;
        if ($count < $amount - 1):
            $string_convidados .= $convidado->getCateg_musico() . ' ' . $convidado->getNome() . ', ';
        else :
            $string_convidados .= $convidado->getCateg_musico() . ' ' . $convidado->getNome() . ' e';
        endif;
        if ($foto == ""):
            $foto = substr($convidado->getFoto(), 3);
        endif;
        $count++;
    endforeach;
    $string_convidados = rtrim($string_convidados, ' e');
else:
    $convidado = array_pop($array_conv);
    if ($convidado->getSexo() == 'M'):
        $string_convidados .= ' o ';
    elseif ($convidado->getSexo() == 'F'):
        $string_convidados .= ' a ';
    endif;
    $string_convidados .= $convidado->getCateg_musico() . ' ' . $convidado->getNome();
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
            <h1><a href="http://www.orquestrasinfonicadorn.com.br/orquestra" target="_self">A ORQUESTRA</a></h1>   
        </div>
        <div id="color1">
            <div>
                <img src="http://www.orquestrasinfonicadorn.com.br/img/Orquestra-Sinfonica-do-Rio-Grande-do-Norte.jpg"/>                                    
            </div>
            <div>
                <p>A Orquestra Sinf&ocirc;nica do RN – OSRN foi criada em 1976 e continua com todo 
                    afinco a realizar um trabalho tanto educativo com a forma&ccedil;&atilde;o de novas plateias, 
                    quanto de difus&atilde;o da m&uacute;sica de qualidade, seja ela erudita ou popular.</p>                                    
            </div>
        </div>
    </article>

    <article id="maestro"  class="col-xs-12 col-sm-6 col-md-3 col-lg-3 articles">
        <div>
            <h1><a href="http://www.orquestrasinfonicadorn.com.br/maestro" target="_self">O MAESTRO</a></h1>
        </div> 
        <div id="color2">
            <div>
                <img src="http://www.orquestrasinfonicadorn.com.br/img/linus-lerner.JPG"/>
            </div>
            <div>
                <p>Linus Lerner &eacute; elogiado por sua flu&ecirc;ncia musical e carisma, regeu v&aacute;rios 
                    grupos nos Estados Unidos, Brasil, Bulg&aacute;ria, China, Rep&uacute;blica Checa, M&eacute;xico, 
                    Espanha e Turquia. O maestro Linus &eacute; Regente da OSRN desde 2012.</p>     
            </div>

        </div>
    </article>                       
    <article id="convidados" class="col-xs-12 col-sm-6 col-md-3 col-lg-3 articles">
        <div>
            <h1><a href="http://www.orquestrasinfonicadorn.com.br/convidados/<?php echo $convidado->getCateg_musico(); ?>/<?php echo $convidado->getNome(); ?>/<?php echo $foto; ?>" target="_self" target="_self">OS CONVIDADOS</a></h1>    
        </div>
        <div id="color3">
            <div>
                <img alt="<?php echo $convidado->getNome(); ?>" src="<?php echo 'http://www.orquestrasinfonicadorn.com.br/' . $foto; ?>"/>
            </div>
            <div>
                <p>A temporada <?php echo $season->getAno(); ?> da OSRN conta com grandes convidados como<?php echo $string_convidados; ?>.</p>                                    
            </div>
        </div>

    </article>
    <article id="musicos" class="col-xs-12 col-sm-6 col-md-3 col-lg-3 articles">
        <div>
            <h1><a href="http://www.orquestrasinfonicadorn.com.br/musicos" target="_self">OS M&Uacute;SICOS</a></h1>                               
        </div>
        <div id="color4">
            <div>
                <img src="http://www.orquestrasinfonicadorn.com.br/img/musicos.JPG"/>                                    
            </div>
            <div>
                <p>Atualmente a Orquestra conta com 60 m&uacute;sicos que ensaiam diariamente na Cidade da Criança, sede da OSRN, 
                    e continua com todo afinco a realizar um trabalho educativo para a forma&ccedil;&atilde;o de novos m&uacute;sicos.</p>     
            </div>
        </div>
    </article>               
</section>
<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-wrapper">
    <div>
        <h1>
            <a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/<?php echo $proximoConcert->getIdevento(); ?>" target="_self">
                PR&Oacute;XIMO CONCERTO
            </a>
        </h1>
    </div>
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container-text">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p><a href = "http://www.orquestrasinfonicadorn.com.br/agenda/concerto/<?php echo $proximoConcert->getIdevento(); ?>" target = "_self"><?php echo $proximoConcert->getTitulo(); ?></a><br/>

                <?php
                $arrayDate = explode("-", $proximoConcert->getDataevento());
                $month = "";
                echo $arrayDate[2];
                switch ($arrayDate[1]) {
                    case "12":
                        $month = " de dezembro";
                        break;
                    case "11":
                        $month = " de novembro";
                        break;
                    case "10":
                        $month = " de outubro";
                        break;
                    case "09":
                        $month = " de setembro";
                        break;
                    case "08":
                        $month = " de agosto";
                        break;
                    case "07":
                        $month = " de julho";
                        break;
                    case "06":
                        $month = " de junho";
                        break;
                    case "05":
                        $month = " de maio";
                        break;
                    case "04":
                        $month = " de abril";
                        break;
                    case "03":
                        $month = " de março";
                        break;
                    case "02":
                        $month = " de fevereiro";
                        break;
                    case "01":
                        $month = " de janeiro";
                        break;
                    default :
                        break;
                }

                echo $month . ' de ' . $arrayDate[0];
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
                            $conductor = '<a href="http://www.orquestrasinfonicadorn.com.br/convidado/' . $convidado_do_concertoAtual->getId_convidado() . '" target="_self">' . $convidado_do_concertoAtual->getNome() . '</a>';
                        else:
                            if ($convidado_do_concertoAtual->getSexo() == 'M'):
                                $stringconvidados .= ' do ';
                            elseif ($convidado_do_concertoAtual->getSexo() == 'F'):
                                $stringconvidados .= ' da ';
                            endif;
                            if ($counter < $amount_invitees - 1):
                                $stringconvidados .= $convidado_do_concertoAtual->getCateg_musico() . ' <a href="http://www.orquestrasinfonicadorn.com.br/convidado/' . $convidado_do_concertoAtual->getId_convidado() . '" target="_self">' . $convidado_do_concertoAtual->getNome() . '</a>,';
                            else:
                                $stringconvidados .= $convidado_do_concertoAtual->getCateg_musico() . ' <a href="http://www.orquestrasinfonicadorn.com.br/convidado/' . $convidado_do_concertoAtual->getId_convidado() . '" target="_self">' . $convidado_do_concertoAtual->getNome() . '</a> e';
                            endif;
                        endif;

                        $counter++;
                    endforeach;
                    $stringconvidados = rtrim($stringconvidados, 'e');
                    $stringconvidados . ". ";

                elseif (count($prox_convidado) == 1):
                    $convidado_do_concertoAtual = $prox_convidado[0];
                    if (strtolower($convidado_do_concertoAtual->getCateg_musico()) == "maestro"):
                        $conductor = '<a href="http://www.orquestrasinfonicadorn.com.br/convidado/' . $convidado_do_concertoAtual->getId_convidado() . '" target="_self">' . $convidado_do_concertoAtual->getNome() . '</a>';
                    else:
                        if ($convidado_do_concertoAtual->getSexo() == 'M'):
                            $stringconvidados .= ' do ';
                        elseif ($convidado_do_concertoAtual->getSexo() == 'F'):
                            $stringconvidados .= ' da ';
                        endif;
                        $stringconvidados .= $convidado_do_concertoAtual->getCateg_musico() . ' <a href="http://www.orquestrasinfonicadorn.com.br/convidado/' . $convidado_do_concertoAtual->getId_convidado() . '" target="_self">' . $convidado_do_concertoAtual->getNome() . '</a>.';
                    endif;
                else:
                    $stringconvidados .= ' de m&uacute;sicos solistas como convidados especiais.';
                endif;

                if ($conductor == ""):
                    $conductor = '<a href="http://www.orquestrasinfonicadorn.com.br/maestro" target="_self">' . $proximoConcert->getMaestro() . '</a>';
                else:

                endif;
                ?>
                O projeto &OpenCurlyDoubleQuote;Ter&ccedil;as Cl&aacute;ssicas&CloseCurlyDoubleQuote; apresentar&aacute; neste m&ecirc;s <?php echo $month; ?>, mais um 
                concerto da temporada <?php echo $season->getAno(); ?> da Orquestra Sinf&ocirc;nica do Rio Grande do Norte 
                (OSRN) em Natal, no Teatro Riachuelo <!-- NA CATEDRAL METROPOLITANA DE NATAL -->. Sob reg&ecirc;ncia do maestro <?php echo $conductor; ?>, a apresenta&ccedil;&atilde;o contar&aacute; com a participa&ccedil;&atilde;o 
                <?php echo $stringconvidados; ?> O espet&aacute;culo est&aacute; marcado para o dia <?php echo $arrayDate[2] . $month . ' de ' . $arrayDate[0] ?>, a partir das <?php echo $timedate->format("H"); ?>h, com entrada  gratuita mediante retirada pr&eacute;via de ingressos<!-- livre -->.
            </p>
            <p>
                <b>O PRIMEIRO LOTE de 500 ingressos</b> ser&aacute; distribu&iacute;do gratuitamente atrav&eacute;s de reserva pr&eacute;via entre os dias <?php echo $dateTck_begin->format("d"); ?> e <?php echo $dateTck_end->format("d") . $month; ?> em <b><a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos" target="_self">formul&aacute;rio dispon&iacute;vel aqui mesmo no website da OSRN</a></b>. Cada CPF cadastrado dar&aacute; direito a 2 (dois) ingressos. Leia <b><a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos" target="_self">aqui</a></b> as informa&ccedil;&otilde;es relativas ao per&iacute;odo para retirada dos ingressos e o procedimento necess&aacute;rio.
            </p>
            <p>
                <b>Obs.:</b> Os ingressos que n&atilde;o forem retirados neste per&iacute;odo, mesmo tendo sido cadastrados aqui no website da OSRN, passar&atilde;o a fazer parte do segundo lote.
            </p>
            <p>
                <b>O SEGUNDO LOTE</b> contar&aacute; com <b>300 ingressos</b> e ser&aacute; distribu&iacute;do para o p&uacute;blico no dia <b><?php echo $timedate->format("d") . $month; ?> a partir das 10 horas</b> na <b>galeria Fernando Chiriboga</b>. Os clientes interessados dever&atilde;o apresentar seu CPF na bilheteria juntamente com documento de identidade com foto e ter&atilde;o direito a retirar no m&aacute;ximo 2 ingressos. Os ingressos ser&atilde;o impressos sem lugar marcado. 
            N&atilde;o haver&aacute; fila de espera ap&oacute;s a distribui&ccedil;&atilde;o de todos os ingressos e somente clientes com ingresso poder&atilde;o entrar no teatro.
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
            <p>
                A Orquestra Sinf&ocirc;nica do RN realiza um prof&iacute;cuo trabalho apresentando
                concertos oficiais no Teatro Riachuelo, concertos populares 
                externos, concertos educativos para toda a rede de ensino, bem como, 
                concertos especiais no interior do Estado.
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
            <h3>Cadastre seu e-mail e receba novidades e not&iacute;cias sobre a OSRN</h3>
            <form name="form_newsletter" action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=OSRN', 'popupwindow', 'scrollbars=yes,width=550,height=520');
                    return true">
                <div id="inputemail">
                    <input id="email_news" placeholder="Seu e-mail" type="email" name="email"/>
                    <input type="hidden" name="opc_newsletter" id="opc_newsletter" value="1"/>
                    <input type="hidden" value="OSRN" name="uri"/>
                    <input type="hidden" name="loc" value="pt_BR"/>
                </div>
                <div id="inputsubmit">
                    <input type="submit" name="submeter" value="Cadastrar" />
                </div>
            </form>
        </div>
    </article>
</section>


