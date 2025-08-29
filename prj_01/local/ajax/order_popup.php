<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>

<?
CModule::IncludeModule('iblock');
?>

<div class="popup popup__order js_popup_order">
    <h2>Добавить позицию в заказ</h2>
    <label class="c-form--label c-form--label__search">
        <input class="c-form--input js_order_search_query_popup" value="<?= $_GET["q"] ?>" type="text" name="q" placeholder="Найти">
        <button class="c-form--label__search_clear display-none js_popup_search_clear" type="button">
            <svg width="14" height="14">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#close2"></use>
            </svg>
        </button>
        <svg width="2" height="16">
            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#line"></use>
        </svg>
        <button class="c-form--label__search_search js_popup_search_button" type="button">
            <svg width="18" height="18">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#search"></use>
            </svg>
        </button>
        <div class="c-form--label__result c-form--label__all display-none"><a href="#">Гематологический анализатор</a><a href="#">Гематологический анализатор</a><a href="#">Гематологический анализатор</a></div>
    </label>
    
    <? if (mb_strlen($_GET["q"]) > 0) { ?>
        <?
        $PAGE = $_SERVER['REQUEST_URI'];

        $arParamsForGlobalSearch = array(
            array(
                'IBLOCK_ID' => Indexis::getIblockId('hematology', 'reagents')
            ),
            array(
                'IBLOCK_ID' => Indexis::getIblockId('biochemistry', 'reagents')
            ),
            array(
                'IBLOCK_ID' => Indexis::getIblockId('analysis', 'reagents')
            ),
            array(
                'IBLOCK_ID' => Indexis::getIblockId('veterinary', 'reagents')
            ),
        );

        $arElementsIds = array();
        $IBLOCKS = array();

        foreach ($arParamsForGlobalSearch as $key => $val) {
            if (intval($val['IBLOCK_ID']) > 0) {
                $arSearchParams = array(
                    '~FILTER_NAME' => 'arrFilterReagents',
                    'CHECK_DATES' => 'N',
                    'IBLOCK_TYPE' => 'reagents',
                    'CACHE_TYPE' => 'N',
                    'CACHE_TIME' => '3600',
                    'SET_TITLE' => 'N',
                    'IBLOCK_ID' => $val['IBLOCK_ID'],
                );
                $ids = $APPLICATION->IncludeComponent(
                    "bitrix:search.page",
                    "reagents",
                    array(
                        "CHECK_DATES" => $arSearchParams["CHECK_DATES"] !== "N" ? "Y" : "N",
                        "arrWHERE" => array("iblock_" . $arSearchParams["IBLOCK_TYPE"]),
                        "arrFILTER" => array("iblock_" . $arSearchParams["IBLOCK_TYPE"]),
                        "SHOW_WHERE" => "N",
                        "CACHE_TYPE" => $arSearchParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arSearchParams["CACHE_TIME"],
                        "SET_TITLE" => $arSearchParams["SET_TITLE"],
                        "arrFILTER_iblock_" . $arSearchParams["IBLOCK_TYPE"] => array($arSearchParams["IBLOCK_ID"]),
                        "PAGE" => $PAGE,
                        'USE_TITLE_RANK' => 'Y',
                        'PAGE_RESULT_COUNT' => 5000,
                    ),
                    $component
                );
                if (!empty($ids)) {
                    $arElementsIds = array_merge($arElementsIds, $ids);
                    $IBLOCKS[] = $val['IBLOCK_ID'];
                }
            }
        }

        if (!empty($arElementsIds)) {
        ?>

            <h3>Результаты:</h3>
            <?
            $GLOBALS['arrFilterOrderPopup']['ID'] = $arElementsIds;
            ?>
            <? $APPLICATION->IncludeComponent(
                "dirui:news.line",
                "order_popup",
                array(
                    "IBLOCK_TYPE" => "reagents",
                    "IBLOCKS" => $IBLOCKS,
                    "NEWS_COUNT" => "30",
                    "FIELD_CODE" => array("ID", "NAME", "CODE", "PROPERTY_NUMBER"),
                    "SORT_BY1" => "NAME",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "DETAIL_URL" => "news_detail.php?ID=#ELEMENT_ID#",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "300",
                    "CACHE_GROUPS" => "Y",

                    // Мои параметры -->
                    "FILTER_NAME" => "arrFilterOrderPopup",
                    // <-- Мои параметры
                )
            ); ?>
        <?
        } else {
        ?>
            Ничего не найдено.
        <?
        }

        //$GLOBALS[$arSearchParams["~FILTER_NAME"]]["=ID"]
        ?>
    <? } else { ?>

        Введите поисковый запрос.

    <? } ?>

    <button class="popup_close js_popup_close_order" type="button"></button>
</div>


<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>