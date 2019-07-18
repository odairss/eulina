<?php
if (isset($_SESSION['origem'])) {
    if ($_SESSION['origem'] == "osrn1") {
        include_once '../DAO/UsuarioDAO.php';
        if (isset($_GET["action"])) {
            if ($_GET["action"] == 1) {
                ?>
                <div class="formulary">
                    <center><h4>Cadastro de usuários</h4></center>
                    <form name="formUser" onsubmit="return verifyPass();" action="../control/ControlUsuario.php" method="post">
                        <input type="hidden" name="opc" value="1"/>
                        <label for="cp_profile">Perfil:</label><br/>
                        <select name="profile">
                            <option value="2" selected="selected">Músico</option>
                            <option value="1">Administrador</option>
                            <option value="3">FJA</option>
                        </select><br/>
                        <label for="cp_nome">Nome completo:</label><br/>
                        <input type="text" name="nome" required="true"/><br/>
                        <label for="cp_tel">Telefone:</label><br/>
                        <input type="tel" name="telefone" id="telef" required="true"/><br/>
                        <label for="cp_email">E-mail:</label><br/>
                        <input type="email" name="email" required="true"/><br/>
                        <label for="cp_login">Nome de usuário:</label><br/>
                        <input type="text" name="login" required="true"/><br/>
                        <label for="cp_senha">Senha:</label><br/>
                        <input type="password" name="senha" id="pass" required="true"/><br/>
                        <label for="cp_confirme">Confirme a senha:</label><br/>
                        <input type="password" name="confirme" id="verifyPassword" required="true"/><br/>
                        <input type="submit" value="Cadastrar usuário"/>
                        <input type="submit" value="Cancelar" formaction="osrnAdmin.php?ctd_admin=agenda&action=1"/>
                    </form>
                    <script type="text/javascript">
                        jQuery(function ($) {
                            $("#telef").mask("(99) 9999-9999");
                        });
                    </script>
                </div>
                <div class="lista_objetos">
                    <center><h4>Usuários cadastrados no sistema</h4></center>
                    <center>
                        <table class="tabela">
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Telefone</th>
                                    <th>Login</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $usuarios = UsuarioDAO::listar();
                                foreach ($usuarios as $usuario) {
                                    ?>
                                    <tr class="<?php
                                    if ($i % 2 == 0) {
                                        echo 'cor1';
                                    } else {
                                        echo 'cor2';
                                    }
                                    ?>">
                                        <td><?php echo $usuario->getIdusuario(); ?></td>
                                        <td><?php echo $usuario->getNome(); ?></td>
                                        <td><?php echo $usuario->getEmail(); ?></td>
                                        <td><?php echo $usuario->getTelefone(); ?></td>
                                        <td><?php echo $usuario->getLogin(); ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </center>
                </div>
                <?php
            }
        } else {
            echo 'Você não tem permissão para acessar esta página';
        }
    } else {
        echo 'Você não tem permissão para acessar esta página!';
    }
} else {
    echo 'Você não tem permissão para acessar esta página!';
}


