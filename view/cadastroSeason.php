<?php
include_once '../DAO/seasonDAO.php';
include_once '../model/season.php';
if (isset($_GET["action"])) {
    if ($_GET["action"] == 1) {
        ?>
        <div class="formulary">
            <form action="../control/controlSeason.php" method="post">
                <input type="hidden" name="opc" value="1"/>
                <label for="cp_ano">Ano da temporada:</label><br/>
                <input type="number" min="2014" max="2030" name="ano" id="ano" required="true"/><br/>
                <input type="submit" value="Criar temporada"/>
                <input type="submit" value="Cancelar" formaction="osrnAdmin.php"/>
            </form>
            <script type="text/javascript">
                jQuery(function ($) {
                    $("#ano").mask("9999");
                });
            </script>
        </div>
        <div class="lista_objetos">
            <h1>Temporadas cadastradas</h1>
            <?php
            $temporadas = seasonDAO::listar();
            $temporada = new season();
            foreach ($temporadas as $season) {
                $temporada = $season;
                echo $temporada->getAno() . "<br/>";
            }
            ?>
        </div>
        <?php
    }
}


