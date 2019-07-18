<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if (isset($_SESSION["origem"])) {
    unset($_SESSION["origem"]);
    unset($_SESSION);
    session_destroy();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            body{
                background-image: url(http://www.orquestrasinfonicadorn.com.br/img/score.png);
                background-repeat: no-repeat;
                background-size: 100% 100%;
                background-position: bottom;
            }
        </style>
    </head>
    <body>
        <style type="text/css">
            .formulary_login{
                position: relative;
                background-color: #ccff33;

                background-color: #FFFFFF;
                /*IE*/
                background-image: url(http://www.orquestrasinfonicadorn.com.br/img/bg1.png);
                background-repeat: no-repeat;
                background-size: 100% 100%;
                /*Outros browsers*/
                background-image:-webkit-linear-gradient(#660000 3%, #996600 50%);
                background-image: -moz-linear-gradient(#660000 3%, #996600 50%);
                background-image: -o-linear-gradient(#660000 3%, #996600 50%);
                overflow:hidden;
                background-color: rgba(110, 142, 185, 0.4);fundo transparente;

                border-radius: 8px;
                box-shadow: 3px 5px 8px #999999;
                padding: 20px;
                margin-top: 2%;
                width: 30%;
                left: 35%;
                height: auto;
                /*float:left;*/
                font-family: Arial;
                overflow: hidden;
                color:  #FFFFFF;
            }
            .formulary_login form label, input{
                margin: 5px;
            }
            .formulary_login form input[name='login'], input[name='senha']{
                width: 50%;
                height: 20px;

            }
        </style>
        <a href="http://www.orquestrasinfonicadorn.com.br" target="_self"><img src="http://www.orquestrasinfonicadorn.com.br/img/logos/logoosrn.png" style="max-width:20%; left: 0;"/></a>
        <div class="formulary_login">
            <center><h3>Bem-vindo!</h3></center>
            <p>Acesso privado! Informe seu login e senha para entrar</p>
            <form action="/osrn1/control/ControlUsuario.php" method="post">
                <input type="hidden" name="opc" value="5"/>
                <label for="cp_profile">Perfil:</label><br/>
                <select name="profile">
                    <option value="2" selected="selected">M&uacute;sico</option>
                    <option value="1">Administrador</option>
                    <option value="3">FJA</option>
                </select><br/>
                <label for="cp_login">Login:</label><br/>
                <input type="text" name="login" required="true"/><br/>
                <label for="cp_login">Senha:</label><br/>
                <input type="password" name="senha" required="true"/><br/>
                <input type="submit" value="Entrar"/>
                <input type="submit" value="Cancelar" formaction="http://www.orquestrasinfonicadorn.com.br"/>
            </form>
            <?php
            if (isset($_GET["resp"])) {
                if ($_GET["resp"] == 0) {
                    echo '<span style="text-align:center; color:red">Nome de usuário ou senha incorreta!</pan>';
                }
            }
            ?>
        </div>
    </body>
</html>
