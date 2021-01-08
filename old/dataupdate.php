<?php

    // ------------------------------
    //  DATA UPDATE
    //                      Ver 1.0.0
    // ------------------------------

    $allData = getFyStockDividend();



    // 配当に関するデータを取得します
    function getFyStockDividend () {
        $json = file_get_contents("../fy-stock-dividend.json");
        $arr = json_decode($json, true);
        $codes = array_keys($arr["item"]);

        $items;
        for ($n=0; $n < count($codes); $n++) {
            $thisCode = $codes[$n];
            $items[$n] = [$thisCode, $arr["item"][$thisCode][1], $arr["item"][$thisCode][4], getStockPrice($thisCode)];

            // テスト表示用
            echo "コード：".$items[$n][0]." 配当：".$items[$n][1]." 配当性向：".$items[$n][2]." 前日終値：".$items[$n][3]."<br>";
        }

        return $items;
    }



    // 昨日の終値を返します
    function getStockPrice ($stockCode) {
        require_once("./assets/phpQuery-onefile.php");
        $html = file_get_contents("https://kabuoji3.com/stock/".$stockCode."/");
        return phpQuery::newDocument($html) -> find("tbody") -> find("td:eq(6)") -> text();
    }

?>
