<?php
$rst = "";
if (isset($_GET["rst"])):
    $rst = $_GET["rst"];
endif;
?>
<div id="headerchangepass">
    <div id="blocklogo">
        <img src="../img/logos/logoosrn.png" style="max-width: 100%;"/>
    </div>
    <div id="blockmenu">
        <a href="?ctd_admin=changepassword" target="_self">Alterar senha</a> || <a href="login.php" target="_self">Sair</a>
    </div>
</div>
<div id="formchangepass">
    <?php
    if ($rst == "4"):
        echo '<span style="color: red; font-weight: bold">Problemas na atualização da senha. Tente novamente!</span>';
    endif;
    ?>
    <form action="../control/ControlUsuario.php" method="post">
        <input type="hidden" value="6" name="opc"/>
        <?php
        if ($rst == "2"):
            echo '<span style="color: red; font-weight: bold">Senha atual incorreta!</span>';
        endif;
        ?>
        <div  class="form-group">
            Senha Atual:<br/>
            <input class="form-control" type="password" name="currentpass"/>
        </div>
        <div class="form-group">
            Nova senha:<br/>
            <input  class="form-control"  type="password" name="newpass"/>
        </div>
        <?php
        if ($rst == "3"):
            echo '<span style="color: red; font-weight: bold">As senhas não coincidem!</span>';
        endif;
        ?>
        <div class="form-group">
            confirme a nova senha:<br/>
            <input  class="form-control"  type="password" name="confirmpass"/>
        </div>
        <div class="form-group">
            <input class="btn btn-primary"  type="submit" value="Alterar senha"/>
            <input class="btn"  type="submit" formaction="?ctd_admin=ingressos&action=1" value="Cancelar"/>
        </div>
    </form>
</div>
