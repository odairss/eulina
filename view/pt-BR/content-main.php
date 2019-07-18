<script>
    // init controller
    var controller = new ScrollMagic.Controller();
</script>
<section class="col-xs-12 col-sm-12 col-md-12 section-home-zero" id="inicio">

    <div id="trigger4" style="position: absolute; width: 100%;"></div>

    <!--LADO ESQUERDO DA CORTINA -->                        
    <div id="left-curtain-1"></div>
    <div id="left-curtain-2"></div>
    <div id="left-curtain-3"></div>
    <div id="left-curtain-over-1"></div>
    <div id="left-curtain-over-2"></div>
    <div id="left-curtain-over-3"></div>
    <!--LADO DIREITO DA CORTINA -->
    <div id="right-curtain-1"></div>
    <div id="right-curtain-2"></div>
    <div id="right-curtain-3"></div>
    <div id="right-curtain-over-1"></div>
    <div id="right-curtain-over-2"></div>
    <div id="right-curtain-over-3"></div>

    <div id="small-circle-left-sponsors">
    <span>Patroc&iacute;nio</span>
        <div class="container-patrocinios">
            <div id="slides">
                <img alt="Governo do Rio Grande do Norte" src="http://www.orquestrasinfonicadorn.com.br/img/governorn.png">
                <img alt="Lei C&atilde;mara Cascudo" src="http://www.orquestrasinfonicadorn.com.br/img/leicamcascudo.png">
                <img alt="Prefeitura do Natal" src="http://www.orquestrasinfonicadorn.com.br/img/prefeituranatal.png">
                <img alt="Lei Djalma Maranh&atilde;o" src="http://www.orquestrasinfonicadorn.com.br/img/leidjalmamaranhao.png">
            </div>
        </div>
        <script type="text/javascript" src="http://www.orquestrasinfonicadorn.com.br/plugins/jquery.slides.min.js"></script>
        <script type="text/javascript">
    $(function () {
        $('#slides').slidesjs({
            width: 100,
            height: 100,
            play: {
                active: true,
                auto: true,
                interval: 4000,
                swap: true
            }
        });
    });
        </script>
    </div>
    <div id="big-circle-left-logo">
        <div id="logo-circle">
            <img src="http://www.orquestrasinfonicadorn.com.br/img/logos/OSRN2 - Logo.png" style=""/>
            <hr/>
            <span>Diretor Administrativo:<br/>Luiz Antônio de Paiva<br/>
                Diretor Artístico:<br/>Línus Lerner</span>
        </div>
    </div>
    <div id="reserve-ingressos"><a href="http://www.orquestrasinfonicadorn.com.br/pt/ingressos" target="_self">RESERVE<br/>O SEU INGRESSO<br/>PARA<br/>O PR&Oacute;XIMO<br/>CONCERTO</a></div>
</section>