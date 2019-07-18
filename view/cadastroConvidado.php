<?php
//session_start();
//$_SESSION["origem"] = 1;
include_once '../DAO/ConvidadoDAO.php';
include_once '../DAO/AgendaDAO.php';
include_once '../DAO/seasonDAO.php';
include_once '../model/season.php';
include_once '../model/agenda.php';

if (isset($_GET["action"])) {
    if ($_GET["action"] == 1) {
        ?>
        <div class="formulary">
            <center><h4>Controle dos convidados</h4></center>
            <form action="../control/ControlConvidados.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="opc" value="1"/>
                <label for="cp_nome"><b>Nome:</b></label><br/>
                <input type="text" name="nome" required="true"/><br/>


                <?php
                $year = date("Y");
                $season = seasonDAO::getSeason($year);
                if (is_null($season)):
                    echo '<label for="cp_evento"><b>Evento:</b></label><br/>';
                    echo '<select name="id_evento" required="required">';
                    echo '<option value=""></option>';
                    echo '</select><span style="color: red">Não existe temporada cadastra. É preciso cadastrar primeiramente a temporada</span><br/>';
                else:
                    $concerts = AgendaDAO::listToSeason($season->getId_season());
                    $concert = new agenda();
                    echo '<label for="cp_evento"><b>Eventos (da temporada ' . $season->getAno() . '):</b></label><br/>';
                    echo '<select name="id_evento" required="required">';
                    foreach ($concerts as $object_value):
                        $concert = $object_value;
                        echo '<option value="' . $concert->getIdevento() . '">' . $concert->getTitulo() . '</option>';
                    endforeach;
                    echo '</select><br/>';
                endif;
                ?>
                </select><br/>
                <label for="cp_foto"><b>Foto:</b></label><br/>
                <input type="file" name="foto" required="required"/><br/>
                <label for="cp_categ"><b>Categoria (pt_BR):</b></label><br/>
                <input type="text" name="categ_musico" required="required"/><span style="color:  #999999"> ex.: (maestro, tenor, pianista, etc.)</span><br/>

                <label for="cp_categ"><b>Categoria (en_US):</b></label><br/>
                <input type="text" name="categ_en_us" required="required"/><span style="color:  #999999"> ex.: (conductor, tenor, pianist, etc.)</span><br/>

                <label for="cp_country"><b>Pa&iacute;s:</b></label><br/>
                <input type="text" name="country" required="required"/><br/>
                <label for="cp_sexo"><b>Sexo:</b></label><br/>
                <select name="sexo" required="required">
                    <option value="">Selecione... </option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select><br/>

                <label for="cp_resume"><b>Resumo (pt_BR):</b></label><br/>
                <textarea cols="80" rows="10" id="editor1" name="resume" required="required">
                </textarea><br/>

                <label for="cp_resume"><b>Resumo (en_US):</b></label><br/>
                <textarea cols="80" rows="10" id="editor2" name="res_en_us" required="required">
                </textarea><br/>

                <label for="cp_historico"><b>Curr&iacute;culo (pt_BR):</b></label><br/>
                <textarea cols="80" rows="10" id="editor3" name="historico" required="required">
                </textarea><br/>

                <label for="cp_historico"><b>Curr&iacute;culo (en_US):</b></label><br/>
                <textarea cols="80" rows="10" id="editor4" name="bio_en_us" required="required">
                </textarea><br/>


                <input type="submit" value="Adicionar convidado"/>
                <input type="submit" value="Cancelar" formaction="../view/admin.php"/>
            </form>
        </div>
        <div class="lista_objetos">
            <center><h4>Convidados cadastrados</h4></center>
            <?php
            $convidados = ConvidadoDAO::buscarTodos();
            foreach ($convidados as $convidado) {
                if ($convidado->getFoto() != "") {
                    echo '<img src="' . $convidado->getFoto() . '" style="max-width:50px;"/>';
                }
                ?>
                <?php echo $convidado->getNome() . "<br/>"; ?>
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

