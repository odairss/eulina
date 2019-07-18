<?php
include_once 'DAO/MusicoDAO.php';
$musicos = MusicoDAO::buscarTodos();
?>
<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-wrapper">
    <div>
        <h1>THE MUSICIANS</h1>
    </div>
    <article class="container-text">
        <div>
            <img src=""/>
        </div>
        <div class="page_musicos">
            <article>
                <h5><strong>1<sup>o</sup> Violins:</strong></h5>
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
                <h5><strong>2<sup>o</sup> Violins:</strong></h5>
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
                <h5><strong>Cellos:</strong></h5>
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
                <h5><strong>Basses:</strong></h5>
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
                <h5><strong>Flutes:</strong></h5>
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
                <h5><strong>Oboes:</strong></h5>
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
                <h5><strong>Clarinets:</strong></h5>
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
                <h5><strong>Bassoons:</strong></h5>
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
                <h5><strong>Horns:</strong></h5>
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
                <h5><strong>Trumpets:</strong></h5>
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
                <h5><strong>Timpani:</strong></h5>
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
                <h5><strong>Percussion:</strong></h5>
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
                <h5><strong>ARTISTIC DIRECTOR:</strong></h5>
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
                <h5><strong>COORDINATION ADMINISTRATIVE:</strong></h5>
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
                <h5><strong>Office:</strong></h5>
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
                <h5><strong>Inspector:</strong></h5>
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
                <h5><strong>ARCHIVISTS MUSICIAN - COPYISTS:</strong></h5>
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
                <h5><strong>ASSEMBLERS:</strong></h5>
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
                <h5><strong>Legend:</strong></h5>
                <ul>
                    <li>(*) Head of Naipe</li>
                    <li>(**) Guest musician</li>
                    <li>(***) Trainees</li>
                </ul>
            </article>
        </div>
    </article>
</section>