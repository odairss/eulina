<?php
//session_start();
//$_SESSION["origem"] = 1;
include_once '../DAO/MusicoDAO.php';

if (isset($_GET["action"])) {
    if ($_GET["action"] == 1) {
        ?>
        <div class="formulary">
            <center><h4>Controle dos músicos</h4></center>
            <form action="../control/ControlMusicos.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="opc" value="1"/>
                <label for="cp_nome"><b>Nome:</b></label><br/>
                <input type="text" name="nome" required="true"/><br/>
                <label for="cp_telefone"><b>Telefone:</b></label><br/>
                <input type="text" id="telef" name="telefone"/><br/>
                <label for="cp_foto"><b>Foto:</b></label><br/>
                <input type="file" name="foto"/><br/>
                <label for="cp_email"><b>Email:</b></label><br/>
                <input type="email" name="email"/><br/>
                <label for="cp_categoria"><b>Categoria:</b></label><br/>
                <select name="categoria">
                    <option value="0">selecione uma categoria</option>
                    <option value="1">Chefe de Naipe</option>
                    <option value="2">Convidado</option>
                    <option value="3">Estagiário</option>
                </select><br/>
                <label for="cp_instrumento"><b>Instrumento:</b></label><br/>
                <select name="instrumento">
                    <option value="s-instrumento">selecione um instrumento</option>
                    <option value="1-violino">1&SmallCircle; violino</option>
                    <option value="2-violino">2&SmallCircle; violino</option>
                    <option value="viola">Viola</option>
                    <option value="violoncelo">Violoncelo</option>
                    <option value="contrabaixo">Contrabaixo</option>
                    <option value="flauta">Flauta</option>
                    <option value="oboe">Oboé</option>
                    <option value="clarinete">Clarinete</option>
                    <option value="fagote">Fagote</option>
                    <option value="trompa">Trompa</option>
                    <option value="trompete">Trompete</option>
                    <option value="trombone">Trombone</option>
                    <option value="tuba">Tuba</option>
                    <option value="timpano">Tímpano</option>
                    <option value="percussao">Percussão</option>
                    <option value="secretaria">Secretaria</option>
                    <option value="inspetor">Secret-Inspetor</option>
                    <option value="montador">Montador</option>
                    <option value="coordenadoria-administrativa">Coordenadoria administrativa</option>
                    <option value="arquivista-musico-copista">Arquivista músico - copista</option>
                    <option value="diretor-artistico">Diretor artístico</option>
                </select>
                <br/>
                <label for="cp_historico"><b>Histórico:</b></label><br/>
                <textarea name="historico" cols="80" rows="10" id="editor1"></textarea><br/>
                <input type="submit" value="Adicionar músico"/>
                <input type="submit" value="Cancelar" formaction="../view/admin.php"/>
            </form>
            <script type="text/javascript">
                jQuery(function ($) {
                    $("#telef").mask("(99) 9999-9999");
                });
            </script>
        </div>
        <div class="lista_objetos">
            <center><h4>Componentes da OSRN</h4></center>
            <?php
            $musicos = MusicoDAO::buscarTodos();
            foreach ($musicos as $musico) {
                if ($musico->getImg() != "") {
                    echo '<img src="' . $musico->getImg() . '" style="max-width:50px;"/>';
                }
                ?>
                <?php echo $musico->getNome() . " - ", $musico->getInstrumento()."<br/>"; ?>
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

