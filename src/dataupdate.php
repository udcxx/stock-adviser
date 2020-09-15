<?php

    // ------------------------------
    //  DATA UPDATE
    //                      Ver 1.0.0
    // ------------------------------

    require_once("./assets/phpQuery-onefile.php");
    $html = file_get_contents("");
    echo phpQuery::newDocument($html)->find("")->text();

?>