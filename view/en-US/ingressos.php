<?php
if (!isset($_SESSION)):
    session_start();
endif;
$_SESSION["origem"] = "ticket";
include_once '../../DAO/AgendaDAO.php';
include_once '../../model/agenda.php';
include_once '../../DAO/ingressoDAO.php';

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
        <title>Tickets | OSRN</title>
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

                        $date_event = new DateTime($concert->getDataevento());


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
                                                    <a href="http://www.orquestrasinfonicadorn.com.br">Back to home page</a>&numsp;&numsp;
                                                    <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Select another concert</a>
                                                    <br/><br/>
                                                </div>';
                                    echo '<h3 style="color: green; font-weight: bold;">';
                                    echo 'Congratulations! Your ticket to the ' . $date_event->format("d") . 'th concert in the' . $concert->getLocal() . ' has been booked successfully!';
                                    echo '</h3>';
                                    if ($concert->getReservetimes()):
                                        echo 'Attend personally with your CPF at the ' . $concert->getPlacetickets() . ', located at ' . $concert->getPlaceticketaddress() . ', on ' . $date_event->format("F") . ' ' . $date_rm_ticket2->format("d") . ' (' . $date_rm_ticket2->format("l") . ') from ' . $date_rm_ticket2->format("h a") . ' to ' . $dateEnd_rm_ticket2->format("h a") . ' or on ' . $date_event->format("F") . ' ' . $date_rm_ticket3->format("d") . ' (' . $date_rm_ticket3->format("l") . ') from ' . $date_rm_ticket3->format("h a") . ' to ' . $dateEnd_rm_ticket3->format("h a") . ' ticket. The registered CPF holder shall be entitled to a maximum of two (2) tickets. Only the registered CPF holder can make the withdrawal of the ticket, being irrevocable for any circumstance. As well as that, the tickets will only be distributed at ' . $concert->getPlacetickets() . ' on ' . $date_event->format("F") . ' ' . $date_rm_ticket2->format("d") . ' (' . $date_rm_ticket2->format("l") . ') from ' . $date_rm_ticket2->format("h a") . ' to ' . $dateEnd_rm_ticket2->format("h a") . ' and on ' . $date_event->format("F") . ' ' . $date_rm_ticket3->format("d") . ' (' . $date_rm_ticket3->format("l") . '), from ' . $date_rm_ticket3->format("h a") . ' to ' . $dateEnd_rm_ticket3->format("h a") . ' Distribution will not take place outside these hours.';
                                    else:
                                        echo 'Come personally with your CPF in hand at ' . $concert->getPlacetickets() . ', located at the ' . $concert->getPlaceticketaddress() . ', this coming ' . $date_rm_ticket->format("d") . 'th of ' . $date_event->format("F") . ' (' . $date_rm_ticket->format("l") . '), from ' . $date_rm_ticket->format("h a") . ' to ' . $dateEnd_rm_ticket->format("h a") . ' and withdraw your ticket. Only the registered CPF holder can make the withdrawal of the ticket, being irrevocable for any circumstance. As well as that, the tickets will only be distributed in ' . $concert->getPlacetickets() . ', this next ' . $date_rm_ticket->format('d') . 'th of ' . $date_event->format("F") . ' (' . $date_rm_ticket->format('l') . '), from ' . $date_rm_ticket->format('h a') . ' to ' . $dateEnd_rm_ticket->format('h a') . '. Distribution will not take place outside these hours.';
                                    endif;

                                    echo '</div>';
                                elseif ($request == 'dennied'): // Entra aqui quando o formulário estava disponível, o cliente o acessou, mas antes dele submeter, se esgotaram os ingressos. Este if com condição DENNIED está aqui mas provavelmente será pouco utilizado.
                                    echo '<div class="col-sm-12 col-md-12">
                                                <div class="col-sm-12 col-md-12">
                                                    <br/><br/>
                                                    <a href="http://www.orquestrasinfonicadorn.com.br">Back to home page</a>&numsp;&numsp;
                                                    <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Select another concert</a>
                                                    <br/><br/>
                                                </div>';
                                    echo '<h3 style="font-weight: bold; color: red; text-align: center">';
                                    echo 'THE RESERVATION OF YOUR REGISTRATION FOR THE CONCERT OF THE ' . $date_event->format("d") . 'TH DAY, AT THE ' . $concert->getLocal() . ' WAS NOT COMPLETED!';
                                    echo '</h3>';
                                    echo '<h5 style="font-weight: bold; color: red;">';
                                    echo 'Reason: Before you send your data the INTERNET LOT FOR THAT CONCERT CLEARED!';
                                    echo '</h5>';

                                    if ($concert->getBoxofficelot()):
                                        echo '<p>';
                                        echo 'You can still withdraw your ticket by LOTE BILHETERIA on  <span style="font-weight: bold">' . $date_event->format("F") . ' ' . $date_event->format("d") . 'th from 10am</span> at the box office of ' . $concert->getPlacetickets() . ', located in ' . $concert->getPlaceticketaddress() . '. Interested persons should present their CPF. Each person will have the right to withdraw up to 2 tickets.';
                                        echo '</p>';
                                    else:
                                        echo '<p>';
                                        echo 'THERE WILL NOT BE LOT BILLETTE FOR THE ' . $date_event->format("d") . 'TH CONCERT TO BE HELD AT THE ' . $concert->getLocal() . '. ALL DISTRIBUTION WILL BE MADE BY THE INTERNET LOT.';
                                        echo '</p>';
                                    endif;
                                    echo '</div>';
                                else: //Entra aqui quando o formulário estiver disponível, o cliente o acessou, mas não o submeteu ainda.
                                    ?>
                                    <div class="col-sm-12 col-md-12 ">
                                        <div class="col-sm-12 col-md-12">
                                            <br/><br/>
                                            <a href="http://www.orquestrasinfonicadorn.com.br">Back to home page</a>&numsp;&numsp;
                                            <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Select another concert</a>
                                            <br/><br/>
                                        </div>
                                        <di.v class="animation" id="box">
                                            <h5 style="font-weight: bold; color: #993300; text-align:  justify">Fill out the form below and book your ticket here!</h5>
                                    </div>
                                    <p style="text-align:  justify">
                                        <strong>For the concert of the <?php echo $date_event->format("d") ?>th, at the <?php echo $concert->getLocal() ?></strong>, the online ticket reservation will be available from 9:00 pm on the <?php echo $date_begin->format("d"); ?>th until the 11:59 pm on the <?php echo $date_end->format("d"); ?>th, or until the LOTE INTERNET tickets are exhausted, whichever comes first .
                                    </p>

                                    <?php
                                    if ($concert->getReservetimes()):
                                        echo 'After completing the form and receiving confirmation, attend personally with your CPF at the ' . $concert->getPlacetickets() . ', located at ' . $concert->getPlaceticketaddress() . ', on ' . $date_event->format("F") . ' ' . $date_rm_ticket2->format("d") . ' (' . $date_rm_ticket2->format("l") . ') from ' . $date_rm_ticket2->format("h a") . ' to ' . $dateEnd_rm_ticket2->format("h a") . ' or on ' . $date_event->format("F") . ' ' . $date_rm_ticket3->format("d") . ' (' . $date_rm_ticket3->format("l") . ') from ' . $date_rm_ticket3->format("h a") . ' to ' . $dateEnd_rm_ticket3->format("h a") . ' ticket. The registered CPF holder shall be entitled to a maximum of two (2) tickets. Only the registered CPF holder can make the withdrawal of the ticket, being irrevocable for any circumstance. As well as that, the tickets will only be distributed at ' . $concert->getPlacetickets() . ' on ' . $date_event->format("F") . ' ' . $date_rm_ticket2->format("d") . ' (' . $date_rm_ticket2->format("l") . ') from ' . $date_rm_ticket2->format("h a") . ' to ' . $dateEnd_rm_ticket2->format("h a") . ' and on ' . $date_event->format("F") . ' ' . $date_rm_ticket3->format("d") . ' (' . $date_rm_ticket3->format("l") . '), from ' . $date_rm_ticket3->format("h a") . ' to ' . $dateEnd_rm_ticket3->format("h a") . ' Distribution will not take place outside these hours.';
                                    else:
                                        echo 'After completing the form and receiving confirmation, come personally with your CPF in hand at ' . $concert->getPlacetickets() . ', located at the ' . $concert->getPlaceticketaddress() . ', this coming ' . $date_rm_ticket->format("d") . 'th of ' . $date_event->format("F") . ' (' . $date_rm_ticket->format("l") . '), from ' . $date_rm_ticket->format("h a") . ' to ' . $dateEnd_rm_ticket->format("h a") . ' and withdraw your ticket. Only the registered CPF holder can make the withdrawal of the ticket, being irrevocable for any circumstance. As well as that, the tickets will only be distributed in ' . $concert->getPlacetickets() . ', this next ' . $date_rm_ticket->format('d') . 'th of ' . $date_event->format("F") . ' (' . $date_rm_ticket->format('l') . '), from ' . $date_rm_ticket->format('h a') . ' to ' . $dateEnd_rm_ticket->format('h a') . '. Distribution will not take place outside these hours.';
                                    endif;
                                    ?>


                                    <p style="text-align:  justify">The Jos&eacute; Augusto Foundation is expanding the library collections of the State Houses of Culture. You can be a contributor! When withdrawing his ticket donates a literary book to compose this new collection of the Houses of Culture of the State of Rio Grande do Norte. Be a collaborator!</p>
                                    <?php if ($concert->getBoxofficelot()): ?>
                                        <p style="text-align:  justify">Tickets that are not withdrawn during this period, even though they were registered here on the OSRN website, will be included in the <strong>LOTE BILHETERIA</strong>. The box office lot will have <span style="font-weight: bold; color:  #993300">300 tickets</span> and will be distributed to the public on<span style="font-weight: bold; color:  #993300"> <?php echo $date_event->format("F") . ' ' . $date_event->format("d"); ?>th, starting at 10am</span> at the box office of <?php echo $concert->getPlacetickets(); ?>. Interested persons should present their CPF. Each person will have the right to withdraw up to 2 tickets.</p>
                                    <?php else: ?>
                                        <p  style="text-align:  justify">THERE WILL NOT BE LOT BILHETERIA FOR THE CONCERT OF THE <?php echo $date_event->format("d"); ?>TH DAY IN THE <?php echo $concert->getLocal(); ?>. ALL DISTRIBUTION WILL BE MADE BY THE INTERNET LOT.</p>
                                    <?php endif; ?>
                                    <form action="../../control/controlIngresso.php" method="post" name="registerIngresso">
                                        <input type="hidden" name="opc" value="1"/>
                                        <input type="hidden" name="date_begin" value="<?php echo $date_begin->format("Y-m-d H:i:s"); ?>"/>
                                        <input type="hidden" name="date_end" value="<?php echo $date_end->format("Y-m-d H:i:s"); ?>"/>
                                        <input type="hidden" name="currentDate" value="<?php echo $currentDate->format("Y-m-d H:i:s"); ?>"/>
                                        <input type="hidden" name="idconcert" value="<?php echo $concert->getIdevento(); ?>"/>
                                        <div class="form-group form-group-ingressos">
                                            <label for="campo_nome">Name:</label>
                                            <input type="text" class="form-control" name="name-ingressos" required="true"/>
                                        </div>

                                        <?php
                                        if ($request == "invalidCpf"):
                                            echo '<p style="color: red; font-weight: bold">';
                                            echo 'Invalid CPF!';
                                            echo '</p>';
                                        elseif ($request == "invalidCharCpf") :
                                            echo '<p style="color: red; font-weight: bold">';
                                            echo 'Invalid characters for the CPF field!';
                                            echo '</p>';
                                        elseif ($request == "arealdyExists"):
                                            echo '<p style="color: red; font-weight: bold">';
                                            echo 'CPF Already Registered!';
                                            echo '</p>';
                                        elseif ($request == "cpfBloqueado"):
                                            echo '<p style="color: red; font-weight: bold">';
                                            echo 'This CPF is locked in the OSRN system due to inactivity!';
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
                                            <input type="submit" name="submit-ingressos" value="Conclude"  class="btn btn-primary" />
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
                                            <a href="http://www.orquestrasinfonicadorn.com.br">Back to home page</a>&numsp;&numsp;
                                            <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Select another concert</a>
                                            <br/><br/>
                                        </div>';
                            echo '<h3 style="color: green; font-weight: bold;">';
                            echo 'Congratulations! Your ticket to the ' . $date_event->format("d") . 'th concert at ' . $concert->getLocal() . ' was successfully booked!';
                            echo '</h3>';

                            if ($concert->getReservetimes()):
                                echo 'Attend personally with your CPF at the ' . $concert->getPlacetickets() . ', located at ' . $concert->getPlaceticketaddress() . ', on ' . $date_event->format("F") . ' ' . $date_rm_ticket2->format("d") . ' (' . $date_rm_ticket2->format("l") . ') from ' . $date_rm_ticket2->format("h a") . ' to ' . $dateEnd_rm_ticket2->format("h a") . ' or on ' . $date_event->format("F") . ' ' . $date_rm_ticket3->format("d") . ' (' . $date_rm_ticket3->format("l") . ') from ' . $date_rm_ticket3->format("h a") . ' to ' . $dateEnd_rm_ticket3->format("h a") . ' ticket. The registered CPF holder shall be entitled to a maximum of two (2) tickets. Only the registered CPF holder can make the withdrawal of the ticket, being irrevocable for any circumstance. As well as that, the tickets will only be distributed at ' . $concert->getPlacetickets() . ' on ' . $date_event->format("F") . ' ' . $date_rm_ticket2->format("d") . ' (' . $date_rm_ticket2->format("l") . ') from ' . $date_rm_ticket2->format("h a") . ' to ' . $dateEnd_rm_ticket2->format("h a") . ' and on ' . $date_event->format("F") . ' ' . $date_rm_ticket3->format("d") . ' (' . $date_rm_ticket3->format("l") . '), from ' . $date_rm_ticket3->format("h a") . ' to ' . $dateEnd_rm_ticket3->format("h a") . ' Distribution will not take place outside these hours.';
                            else:
                                echo 'Come personally with your CPF in hand at ' . $concert->getPlacetickets() . ', located at the ' . $concert->getPlaceticketaddress() . ', this coming ' . $date_rm_ticket->format("d") . 'th of ' . $date_event->format("F") . ' (' . $date_rm_ticket->format("l") . '), from ' . $date_rm_ticket->format("h a") . ' to ' . $dateEnd_rm_ticket->format("h a") . ' and withdraw your ticket. Only the registered CPF holder can make the withdrawal of the ticket, being irrevocable for any circumstance. As well as that, the tickets will only be distributed in ' . $concert->getPlacetickets() . ', this next ' . $date_rm_ticket->format('d') . 'th of ' . $date_event->format("F") . ' (' . $date_rm_ticket->format('l') . '), from ' . $date_rm_ticket->format('h a') . ' to ' . $dateEnd_rm_ticket->format('h a') . '. Distribution will not take place outside these hours.';
                            endif;

                            echo '</div>';
                        elseif ($request == 'dennied'):  // Entra aqui quando o formulário estava disponível, o cliente o acessou, mas antes dele submeter, se esgotaram os ingressos. 
                            echo '<div class="col-sm-12 col-md-12">';
                            echo '  <div class="col-sm-12 col-md-12">
                                           <br/><br/>
                                            <a href="http://www.orquestrasinfonicadorn.com.br">Back to home page</a>&numsp;&numsp;
                                            <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Select another concert</a>
                                           <br/><br/>
                                        </div>';
                            echo '<h3 style="font-weight: bold; color: red; text-align: center">';
                            echo 'THE RESERVATION OF YOUR REGISTRATION FOR THE ' . $date_event->format("d") . 'TH CONCERT, AT ' . $concert->getLocal() . ', WAS NOT COMPLETED!';
                            echo '</h3>';
                            echo '<h5 style="font-weight: bold; color: red;">';
                            echo 'Reason: Before you send your data the INTERNET LOT FOR THAT CONCERT CLEARED!';
                            echo '</h5>';
                            if ($concert->getBoxofficelot()):
                                echo '<p>';
                                echo 'You can still withdraw your ticket at LOTE BILHETERIA on ' . $date_event->format("F") . ' ' . $date_event->format("d") . 'th from 10am</span> at the ticket office of ' . $concert->getPlacetickets() . '. Interested persons should present their CPF. Each person will have the right to withdraw up to 2 tickets.';
                                echo '</p>';
                            else:
                                echo '<p>';
                                echo 'THERE WILL NOT BE LOT BILLETTE FOR THE CONCERT OF THE ' . $date_event->format("d") . 'TH DAY IN THE ' . $concert->getLocal() . ' ALL THE DISTRIBUTION WILL BE MADE BY THE INTERNET LOT.';
                                echo '</p>';
                            endif;
                            echo '</div>';
                        else:
                            ?>
                            <div class="col-sm-12 col-md-12">
                                <div class="col-sm-12 col-md-12">
                                    <a href="http://www.orquestrasinfonicadorn.com.br">Back to home page</a>&numsp;&numsp;
                                    <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Select another concert</a>
                                </div>
                                <div class="animation" id="box">
                                    <h4>Tickets</h4>
                                </div>
                                <h3 style="font-weight: bold; color: red; text-align: center">
                                    THE INTERNET LOT FOR THE CONCERT OF THE <?php echo $date_event->format("d") ?>TH DAY, AT THE <?php echo $concert->getLocal() ?>, SOLD OUT!
                                </h3>
                                <?php if ($concert->getBoxofficelot()): ?>
                                    <p>
                                        You can still withdraw your ticket in the LOTE BILHETERIA on the <span style="font-weight: bold"><?php echo $date_event->format("d"); ?>th. <?php echo $date_event->format("F") ?> from 10 am</span> at the box office of <?php echo $concert->getPlacetickets(); ?>. Interested persons should present their CPF. Each person will have the right to withdraw up to 2 tickets.
                                    </p>
                                <?php else: ?>
                                    <p>THERE WILL BE NO LOT BOX OFFICE FOR THE DAY CONCERT IN <?php echo $date_event->format("d") . ' ' . $concert->getLocal(); ?>. ALL DISTRIBUTION WILL BE MADE BY THE INTERNET LOT.</p>
                                <?php endif; ?>
                            </div>
                        <?php
                        endif;
                    endif;
                else://entra aqui quando o formulário não está disponível para reservas. 
                    ?>
                    <div class="col-sm-12 col-md-12">
                        <div class="col-sm-12 col-md-12">
                            <a href="http://www.orquestrasinfonicadorn.com.br">Back to home page</a>&numsp;&numsp;
                            <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos">Select another concert</a>
                        </div>
                        <div class="animation" id="box">
                            <h4>Tickets</h4>
                        </div>
                        <?php echo '<p>' . $currentDate->format("F d, Y h:i:s a") . '</p>'; ?>
                        <p>
                            <strong>For the concert of the <?php echo $date_event->format("d"); ?>th, at the <?php echo $concert->getLocal(); ?> </strong>, the online ticket reservation is not released at the moment. The release always takes place a week before the concert.
                        </p>
                        <p>
                            For the <?php echo $date_event->format("F") . ' ' . $date_event->format("Y"); ?> concert to be held on <?php echo $date_event->format("m") . '/' . $date_event->format("d"); ?>, the online reservation will be released from 9am on the <?php echo $date_begin->format("d"); ?>th until 23:59 on the <?php echo $date_end->format("d"); ?>th, or until the tickets run out, which ends first.<br/> <span style="font-weight: bold; color:  #993300">Stay tuned!</span>
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
                        <a href="http://www.orquestrasinfonicadorn.com.br">Back to home page</a>
                        <br/><br/>
                    </div>
                    <p>
                        Select below the concert for which you want to book your ticket
                    </p>
                    <?php
                    foreach ($concertosdomes as $concertos):
                        $dateconcert = new DateTime($concertos["dataevento"]);
                        ?>
                        <p>
                            <?php
                            if ($concertos["loteinternet"] == '0'):
                                ?>
                                Concert of the <?php echo $dateconcert->format('d'); ?>th in the <?php echo $concertos["local"] ?>.

                                <strong>(There will be no tickets reserved for this concert.)</strong>
                                <?php
                            elseif ($concertos["loteinternet"] == '1'):
                                ?>
                                <a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos/<?php echo $concertos["idevento"]; ?>" target="_self">
                                    Concert of the <?php echo $dateconcert->format('d'); ?>th in the <?php echo $concertos["local"] ?>.
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
                        <a href="http://www.orquestrasinfonicadorn.com.br">Back to home page</a>&numsp;&numsp;
                        <br/><br/>
                    </div>
                    <div class="animation" id="box">
                        <h4>Tickets</h4>
                    </div>
                    <?php echo '<p>' . $currentDate->format("F d, Y h:i:s a") . '</p>'; ?>
                    <p>
                        Online ticket reservation is not currently available. The release always takes place a week before the concert.
                    </p>
                    <h5 style="font-weight: bold; color: #993300; text-align:  justify">Help the Jos&eacute; Augusto Foundation to expand the collections of the Houses of Culture of Rio Grande do Norte!</h5>
                    <p style="text-align:  justify">The Jos&eacute; Augusto Foundation is expanding the library collections of the State Houses of Culture. You can be a contributor! When withdrawing his ticket donates a literary book to compose this new collection of the Houses of Culture of the State of Rio Grande do Norte. Be a collaborator!</p>
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
            &copy; 2014 Copyright Rio Grande do Norte Symphony Orchestra | Development: <a href="http://odairss.blogspot.com.br/" target="_blank">Odair Soares</a>
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
