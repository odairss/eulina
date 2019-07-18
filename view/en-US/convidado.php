<?php
include_once 'DAO/ConvidadoDAO.php';
include_once 'DAO/AgendaDAO.php';
if (isset($_GET["id_convidado"])):
    $convidado = ConvidadoDAO::buscar($_GET["id_convidado"]);
    if ($convidado != NULL):
        $concert = AgendaDAO::pesquisar($convidado->getId_evento());
        $date = implode("-", array_reverse(explode("/", $concert->getDataevento())));
        $date_en_us = new DateTime($date);
        $guest_photo = substr($convidado->getFoto(), 3);
        $name_guest = $convidado->getNome();
        $category_en = $convidado->getCateg_en_us();
        $country = $convidado->getCountry();
        $bio = $convidado->getBio_en_us();
        $id_guest = $convidado->getId_convidado();
        ?>
        <section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-wrapper">
            <div>
                <h1><?php echo $name_guest; ?></h1>
            </div>
            <article class="container-text">
                <div class="col-xs-12 col-sm-12 col-md-12 convidado_page">
                    <div id="convid">
                        <a href="<?php echo 'http://www.orquestrasinfonicadorn.com.br/' . $guest_photo ?>" data-lightbox='image-1' data-title='<?php echo $name_guest ?>'><img src="<?php echo 'http://www.orquestrasinfonicadorn.com.br/' . $guest_photo; ?>"/></a>
                    </div>
                    <p id="info-concert">
                        <strong>

                            <?php
                            echo "Soloist: " . $category_en . "<br/>";
                            echo " (" . $country . ")<br/>";
                            ?>
                            Invited to the concert:<br/>
                            <a href="http://www.orquestrasinfonicadorn.com.br/agenda/concerto/<?php echo $concert->getIdevento(); ?>" target="_SELF"><?php echo $concert->getTitulo(); ?></a><br/>
                            <?php echo $date_en_us->format("F d, Y"); ?><br/>
                        </strong>
                    </p>
                    <?php echo $bio; ?>

                </div>
                <h4>Comments</h4>
                <div id="comentplugin-facebook">
                    <div class="fb-comments" data-href="http://www.orquestrasinfonicadorn.com.br/convidado/<?php echo $_GET["id_convidado"]; ?>" data-width="100%" data-numposts="10"></div>
                </div>
            </article>
        </section>
        <?php
    else:
        ?>
        <section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-wrapper">
            <article class="container-text">
                <div>
                    <h1><?php echo "No guest found" ?></h1>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 convidado_page">
                    <div id="convid">
                        <a href="#" data-lightbox='image-1' data-title=' '><img src=" "/></a>
                    </div>
                    <p id="info-concert">
                        <strong>
                        </strong>
                    </p>
                    <?php echo ""; ?>

                </div>
            </article>
        </section>
    <?php
    endif;
    endif;