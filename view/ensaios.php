<!DOCTYPE html>
<!--
Autor: Odair Soares.
E-mail: odairsds@gmail.com
Cel.: 55 84 9467-9154
-->
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>OSRN | Calend&aacute;rio 2017</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../plugins/jquery-ui/jquery-ui.css" media="all"/>
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../plugins/jquery-ui/jquery-ui.js"></script>
        <style>
            body{
                color:  #796e67;
                font-size: 79%;
                background: #dcc599;
                /*                IE
                                background-image: url(../img/bg/bg1.png);
                                background-repeat: no-repeat;
                                background-size: 100% 100%;
                                Outros browsers
                                background-image:-webkit-linear-gradient(#660000 3%, #996600 50%);
                                background-image: -moz-linear-gradient(#660000 3%, #996600 50%);
                                background-image: -o-linear-gradient(#660000 3%, #996600 50%);
                                background-color: rgba(110, 142, 185, 0.4);fundo transparente;*/
            }
            #wrapper{
                position: relative;
                width: 80%;
                left: 10%;
                background: #FFFFFF;
                /*border: 1px  solid #FFFFFF;*/
                box-shadow: 2px 5px 3px #663300;
                overflow: hidden;
            }
            table{
                text-align: center;
            }
            #wrapper #calendario{
                position: relative;
                z-index: 2;
                float: left;
                width: 67%;
                background-color: #FFFFFF;
                padding: 20px;
                /*margin-left: 5px;*/
                margin-top: 5px;
                margin-bottom: 30px;
            }
            #wrapper #calendario p{
                text-align: center;
            }
            #wrapper #calendario table{
                width: 99%;
                background-color: #c3c3c3;
            }
            #wrapper #calendario table tr th{
                background-color: #e49200;
                color: #ffffae;
            }
            #wrapper #calendario table tr td{
                background-color: #ffffff;
            }
            #wrapper #ensaios table tr .diaensaio{
                background-color: #b0ff24;
            }
            #wrapper #ensaios table tr .diaensaio p{
                padding: 0;
                margin: 0;
            }
            #wrapper #ensaios table tr .diaensaio p a{
                display: block;
                text-decoration: none;
                color: #796e67;
            }
            #wrapper #ensaios table tr .diaensaio p a:hover{
                background-color: #ffff4a;
            }
            #wrapper #ensaios{
                position: relative;
                z-index: 2;
                float: left;
                width: 23%;
                background-color: #FFFFFF;
                padding: 20px;
                margin-left: 2px;
                margin-top: 5px;
            }
            #wrapper #ensaios table{
                width: 95%;
                background-color: #c3c3c3;
            }
            #wrapper #ensaios table tr th{
                background-color: #e49200;
                color: #ffffae;
            }
            #wrapper #ensaios table tr td{
                background-color: #ffffff;
            }
            #wrapper #ensaios #legend{
                position: relative;
                width: 60%;
                /*float: left;*/
                display: table;
                margin: 10px;
            }
            #wrapper #ensaios #legend .legend1{
                position: relative;
                float: left;
                width: 100%;
                display: table;
                padding: 4px;
                /*border: 1px solid #a5a2a2;*/
            }
            #wrapper #ensaios #legend .legend1 .cor{
                background-color: #b0ff24;
                width: 30px;
                height: 30px;
                float: left;
                border: 1px solid #a5a2a2;
            }
            #wrapper #ensaios #legend .legend1 .cor2{
                background-color: #FFFFFF;
                width: 30px;
                height: 30px;
                float: left;
                border: 1px solid #a5a2a2;
            }
            #wrapper #ensaios #legend .legend1 .textlegend{
                background: none;
                height: 30px;
                float: left;
                padding-left: 5px;
            }
            #wrapper #calendario #headcalendario{
                position: relative;
                width: 98%;
                float: left;
                /*display: table;*/
                /*border: 1px solid;*/
            }
            #wrapper #calendario #headcalendario #logoosrn{
                position: relative;
                width: 20%;
                float: left;
                /*border: 1px solid;*/
            }
            #wrapper #calendario #headcalendario #titleosrn{
                position: relative;
                width: 79%;
                float: left;
                /*border: 1px solid;*/
            }
            #wrapper #calendario #headcalendario #titleosrn h1{
                text-align: center;
                font-size: 200%;
            }
            #wrapper #calendario #headcalendario #logoosrn img{
                max-width: 100%;
            }
            #buttonexit{
                position: relative;
                z-index: 7;
                float: right;
                background: none;
            }
            #buttonexit #btnexit{
                border: none;
                background: url(../img/exit.png);
                background-repeat: no-repeat;
                cursor: pointer;
                width: 25px;
                height: 25px;
                margin: 2px;
            }
        </style>
    </head>
    <body>
        <section id="wrapper">
            <div id="buttonexit">
                <form action="../control/ControlUsuario.php" method="post">
                    <input type="hidden" name="opc" value="3"/>
                    <input id="btnexit" type="submit" value=" "/>
                </form>
            </div>
            <?php
            if (isset($_SESSION["origem"])) {
                if ($_SESSION["origem"] == "osrn1") {
                    ?>
                    <section id="calendario">
                        <article id="headcalendario">
                            <article id="logoosrn">
                                <a href="http://www.orquestrasinfonicadorn.com.br" target="_self"><img src="../img/logos/logoosrn.png"/></a>
                            </article>
                            <article id="titleosrn">
                                <h1>Calend&aacute;rio 2017</h1>
                            </article>
                        </article>

                        <h2>MAR&Ccedil;O</h2>
                        <p>
                            <strong>Quarta-feira dia 29, Teatro Riachuelo (20 horas)</strong><br/>
                            <strong>Quinta-feira dia 30, Teatro da UFRN (20 horas)</strong><br/>
                            <strong>Sexta-feira dia 31, Teatro da UFRN (20 horas)</strong><br/>
                            Maestro: Linus Lerner<br/>
                            Solista (piano): Durval Cesetti (BRA)<br/>
                        </p>
                        <p><strong>PROGRAMA</strong></p>
                        <table>
                            <thead>
                                <tr>
                                    <th>Compositor</th>
                                    <th>Obra</th>
                                    <th>Orquestra&ccedil;&atilde;o</th>
                                    <th>Dura&ccedil;&atilde;o</th>
                                    <th>Edi&ccedil;&atilde;o</th>
                                    <th>Links</th>
                                    <th>Notas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Georges Enesco (1881-1955)</td>
                                    <td>Romanian Rhapsody N&ocy;. 1, Op. 11 in A Major (1901)</td>
                                    <td>3(1.2.3/pic) 3(1.2.Eh) 22 - 4 4(2tp.2crt) 3 1 - tmp+3 - 2 hp - str</td>
                                    <td>11&apos;</td>
                                    <td>IMSLP</td>
                                    <td><a href="https://www.youtube.com/watch?v=4TDCMoou2Uc" target="_blank">https://www.youtube.com/watch?v=4TDCMoou2Uc</a><br/><br/><a href="https://www.youtube.com/watch?v=qZUsvQbTn_o" target="_blank">https://www.youtube.com/watch?v=qZUsvQbTn_o</a></td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td>Fryderyk Franciszek Chopin (1810-1849)</td>
                                    <td>Concerto para Piano N&ocy;. 1 Op. 11 em Mi menor (1830)</td>
                                    <td>2 2(1.Eh)2 2 - 4 2 1 0 - tmp - cordas</td>
                                    <td>39&apos;</td>
                                    <td>IMSLP</td>
                                    <td><a href="https://www.youtube.com/watch?v=MkrwU5Pd93c" target="_blank">https://www.youtube.com/watch?v=MkrwU5Pd93c</a><br/><br/><a href="https://www.youtube.com/watch?v=uM09BWHC_HM" target="_blank">https://www.youtube.com/watch?v=uM09BWHC_HM</a></td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td>Piotr Ilyich Tchaikovsky (1840-1893)</td>
                                    <td>Symphony N&ocy;. 6, Op. 74 em Sim menor (Pat&eacute;tica) (1893)</td>
                                    <td>3(1.2.pic 2 2 2 - 4 2 3 1 - tmp+2 - cordas</td>
                                    <td>46&apos;</td>
                                    <td>IMSLP</td>
                                    <td><a href="https://www.youtube.com/watch?v=8VswsTffasc" target="_blank">https://www.youtube.com/watch?v=8VswsTffasc</a><br/><br/><a href="https://www.youtube.com/watch?v=vTckXeRfXAE" target="_blank">https://www.youtube.com/watch?v=vTckXeRfXAE</a></td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    <section id="ensaios">
                        <h2>
                            Hor&aacute;rios dos ensaios
                        </h2>
                        <div id="legend">
                            <section class="legend1">
                                <div class="cor"></div><div class="textlegend">Dia de ensaio</div>
                            </section>
                            <section class="legend1">
                                <div class="cor2"></div><div class="textlegend">Dias sem ensaio</div>
                            </section>
                        </div>
                        <p>*Passe o mouse sobre os dias de ensaio para mais informa&ccedil;&otilde;es</p>

                        <p>mar&ccedil;o</p>
                        <table>
                            <thead>
                                <tr><th>Dom</th><th>Seg</th><th> Ter</th><th>Qua </th><th> Qui</th><th>Sex</th><th>Sab</th></tr>
                            </thead>
                            <tbody>
                                <tr><td></td><td></td><td></td><td>1</td><td>2</td><td>3</td><td> 4 </td></tr>
                                <tr><td> 5 </td><td> 6 </td><td> 7</td><td> 8</td><td> 9 </td> <td>10</td><td>11</td></tr>
                                <tr><td> 12</td><td class="diaensaio"><p id="tooltip1"><a href="#" title="Ensaio chefes de naipe das cordas c/ Craciun">13</a></p></td><td class="diaensaio"><p id="tooltip2"><a href="#" title="Ensaio violinos c/ Craciun 14:30 Sala OSRN">14</a></p></td><td class="diaensaio"><p id="tooltip3"><a href="#" title="Ensaio cordas c/ Craciun e Willames 14:30">15</a></p></td><td class="diaensaio"><p id="tooltip4"><a href="#" title="Ensaio madeiras e metais c/ Willames">16</a></p></td><td>17</td><td>18</td></tr>
                                <tr><td>19</td><td class="diaensaio"><p id="tooltip5"><a href="#" title="Ensaio 14:30 com Willames, Sala OSRN">20</a></p></td><td class="diaensaio"><p id="tooltip6"><a href="#" title="Ensaio 14:30, Sala OSRN">21</a></p></td><td class="diaensaio"><p id="tooltip7"><a href="#" title="Ensaio 14:30, Sala OSRN">22</a></p></td><td class="diaensaio"><p id="tooltip8"><a href="#" title="Ensaio 14:30, Sala OSRN">23</a></p></td><td class="diaensaio"><p id="tooltip9"><a href="#" title="Ensaio 14:30, UFRN">24</a></p></td><td>25</td></tr>
                                <tr><td>26</td><td class="diaensaio"><p id="tooltip10"><a href="#" title="Ensaio 14:30, UFRN">27</a></p></td><td class="diaensaio"><p id="tooltip11"><a href="#" title="Ensaio 14:30, Sala OSRN">28</a></p></td><td class="diaensaio"><p id="tooltip12"><a href="#" title="Ensaio Geral 14:00 (Teatro Riachuelo) Concerto 20:00 Teatro Riachuelo">29</a></p></td><td class="diaensaio"><p id="tooltip13"><a href="#" title="Concerto 20:00 UFRN">30</a></p></td><td class="diaensaio"><p id="tooltip14"><a href="#" title="Concerto 20:00 UFRN">31</a></p></td><td></td></tr>
                            </tbody>
                        </table>
                    </section>
                    <?php
                }
            } else {
                echo '<h1 style="color: #FF0000">Você não tem permissão para acessar esta página.<a href="http://www.orquestrasinfonicadorn.com.br">Clique aqui</a></h1>';
            }
            ?>
        </section>
        <script>
            $("#tooltip1").tooltip();
            $("#tooltip2").tooltip();
            $("#tooltip3").tooltip();
            $("#tooltip4").tooltip();
            $("#tooltip5").tooltip();
            $("#tooltip6").tooltip();
            $("#tooltip7").tooltip();
            $("#tooltip8").tooltip();
            $("#tooltip9").tooltip();
            $("#tooltip10").tooltip();
            $("#tooltip11").tooltip();
            $("#tooltip12").tooltip();
            $("#tooltip13").tooltip();
            $("#tooltip14").tooltip();
            $("#tooltip15").tooltip();
            $("#tooltip16").tooltip();
            $("#tooltip17").tooltip();
            $("#tooltip18").tooltip();
            $("#tooltip19").tooltip();
            $("#tooltip20").tooltip();
            $("#tooltip21").tooltip();
            $("#tooltip22").tooltip();
            $("#tooltip23").tooltip();
            $("#tooltip24").tooltip();
            $("#tooltip25").tooltip();
            $("#tooltip26").tooltip();
            $("#tooltip27").tooltip();
            $("#tooltip28").tooltip();
            $("#tooltip29").tooltip();
            $("#tooltip30").tooltip();
            $("#tooltip31").tooltip();
            $("#tooltip32").tooltip();
            $("#tooltip33").tooltip();
            $("#tooltip34").tooltip();
            $("#tooltip35").tooltip();
        </script>
    </body>
</html>
