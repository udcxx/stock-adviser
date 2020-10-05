<?php

    // ------------------------------
    //  DATA UPDATE
    //                      Ver 1.0.0
    // ------------------------------


    echo getStockPrice("7203");

    function getStockPrice ($stockCode) {
        require_once("./assets/phpQuery-onefile.php");
        $html = file_get_contents("https://kabuoji3.com/stock/".$stockCode."/");
        return phpQuery::newDocument($html) -> find("tbody") -> find("td:eq(6)") -> text();
    }

?>
