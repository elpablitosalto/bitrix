<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$item = $arParams['ITEM'];
?>
<?if (is_array($item['PROPERTIES']['S_2']['VALUE']) && count($item['PROPERTIES']['S_2']['VALUE']) > 0):?>
    <section class="nb-section nb-price-table-section" id="<?=$arParams['BLOCK_AREA_ID']?>">
        <div class="container" id="<?=$arParams['EDIT_AREA_ID']?>">
            <div class="nb-section__header">
                <?
                // Вывод заголовка для десктопа -->
                if (strlen($item["H_FST_PART_D"]) > 0) {
                    ?>
                    <h2 class="nb-section__title">
                        <?
                        echo $item["H_FST_PART_D"];
                        if (strlen($item["H_SEC_PART_D"]) > 0) {
                            ?> <span class="font-weight_normal">
                            <?= $item["H_SEC_PART_D"]; ?>
                        </span>
                            <?
                        }
                        ?>
                    </h2>
                    <?
                }
                // <-- Вывод заголовка для десктопа
                ?>
            </div>
            <?
            $GLOBALS['arFilter' . $item['ID']] = ['ID' => $item['PROPERTIES']['S_2']['VALUE']];

            $arAccordeonData = [];
            foreach ($item['PROPERTIES']['S_2']['VALUE'] as $key => $priceId) {
                $arAccordeonData[] = reset(unserialize($item['PROPERTIES']['S_2']['~DESCRIPTION'][$key]));
            }

            if (isset($arAccordeonData[0]) && $arAccordeonData[0] == '')
                $arAccordeonData[0] = '-';

            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "price_accordeon",
                Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "N",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array("", ""),
                    "FILTER_NAME" => 'arFilter' . $item['ID'],
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => Indexis::getIblockId('pricelist', 'services'),
                    "IBLOCK_TYPE" => "services",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "N",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "1000",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array("NAME_ALT", "SHOW_PRICE_FROM", "PRICE", "PRICE_OLD", ""),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ID",
                    "SORT_BY2" => "NAME",
                    "SORT_ORDER1" => $item['PROPERTIES']['S_2']['VALUE'],
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "EDIT_AREA_ID" => $arParams['EDIT_AREA_ID'],
                    "ACCORDEON_DATA" => $arAccordeonData
                )
            );?>
        </div>
    </section>
<?endif;?>