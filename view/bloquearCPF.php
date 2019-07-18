<?php
include_once '../DAO/bloquearCpfDAO.php';
include_once '../model/cpfBloqueado.php';
if (isset($_GET["action"])) {
    if ($_GET["action"] == 1) {
        ?>
        <div class="formulary">
            <center><h4>Controle de CPFs</h4></center>
            <form action="../control/controlCpfBloqueado.php" method="post">
                <input type="hidden" name="opc" value="1"/>
                <label for="cpf_Bloqueado"><b>CPF:</b></label><br/>
                <input id="cpfbloqueado" type="text" name="cpfBloqueado" required="true"/><br/>

                <input type="submit" value="Bloquear CPF"/>
                <input type="submit" value="Cancelar" formaction="../view/osrnAdmin.php"/>
            </form>
            <script type="text/javascript">
                jQuery(function ($) {
                    $("#cpfbloqueado").mask("99999999999");
                });
            </script>
        </div>
        <div class="lista_objetos">
            <center><h4>CPFs Bloqueados</h4></center>
            <?php
            $cpfsbloqueados = bloquearCpfDAO::listar();
            foreach ($cpfsbloqueados as $cpf) {
                echo $cpf->getIdCpf() . ' - ', $cpf->getCpfBloqueado() . ' - <a href="../control/controlCpfBloqueado.php?opc=3&idcpf=' . $cpf->getIdCpf() . '">Desbloquear</a><br/>';
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

