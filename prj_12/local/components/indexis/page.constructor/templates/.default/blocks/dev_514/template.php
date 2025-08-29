<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$item = $arParams['ITEM'];
$chosenAddressId = ($arParams['SYNC_CONTENT_CLINIC'] == 'Y' ? intval($_COOKIE['chosenAddressId']) : 0);
// -->
$IND_PROP = "";
//if (intval($_COOKIE['chosenAddressId']) > 0) {
//    $index = $GLOBALS["arSiteConfig"]["IND_PROPS_ADDRESS"][$_COOKIE['chosenAddressId']];
//    if (strlen($index) > 0) {
//        $IND_PROP = "_" . $index;
//    }
//}
$DEV_514 = 'DEV_514' . $IND_PROP;
$DEV_514_LICENSES = 'DEV_514_LICENSES' . $IND_PROP;
// <--

$arPropertieValue = $item['DISPLAY_PROPERTIES'][$DEV_514]['VALUE'];
$FILTER_NAME = "arrFilter_licenses";
$arIds = array();

if ($chosenAddressId > 0) {

    $res = CIBlockElement::GetList(['SORT' => 'ASC'], [
        'IBLOCK_ID' => Indexis::getIblockId('addresses', 'contacts'),
        'ACTIVE_DATE' => 'Y',
        'ACTIVE' => 'Y',
        'ID' => $chosenAddressId,
        '!PROPERTY_DEV_514_LICENSES' => false
    ], false, false, [
        'ID', 'PROPERTY_DEV_514_LICENSES'
    ]);

    while($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arIds[] = $arFields['PROPERTY_DEV_514_LICENSES_VALUE'];
    }

} else {
    foreach ($arPropertieValue as $arItem) {
        $arItemValues = $arItem['SUB_VALUES'];
        $val = $arItemValues[$DEV_514_LICENSES]['VALUE'];
        $arIds[] = $val;
    }
}

if (!empty($arIds)) {
    $GLOBALS[$FILTER_NAME]["ID"] = $arIds;
}

if (!empty($GLOBALS[$FILTER_NAME]["ID"])) {
?>
    <section class="nb-section nb-section_dark nb-licenses-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
        <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
            <? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') : ?>
                <div class="nb-section__header">
                    <? require __DIR__ . "/../../title.php"; ?>
                </div>
            <? endif; ?>
            <div class="nb-section__body">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "licenses_v2",
                    array(
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => "block" . $item['ID'],
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "N",
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => Indexis::getIblockId("licenses"),
                        "NEWS_COUNT" => "200",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => $FILTER_NAME,
                        "FIELD_CODE" => array(
                            "ID",
                            "NAME",
                            "PREVIEW_TEXT",
                            //"PREVIEW_PICTURE",
                            //"DETAIL_PICTURE",
                            "DETAIL_PAGE_URL"
                        ),
                        "PROPERTY_CODE" => array("DATE", "CITY"),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "CACHE_FILTER" => "Y",
                        "CACHE_GROUPS" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "",
                        "PAGER_DESC_NUMBERING" => "Y",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "Y",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => "",
                        "PAGER_BASE_LINK" => "",
                        "PAGER_PARAMS_NAME" => "arrPager",
                        "SYNC_CONTENT_CLINIC" => $arParams['SYNC_CONTENT_CLINIC']
                    )
                );
                ?>
            </div>
        </div>
    </section>
<?
}
?>