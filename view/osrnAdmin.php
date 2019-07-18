<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if (isset($_SESSION["origem"])) {
    if ($_SESSION["origem"] == "osrn1") {
//        if (isset($_GET["ctd_admin"])) {
//            switch ($_GET["ctd_admin"]) {
//                case "agenda":
//                    break;
//                case "season";
//                    break;
//                case "musico":
//                    break;
//                case "convidado":
////                    include_once '../DAO/ConvidadoDAO.php';
//                    break;
//                case "user":
//                    break;
//                case "ingressos":
//                    break;
//            }
//        }
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>SISTEMA OSRN</title>
                <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
                <script type="text/javascript" src="http://www.orquestrasinfonicadorn.com.br/plugins/ckeditor/ckeditor.js"></script>
                <script type="text/javascript" src="http://www.orquestrasinfonicadorn.com.br/plugins/ckeditor/adapters/jquery.js"></script>
                <script type="text/javascript" src="http://www.orquestrasinfonicadorn.com.br/plugins/jquery.maskedinput.js"></script>

                <script src="http://www.orquestrasinfonicadorn.com.br/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
                <link rel="stylesheet" type="text/css" href="http://www.orquestrasinfonicadorn.com.br/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css" media="all"/>
                <script>
                    CKEDITOR.disableAutoInline = true;

                    $(document).ready(function () {
                        $('#editor1').ckeditor();
                        $('#editor2').ckeditor();
                        $('#editor3').ckeditor();
                        $('#editor4').ckeditor();
                    });
                </script>
                <style type="text/css">
                    *{margin: 0;padding: 0}
                    .container_admin{
                        position: absolute;
                        width: 100%;
                        background: #dcc599;
                        /*border: 1px solid;*/
                    }
                    .container_admin .menu_admin{
                        position: relative;
                        float: left;
                        width: 100%;
                        padding: 10px;
                        background:  #fcfae3;
                        border: 1px solid #98711f;
                    }
                    .container_admin .menu_admin ul{
                        list-style: none;

                    }
                    .container_admin .menu_admin ul li{
                        float: left;
                        margin-left: 3px;
                        margin-right: 3px;
                    }
                    .container_admin .frame_admin{
                        position: relative;
                        width: 70%;
                        left: 15%;
                        min-height: 600px;
                        border: 1px solid #cccccc;
                        padding: 20px;
                        background: #fff;
                        /*box-shadow: 1px 2px 3px #462a13;*/
                        overflow: hidden;
                    }
                    .container_admin .frame_admin #blocklogo{
                        position: relative;
                        float: left;
                        z-index: 1;
                        width: 20%;
                        /*border: 1px solid black;*/
                    }
                    .container_admin .frame_admin #blockmenu{
                        position: relative;
                        float: right;
                        z-index: 1;
                        text-align: right;
                        width: 78%;
                        /*border: 1px solid black;*/
                    }
                    .container_admin .frame_admin .contents{
                        position: relative;
                        float: left;
                        z-index: 1;
                        font-size: 1.6em;
                        text-align: left;
                        width: 98%;
                        /*border: 1px solid green;*/
                    }
                    .container_admin .frame_admin #headerchangepass{
                        position: relative;
                        z-index: 1;
                        width: 98%;
                        float: left;
                        margin-bottom: 20px;
                    }
                    .container_admin .frame_admin #formchangepass{
                        position: relative;
                        float: left;
                        z-index: 1;
                        width: 50%;
                        /*border: 1px solid green;*/
                    }
                    .formulary{
                        position: relative;
                        border: 1px solid #cc6600;
                        border-radius: 8px;
                        padding: 30px;
                    }
                    .lista_objetos{
                        position: relative;
                        border: 1px solid #cc6600;
                        border-radius: 8px;
                        padding: 30px;
                    }
                    .tabela{
                        text-align: center;
                        margin: 30px;
                        border: 3px solid #660000;
                        border-radius: 5px;
                    }
                    .tabela th{
                        background-color:  #999900;
                    }
                    .tabela th, td{
                        margin: 5px;
                        padding: 5px;
                    }
                    .cor1{
                        background-color: #ffcc00;
                    }
                    .cor2{
                        background-color: #ffffcc;
                    }
                    label{
                        font-weight:  normal;
                    }
                </style>
                <script type="text/javascript">
                    function verifyPass() {
                        var senha = document.formUser.confirme.value;
                        var verify = document.formUser.senha.value;
                        if (senha === verify) {
                            return true;
                        } else {
                            alert("A senha não confere!");
                            return false;
                        }
                    }
                </script>
            </head>
            <body>
                <div class="container_admin">
                    <?php
                    if (isset($_GET["ctd_admin"])):
                        if ($_GET["ctd_admin"] != "ingressos" and $_GET["ctd_admin"] != "changepassword"):
                            ?>
                            <div class="menu_admin">
                                <ul>
                                    <li><a href="?ctd_admin=agenda&action=1" target="_self">Gerenciar agenda</a></li>
                                    <li><a href="?ctd_admin=season&action=1" target="_self">Gerenciar Temporadas</a></li>
                                    <li><a href="?ctd_admin=user&action=1" target="_self">Gerenciar usuários</a></li>
                                    <li><a href="?ctd_admin=musico&action=1" target="_self">Gerenciar músicos</a></li>
                                    <li><a href="?ctd_admin=convidado&action=1" target="_self">Gerenciar convidados</a></li>
                                    <li><a href="login.php" target="_self">Sair</a></li>
                                </ul>
                            </div>
                            <?php
                        endif;
                    endif;
                    ?>
                    <div class="frame_admin">
                        <?php
                        echo $_SESSION["name_user"] . " - " . $_SESSION["login_user"] . " - " . $_SESSION["id_user"] . " - " . $_SESSION["status_user"];
                        if (isset($_GET["ctd_admin"])) {
                            switch ($_GET["ctd_admin"]) {
                                case "agenda":
                                    include_once 'cadastroAgenda.php';
                                    break;
                                case "season":
                                    include_once 'cadastroSeason.php';
                                    break;
                                case "user":
                                    include_once 'cadastroUsuario.php';
                                    break;
                                case "musico":
                                    include_once 'cadastroMusico.php';
                                    break;
                                case "convidado":
                                    include_once 'cadastroConvidado.php';
                                    break;
                                case "ingresso":
                                    include_once 'ingressos.php';
                                case "ingressos":
                                    include_once 'managerTickets.php';
                                    break;
                                case "changepassword":
                                    include_once 'changepassword.php';
                                    break;
                                case 'bloquearcpf':
                                    include_once 'bloquearCPF.php';
                                    break;
                            }
                        }
                        ?>
                    </div>
                </div>
            </body>
        </html>
        <?php
    } else {
        echo 'Acesso não autorizado';
    }
} else {
    echo 'Acesso não autorizado!';
}

