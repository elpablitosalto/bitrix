<div class="dp-search-items">
    <?
    $bNoSearchResults = false;
    ?>
    <? if (mb_strlen($_GET["q"]) > 0) { ?>
        <?
        $arSearchParams = array(
            '~FILTER_NAME' =>  $arParams["~FILTER_NAME"],
            'CHECK_DATES' => 'N',
            'IBLOCK_TYPE' => $arParams["IBLOCK_TYPE"],
            'CACHE_TYPE' => 'N',
            'CACHE_TIME' => '3600',
            'SET_TITLE' => 'N',
            'IBLOCK_ID' => $arParams["IBLOCK_ID"],
        );
        //vardump($arSearchParams);
        $GLOBALS[$arSearchParams["~FILTER_NAME"]]["ID"] = $APPLICATION->IncludeComponent(
            "bitrix:search.page",
            "articles",
            array(
                "CHECK_DATES" => $arSearchParams["CHECK_DATES"] !== "N" ? "Y" : "N",
                "arrWHERE" => array("iblock_" . $arSearchParams["IBLOCK_TYPE"]),
                "arrFILTER" => array("iblock_" . $arSearchParams["IBLOCK_TYPE"]),
                "SHOW_WHERE" => "N",
                "CACHE_TYPE" => $arSearchParams["CACHE_TYPE"],
                "CACHE_TIME" => $arSearchParams["CACHE_TIME"],
                "SET_TITLE" => $arSearchParams["SET_TITLE"],
                "arrFILTER_iblock_" . $arSearchParams["IBLOCK_TYPE"] => array($arSearchParams["IBLOCK_ID"]),
                "PAGE" => $_SERVER['REQUEST_URI'],
                'USE_TITLE_RANK' => 'Y',
                'PAGE_RESULT_COUNT' => 5000,
            ),
            $component
        );
        if (empty($GLOBALS[$arSearchParams["~FILTER_NAME"]]["ID"])) {
            $bNoSearchResults = true;
        }

        //vardump($GLOBALS[$arSearchParams["~FILTER_NAME"]]);
        ?>
    <? } else { ?>

    <? } ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:search.form",
        "articles",
        array(
            //"PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
            //"PAGE" => $arResult["FOLDER"],
            "PAGE" => $_SERVER['REQUEST_URI'],
        ),
        $component
    ); ?>
</div>