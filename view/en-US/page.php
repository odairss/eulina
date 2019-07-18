<!DOCTYPE html>
<!--
Autor: Odair Soares.
E-mail: odairsds@gmail.com
Cel.: 55 84 9467-9154
-->
<?php
$_SESSION["origem"] = 2;
if (isset($_GET["id_convidado"])) {
    include_once 'DAO/ConvidadoDAO.php';
    include_once 'model/convidado.php';
} elseif (isset($_GET["id_concert"])) {
    include_once 'DAO/AgendaDAO.php';
    include_once 'model/agenda.php';
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta property="og:site_name" content="Orquestra Sinf&ocirc;nica do Rio Grande do Norte" />
        <meta property="fb:app_id" content="161517967527557" />


        <?php
        if (isset($_GET["ctd"])) {
            if ($_GET["ctd"] == 'inicio') {
                $_SESSION["agenda"] = TRUE;
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br" />
                <meta property="og:description" content="A OSRN foi criada em 1976 e continua com todo afinco a realizar um trabalho tanto..." />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/homeorquestra.JPG" />
                <meta property="og:title" content="In&iacute;cio | OSRN" />
                <meta name="keywords" content="osrn,orquestra, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title>In&iacute;cio | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 'agenda') {
                if (isset($_GET["id_concert"])) {
                    $_SESSION["agenda"] = TRUE;
                    $id_concerto = $_GET['id_concert'];
                    $concert = new agenda();
                    $concert = AgendaDAO::pesquisar($id_concerto);
                    $resume = strip_tags($concert->getResume());
                    $foto = substr($concert->getArquivo(), 3);
                    $title = str_replace("\"", "", $concert->getTitulo())
                    ?>
                    <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=2&id_concert=<?php echo $concert->getIdevento(); ?>" />
                    <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=2&id_concert=<?php echo $concert->getIdevento(); ?>" />
                    <meta property="og:description" content="<?php echo $resume; ?>" />
                    <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/<?php echo $foto; ?>" />
                    <meta property="og:title" content="<?php echo $title; ?>" />
                    <meta name="keywords" content="osrn,orquestra, <?php echo $title; ?>, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                    <title><?php echo $concert->getTitulo(); ?></title>
                    <?php
                } else {
                    $_SESSION["agenda"] = FALSE;
                    ?>
                    <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=2" />
                    <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=2" />
                    <meta property="og:description" content="Agenda <?php echo date("Y"); ?> da OSRN" />
                    <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/homeorquestra.JPG" />
                    <meta property="og:title" content="Agenda <?php echo date("Y"); ?> | OSRN" />
                    <meta name="keywords" content="osrn,orquestra, agenda, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                    <title>Agenda <?php echo date("Y"); ?> | OSRN</title>
                    <?php
                }
            } elseif ($_GET["ctd"] == 'contato') {
                $_SESSION["agenda"] = FALSE;
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=3" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=3" />
                <meta property="og:description" content="Formul&aacute;rio de contato  da OSRN" />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/Orquestra Sinfonica do Rio Grande do Norte.jpg" />
                <meta property="og:title" content="Contato | OSRN" />
                <meta name="keywords" content="osrn,orquestra, videos, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title>Contato | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 'videos') {
                $_SESSION["agenda"] = FALSE;
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=4" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=4" />
                <meta property="og:description" content="V&iacute;deos dos melhores momentos da OSRN" />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/Orquestra Sinfonica do Rio Grande do Norte.jpg" />
                <meta property="og:title" content="V&iacute;deos | OSRN" />
                <meta name="keywords" content="osrn,orquestra, videos, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title>V&iacute;deos | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 'imagens') {
                $_SESSION["agenda"] = TRUE;
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=5" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=5" />
                <meta property="og:description" content="Melhores momentos da OSRN" />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/Orquestra Sinfonica do Rio Grande do Norte.jpg" />
                <meta property="og:title" content="Fotos | OSRN" />
                <meta name="keywords" content="osrn,orquestra,fotos, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title>Fotos | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 'noticias') {
                $_SESSION["agenda"] = FALSE;
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=6" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=6" />
                <meta property="og:description" content="Not&iacute;cias sobre a OSRN" />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/Orquestra Sinfonica do Rio Grande do Norte.jpg" />
                <meta property="og:title" content="Not&iacute;cias | OSRN" />
                <meta name="keywords" content="osrn,orquestra, noticias, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title>Not&iacute;cias | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 'musicos') {
                $_SESSION["agenda"] = FALSE;
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=7" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=7" />
                <meta property="og:description" content="Atualmente a Orquestra conta com 60 m&uacute;sicos que ensaiam diariamente na Academia Norteriograndense de Letras, sede da OSRN, e continua com todo afinco a realizar um trabalho educativo para a forma&ccedil;&atilde;o de novos m&uacute;sicos." />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/musicos.JPG" />
                <meta property="og:title" content="M&uacute;sicos | OSRN" />
                <meta name="keywords" content="osrn,orquestra, musico, musicos, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title>M&uacute;sicos | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 'orquestra') {
                $_SESSION["agenda"] = TRUE;
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=8" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=8" />
                <meta property="og:description" content="A Orquestra Sinf&ocirc;nica do Rio Grande do Norte foi criada pelo do Decreto nº 6874 de mar&ccedil;o de 1976, assinado pelo ent&atilde;o Governador Tarc&iacute;sio Maia, atrav&eacute;s de iniciativa do, &agrave; &eacute;poca, Secret&aacute;rio de Educa&ccedil;&atilde;o e Cultura, Professor Jo&atilde;o Faustino, passando a pertencer aos quadros administrativos da mesma Secretaria." />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/Orquestra Sinfonica do Rio Grande do Norte.jpg" />
                <meta property="og:title" content="Orquestra | OSRN" />
                <meta name="keywords" content="osrn,orquestra, musico, musicos, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title>Orquestra | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 'maestro') {
                $_SESSION["agenda"] = TRUE;
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=9" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=9" />
                <meta property="og:description" content="Linus Lerner &eacute; elogiado por sua flu&ecirc;ncia musical e carisma, regeu v&aacute;rios grupos nos Estados Unidos, Brasil, Bulg&aacute;ria, China, Rep&uacute;blica Checa, M&eacute;xico, Espanha e Turquia. O maestro Linus &eacute; Regente da OSRN desde 2012." />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/linus-lerner.JPG" />
                <meta property="og:title" content="O Maestro | OSRN" />
                <meta name="keywords" content="osrn,orquestra,maestro, musico, musicos, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title>O Maestro | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 10) {
                $_SESSION["agenda"] = TRUE;
                ?>
                <meta http-equiv="refresh" content="5; url=http://www.orquestrasinfonicadorn.com.br/view/pt-BR/ingressos.php">
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=10" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=10" />
                <meta property="og:description" content="Formul&aacute;rio para solicita&ccedil;&atilde;o de ingressos para concertos da OSRN" />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/Orquestra Sinfonica do Rio Grande do Norte.jpg" />
                <meta property="og:title" content="Ingressos | OSRN" />
                <meta name="keywords" content="osrn,orquestra,ingressos, sinfonica, rn, rio grande do norte" />
                <title>Selecione o concerto | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 'convidados') {
                $_SESSION["agenda"] = FALSE;
                if (isset($_GET["cv"]) && isset($_GET["categ"]) && isset($_GET["photo"])):
                    $nome = $_GET["cv"];
                    $categ = $_GET["categ"];
                    $photo = $_GET["photo"];
                else:
                    $nome = "";
                    $categ = "";
                    $photo = "";
                endif;
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=12" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=12" />
                <meta property="og:description" content="A temporada <?php echo date("Y"); ?> da OSRN conta com grandes convidados como o(a) <?php echo $categ . " " . $nome; ?>." />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/<?php echo $photo; ?>" />
                <meta property="og:title" content="Convidados <?php echo date("Y"); ?> | OSRN" />
                <meta name="keywords" content="osrn,orquestra, convidados, musico, musicos, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title>Convidados <?php echo date("Y"); ?> | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 13) {
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=13" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=13" />
                <meta property="og:description" content="A temporada <?php echo date("Y"); ?> da OSRN conta com grandes convidados." />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/Orquestra Sinfonica do Rio Grande do Norte.jpg" />
                <meta property="og:title" content="Temporada <?php echo date("Y"); ?> | OSRN" />
                <meta name="keywords" content="osrn,orquestra, temporada, 2015, musico, musicos, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title>Temporada <?php echo date("Y"); ?> | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 14) {
                $_SESSION["agenda"] = TRUE;
            } elseif ($_GET["ctd"] == 'performances') {
                $_SESSION["agenda"] = FALSE;
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=15" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=15" />
                <meta property="og:description" content="A Orquestra Sinf&ocirc;nica do RN realiza um prof&iacute;cuo trabalho apresentando concertos oficiais no Teatro Riachuelo, concertos populares externos, concertos educativos para toda a rede de ensino, bem como, concertos especiais no interior do Estado." />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/DSC_2143.jpg" />
                <meta property="og:title" content="Performances | OSRN" />
                <meta name="keywords" content="osrn,orquestra, performances, musico, musicos, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title>Performances | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 'convidado') {
                $_SESSION["agenda"] = TRUE;
                $resume = "";
                $foto = "";
                $name = "";
                $id = "";
                if (isset($_GET["id_convidado"])) {
                    $convidado = ConvidadoDAO::buscar($_GET["id_convidado"]);
                    if ($convidado != NULL):
                        $resume = strip_tags($convidado->getResume());
                        $foto = substr($convidado->getFoto(), 3);
                        $name = strip_tags($convidado->getNome());
                        $id = $convidado->getId_convidado();
                    endif;
                }
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=17&id_convidado=<?php echo $id; ?>" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=17&id_convidado=<?php echo $id; ?>" />
                <meta property="og:description" content="<?php echo $resume; ?>" />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/<?php echo $foto; ?>" />
                <meta property="og:title" content="<?php echo $name; ?> | OSRN" />
                <meta name="keywords" content="osrn,orquestra, <?php echo $name; ?>, musico, musicos, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title><?php echo $name; ?> | OSRN</title>
                <?php
            }elseif ($_GET["ctd"] == 18) {
                $_SESSION["agenda"] = TRUE;
                ?>
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br" />
                <meta property="og:description" content="A OSRN foi criada em 1976 e continua com todo afinco a realizar um trabalho tanto..." />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/homeorquestra.JPG" />
                <meta property="og:title" content="Avisos | OSRN" />
                <meta name="keywords" content="osrn,orquestra, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
                <title>Avisos | OSRN</title>
                <?php
            } elseif ($_GET["ctd"] == 19) {
                $_SESSION["agenda"] = TRUE;
                ?>
                <meta http-equiv="refresh" content="5; url=http://www.orquestrasinfonicadorn.com.br/view/pt-BR/ingressos.php">
                <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=19" />
                <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=19" />
                <meta property="og:description" content="Formul&aacute;rio para solicita&ccedil;&atilde;o de ingressos para concertos da OSRN" />
                <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/Orquestra Sinfonica do Rio Grande do Norte.jpg" />
                <meta property="og:title" content="Ingressos | OSRN" />
                <meta name="keywords" content="osrn,orquestra,ingressos, sinfonica, rn, rio grande do norte" />
                <title>Ingressos | OSRN</title>
                <?php
            }
        } else {
            $_SESSION["agenda"] = TRUE;
            ?>
            <link rel="canonical" href="http://www.orquestrasinfonicadorn.com.br" />
            <meta property="og:url" content="http://www.orquestrasinfonicadorn.com.br" />
            <meta property="og:description" content="A OSRN foi criada em 1976 e continua com todo afinco a realizar um trabalho tanto..." />
            <meta property="og:image" content="http://www.orquestrasinfonicadorn.com.br/img/shared/homeorquestra.JPG" />
            <meta property="og:title" content="In&iacute;cio | OSRN" />
            <meta name="keywords" content="osrn,orquestra, sinfonica, rn, rio grande do norte, musica classica, linus, lerner" />
            <title>In&iacute;cio | OSRN</title>
            <?php
        }
        ?>
        <meta name="author" content="Orquestra Sinfonica do Rio Grande do Norte">
        <meta property="og:locale" content="pt_BR">
        <meta property="og:type" content="website" />
        <meta name="robots" content="index, follow" />
        <link rel="alternate" type="application/rss+xml" title="news_osrn" href="rss/news_osrn.rss"/>

        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/latest/normalize.css" media="all" />
        <link href="https://fonts.googleapis.com/css?family=Alegreya+SC|Cinzel+Decorative|Cinzel:900|Niconne|Playfair+Display+SC|Sacramento|Vidaloka|Anton" rel="stylesheet">         
        <link href="https://fonts.googleapis.com/css?family=Adamina|Almendra|Amarante|Caudex|Coda+Caption:800|Cormorant+Unicase|Graduate|IM+Fell+Double+Pica+SC|IM+Fell+English+SC|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer+SC|Katibeh|Marcellus+SC|Metamorphous|Pirata+One|Playfair+Display+SC|Spectral+SC" rel="stylesheet">
        <?php
        include_once 'links-and-scripts.php';
        ?>

        <style>

            .tg-placeHolder{
                background: #000;
            }

            .tg-overlay {
                background: linear-gradient(135deg, rgba(0, 0, 0, 0.78) 0%, rgba(23, 23, 23, 0.60) 100%);
            }

            .thumb-grid .thumbWrapper {
                width: 100%;
                height: 400px;
            }
            .thumbGallery {
                display: none;
            }

        </style>


        <!-- ========= CONFIGURAÇÕES DE IDIOMA =========== -->
        <?php
        $server_name = $_SERVER["SERVER_NAME"];
        $request_uri = $_SERVER["REQUEST_URI"];

        $arrayUrl = explode('/', $request_uri);
        $test = $arrayUrl[count($arrayUrl) - 1];
        if ($test == 'en' or $test == 'pt'):
            array_pop($arrayUrl);
            if (count($arrayUrl) == 1):
                $request_uri = implode("", $arrayUrl);
            else:
                $request_uri = implode("/", $arrayUrl);
            endif;
        endif;
        $url = rtrim($request_uri, '/');
        ?>


        <script type="text/javascript">
            $(document).on('click', '#pt', function () {
                window.open("http://<?php
        echo $server_name;
        echo $url
        ?>/pt", "_self");
            });
            $(document).on('click', '#en', function () {
                window.open("http://<?php
        echo $server_name;
        echo $url
        ?>/en", "_self");
            });
        </script>

        <!-- ========= FIM DAS CONFIGURAÇÕES DE IDIOMA =========== -->

    </head>
    <body>
        <script>
            window.fbAsyncInit = function () {
                FB.init({
                    appId: '161517967527557',
                    xfbml: true,
                    version: 'v2.5'
                });
            };

            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <?php
        include_once './control/analyticstracking.php';
        ?>
        <div class="container-fluid">
            <?php
            include_once 'view/en-US/header.php';
            ?>
            <div class="row">
                <main class="col-md-12 main-body">
                    <?php
                    include_once 'content-main.php';
                    if (isset($_GET["ctd"])):
                        if ($_GET["ctd"] == 'inicio'):
                            include_once 'view/en-US/home.php';
                        elseif ($_GET["ctd"] == 'orquestra'):
                            include_once 'view/en-US/orquestra.php';
                        elseif ($_GET["ctd"] == 'agenda'):
                            include_once 'view/en-US/agenda.php';
                        elseif ($_GET["ctd"] == 'contato'):
                            include_once 'view/en-US/contato.php';
                        elseif ($_GET["ctd"] == 'convidados'):
                            include_once 'view/en-US/convidados.php';
                        elseif ($_GET['ctd'] == 'convidado'):
                            include_once 'view/en-US/convidado.php';
                        elseif ($_GET["ctd"] == 'imagens'):
                            include_once 'view/en-US/imagens.php';
                        elseif ($_GET["ctd"] == 'videos'):
                            include_once 'view/en-US/videos.php';
                        elseif ($_GET["ctd"] == 'noticias'):
                            include_once 'view/en-US/noticias.php';
                        elseif ($_GET["ctd"] == 'maestro'):
                            include_once 'view/en-US/maestro.php';
                        elseif ($_GET["ctd"] == 'musicos'):
                            include_once 'view/en-US/musicos.php';
                        elseif ($_GET['ctd'] == 'performances'):
                            include_once 'view/en-US/performances.php';
                        else:
                            include_once 'view/en-US/home.php';
                        endif;
                    else:
                        include_once 'view/en-US/home.php';
                    endif;
                    ?>
                </main>
            </div>
        </div>
        <?php
        include_once 'view/en-US/footer.php';
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                /*======================================== VEGAS BACKGROUND SLIDES ===========================================================*/
                $("body").vegas({
                    slides: [
                        {src: "http://www.orquestrasinfonicadorn.com.br/img/slides/bg1.jpg"},
                        {src: "http://www.orquestrasinfonicadorn.com.br/img/slides/bg2.jpg"},
                        {src: "http://www.orquestrasinfonicadorn.com.br/img/slides/bg3.jpg"},
                        {src: "http://www.orquestrasinfonicadorn.com.br/img/slides/bg4.jpg"}
                    ],
                    preload: true,
                    timer: false,
                    /*overlay: true,*/
                    overlay: 'http://www.orquestrasinfonicadorn.com.br/plugins/vegas/overlays/06.png',
                    delay: 20000,
                    transitionDuration: 3000,
                    collor: "#000",
                    transition: ['fade', 'zoomin'],
                    animation: 'kenburns'
                });
                /*======================================== CENAS DO SCROLLMAGIC ===========================================================*/
                // build initials tweens
                var leftInitial;
                var leftFinal;
                var bigCircleLeftLogoFrom = -300;
                var bigCircleLeftLogoTo = 70;
                var smallCircleLeftSponsorsFrom = -200;
                var smallCircleLeftSponsorsTo = 60;
                if (screen.width <= 320) {
                    leftInitial = 330;
                    leftFinal = 223;
                    bigCircleLeftLogoFrom = -125;
                    bigCircleLeftLogoTo = 5;
                    smallCircleLeftSponsorsTo = 5;
                } else if (screen.width <= 375) {
                    leftInitial = 380;
                    leftFinal = 270;
                    bigCircleLeftLogoFrom = -125;
                    bigCircleLeftLogoTo = 5;
                    smallCircleLeftSponsorsTo = 5;
                } else if (screen.width <= 414) {
                    leftInitial = 420;
                    leftFinal = 300;
                    bigCircleLeftLogoFrom = -200;
                    bigCircleLeftLogoTo = 10;
                    smallCircleLeftSponsorsFrom = -100;
                    smallCircleLeftSponsorsTo = 10;
                } else if (screen.width <= 533 & screen.height <= 320) {
                    leftInitial = 550;
                    leftFinal = 430;
                    bigCircleLeftLogoFrom = -125;
                    bigCircleLeftLogoTo = 5;
                    smallCircleLeftSponsorsFrom = -100;
                    smallCircleLeftSponsorsTo = 5;
                } else if (screen.width <= 992) {
                    leftInitial = 1000;
                    leftFinal = 760;
                } else if (screen.width <= 1024) {
                    leftInitial = 1030;
                    leftFinal = 830;
                } else if (screen.width <= 1280) {
                    leftInitial = 1300;
                    leftFinal = 1060;
                } else if (screen.width <= 1366) {
                    leftInitial = 1380;
                    leftFinal = 1130;
                } else if (screen.width > 1366) {
                    leftInitial = 1700;
                    leftFinal = 1320;
                }
                TweenMax.staggerFromTo("#reserve-ingressos", 2, {left: leftInitial, scale: 0.5, opacity: 0, rotation: 150}, {left: leftFinal, scale: 1, opacity: 1, rotation: 20, ease: Back.easeOut, delay: 1}, 0.20);
                TweenMax.staggerFromTo("#big-circle-left-logo", 1, {left: bigCircleLeftLogoFrom, rotation: 220, scale: 0.5, opacity: 0}, {left: bigCircleLeftLogoTo, rotation: 0, opacity: 1, scale: 1, ease: Back.easeOut}, 0.20);
                TweenMax.staggerFromTo("#small-circle-left-sponsors", 2, {left: smallCircleLeftSponsorsFrom}, {left: smallCircleLeftSponsorsTo, ease: Elastic.easeOut, delay: 1}, 0.15);
                /*
                 * ease options:
                 * Back.easeOut
                 * Elastic.easeOut
                 * Bounce.easeOut
                 * Power0
                 * Power1
                 * Power2
                 * Power3
                 * Power4
                 * Rough
                 * SlowMo
                 * Stepped
                 * Circ
                 * Expo
                 * Sine
                 */
                var tween1;
                var toLeft = 0;
                var bigCircleTo = -350;
                var smallCircleTo = -300;
                if (screen.width <= 320) {
                    toLeft = 330;
                } else if (screen.width <= 375) {
                    toLeft = 380;
                    bigCircleTo = -125;
                } else if (screen.width <= 414) {
                    toLeft = 420;
                    bigCircleTo = -200;
                    smallCircleTo = -100;
                } else if (screen.width <= 533 & screen.height <= 320) {
                    toLeft = 550;
                    bigCircleTo = -125;
                    smallCircleTo = -100;
                } else if (screen.width <= 992) {
                    toLeft = 1000;
                } else if (screen.width <= 1024) {
                    toLeft = 1030;
                } else if (screen.width <= 1280) {
                    toLeft = 1300;
                } else if (screen.width <= 1366) {
                    toLeft = 1380;
                } else if (screen.width > 1366) {
                    toLeft = 1700;
                }
                tween1 = TweenMax.to("#reserve-ingressos", 2, {left: toLeft, scale: 0.6}, 0.15);

                var tween2 = TweenMax.to("#big-circle-left-logo", 2, {left: bigCircleTo, delay: 2.8}, 0.15);
                //LADO ESQUERDO DA CORTINA
                var tween3 = TweenMax.to("#left-curtain-1", 2, {x: -150, delay: 0.2});
                var tween4 = TweenMax.to("#left-curtain-2", 2, {x: -100, delay: 0.5});
                var tween5 = TweenMax.to("#left-curtain-3", 2, {x: -100, delay: 0.8});
                var tween6 = TweenMax.to("#left-curtain-over-1", 2, {x: -190, delay: 1.1});
                var tween7 = TweenMax.to("#left-curtain-over-2", 2, {x: -190, delay: 1.4});
                var tween8 = TweenMax.to("#left-curtain-over-3", 2, {x: -150, delay: 1.7});
                //LADO DIREITO DA CORTINA
                var tween9 = TweenMax.to("#right-curtain-1", 2, {x: 1550, delay: 0.2});
                var tween10 = TweenMax.to("#right-curtain-2", 2, {x: 1500, delay: 0.5});
                var tween11 = TweenMax.to("#right-curtain-3", 2, {x: 1500, delay: 0.8});
                var tween12 = TweenMax.to("#right-curtain-over-1", 2, {x: 1590, delay: 1.1});
                var tween13 = TweenMax.to("#right-curtain-over-2", 2, {x: 1590, delay: 1.4});
                var tween14 = TweenMax.to("#right-curtain-over-3", 2, {x: 1550, delay: 1.7});
                var tween15 = TweenMax.to("#small-circle-left-sponsors", 2, {x: smallCircleTo});
                var offset;
                if (screen.width <= 320) {
                    offset = 115;
                } else if (screen.width <= 414) {
                    offset = 150;
                } else if (screen.width <= 960) {
                    offset = 125;
                } else if (screen.width <= 992) {
                    offset = 110;
                } else if (screen.width <= 1024) {
                    offset = 160;
                } else if (screen.width <= 1280) {
                    offset = 165;
                } else if (screen.width <= 1366) {
                    offset = 160;
                } else if (screen.width > 1366) {
                    offset = 180;
                }

                var scene0 = new ScrollMagic.Scene(
                        {
                            triggerElement: "#trigger4",
                            offset: offset,
                            triggerHook: 0.20,
                            duration: 500
                        }).setTween([
                    tween1,
                    tween2,
                    tween3,
                    tween4,
                    tween5,
                    tween6,
                    tween7,
                    tween8,
                    tween9,
                    tween10,
                    tween11,
                    tween12,
                    tween13,
                    tween14,
                    tween15
                ]);
//                        .addIndicators({name: "staggering"});

                controller.addScene(scene0);
                var tweenOrquestra = TweenMax.from("#orquestra", 2, {x: -50, scale: 0.5, opacity: 0});
                var tweenMaestro = TweenMax.from("#maestro", 2, {x: -50, scale: 0.5, opacity: 0, delay: 0.4});
                var tweenConvidados = TweenMax.from("#convidados", 2, {x: -50, scale: 0.5, opacity: 0, delay: 0.8});
                var tweenMusicos = TweenMax.from("#musicos", 2, {x: -50, scale: 0.5, opacity: 0, delay: 1.2});
                var scene1 = new ScrollMagic.Scene({triggerElement: "#trigger5", offset: 0, triggerHook: 0.50, duration: 200})
                        .setTween([tweenOrquestra, tweenMaestro, tweenConvidados, tweenMusicos]);
                // .addIndicators({name: "cena2"});


                var tweenTitleNews = TweenMax.from("#title-news", 1, {x: -100, scale: 0.5, opacity: 0});
                var tweenNews1 = TweenMax.from("#news1", 3, {x: -1000, delay: 0, rotation: -90});
                var tweenNews2 = TweenMax.from("#news2", 3, {x: 2000, delay: 0.5, rotation: -90});
                var scene2 = new ScrollMagic.Scene({triggerElement: "#trigger6", offset: 0, triggerHook: 0.70, duration: 400})
                        .setTween([tweenTitleNews, tweenNews1, tweenNews2]);
                // .addIndicators({name: "cena3"});

                var tweenNews3 = TweenMax.from("#news3", 3, {x: -1000, delay: 0.8, rotation: -90});
                var tweenNews4 = TweenMax.from("#news4", 3, {x: 2000, delay: 1.2, rotation: -90});
                var scene3 = new ScrollMagic.Scene({triggerElement: "#trigger7", offset: 0, triggerHook: 0.20, duration: 400})
                        .setTween([tweenNews3, tweenNews4]);
                // .addIndicators({name: "cena4"});

                controller.addScene([scene1, scene2, scene3]);
            });
        </script>
    </body>
</html>
