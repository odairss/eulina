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
        <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/en/ingressos" />
        <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/en/ingressos" />
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
                    if (isset($_GET["idconcerto"]))://entra aqui quando existir concertos cadastrados no mês corrente
                        $idevento = $_GET["idconcerto"];
                        $concert = AgendaDAO::pesquisar($idevento);

                        //configuração dos dias nos quais se inicia e se encerra a reserva online dos ingressos:
                        $date_begin = new DateTime($concert->getDataevento() . ' 09:00:00');
                        $date_end = new DateTime($concert->getDataevento() . ' 23:59:59');
                        $date_begin->sub(new DateInterval('P' . $concert->getDaysstartreserve() . 'D'));
                        $date_end->sub(new DateInterval("P" . $concert->getDaysendreserve() . "D"));

                        //configuração dos horários nos quais se inicia e se encerra a retirada dos ingressos no dia programado:
                        if ($concert->getReservetimes()):
                            //Nos casos em que será possível retirar os ingressos pela manhã e pela tarde:
                            $date_rm_ticket2 = new DateTime($concert->getDataevento() . ' ' . $concert->getSecondestarttimes());
                            $dateEnd_rm_ticket2 = new DateTime($concert->getDataevento() . ' ' . $concert->getSecondeendtimes());
                            $date_rm_ticket3 = new DateTime($concert->getDataevento() . ' ' . $concert->getThirdstarttimes());
                            $dateEnd_rm_ticket3 = new DateTime($concert->getDataevento() . ' ' . $concert->getThirdendtimes());
                        else:
                            //Nos casos em que só será possível retirar os ingressos pela tarde:
                            $date_rm_ticket = new DateTime($concert->getDataevento() . ' ' . $concert->getFirststarttimes());
                            $dateEnd_rm_ticket = new DateTime($concert->getDataevento() . ' ' . $concert->getFirstendtimes());
                        endif;

//configuração dos dias para a retirada dos ingressos
                        if ($concert->getReservetimes()):
                            $date_rm_ticket2->sub(new DateInterval("P" . $concert->getStartwithdrawaltickets() . "D"));
                            $dateEnd_rm_ticket2->sub(new DateInterval("P" . $concert->getEndwithdrawaltickets() . "D"));
                            $date_rm_ticket3->sub(new DateInterval("P" . $concert->getStartwithdrawaltickets() . "D"));
                            $dateEnd_rm_ticket3->sub(new DateInterval("P" . $concert->getEndwithdrawaltickets() . "D"));
                        else:
                            $date_rm_ticket->sub(new DateInterval("P" . $concert->getStartwithdrawaltickets() . "D"));
                            $dateEnd_rm_ticket->sub(new DateInterval("P" . $concert->getEndwithdrawaltickets() . "D"));
                        endif;
                        $date_event = new DateTime($concert->getDataevento());
                        $convert_month = new convertDateToString();
                        $month_event = $convert_month->convertMonthToPortuguese($date_event->format("m"));
                        $verify_amount = ingressoDAO::checkAmount($concert->getIdevento(), $concert->getAmountticket());
                        $request = "";
                        if (isset($_GET['rst']))://variável que trás a resposta da submissão do formulário.
                            $request = $_GET['rst'];
                        endif;
                        if ($date_begin < $currentDate and $currentDate < $date_end)://entra aqui quando o formulário estiver disponível.
                            if ($verify_amount):
                                if ($request == 'success'):
                                    echo '<div class="col-sm-12 col-md-12">
                                                <div class="col-sm-12 col-md-12">
                                                    <br/><br/>
                                                    <a href="http://www.orquestrasinfonicadorn.com.br">Home</a>&numsp;&numsp;
                                                    <a href="http://www.orquestrasinfonicadorn.com.br/en/ingressos">Select another concert</a>
                                                    <br/><br/>
                                                </div>';
                                    echo '<h3 style="color: green; font-weight: bold;">';
                                    echo 'Congratulations! Your ticket to the concert of the ' . $date_event->format("d") . 'th, at ' . $concert->getLocal() . ', has been successfully booked!';
                                    echo '</h3>';
                                    if ($concert->getReservetimes()):
                                        echo '<p>personally attend with your CPF on hand at the ' . $concert->getPlacetickets() . ' (' . $concert->getPlaceticketaddress() . ') this next Monday (December 12), from ' . $date_rm_ticket2->format("h a") . '. to ' . $dateEnd_rm_ticket2->format("h a") . ', and from ' . $date_rm_ticket3->format("h a") . ' to ' . $dateEnd_rm_ticket3->format("h a") . ' and remove your ticket. Only the holder of the registered CPF can perform the removal of the ticket, and irrevocable license to any circumstance. As well, the tickets will only be distributed at the ' . $concert->getPlacetickets() . ', this next Monday (December 12), from ' . $date_rm_ticket2->format("h a") . ' to ' . $dateEnd_rm_ticket2->format("h a") . ', and from ' . $date_rm_ticket3->format("h a") . ' to ' . $dateEnd_rm_ticket3->format("h a") . ' No distribution will be carried out in that time.</p>';
                                    else:
                                        echo '<p>Attend personally with your CPF in hand at ' . $concert->getPlacetickets() . ' (' . $concert->getPlaceticketaddress() . ') from ' . $date_event->format("F") . ' ' . $date_rm_ticket->format("d") . 'th to ' . $dateEnd_rm_ticket->format("d") . 'th, from ' . $date_rm_ticket->format("h a") . ' to ' . $dateEnd_rm_ticket->format("h a") . ' and withdraw your ticket. The registered CPF holder shall be entitled to a maximum of two (2) tickets. Only the registered CPF holder can make the withdrawal of the ticket, being irrevocable for any circumstance. As well as that, tickets for the ' . $date_event->format("d") . 'th concert will only be distributed at ' . $concert->getPlacetickets() . ', between ' . $date_event->format("F") . ' ' . $date_rm_ticket->format("d") . 'th to ' . $dateEnd_rm_ticket->format("d") . 'th, from ' . $date_rm_ticket->format("h a") . ' to ' . $dateEnd_rm_ticket->format("h a") . '. Distribution will not take place outside these hours.</p>';
                                    endif;

                                    echo '</div>';
                                elseif ($request == 'dennied')://este if com condição dennied está aqui mas provavelmente nunca será utilizado. pois seu lugar não é aqui.
                                    echo '<div class="col-sm-12 col-md-12">
                                                <div class="col-sm-12 col-md-12">
                                                    <br/><br/>
                                                    <a href="http://www.orquestrasinfonicadorn.com.br">Home</a>&numsp;&numsp;
                                                    <a href="http://www.orquestrasinfonicadorn.com.br/en/ingressos">Select another concert</a>
                                                    <br/><br/>
                                                </div>';
                                    echo '<h3 style="font-weight: bold; color: red; text-align: center">';
                                    echo 'THE RESERVATION OF YOUR REGISTRATION FOR THE CONCERT OF THE ' . $date_event->format("d") . 'TH DAY, AT ' . $concert->getLocal() . ', WAS NOT COMPLETED!';
                                    echo '</h3>';
                                    echo '<h5 style="font-weight: bold; color: red;">';
                                    echo 'Reason: Before you send your data the INTERNET LOT FOR THAT CONCERT CLEARED!!';
                                    echo '</h5>';
                                    if ($concert->getBoxofficelot()):
                                        echo '<p>';
                                        echo 'You can still withdraw your ticket at the BOX OFFICE LOT on <span style="font-weight: bold">' . $date_event->format("F d") . ' from noon</span> in the Riachuelo Theatre box office. Interested persons should submit their CPF at the theater box office. Each person shall be entitled to withdraw up to 2 tickets.';
                                        echo '</p>';
                                    else:
                                        echo '<p>';
                                        echo 'THERE WILL BE NO BOX OFFICE FOR THE CONCERT OF THE ' . $date_event->format("d") . 'TH DAY AT ' . $concert->getLocal() . '. ALL DISTRIBUTION WILL BE MADE BY THE INTERNET LOT.';
                                        echo '</p>';
                                    endif;
                                    echo '</div>';
                                else:
                                    ?>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="col-sm-12 col-md-12">
                                            <br/><br/>
                                            <a href="http://www.orquestrasinfonicadorn.com.br">Home</a>&numsp;&numsp;
                                            <a href="http://www.orquestrasinfonicadorn.com.br/en/ingressos">Select another concert</a>
                                            <br/><br/>
                                        </div>
                                        <div class="animation" id="box">
                                            <h5 style="font-weight: bold; color: #993300; text-align:  justify">Complete the form below and set aside here your ticket!</h5>
                                        </div>

                                        <p style="text-align:  justify"><!-- para quando o formulário estiver disponível -->
                                            <strong>For the concert of the <?php echo $date_event->format("d") ?>th, at the <?php echo $concert->getLocal() ?>,</strong><br/>
                                            The form will be available from 9:00 am on <?php echo $date_begin->format("d"); ?> to 11:59 pm on <?php echo $date_end->format("d F"); ?>, or even run out of INTERNET LOT tickets, which end first.
                                        </p>
                                        <?php if ($concert->getReservetimes()): ?>
                                            <p style="text-align:  justify">After completing the form and receiving the information: FORM COMPLETED WITH SUCCESS, personally attend with your CPF (Social Security Number) in hand the <?php echo $concert->getPlacetickets() ?> (<?php echo $concert->getPlaceticketaddress() ?>) this next Monday (December 12), from <?php echo $date_rm_ticket2->format("h a") ?> to <?php echo $dateEnd_rm_ticket2->format("h a"); ?>, and from <?php echo $date_rm_ticket3->format("h a"); ?> to <?php echo $dateEnd_rm_ticket3->format("h a"); ?> and remove your ticket. Only the holder of the registered CPF can perform the removal of the ticket, and irrevocable license to any circumstance. As well, the tickets will only be distributed at the <?php echo $concert->getPlacetickets(); ?> this next Monday (December 12), from <?php echo $date_rm_ticket2->format("h a"); ?> to <?php echo $dateEnd_rm_ticket2->format("h a"); ?>, and from <?php echo $date_rm_ticket3->format("h a"); ?> to <?php echo $dateEnd_rm_ticket3->format("h a"); ?> No distribution will be carried out in that time.</p>
                                        <?php else: ?>
                                            <p style="text-align:  justify">After completing the form and receiving the information: FORM COMPLETED WITH SUCCESS, personally attend with your CPF in hand at <?php echo $concert->getPlacetickets(); ?> (<?php echo $concert->getPlaceticketaddress(); ?>) between the days  <?php echo $dateEnd_rm_ticket->format("F") . ' ' . $date_rm_ticket->format("d") . ' and ' . $dateEnd_rm_ticket->format("d") . ' from ' . $date_rm_ticket->format("h a") . ' to ' . $dateEnd_rm_ticket->format("h a"); ?> and remove your ticket. The registered CPF holder shall be entitled to a maximum of two (2) tickets. Only the registered CPF holder can make the withdrawal of the ticket, being irrevocable for any circumstance. As well as tickets for the concert on the <?php echo $date_event->format("d"); ?>th  will only be distributed at the <?php echo $concert->getPlacetickets(); ?>, from <?php echo $date_event->format("F") . ' ' . $date_rm_ticket->format("d") . 'th to ' . $dateEnd_rm_ticket->format("d") . 'th, from ' . $date_rm_ticket->format("h a") . ' to ' . $dateEnd_rm_ticket->format("h a"); ?>. Distribution will not take place outside these hours.</p>
                                        <?php endif; ?>
                                        <p style="text-align:  justify">Jos&eacute; Augusto Foundation is expanding the collection of libraries of State Cultural Houses. You can be a collaborator! When removing your ticket donate a literary book to compose this new collection of Rio Grande do Norte State Culture Houses. Be a collaborator!</p>
                                        <?php if ($concert->getBoxofficelot()): ?>
                                            <p style="text-align:  justify">Tickets that are not removed this period, even though it was registered here on the website of OSRN, will comprise the BOX OFFICE LOT. The box lot will count on <span style="font-weight: bold; color:  #993300">300 tickets</span> and it will be distributed to the public on <span style="font-weight: bold; color:  #993300"><?php echo $date_event->format("F d"); ?> from noon</span> in the Riachuelo Theatre box office. Interested persons should submit their CPF at the theater box office. Each person shall be entitled to withdraw up to 2 tickets.</p>
                                        <?php else: ?>
                                            <p  style="text-align:  justify">THERE WILL BE NO BOX OFFICE FOR THE CONCERT OF THE <?php echo $date_event->format("d"); ?>TH DAY AT THE <?php echo $concert->getLocal(); ?>. ALL DISTRIBUTION WILL BE MADE BY THE INTERNET LOT.</p>
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
                                                echo 'CPF already registered!';
                                                echo '</p>';
                                            elseif ($request == "cpfBloqueado"):
                                                echo '<p style="color: red; font-weight: bold">';
                                                echo 'This CPF is blocked in the OSRN system due to lack of!';
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
                                                    <input type="email" class="form-control" placeholder="email@exemplo.com"
                                                           id="email" name="email-ingressos" required="true">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-ingressos">
                                                <label for="campo_tel">WhatsApp:</label>
                                                <input type="text" class="form-control"  name="telefone-ingressos" id="telefone" required="true"/>
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" name="submit-ingressos" value="Enviar"  class="btn btn-primary" />
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
                                if ($request == 'success'):
                                    echo '<div class="col-sm-12 col-md-12">
                                                <div class="col-sm-12 col-md-12">
                                                    <br/><br/>
                                                    <a href="http://www.orquestrasinfonicadorn.com.br">Home</a>&numsp;&numsp;
                                                    <a href="http://www.orquestrasinfonicadorn.com.br/en/ingressos">Select another concert</a>
                                                    <br/><br/>
                                                </div>';
                                    echo '<h3 style="color: green; font-weight: bold;">';
                                    echo 'Congratulations! Your ticket to the concert of the ' . $date_event->format("d") . 'th, at ' . $concert->getLocal() . ', has been successfully booked!';
                                    echo '</h3>';
                                    if ($concert->getReservetimes()):
                                        echo '<p>personally attend with your CPF on hand at the ' . $concert->getPlacetickets() . ' (' . $concert->getPlaceticketaddress() . ') this next Monday (December 12), from ' . $date_rm_ticket2->format("h a") . ' to ' . $dateEnd_rm_ticket2->format("h a") . ', and from ' . $date_rm_ticket3->format("h a") . ' to ' . $dateEnd_rm_ticket3->format("h a") . ' and remove your ticket. Only the holder of the registered CPF can perform the removal of the ticket, and irrevocable license to any circumstance. As well, the tickets will only be distributed at the ' . $concert->getPlacetickets() . ', this next Monday (December 12), from ' . $date_rm_ticket2->format("h a") . ' to ' . $dateEnd_rm_ticket2->format("h a") . ', and from ' . $date_rm_ticket3->format("h a") . ' to ' . $dateEnd_rm_ticket3->format("h a") . ' No distribution will be carried out in that time.</p>';
                                    else:
                                        echo '<p>Attend personally with your CPF in hand at ' . $concert->getPlacetickets() . ' (' . $concert->getPlaceticketaddress() . ') from ' . $date_event->format("F") . ' ' . $date_rm_ticket->format("d") . 'th to ' . $dateEnd_rm_ticket->format("d") . 'th, from ' . $date_rm_ticket->format("h a") . ' to ' . $dateEnd_rm_ticket->format("h a") . ' and withdraw your ticket. The registered CPF holder shall be entitled to a maximum of two (2) tickets. Only the registered CPF holder can make the withdrawal of the ticket, being irrevocable for any circumstance. As well as that, tickets for the ' . $date_event->format("d") . 'th concert will only be distributed at ' . $concert->getPlacetickets() . ', between ' . $date_event->format("F") . ' ' . $date_rm_ticket->format("d") . 'th to ' . $dateEnd_rm_ticket->format("d") . 'th, from ' . $date_rm_ticket->format("h a") . ' to ' . $dateEnd_rm_ticket->format("h a") . '. Distribution will not take place outside these hours.</p>';
                                    endif;

                                    echo '</div>';
                                elseif ($request == 'dennied'):
                                    echo '<div class="col-sm-12 col-md-12">
                                                <div class="col-sm-12 col-md-12">
                                                    <br/><br/>
                                                    <a href="http://www.orquestrasinfonicadorn.com.br">Home</a>&numsp;&numsp;
                                                    <a href="http://www.orquestrasinfonicadorn.com.br/en/ingressos">Select another concert</a>
                                                    <br/><br/>
                                                </div>';
                                    echo '<h3 style="font-weight: bold; color: red; text-align: center">';
                                    echo 'THE RESERVATION OF YOUR REGISTRATION FOR THE CONCERT OF THE ' . $date_event->format("d") . 'TH DAY, AT ' . $concert->getLocal() . ', WAS NOT COMPLETED!';
                                    echo '</h3>';
                                    echo '<h5 style="font-weight: bold; color: red;">';
                                    echo 'Reason: Before you send your data the INTERNET LOT FOR THAT CONCERT CLEARED!';
                                    echo '</h5>';
                                    if ($concert->getBoxofficelot()):
                                        echo '<p>';
                                        echo 'You can still withdraw your ticket at BOX OFFICE LOT <span style="font-weight: bold">' . $date_event->format("F d") . ' from noon</span> in the Riachuelo Theatre box office. Interested persons should submit their CPF at the theater box office. Each person shall be entitled to withdraw up to 2 tickets.';
                                        echo '</p>';
                                    else:
                                        echo '<p>';
                                        echo 'THERE WILL BE NO BOX OFFICE FOR THE CONCERT OF THE ' . $date_event->format("d") . 'TH DAY AT THE ' . $concert->getLocal() . '. ALL DISTRIBUTION WILL BE MADE BY THE INTERNET LOT.';
                                        echo '</p>';
                                    endif;
                                    echo '</div>';
                                else:
                                    ?>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="col-sm-12 col-md-12">
                                            <br/><br/>
                                            <a href="http://www.orquestrasinfonicadorn.com.br">Home</a>&numsp;&numsp;
                                            <a href="http://www.orquestrasinfonicadorn.com.br/en/ingressos">Select another concert</a>
                                            <br/><br/>
                                        </div>
                                        <div class="animation" id="box">
                                            <h4>Tickets</h4>
                                        </div>
                                        <h3 style="font-weight: bold; color: red; text-align: center">
                                            THE INTERNET LOT FOR THE CONCERT OF THE <?php $date_event->format("d") ?>TH DAY, AT THE <?php echo $concert->getLocal() ?>, SOLD OUT!
                                        </h3>
                                        <?php if ($concert->getBoxofficelot()): ?>
                                            <p>
                                                You can still withdraw your ticket at BOX OFFICE LOT <span style="font-weight: bold"><?php echo $date_event->format("F d"); ?> from noon</span> in the Riachuelo Theatre box office. Interested persons should submit their CPF at the theater box office. Each person shall be entitled to withdraw up to 2 tickets.
                                            </p>
                                        <?php else: ?>
                                            <p> THERE WILL BE NO BOX OFFICE FOR THE CONCERT OF THE <?php echo $date_event->format("d"); ?>TH DAY AT THE <?php echo $concert->getLocal() ?>. ALL DISTRIBUTION WILL BE MADE BY THE INTERNET LOT.</p>
                                        <?php endif; ?> 
                                    </div>
                                <?php
                                endif;
                            endif;
                        else://entra aqui quando o formulário não estiver disponível
                            ?>
                            <div class="col-sm-12 col-md-12">
                                <div class="col-sm-12 col-md-12">
                                    <br/><br/>
                                    <a href="http://www.orquestrasinfonicadorn.com.br">Home</a>&numsp;&numsp;
                                    <a href="http://www.orquestrasinfonicadorn.com.br/en/ingressos">Select another concert</a>
                                    <br/><br/>
                                </div>
                                <div class="animation" id="box">
                                    <h4>Tickets</h4>
                                </div>
                                <?php echo '<p>' . $currentDate->format("F d, Y h:i:s a") . '</p>'; ?>
                                <p>
                                    <strong>For the concert of the <?php echo $date_event->format("d"); ?>th, at the <?php echo $concert->getLocal(); ?>,</strong><br/>                    
                                    The form for ticket reservation is not enabled at the moment. The liberation form for tickets reservation always happen one week before performing the concert.
                                </p>
                                <p>
                                    For the <?php echo $date_event->format("F Y") ?> concert to be held on <?php echo $date_event->format("d"); ?>, the form will be free from 9:00am on <?php echo $date_begin->format("d"); ?> to 11:59pm on the <?php echo $date_end->format("d"); ?>th, or even run out of tickets, which end first.<br/> <span style="font-weight: bold; color:  #993300">Stay tuned!</span>
                                </p>
                        <!--<p>After completing the form and receive confirmation personally attend with your CPF (Social Security Number) in hand the Foundation Jos&eacute; Augusto (Rua Jundiai, 641 - Tirol, Natal - RN, CEP 59020-120) between <?php // echo $date_rm_ticket->format("d");                   ?> and <?php // echo $dateEnd_rm_ticket->format("F d") . ', ' . $date_rm_ticket->format("h a") . ' to ' . $dateEnd_rm_ticket->format("h a");                   ?>, and remove your ticket. Only the holder of the registered CPF can perform the removal of the ticket, and irrevocable license to any circumstance. As well, the tickets will only be distributed at the Foundation Jos&eacute; Augusto, between <?php // echo $date_rm_ticket->format("d");                   ?> and <?php // echo $dateEnd_rm_ticket->format("d F") . ', ' . $date_rm_ticket->format("h a") . ' to ' . $dateEnd_rm_ticket->format("h a");                   ?>. No distribution will be carried out in that time.</p>-->
                        <!--<p>After completing the form and receive confirmation personally attend with your CPF (Social Security Number) in hand the Foundation Jos&eacute; Augusto (Rua Jundiai, 641 - Tirol, Natal - RN, CEP 59020-120) on December 12, from 9 a.m. to noon, and from 1 p.m. to 4 p.m. and remove your ticket. Only the holder of the registered CPF can perform the removal of the ticket, and irrevocable license to any circumstance. As well, the tickets will only be distributed at the Foundation Jos&eacute; Augusto on December 12, from 9 a.m. to noon, and from 1 p.m. to 4 p.m. No distribution will be carried out in that time.</p>-->
                                <?php // if ($concert->getIdevento() == 31):  ?>
                                 <!--<p style="text-align:  justify"> para quando o formulário estiver disponível Tickets that are not removed this period, even though it was registered here on the website of OSRN, will comprise the BOX OFFICE LOT. The box lot will count on <span style="font-weight: bold; color:  #993300">300 tickets</span> and it will be distributed to the public on <span style="font-weight: bold; color:  #993300"><?php // echo $date_event->format("F d");                    ?> from noon</span> in the Riachuelo Theatre box office. Interested persons should submit their CPF at the theater box office. Each person shall be entitled to withdraw up to 2 tickets.</p>-->
                                <?php // endif;   ?>
                            </div>
                            <!--            <div class="col-sm-12 col-md-12">
                                            <h5 style="font-weight: bold; color: #993300; text-align:  justify">Help Jos&eacute; Augusto Foundation to expand the collection of libraries of Rio Grande do Norte Culture Houses!</h5>
                                            <p style="text-align:  justify">Jos&eacute; Augusto Foundation is expanding the collection of libraries of State Cultural Houses. You can be a collaborator! When removing your ticket donate a literary book to compose this new collection of Rio Grande do Norte State Culture Houses. Be a contributor!</p>
                                        </div>-->
                            <script type="text/javascript">
                                $(function () {
                                    $('#box').animate({
                                        marginLeft: "75%"
                                    }, 1600);
                                });
                            </script>
                        <?php
                        endif;


                    elseif (count($concertosdomes) >= 1):
                        ?>
                        <div class="col-sm-12 col-md-12">
                            <div class="col-sm-12 col-md-12">
                                <br/><br/>
                                <a href="http://www.orquestrasinfonicadorn.com.br">Home</a>&numsp;&numsp;
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
                                        Concert of <?php echo $dateconcert->format('d'); ?>th at the <?php echo $concertos["local"] ?>.
                                        <strong>(There will be no tickets reserved for this concert.)</strong>
                                        <?php
                                    elseif ($concertos["loteinternet"] == '1'):
                                        ?>
                                        <a href="http://www.orquestrasinfonicadorn.com.br/en/ingressos/<?php echo $concertos["idevento"]; ?>" target="_self">
                                            Concert of <?php echo $dateconcert->format('d'); ?>th at the <?php echo $concertos["local"] ?>.
                                        </a>
                                        <?php
                                    endif;
                                    ?>
                                </p>
                                <?php
                            endforeach;
                            ?>
                        </div>
                        <?php
                    else:
                        ?>
                        <div class="col-sm-12 col-md-12">
                            <div class="col-sm-12 col-md-12">
                                <br/><br/>
                                <a href="http://www.orquestrasinfonicadorn.com.br">Home</a>&numsp;&numsp;
                                <br/><br/>
                            </div>
                            <div class="animation" id="box">
                                <h4>Tickets</h4>
                            </div>
                            <?php echo '<p>' . $currentDate->format("d/m/Y H:i:s") . '</p>'; ?>
                            <p>
                                The form for ticket reservation is not enabled at the moment. The liberation form for tickets reservation always happen one week before performing the concert.
                            </p>
                            <!--                        </div>
                                                    <div class="col-sm-12 col-md-12">-->
                            <h5 style="font-weight: bold; color: #993300; text-align:  justify">Help Jos&eacute; Augusto Foundation to expand the collection of libraries of Rio Grande do Norte Culture Houses!</h5>
                            <p style="text-align:  justify">Jos&eacute; Augusto Foundation is expanding the collection of libraries of State Cultural Houses. You can be a collaborator! When removing your ticket donate a literary book to compose this new collection of Rio Grande do Norte State Culture Houses. Be a contributor!</p>
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
                    ?>
                </main>
            </div>
            <footer class="row">
                <p>
                    &copy; 2014 Copyright Orquestra Sinfônica do Rio Grande do Norte | Development: <a href="http://odairss.blogspot.com.br/" target="_blank">Odair Soares</a>
                </p>
            </footer>
        </div>
    </body>
</html>
