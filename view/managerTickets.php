<?php
include_once '../DAO/AgendaDAO.php';
$agenda = AgendaDAO::getConcerts();
?>
<div id="blocklogo">
    <img src="../img/logos/logoosrn.png" style="max-width: 100%;"/>
</div>
<div id="blockmenu">
    <a href="?ctd_admin=bloquearcpf&action=1" target="_self">Bloquear CPF</a> || 
    <a href="?ctd_admin=changepassword" target="_self">Alterar senha</a> || <a href="login.php" target="_self">Sair</a>
</div>
<div class="contents">
    <!--<a class="media" href="../control/geraPDF.php?idconcert=21">Mar&ccedil; 2016</a><br/>-->
    <?php
    foreach ($agenda as $conc):
        $date = new DateTime($conc["dataevento"]);
        echo '<a class="media" href="../control/geraPDF.php?idconcert=' . $conc["idevento"] . '">' . $date->format("d, M Y") . '</a><br/>';
    endforeach;
    ?>
    <script>
        $('a.media').media({width: 100 % , height: 400});
    </script>
</div>
