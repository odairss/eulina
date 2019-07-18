<?php
include_once 'DAO/MusicoDAO.php';
$musicos = MusicoDAO::buscarTodos();
?>
<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-wrapper">
    <div>
        <h1>OS M&Uacute;SICOS</h1>
    </div>
    <article class="container-text">
        <div>
            <img src=""/>
        </div>
        <div class="page_musicos">
            <article>
                <h5><strong>1<sup>o</sup> Violinos:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "1-violino") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>2<sup>o</sup> Violinos:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "2-violino") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Violas:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "viola") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Violoncelos:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "violoncelo") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Contrabaixos:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "contrabaixo") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Flautas:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "flauta") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Obo&eacute;s:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "oboe") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Clarinetes:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "clarinete") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Fagotes:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "fagote") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Trompas:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "trompa") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Trompetes:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "trompete") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Trombones:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "trombone") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Tuba:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "tuba") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>T&iacute;mpanos:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "timpano") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Percuss&atilde;o:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "percussao") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>DIRETOR ART&Iacute;STICO:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "diretor-artistico") {
                            echo '<li><a href="?ctd=9" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>COORDENADORIA ADMINISTRATIVA:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "coordenadoria-administrativa") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>SECRETARIA:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "secretaria") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
                <h5><strong>Inspetor:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "inspetor") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>ARQUIVISTAS M&Uacute;SICO - COPISTAS:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "arquivista-musico-copista") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>MONTADORES:</strong></h5>
                <ul>
                    <?php
                    foreach ($musicos as $musico) {
                        if ($musico->getInstrumento() == "montador") {
                            echo '<li><a href="?ctd=14&id_musico=' . $musico->getId_musico() . '" target="_self">' . $musico->getNome();
                            if ($musico->getCategoria() == 0) {
                                echo '';
                            } elseif ($musico->getCategoria() == 1) {
                                echo ' (*)';
                            } elseif ($musico->getCategoria() == 2) {
                                echo ' (**)';
                            } elseif ($musico->getCategoria() == 3) {
                                echo ' (***)';
                            }
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </article>
            <article>
                <h5><strong>Legenda:</strong></h5>
                <ul>
                    <li>(*) Chefe de Naipe</li>
                    <li>(**) M&uacute;sico Convidado</li>
                    <li>(***) Estagi&aacute;rios</li>
                </ul>
            </article>
        </div>
    </article>
</section>