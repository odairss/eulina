<?php 
if(isset($_GET["sent"])):
    if($_GET["sent"] == "sent"):
        ?>
<script type="text/javascript">
    alert("Email enviado com sucesso!\nEntraremos em contato com voc&ecirc; em breve.");
</script>
<?php
    endif;
endif;
?>
<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-home-five" id="contato">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 spacer5">
        <div class="left-border-decorate-sup cor-8e556b">

        </div>
        <div class="left-border-decorate-sub cor-802b4c">

        </div>
        <div style="position: absolute; z-index: 3; left: 0; width: 100%; background: none;">
            <h1>Entre em contato com a OSRN</h1>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 div-form">
        <form action="/osrn1/view/Mail.php" method="post" name="contato">
            <div class="form-group">
                <label for="campo_nome">Nome:</label>
                <input type="text" class="form-control" name="nomeRemetente" required="true"/>
            </div>
            <div class="form-group">
                <label for="campo_email">E-mail:</label>
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input type="email" class="form-control" placeholder="email@exemplo.com"
                           id="email" name="emailRemetente" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="campo_tel">Telefone:</label>
                <input type="text" class="form-control"  name="telephony" id="telefone" required="true"/>
            </div>
            <div class="form-group">
                <label for = "campo_msg">Mensagem:</label><br/>
                <textarea name = "mensagem"  class="form-control" ></textarea>
            </div>
            <div class="form-group send">
                <input type="submit" value=""  class="btn btn-primary" />
            </div>
        </form>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 spacer5">
        <p>Diretor Administrativo: Luis Antônio de Paiva - 84 3232-5318</p> 
        <span><img src="http://www.orquestrasinfonicadorn.com.br/img/logos/gmail.png" style="max-width:40px"/></span>
        <a href="mailto:orquestrasinfonicarn@gmail.com">orquestrasinfonicarn@gmail.com</a>
        <span><img src="http://www.orquestrasinfonicadorn.com.br/img/logos/outlook.ico" style="max-width:40px"/></span>
        <a href="mailto:ccpovo@hotmail.com">ccpovo@hotmail.com</a>
        <span style="margin:2px">
            <img src="http://www.orquestrasinfonicadorn.com.br/img/logos/twitter.png" style="max-width:40px"/>
        </span>
        <a href="https://twitter.com/rnsinfonica" target="_blank">&commat;rnsinfonica</a>
        <span style="margin:2px">
            <img src="http://www.orquestrasinfonicadorn.com.br/img/logos/facebook.png" style="max-width:40px"/>
        </span>
        <a href="https://www.facebook.com/rnsinfonica" target="_blank">rnsinfonica</a>
        <span style="margin:2px">
            <img src="http://www.orquestrasinfonicadorn.com.br/img/linuslerner.jpg" style="max-width:40px"/>
        </span>
        <a href="http://www.linuslerner.com" target="_blank">linuslerner.com</a>
    </div>
</section>