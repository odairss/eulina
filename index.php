<?php

session_start();
if (!isset($_GET["lang"]) AND ! isset($_SESSION["language"])):
    if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])):
        $_SESSION["language"] = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
        if ($_SESSION["language"] == 'pt'):
            require( dirname(__FILE__) . '/view/pt-BR/page.php');
        else:
            require( dirname(__FILE__) . '/view/en-US/page.php');
        endif;
    else:
        require( dirname(__FILE__) . '/view/pt-BR/page.php');
    endif;
elseif (isset($_GET["lang"]) AND isset($_SESSION["language"])):
    if ($_GET["lang"] == 'pt'):
        $_SESSION["language"] = 'pt';
        require( dirname(__FILE__) . '/view/pt-BR/page.php');
    else:
        $_SESSION["language"] = 'en';
        require( dirname(__FILE__) . '/view/en-US/page.php');
    endif;
elseif (isset($_SESSION["language"]) AND ! isset($_GET["lang"])):
    if ($_SESSION["language"] == 'pt'):
        require( dirname(__FILE__) . '/view/pt-BR/page.php');
    else:
        require( dirname(__FILE__) . '/view/en-US/page.php');
    endif;
endif;