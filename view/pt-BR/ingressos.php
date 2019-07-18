<?php
if (!isset($_SESSION)):
    session_start();
endif;
$_SESSION["origem"] = "ticket";
include_once '../../DAO/AgendaDAO.php';
include_once '../../model/agenda.php';
include_once '../../DAO/ingressoDAO.php';
include_once '../../control/convertDateToString.php';

$_SESSION["register_ticket"] = TRUE;
date_default_timezone_set('America/Fortaleza');
$currentDate = new DateTime();
$concert = new agenda();

$concertosdomes = AgendaDAO::getConcertsMonth();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta property="og:site_name" content="Orquestra Sinf&ocirc;nica do Rio Grande do Norte" />
        <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos" />
        <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/pt/ingressos" />
        <meta property="og:description" content="Formul&aacute;rio para solicita&ccedil;&atilde;o de ingressos para concertos da OSRN" />
        <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/Orquestra Sinfonica do Rio Grande do Norte.jpg" />
        <meta property="og:title" content="Ingressos | OSRN" />
        <meta name="keywords" content="osrn, orquestra, ingressos, reserva de ingressos, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
        <meta name="author" content="Orquestra Sinfonica do Rio Grande do Norte">
        <meta property="og:locale" content="pt_BR">
        <meta property="og:type" content="website" />
        <title>Ingressos | OSRN</title>
        <link href="https://fonts.googleapis.com/css?family=Adamina|Almendra|Amarante|Caudex|Coda+Caption:800|Cormorant+Unicase|Graduate|IM+Fell+Double+Pica+SC|IM+Fell+English+SC|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer+SC|Katibeh|Marcellus+SC|Metamorphous|Pirata+One|Playfair+Display+SC|Spectral+SC" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="http://www.orquestrasinfonicadorn.com.br/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://www.orquestrasinfonicadorn.com.br/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="http://www.orquestrasinfonicadorn.com.br/style/style.css" media="all"/>
        <script type="text/javascript" src="http://www.orquestrasinfonicadorn.com.br/plugins/jquery.maskedinput.js"></script>
    </head>
    <body class="form-tickets">
        <?php
        include_once '../../control/analyticstracking.php';
        ?>
        <div class="container formcontainermain">
            <header class="row">
                <article id="logoosrntickets">
                    <a href="http://www.orquestrasinfonicadorn.com.br" target="_self"><img src="http://www.orquestrasinfonicadorn.com.br/img/logos/logoosrn.png"/></a>
                </article>
            </header>
            <div class="row">
                <main role="main" class="col-sm-12 col-md-12" id="maintickets">
                    <?php
                    if (isset($_GET["idconcerto"]))://entra aqui quando o cliente entrou na página com a lista de concertos e selecionou um concerto para realizar a reserva de ingressos.

                        $idevento = $_GET["idconcerto"];

                        $concert = AgendaDAO::pesquisar($idevento); // cria um objeto com todos os dados do concerto selecionado pelo cliente.
                        //------- CONFIGURAÇÃO DOS DIAS NOS QUAIS SE INICIA E ENCERRA A RESERVA ONLINE DOS INGRESSOS: ------

                        $date_begin = new DateTime($concert->getDataevento() . ' 09:00:00'); // cria um objeto DateTime com a data do concerto
                        $date_end = new DateTime($concert->getDataevento() . ' 23:59:59'); // cria outro objeto DateTime com a data do concerto
                        $date_begin->sub(new DateInterval('P' . $concert->getDaysstartreserve() . 'D')); // define o dia no qual se inicia a reserva online dos ingressos
                        $date_end->sub(new DateInterval("P" . $concert->getDaysendreserve() . "D")); // define o dia no qual se encerra a reserva online dos ingressos
                        // ------ CONFIGURAÇÃO DOS DIAS E HORÁRIOS NOS QUAIS SE INICIA E ENCERRA A RETIRADA DOS INGRESSOS FÍSICOS RESERVADOS NO SITE: ------

                        if ($concert->getReservetimes()): //Entra aqui quando houver dois horários para a retirada dos ingressos:
                            $date_rm_ticket2 = new DateTime($concert->getDataevento() . ' ' . $concert->getSecondestarttimes()); // cria objeto DateTime com a data do concerto e o PRIMEIRO HORÁRIO INICIAL da retirada dos ingressos.
                            $dateEnd_rm_ticket2 = new DateTime($concert->getDataevento() . ' ' . $concert->getSecondeendtimes()); // cria objeto DateTime com a data do concerto e o PRIMEIRO HORÁRIO FINAL da retirada dos ingressos
                            $date_rm_ticket3 = new DateTime($concert->getDataevento() . ' ' . $concert->getThirdstarttimes()); // cria objeto DateTime com a data do concerto e o SEGUNDO HORÁRIO INICIAL  da retirada dos ingressos.
                            $dateEnd_rm_ticket3 = new DateTime($concert->getDataevento() . ' ' . $concert->getThirdendtimes()); // cria objeto DateTime com a data do concerto e o SEGUNDO HORÁRIO FINAL  da retirada dos ingressos.
                        else: //Entra aqui quando só houver um horário para a retirada dos ingressos:
                            $date_rm_ticket = new DateTime($concert->getDataevento() . ' ' . $concert->getFirststarttimes()); // cria objeto DateTime com a data do concerto e o HORÁRIO INICIAL  da retirada dos ingressos.
                            $dateEnd_rm_ticket = new DateTime($concert->getDataevento() . ' ' . $concert->getFirstendtimes()); // cria objeto DateTime com a data do concerto e o HORÁRIO FINAL  da retirada dos ingressos.
                        endif;

                        //configuração dos dias para a retirada dos ingressos
                        if ($concert->getReservetimes()): //Entra aqui quando houver dois horários para a retirada dos ingressos:
                            $date_rm_ticket2->sub(new DateInterval("P" . $concert->getStartwithdrawaltickets() . "D")); // define o DIA do PRIMEIRO HORÁRIO INICIAL da retirada de ingressos.
                            $dateEnd_rm_ticket2->sub(new DateInterval("P" . $concert->getStartwithdrawaltickets() . "D"));  // define o DIA do PRIMEIRO HORÁRIO FINAL da retirada de ingressos.
                            $date_rm_ticket3->sub(new DateInterval("P" . $concert->getEndwithdrawaltickets() . "D"));  // define o DIA do SEGUNDO HORÁRIO INICIAL da retirada de ingressos.
                            $dateEnd_rm_ticket3->sub(new DateInterval("P" . $concert->getEndwithdrawaltickets() . "D"));  // define o DIA do SEGUNDO HORÁRIO FINAL da retirada de ingressos.
                        else: //Entra aqui quando só houver um horário para a retirada dos ingressos:
                            $date_rm_ticket->sub(new DateInterval("P" . $concert->getStartwithdrawaltickets() . "D")); // define o DIA do HORÁRIO INICIAL da retirada de ingressos.
                            $dateEnd_rm_ticket->sub(new DateInterval("P" . $concert->getStartwithdrawaltickets() . "D")); // define o DIA do HORÁRIO FINAL da retirada de ingressos.
                        endif;


                        //convertendo o nome do mês do concerto de inglês para português
                        $date_event = new DateTime($concert->getDataevento());
                        $convertdate = new convertDateToString();
                        $month_event = $convertdate->convertMonthToPortuguese($date_event->format("m"));


                        //convertendo os dias da semana em que podem ser retirados os ingressos físicos de inglês para português
                        if ($concert->getReservetimes()):
                            $dia1DeRetirarIngresso = translateWeekDaysName($date_rm_ticket2->format("l"));
                            $dia2DeRetirarIngresso = translateWeekDaysName($date_rm_ticket3->format("l"));
                        else:
                            $dia0DeRetirarIngresso = translateWeekDaysName($date_rm_ticket->format("l"));
                        endif;


                        $verify_amount = ingressoDAO::checkAmount($concert->getIdevento(), $concert->getAmountticket());

                        $request = "";
                        if (isset($_GET['rst']))://variável que trás a resposta da submissão do formulário.
                            $request = $_GET['rst'];
                        endif;
                        if ($date_begin < $currentDate and $currentDate < $date_end):// Só entra aqui quando o formulário está disponível para reservas.
                            if ($verify_amount):
                                if ($request == 'success'): // Entra aqui quando o cliente submeteu o formulário. Aqui ele receberá a confirmação positiva da sua submissão.
                                    echo '<div class="col-sm-12 col-md-12">
                                                <div class="col-sm-12 col-md-12">
                                                    <br/><br/>
                                                    <a href="http://www.orquestrasinfonicadorn.com.br">In&iacute;cio</a>&numsp;&numsp;
                                                    <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Selecione outro concerto</a>
                                                    <br/><br/>
                                                </div>';
                                    echo '<h3 style="color: green; font-weight: bold;">';
                                    echo 'Parab&eacute;ns! Seu ingresso para o concerto do dia ' . $date_event->format("d") . ', no ' . $concert->getLocal() . ', foi reservado com sucesso!';
                                    echo '</h3>';
                                    if ($concert->getReservetimes()):
                                        echo '<p>Compare&ccedil;a pessoalmente com o seu CPF em m&atilde;os na ' . $concert->getPlacetickets() . ', localizada no ' . $concert->getPlaceticketaddress() . ', no dia ' . $date_rm_ticket2->format("d") . ' de ' . $month_event . ' (' . $dia1DeRetirarIngresso . ') das ' . $date_rm_ticket2->format("H") . 'hrs as ' . $dateEnd_rm_ticket2->format("H") . 'hrs ou no dia ' . $date_rm_ticket3->format("d") . ' de ' . $month_event . ' (' . $dia2DeRetirarIngresso . '), das ' . $date_rm_ticket3->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket3->format("H") . 'hrs ' . 'e retire seu ingresso. O titular do CPF cadastrado ter&aacute; direito a no m&aacute;ximo 2 (dois) ingressos.</p> <p>Somente o titular do CPF cadastrado poder&aacute; realizar a retirada do ingresso, sendo irrevog&aacute;vel para qualquer circunst&acirc;ncia. Assim como tamb&eacute;m, os ingressos s&oacute; ser&atilde;o distribu&iacute;dos na ' . $concert->getPlacetickets() . ', no dia ' . $date_rm_ticket2->format("d") . ' de ' . $month_event . ' (' . $dia1DeRetirarIngresso . ') das ' . $date_rm_ticket2->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket2->format("H") . 'hrs e no dia ' . $dateEnd_rm_ticket3->format("d") . ' de ' . $month_event . ' (' . $dia2DeRetirarIngresso . '), das ' . $date_rm_ticket3->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket3->format("H") . 'hrs. ' . 'N&atilde;o ser&aacute; realizada a distribui&ccedil;&atilde;o fora desse hor&aacute;rio.</p>';
                                    else:
                                        echo '<p>Compare&ccedil;a pessoalmente com o seu CPF em m&atilde;os na ' . $concert->getPlacetickets() . ', localizada no ' . $concert->getPlaceticketaddress() . ', neste pr&oacute;ximo dia ' . $date_rm_ticket->format("d") . ' de ' . $month_event . '(' . $dia0DeRetirarIngresso . '), das ' . $date_rm_ticket->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket->format("H") . 'hrs e retire seu ingresso. Somente o titular do CPF cadastrado poder&aacute; realizar a retirada do ingresso, sendo irrevog&aacute;vel para qualquer circunst&acirc;ncia. Assim como tamb&eacute;m, os ingressos s&oacute; ser&atilde;o distribu&iacute;dos na ' . $concert->getPlacetickets() . ', neste pr&oacute;ximo dia ' . $date_rm_ticket->format('d') . ' de ' . $month_event . ' (' . $dia0DeRetirarIngresso . '), das ' . $date_rm_ticket->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket->format("H") . 'hrs. N&atilde;o ser&aacute; realizada a distribui&ccedil;&atilde;o fora desse hor&aacute;rio.</p>';
                                    endif;

                                    echo '</div>';
                                elseif ($request == 'dennied'): // Entra aqui quando o formulário estava disponível, o cliente o acessou, mas antes dele submeter, se esgotaram os ingressos. Este if com condição DENNIED está aqui mas provavelmente será pouco utilizado.
                                    echo '<div class="col-sm-12 col-md-12">
                                                <div class="col-sm-12 col-md-12">
                                                    <br/><br/>
                                                    <a href="http://www.orquestrasinfonicadorn.com.br">In&iacute;cio</a>&numsp;&numsp;
                                                    <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Selecione outro concerto</a>
                                                    <br/><br/>
                                                </div>';
                                    echo '<h3 style="font-weight: bold; color: red; text-align: center">';
                                    echo 'A RESERVA DO SEU INGRESSO PARA O CONCERTO DO DIA ' . $date_event->format("d") . ', no ' . $concert->getLocal() . ', N&Atilde;O FOI COMPLETADA!';
                                    echo '</h3>';
                                    echo '<h5 style="font-weight: bold; color: red;">';
                                    echo 'Motivo: Antes de voc&ecirc; enviar os seus dados o LOTE INTERNET PARA ESSE CONCERTO ESGOTOU!';
                                    echo '</h5>';

                                    if ($concert->getBoxofficelot()):
                                        echo '<p>';
                                        echo 'Voc&ecirc; ainda pode retirar seu ingresso no LOTE BILHETERIA no dia <span style="font-weight: bold">' . $date_event->format("d") . ' de ' . $month_event . ' a partir das 10 hrs</span> na bilheteria da ' . $concert->getPlacetickets() . ', localizada no ' . $concert->getPlaceticketaddress() . '. As pessoas interessadas dever&atilde;o apresentar seu CPF na bilheteria da ' . $concert->getPlacetickets() . '. Cada pessoa ter&aacute; direito a retirar at&eacute; 2 ingressos.';
                                        echo '</p>';
                                    else:
                                        echo '<p>';
                                        echo 'N&Atilde;O HAVER&Aacute; LOTE BILHETERIA PARA O CONCERTO DO DIA ' . $date_event->format("d") . 'A SER REALIZADO NA ' . $concert->getLocal() . '. TODA A DISTRIBUI&Ccedil;&Atilde;O SER&Aacute; FEITA PELO LOTE INTERNET.';
                                        echo '</p>';
                                    endif;
                                    echo '</div>';
                                else: //Entra aqui quando o formulário estiver disponível, o cliente o acessou, mas não o submeteu ainda.
                                    ?>
                                    <div class="col-sm-12 col-md-12 ">
                                        <div class="col-sm-12 col-md-12">
                                            <br/><br/>
                                            <a href="http://www.orquestrasinfonicadorn.com.br">In&iacute;cio</a>&numsp;&numsp;
                                            <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Selecione outro concerto</a>
                                            <br/><br/>
                                        </div>
                                        <di.v class="animation" id="box">
                                            <h5 style="font-weight: bold; color: #993300; text-align:  justify">Preencha o formul&aacute;rio abaixo e reserve aqui o seu ingresso!</h5>
                                    </div>
                                    <p style="text-align:  justify">
                                        <strong>Para o concerto do dia <?php echo $date_event->format("d") ?>, no <?php echo $concert->getLocal() ?> </strong>, a reserva de ingressos online estar&aacute; dispon&iacute;vel a partir das 9:00 horas do dia <?php echo $date_begin->format("d"); ?> at&eacute; &agrave;s 23:59 do dia <?php echo $date_end->format("d"); ?>, ou at&eacute; esgotar os ingressos do LOTE INTERNET, o que acabar primeiro.
                                    </p>

                                    <?php
                                    if ($concert->getReservetimes()):
                                        echo '<p>Ap&oacute;s prencher o formul&aacute;rio e receber a confirma&ccedil;&atilde;o, compare&ccedil;a pessoalmente com o seu CPF em m&atilde;os na ' . $concert->getPlacetickets() . ', localizada no ' . $concert->getPlaceticketaddress() . ', no dia ' . $date_rm_ticket2->format("d") . ' de ' . $month_event . ' (' . $dia1DeRetirarIngresso . ') das ' . $date_rm_ticket2->format("H") . 'hrs as ' . $dateEnd_rm_ticket2->format("H") . 'hrs ou no dia ' . $date_rm_ticket3->format("d") . ' de ' . $month_event . ' (' . $dia2DeRetirarIngresso . '), das ' . $date_rm_ticket3->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket3->format("H") . 'hrs ' . 'e retire seu ingresso. O titular do CPF cadastrado ter&aacute; direito a no m&aacute;ximo 2 (dois) ingressos.</p> <p>Somente o titular do CPF cadastrado poder&aacute; realizar a retirada do ingresso, sendo irrevog&aacute;vel para qualquer circunst&acirc;ncia. Assim como tamb&eacute;m, os ingressos s&oacute; ser&atilde;o distribu&iacute;dos na ' . $concert->getPlacetickets() . ', no dia ' . $date_rm_ticket2->format("d") . ' de ' . $month_event . ' (' . $dia1DeRetirarIngresso . ') das ' . $date_rm_ticket2->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket2->format("H") . 'hrs e no dia ' . $dateEnd_rm_ticket3->format("d") . ' de ' . $month_event . ' (' . $dia2DeRetirarIngresso . '), das ' . $date_rm_ticket3->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket3->format("H") . 'hrs. ' . 'N&atilde;o ser&aacute; realizada a distribui&ccedil;&atilde;o fora desse hor&aacute;rio.</p>';
                                    else:
                                        echo '<p>Ap&oacute;s prencher o formul&aacute;rio e receber a confirma&ccedil;&atilde;o, compare&ccedil;a pessoalmente com o seu CPF em m&atilde;os na ' . $concert->getPlacetickets() . ', localizada no ' . $concert->getPlaceticketaddress() . ', neste pr&oacute;ximo dia ' . $date_rm_ticket->format("d") . ' de ' . $month_event . '(' . $dia0DeRetirarIngresso . '), das ' . $date_rm_ticket->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket->format("H") . 'hrs e retire seu ingresso. Somente o titular do CPF cadastrado poder&aacute; realizar a retirada do ingresso, sendo irrevog&aacute;vel para qualquer circunst&acirc;ncia. Assim como tamb&eacute;m, os ingressos s&oacute; ser&atilde;o distribu&iacute;dos na ' . $concert->getPlacetickets() . ', neste pr&oacute;ximo dia ' . $date_rm_ticket->format('d') . ' de ' . $month_event . ' (' . $dia0DeRetirarIngresso . '), das ' . $date_rm_ticket->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket->format("H") . 'hrs. N&atilde;o ser&aacute; realizada a distribui&ccedil;&atilde;o fora desse hor&aacute;rio.</p>';
                                    endif;
                                    ?>


                                    <p style="text-align:  justify">A Funda&ccedil;&atilde;o Jos&eacute; Augusto est&aacute; ampliando o acervo das bibliotecas das Casas de Cultura do Estado. Voc&ecirc; pode ser um colaborador! Ao retirar seu ingresso doe um livro liter&aacute;rio para compor esse novo acervo das Casas de Cultura do Estado do Rio Grande do Norte. Seja um colaborador!</p>
                                    <?php if ($concert->getBoxofficelot()): ?>
                                        <p style="text-align:  justify">Os ingressos que n&atilde;o forem retirados neste per&iacute;odo, mesmo tendo sido cadastrados aqui no website da OSRN, passar&atilde;o a compor o <strong>LOTE BILHETERIA</strong>. O lote bilheteria contar&aacute; com <span style="font-weight: bold; color:  #993300">300 ingressos</span> e ser&aacute; distribu&iacute;do para o p&uacute;blico no dia <span style="font-weight: bold; color:  #993300"><?php echo $date_event->format("d") . ' de ' . $month_event; ?>, a partir das 10 hrs</span> na bilheteria da <?php echo $concert->getPlacetickets(); ?>. As pessoas interessadas dever&atilde;o apresentar seu CPF . Cada pessoa ter&aacute; direito a retirar at&eacute; 2 ingressos.</p>
                                    <?php else: ?>
                                        <p  style="text-align:  justify">N&Atilde;O HAVER&Aacute; LOTE BILHETERIA PARA O CONCERTO DO DIA <?php echo $date_event->format("d") . ' NA ' . $concert->getLocal(); ?>. TODA A DISTRIBUI&Ccedil;&Atilde;O SER&Aacute; FEITA PELO LOTE INTERNET.</p>
                                    <?php endif; ?>
                                    <form action="../../control/controlIngresso.php" method="post" name="registerIngresso">
                                        <input type="hidden" name="opc" value="1"/>
                                        <input type="hidden" name="date_begin" value="<?php echo $date_begin->format("Y-m-d H:i:s"); ?>"/>
                                        <input type="hidden" name="date_end" value="<?php echo $date_end->format("Y-m-d H:i:s"); ?>"/>
                                        <input type="hidden" name="currentDate" value="<?php echo $currentDate->format("Y-m-d H:i:s"); ?>"/>
                                        <input type="hidden" name="idconcert" value="<?php echo $concert->getIdevento(); ?>"/>
                                        <div class="form-group form-group-ingressos">
                                            <label for="campo_nome">Nome:</label>
                                            <input type="text" class="form-control" name="name-ingressos" required="true"/>
                                        </div>

                                        <?php
                                        if ($request == "invalidCpf"):
                                            echo '<p style="color: red; font-weight: bold">';
                                            echo 'CPF inv&aacute;lido!';
                                            echo '</p>';
                                        elseif ($request == "invalidCharCpf") :
                                            echo '<p style="color: red; font-weight: bold">';
                                            echo 'Caracteres inv&aacute;lidos para o campo CPF!';
                                            echo '</p>';
                                        elseif ($request == "arealdyExists"):
                                            echo '<p style="color: red; font-weight: bold">';
                                            echo 'CPF J&aacute; cadastrado!';
                                            echo '</p>';
                                        elseif ($request == "cpfBloqueado"):
                                            echo '<p style="color: red; font-weight: bold">';
                                            echo 'Este CPF se encontra bloqueado no sistema da OSRN por falta de inatividade!';
                                            echo '</p>';
                                        endif;
                                        ?>
                                        <div class="form-group form-group-ingressos">
                                            <label for="campo_nome">CPF:</label>
                                            <input type="text" class="form-control" id="cpf" name="cpf-ingressos" required="true"/>
                                        </div>
                                        <div class="form-group form-group-ingressos">
                                            <label for="campo_email">E-mail:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-group-addon-ingressos">@</span>
                                                <input type="email" class="form-control" placeholder="email@exemplo.com" id="email" name="email-ingressos" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group form-group-ingressos">
                                            <label for="campo_tel">WhatsApp:</label>
                                            <input type="text" class="form-control"  name="telefone-ingressos" id="telefone" required="true"/>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" name="submit-ingressos" value="Concluir"  class="btn btn-primary" />
                                            <!--<input type="reset" value="Limpar"  class="btn" />-->
                                        </div>
                                    </form>
                                    <script type="text/javascript">
                                        jQuery(function ($) {
                                            $("#telefone").mask("(99) 99999-9999");
                                            $("#cpf").mask("99999999999");
                                        });
                                    </script>
                                    <br/><br/><br/>
                            </div>
                            <script type="text/javascript">
                                $(function () {
                                    $('#box').animate({
                                        marginLeft: "75%"
                                    }, 1600);
                                });
                            </script>
                        <?php
                        endif;
                    else:
                        if ($request == 'success'): // Entra aqui quando o último ingresso foi reservado com sucesso.
                            echo '<div class="col-sm-12 col-md-12">';
                            echo '  <div class="col-sm-12 col-md-12">
                                            <br/><br/>
                                            <a href="http://www.orquestrasinfonicadorn.com.br">In&iacute;cio</a>&numsp;&numsp;
                                            <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Selecione outro concerto</a>
                                            <br/><br/>
                                        </div>';
                            echo '<h3 style="color: green; font-weight: bold;">';
                            echo 'Parab&eacute;ns! Seu ingresso para o concerto do dia ' . $date_event->format("d") . ', no ' . $concert->getLocal() . ', foi reservado com sucesso!';
                            echo '</h3>';

                            if ($concert->getReservetimes()):
                                echo '<p>Compare&ccedil;a pessoalmente com o seu CPF em m&atilde;os na ' . $concert->getPlacetickets() . ', localizada no ' . $concert->getPlaceticketaddress() . ', no dia ' . $date_rm_ticket2->format("d") . ' de ' . $month_event . ' (' . $dia1DeRetirarIngresso . ') das ' . $date_rm_ticket2->format("H") . 'hrs as ' . $dateEnd_rm_ticket2->format("H") . 'hrs ou no dia ' . $date_rm_ticket3->format("d") . ' de ' . $month_event . ' (' . $dia2DeRetirarIngresso . '), das ' . $date_rm_ticket3->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket3->format("H") . 'hrs ' . 'e retire seu ingresso. O titular do CPF cadastrado ter&aacute; direito a no m&aacute;ximo 2 (dois) ingressos.</p> <p>Somente o titular do CPF cadastrado poder&aacute; realizar a retirada do ingresso, sendo irrevog&aacute;vel para qualquer circunst&acirc;ncia. Assim como tamb&eacute;m, os ingressos s&oacute; ser&atilde;o distribu&iacute;dos na ' . $concert->getPlacetickets() . ', no dia ' . $date_rm_ticket2->format("d") . ' de ' . $month_event . ' (' . $dia1DeRetirarIngresso . ') das ' . $date_rm_ticket2->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket2->format("H") . 'hrs e no dia ' . $dateEnd_rm_ticket3->format("d") . ' de ' . $month_event . ' (' . $dia2DeRetirarIngresso . '), das ' . $date_rm_ticket3->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket3->format("H") . 'hrs. ' . 'N&atilde;o ser&aacute; realizada a distribui&ccedil;&atilde;o fora desse hor&aacute;rio.</p>';
                            else:
                                echo '<p>Compare&ccedil;a pessoalmente com o seu CPF em m&atilde;os na ' . $concert->getPlacetickets() . ', localizada no ' . $concert->getPlaceticketaddress() . ', neste pr&oacute;ximo dia ' . $date_rm_ticket->format("d") . ' de ' . $month_event . '(' . $dia0DeRetirarIngresso . '), das ' . $date_rm_ticket->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket->format("H") . 'hrs e retire seu ingresso. Somente o titular do CPF cadastrado poder&aacute; realizar a retirada do ingresso, sendo irrevog&aacute;vel para qualquer circunst&acirc;ncia. Assim como tamb&eacute;m, os ingressos s&oacute; ser&atilde;o distribu&iacute;dos na ' . $concert->getPlacetickets() . ', neste pr&oacute;ximo dia ' . $date_rm_ticket->format('d') . ' de ' . $month_event . ' (' . $dia0DeRetirarIngresso . '), das ' . $date_rm_ticket->format("H") . 'hrs &agrave;s ' . $dateEnd_rm_ticket->format("H") . 'hrs. N&atilde;o ser&aacute; realizada a distribui&ccedil;&atilde;o fora desse hor&aacute;rio.</p>';
                            endif;

                            echo '</div>';
                        elseif ($request == 'dennied'):  // Entra aqui quando o formulário estava disponível, o cliente o acessou, mas antes dele submeter, se esgotaram os ingressos. 
                            echo '<div class="col-sm-12 col-md-12">';
                            echo '  <div class="col-sm-12 col-md-12">
                                           <br/><br/>
                                            <a href="http://www.orquestrasinfonicadorn.com.br">In&iacute;cio</a>&numsp;&numsp;
                                            <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Selecione outro concerto</a>
                                           <br/><br/>
                                        </div>';
                            echo '<h3 style="font-weight: bold; color: red; text-align: center">';
                            echo 'A RESERVA DO SEU INGRESSO PARA O CONCERTO DO DIA ' . $date_event->format("d") . ', no ' . $concert->getLocal() . ', N&Atilde;O FOI COMPLETADA!';
                            echo '</h3>';
                            echo '<h5 style="font-weight: bold; color: red;">';
                            echo 'Motivo: Antes de voc&ecirc; enviar os seus dados o LOTE INTERNET PARA ESSE CONCERTO ESGOTOU!';
                            echo '</h5>';
                            if ($concert->getBoxofficelot()):
                                echo '<p>';
                                echo 'Voc&ecirc; ainda pode retirar seu ingresso no LOTE BILHETERIA no dia <span style="font-weight: bold">' . $date_event->format("d") . ' de ' . $month_event . ' a partir das 10hrs</span> na bilheteria da ' . $concert->getPlacetickets() . '. As pessoas interessadas dever&atilde;o apresentar seu CPF. Cada pessoa ter&aacute; direito a retirar at&eacute; 2 ingressos.';
                                echo '</p>';
                            else:
                                echo '<p>';
                                echo 'N&Atilde;O HAVER&Aacute; LOTE BILHETERIA PARA O CONCERTO DO DIA ' . $date_event->format("d") . ' NA ' . $concert->getLocal() . '. TODA A DISTRIBUI&Ccedil;&Atilde;O SER&Aacute; FEITA PELO LOTE INTERNET.';
                                echo '</p>';
                            endif;
                            echo '</div>';
                        else:
                            ?>
                            <div class="col-sm-12 col-md-12">
                                <div class="col-sm-12 col-md-12">
                                    <a href="http://www.orquestrasinfonicadorn.com.br">In&iacute;cio</a>&numsp;&numsp;
                                    <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Selecione outro concerto</a>
                                </div>
                                <div class="animation" id="box">
                                    <h4>Ingressos</h4>
                                </div>
                                <h3 style="font-weight: bold; color: red; text-align: center">
                                    O LOTE INTERNET PARA O CONCERTO DO DIA <?php echo $date_event->format("d") ?>, NO <?php echo $concert->getLocal() ?>, ESGOTOU!
                                </h3>
                                <?php if ($concert->getBoxofficelot()): ?>
                                    <p>
                                        Voc&ecirc; ainda pode retirar seu ingresso no LOTE BILHETERIA no dia <span style="font-weight: bold"><?php echo $date_event->format("d") . ' de ' . $month_event; ?> a partir das 10hrs</span> na bilheteria da <?php echo $concert->getPlacetickets(); ?>. As pessoas interessadas dever&atilde;o apresentar seu CPF. Cada pessoa ter&aacute; direito a retirar at&eacute; 2 ingressos.
                                    </p>
                                <?php else: ?>
                                    <p>N&Atilde;O HAVER&Aacute; LOTE BILHETERIA PARA O CONCERTO DO DIA <?php echo $date_event->format("d"); ?>  NA <?php echo $concert->getLocal(); ?>. TODA A DISTRIBUI&Ccedil;&Atilde;O SER&Aacute; FEITA PELO LOTE INTERNET.</p>
                                <?php endif; ?>
                            </div>
                        <?php
                        endif;
                    endif;
                else://entra aqui quando o formulário não está disponível para reservas. 
                    ?>
                    <div class="col-sm-12 col-md-12">
                        <div class="col-sm-12 col-md-12">
                            <a href="http://www.orquestrasinfonicadorn.com.br">In&iacute;cio</a>&numsp;&numsp;
                            <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Selecione outro concerto</a>
                        </div>
                        <div class="animation" id="box">
                            <h4>Ingressos</h4>
                        </div>
                        <?php echo '<p>' . $currentDate->format("d/m/Y H:i:s") . '</p>'; ?>
                        <p>
                            <strong>Para o concerto do dia <?php echo $date_event->format("d"); ?>, no <?php echo $concert->getLocal(); ?> </strong>, a reserva de ingressos online n&atilde;o est&aacute; liberada no momento. A libera&ccedil;&atilde;o acontece sempre uma semana antes da realiza&ccedil;&atilde;o do concerto.
                        </p>
                        <p>
                            Para o concerto de <?php echo $month_event . '/' . $date_event->format("Y") ?> a ser realizado no dia <?php echo $date_event->format("d"); ?>/<?php echo $date_event->format("m"); ?>, a reserva online estar&aacute; liberada a partir das 9 horas do dia <?php echo $date_begin->format("d"); ?> at&eacute; &agrave;s 23:59 do dia <?php echo $date_end->format("d"); ?>, ou at&eacute; esgotarem os ingressos, o que acabar primeiro.<br/> <span style="font-weight: bold; color:  #993300">Fique atento!</span>
                        </p>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#box').animate({
                                marginLeft: "75%"
                            }, 1600);
                        });
                    </script>
                <?php endif; ?> 
            <?php elseif (count($concertosdomes) >= 1): ?>
                <div class="col-sm-12 col-md-12">
                    <div class="col-sm-12 col-md-12">
                        <br/><br/>
                        <a href="http://www.orquestrasinfonicadorn.com.br">In&iacute;cio</a>
                        <br/><br/>
                    </div>
                    <p>
                        Selecione abaixo o concerto para qual deseja reservar o seu ingresso
                    </p>
                    <?php
                    foreach ($concertosdomes as $concertos):
                        $dateconcert = new DateTime($concertos["dataevento"]);
                        ?>
                        <p>
                            <?php
                            if ($concertos["loteinternet"] == '0'):
                                ?>
                                Concerto do dia <?php echo $dateconcert->format('d'); ?> no <?php echo $concertos["local"] ?>.
                                <strong>(N&atilde;o haver&aacute; reserva de ingressos para este concerto.)</strong>
                                <?php
                            elseif ($concertos["loteinternet"] == '1'):
                                ?>
                                <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos/<?php echo $concertos["idevento"]; ?>" target="_self">
                                    Concerto do dia <?php echo $dateconcert->format('d'); ?> no <?php echo $concertos["local"] ?>.
                                </a>
                                <?php
                            endif;
                            ?>
                        </p>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="col-sm-12 col-md-12">
                    <div class="col-sm-12 col-md-12">
                        <br/><br/>
                        <a href="http://www.orquestrasinfonicadorn.com.br">In&iacute;cio</a>&numsp;&numsp;
                        <br/><br/>
                    </div>
                    <div class="animation" id="box">
                        <h4>Ingressos</h4>
                    </div>
                    <?php echo '<p>' . $currentDate->format("d/m/Y H:i:s") . '</p>'; ?>
                    <p>
                        A reserva de ingressos online n&atilde;o est&aacute; liberada no momento. A libera&ccedil;&atilde;o acontece sempre uma semana antes da realiza&ccedil;&atilde;o do concerto.
                    </p>
                    <h5 style="font-weight: bold; color: #993300; text-align:  justify">Ajude a Funda&ccedil;&atilde;o Jos&eacute; Augusto a ampliar o acervo das bibliotecas das Casas de Cultura do Rio Grande do Norte!</h5>
                    <p style="text-align:  justify">A Funda&ccedil;&atilde;o Jos&eacute; Augusto est&aacute; ampliando o acervo das bibliotecas das Casas de Cultura do Estado. Voc&ecirc; pode ser um colaborador! Ao retirar seu ingresso doe um livro liter&aacute;rio para compor esse novo acervo das Casas de Cultura do Estado do Rio Grande do Norte. Seja um colaborador!</p>
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('#box').animate({
                            marginLeft: "75%"
                        }, 1600);
                    });
                </script>
            <?php endif; ?>
        </main>
    </div>
    <footer class="row">
        <p>
            &copy; 2014 Copyright Orquestra Sinfônica do Rio Grande do Norte | Desenvolvimento: <a href="http://odairss.blogspot.com.br/" target="_blank">Odair Soares</a>
        </p>
    </footer>
</div>
</body>
</html>
<?php

function translateWeekDaysName($day) {
    $convertedDay = "";
    if ($day == "Sunday"):
        $convertedDay = 'domingo';
    elseif ($day == "Saturday"):
        $convertedDay = 'sábado';
    elseif ($day == "Monday"):
        $convertedDay = 'segunda-feira';
    elseif ($day == "Tuesday"):
        $convertedDay = "terça-feira";
    elseif ($day == "Wednesday"):
        $convertedDay = 'quarta-feira';
    elseif ($day == "Thursday"):
        $convertedDay = "quinta-feira";
    elseif ($day == "Friday"):
        $convertedDay = 'sexta-feira';
    endif;
    return $convertedDay;
}
