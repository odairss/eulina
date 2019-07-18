<?php
//session_start();
//$_SESSION["origem"] = 1;
include_once '../DAO/AgendaDAO.php';
include_once '../DAO/seasonDAO.php';
include_once '../model/season.php';
include_once '../DAO/MusicoDAO.php';

if (isset($_GET["action"])) {
    if ($_GET["action"] == 1) {
        $maestro = MusicoDAO::buscar(71);
        ?>
        <div class="formulary">
            <center><h4>Controle da agenda de eventos</h4></center>
            <form action="../control/controlAgenda.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="opc" value="1"/>
                <label for="cp_temporada"><strong>Selecione uma temporada:</strong></label><br/>
                <select name="temporada">
                    <?php
                    $seasons = seasonDAO::listar();
                    $season = new season();
                    foreach ($seasons as $temp) {
                        $season = $temp;
                        echo '<option value="' . $season->getId_season() . '">' . $season->getAno() . '</option>';
                    }
                    ?>
                </select> (se pretende cadastrar o concerto para uma temporada futura, primeiro &eacute; necess&aacute;rio cadastrar a temporada <a href="http://www.orquestrasinfonicadorn.com.br/view/osrnAdmin.php?ctd_admin=season&action=1" target="_SELF">aqui</a>)<br/>
                <label for="cp_titulo">T&iacute;tulo do concerto:</label><br/>
                <textarea name="titulo" cols="50" rows="5" required="true"></textarea><br/>

                <label for="cp_resume"><strong>Resumo do concerto:</strong></label><br/>
                <textarea name="resume" cols="80" rows="10" id="editor1" required="true"></textarea><br/>

                <label for="cp_descricao"><strong>Descri&ccedil;&atilde;o do concerto:</strong></label><br/>
                <textarea name="descricao" cols="80" rows="10" id="editor2" required="true"></textarea><br/>
                <label for="cp_maestro">Maestro: </label><br/>
                <input type="text" value="<?php echo $maestro->getNome(); ?>" name="maestro"/><br/>
                <label for="cp_arquivo">Banner ou foto de divulga&ccedil;&atilde;o confeccionado pela ag&ecirc;ncia de propaganda:</label><br/>
                <input type="file" name="arquivo"/><br/>

                <label for="cp_foto_convidados">Banner ou foto dos convidados:</label><br/>
                <input type="file" name="fotoconvidados"/><br/>

                <label for="cp_hora">Hora:</label><br/>
                <input type="time" name="hora" value="20:00" required="true"/><br/>


                <label for="cp_data">Data:</label><br/>
                <input type="date" name="dataevento" required="true"/><!-- id="dtevent" --><br/>
                <label for="cp_local">Local:</label><br/>
                <input type="text" name="local" value="Teatro Riachuelo Natal/RN" required="true"/><br/>
                <br/>
                <label for="cp_loteinternet"><strong>Confirme abaixo se haver&aacute; reserva de ingressos online:</strong></label><br/>
                <input type="radio" name="loteinternet" value="1" checked="true">Sim<br/>
                <input type="radio" name="loteinternet" value="0">N&atilde;o<br/>
                <br/>


                <label for="cp_local">Quantidade de ingressos dispon&iacute;veis:</label><br/>
                <input type="number" name="amountticket" value="250" required="true"/><br/>

                <label for="daysstartreserve">Quantos dias antes do concerto se inicia a reserva de ingressos no site:</label><br/>
                <input type="number" name="daysstartreserve" required="true" value="7"><br/>
                <label for="daysendreserve">Quantos dias antes do concerto se encerra a reserva de ingressos no site:</label><br/>
                <input type="number" name="daysendreserve" value="6" required="true"/><br/>

                <label for="startwithdrawaltickets">Quantos dias antes do concerto se inicia a retirada dos ingressos f&iacute;sicos:</label><br/>
                <input type="number" name="startwithdrawaltickets" value="2" required="true"/><br/>

                <label for="endwithdrawaltickets">quantos dias antes do concerto se encerra a retirada de ingressos f&iacute;sicos:</label><br/>
                <input type="number" name="endwithdrawaltickets" value="1" required="true"/><br/>                

                <label for="reservetimes"><strong>Confirme abaixo se haver&aacute; 2 hor&aacute;rios para retirada de ingressos.</strong></label><br/>
                <select name="reservetimes" required="true">
                    <option value="1">Sim</option>
                    <option selected="selected" value="0">N&atilde;o</option>
                </select><br/>
                <p>Nos casos em que haver&aacute; 2 hor&aacute;rios para retirada dos ingressos, informe abaixo os hor&aacute;rios. Deixe como est&aacute; em caso negativo.</p>
                <label for="secondestarttimes">hor&aacute;rio em que se inicia a primeira retirada dos ingressos:</label><br/>
                <input type="time" name="secondestarttimes" value="09:00:00" required="true"/><br/>

                <label for="secondeendtimes">hor&aacute;rio em que se encerra a primeira retirada dos ingressos:</label><br/>
                <input type="time" name="secondeendtimes" value="12:00:00" required="true"/><br/>

                <label for="thirdstarttimes">hor&aacute;rio em que se inicia a segunda retirada dos ingressos:</label><br/>
                <input type="time" name="thirdstarttimes" value="14:00:00" required="true"/><br/>

                <label for="thirdendtimes">hor&aacute;rio em que se encerra a segunda retirada dos ingressos:</label><br/>
                <input type="time" name="thirdendtimes" value="17:00:00" required="true"/><br/>

                <p><strong>Nos casos em que s&oacute; haver&aacute; 1 hor&aacute;rio para a retirada dos ingressos, informe abaixo o hor&aacute;rio.</strong></p>
                <label for="firststarttimes">hor&aacute;rio em que se inicia a retirada dos ingressos:</label><br/>
                <input type="time" name="firststarttimes" value="13:00:00" required="true"/><br/>

                <label for="firstendtimes">hor&aacute;rio em que se encerra a retirada dos ingressos:</label><br/>
                <input type="time" name="firstendtimes" value="16:00:00" required="true"/><br/>

                <label for="placetickets">Local onde ser&aacute; realizada a retirada de ingressos:</label><br/>
                <input type="text" name="placetickets" value="Galeria Fernando Chiriboga" required="true"/><br/>

                <label for="placeticketaddress">Endere&ccedil;o do local onde ser&aacute; realizada a retirada dos ingressos:</label><br/>
                <textarea name="placeticketaddress" cols="50">Shopping Midway Mall - Av. Bernardo Vieira, 3775 - Tirol,
                Natal – RN. Piso L3</textarea><br/><br/>

                <label for="boxofficelot"><strong>Confirme se haver&aacute; LOTE BILHETERIA para este concerto ou n&atilde;o:</strong></label><br/>
                <select name="boxofficelot" required="true">
                    <option selected="selected" value="1">Sim</option>
                    <option value="0">N&atilde;o</option>
                </select><br/><br/><br/>

                <input type="submit" value="Adicionar evento na agenda"/>
                <input type="submit" value="Cancelar" formaction="../view/admin.php"/>
            </form>
            <script type="text/javascript">
                jQuery(function ($) {
                    $("#dtevent").mask("99/99/9999");
                });
            </script>
        </div>
        <div class="lista_objetos">
            <center><h4>Eventos cadastrados na angeda</h4></center>
            <?php
            $agendados = AgendaDAO::listar();
            foreach ($agendados as $evento) {
                ?>
                <img src="<?php echo $evento->getArquivo(); ?>" style="max-width:50px;"/>
                <?php echo $evento->getTitulo() . "<br/>"; ?>
                <?php
            }
            ?>
        </div>
        <?php
    } else {
        echo 'Você não tem permissão para acessar esta página';
    }
} else {
    echo 'Você não tem permissão para acessar esta página';
}
