<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<?
$sliderID = "specials_slider_wrapp_" . $this->randString();
$notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
$arNotify = unserialize($notifyOption);
?>

<? if ($arResult["ITEMS"]): ?>
    <?
    if ($fast_view_text_tmp = \Bitrix\Main\Config\Option::get('aspro.mshop', 'EXPRESSION_FOR_FAST_VIEW', GetMessage('FAST_VIEW')))
        $fast_view_text = $fast_view_text_tmp;
    else
        $fast_view_text = GetMessage('FAST_VIEW');
    ?>
    <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
        <?
        $arFilter = Array(
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "ID" => $arItem["ID"]
        );
        $res = CIBlockElement::GetList(Array(), $arFilter);
        if ($ob = $res->GetNextElement()) {
            $arProps = $ob->GetProperties();
        }
        ?>

        <? if ($arProps['RASPRODAT']['VALUE'] !== 'Да'): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
            $totalCount = CMShop::GetTotalCount($arItem);
            $arQuantityData = CMShop::GetQuantityArray($totalCount);
            $arItem["FRONT_CATALOG"] = "Y";

            $strMeasure = '';
            if ($arItem["OFFERS"]) {
                $strMeasure = $arItem["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
            } else {
                if (($arParams["SHOW_MEASURE"] == "Y") && ($arItem["CATALOG_MEASURE"])) {
                    $arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
                    $strMeasure = $arMeasure["SYMBOL_RUS"];
                }
            }
            ?>
            <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="catalog_item">
                <div class="image_wrapper_block">
                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="thumb">
                            <? if ($arItem["PROPERTIES"]["HIT"]["VALUE"]) { ?>
                            <div class="stickers">
                                <? foreach ($arItem["PROPERTIES"]["HIT"]["VALUE_XML_ID"] as $key => $class) { ?>
                                    <div class="sticker_<?= strtolower($class); ?>" title="<?= $arItem["PROPERTIES"]["HIT"]["VALUE"][$key] ?>"></div>
                            <? } ?>
                            </div>
                        <? } ?>
                        <?
                        /* $frame = $this->createFrame()->begin('');
                          $frame->setBrowserStorage(true); */
                        ?>
                            <? if ($arParams["DISPLAY_WISH_BUTTONS"] != "N" || $arParams["DISPLAY_COMPARE"] == "Y"): ?>
                            <div class="like_icons">
                <? if ($arItem["CAN_BUY"] && empty($arItem["OFFERS"]) && $arParams["DISPLAY_WISH_BUTTONS"] != "N"): ?>
                                    <div class="wish_item_button">
                                        <span title="<?= GetMessage('CATALOG_WISH') ?>" class="wish_item to" data-item="<?= $arItem["ID"] ?>"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.2373 6.23707C20.7839 7.78372 20.8432 10.2724 19.3718 11.8909L11.9997 19.9998L4.62812 11.8909C3.1568 10.2724 3.21604 7.78374 4.76268 6.2371C6.4896 4.51018 9.33371 4.66778 10.8594 6.57484L12 7.99992L13.1396 6.57479C14.6653 4.66773 17.5104 4.51015 19.2373 6.23707Z" stroke="#7F7C7C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                        <span title="<?= GetMessage('CATALOG_WISH_OUT') ?>" class="wish_item in added" style="display: none;" data-item="<?= $arItem["ID"] ?>"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.2373 6.23707C20.7839 7.78372 20.8432 10.2724 19.3718 11.8909L11.9997 19.9998L4.62812 11.8909C3.1568 10.2724 3.21604 7.78374 4.76268 6.2371C6.4896 4.51018 9.33371 4.66778 10.8594 6.57484L12 7.99992L13.1396 6.57479C14.6653 4.66773 17.5104 4.51015 19.2373 6.23707Z" stroke="#2F2F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                    </div>
                <? endif; ?>
                <? if ($arParams["DISPLAY_COMPARE"] == "Y"): ?>
                                    <div class="compare_item_button">
                                        <span title="<?= GetMessage('CATALOG_COMPARE') ?>" class="compare_item to" data-iblock="<?= $arParams["IBLOCK_ID"] ?>" data-item="<?= $arItem["ID"] ?>" ><i></i></span>
                                        <span title="<?= GetMessage('CATALOG_COMPARE_OUT') ?>" class="compare_item in added" style="display: none;" data-iblock="<?= $arParams["IBLOCK_ID"] ?>" data-item="<?= $arItem["ID"] ?>"><i></i></span>
                                    </div>
                            <? endif; ?>
                            </div>
                        <? endif; ?>
                        <? //$frame->end();?>
                        <img  class="js_lazy lazyload" data-src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
                        <?/*?>
                        <? $img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array("width" => 170, "height" => 170), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                        <? if (!empty($arItem["PREVIEW_PICTURE"])): ?>
                            <img class="js_lazy" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= ($arItem["PREVIEW_PICTURE"]["ALT"] ? $arItem["PREVIEW_PICTURE"]["ALT"] : $arItem["NAME"]); ?>" title="<?= ($arItem["PREVIEW_PICTURE"]["TITLE"] ? $arItem["PREVIEW_PICTURE"]["TITLE"] : $arItem["NAME"]); ?>" />
                        <? elseif (!empty($arItem["DETAIL_PICTURE"])): ?>
                            <img class="js_lazy" data-src="<?= $img["src"] ?>" alt="<?= ($arItem["PREVIEW_PICTURE"]["ALT"] ? $arItem["PREVIEW_PICTURE"]["ALT"] : $arItem["NAME"]); ?>" title="<?= ($arItem["PREVIEW_PICTURE"]["TITLE"] ? $arItem["PREVIEW_PICTURE"]["TITLE"] : $arItem["NAME"]); ?>" />
                        <? else: ?>
                            <img class="js_lazy" data-src="<?= SITE_TEMPLATE_PATH ?>/images/no_photo_medium.png" alt="<?= ($arItem["PREVIEW_PICTURE"]["ALT"] ? $arItem["PREVIEW_PICTURE"]["ALT"] : $arItem["NAME"]); ?>" title="<?= ($arItem["PREVIEW_PICTURE"]["TITLE"] ? $arItem["PREVIEW_PICTURE"]["TITLE"] : $arItem["NAME"]); ?>" />
                        <? endif; ?>
                        <?*/?>
                        <? if ($arParams["SALE_STIKER"] && $arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]) { ?>
                            <div class="sticker_sale_text"><?= $arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]; ?></div>
            <? } ?>
                    </a>
                    <div class="fast_view_block" data-event="jqm" data-param-form_id="fast_view" data-param-iblock_id="<?= $arParams["IBLOCK_ID"]; ?>" data-param-id="<?= $arItem["ID"]; ?>" data-param-item_href="<?= urlencode($arItem["DETAIL_PAGE_URL"]); ?>" data-name="fast_view"><?= $fast_view_text; ?></div>
                </div>
                <div class="item_info main_item_wrapper">
                    <div class="item-title">
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><span><?= $arItem["NAME"] ?></span></a>
                    </div>
                        <?= $arQuantityData["HTML"]; ?>
                        <? $arAddToBasketData = CMShop::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], true); ?>
                    <div class="cost prices clearfix">
                        <? if ($arItem["OFFERS"]): ?>
                            <? \Aspro\Functions\CAsproMShopSku::showItemPrices($arParams, $arItem, $item_id, $min_price_id); ?>
                        <? else: ?>
                            <?
                            $item_id = $arItem["ID"];
                            if (isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']) { // USE_PRICE_COUNT
                                ?>
                                <? if ($arItem['ITEM_PRICE_MODE'] == 'Q' && count($arItem['PRICE_MATRIX']['ROWS']) > 1): ?>
                                    <?= CMShop::showPriceRangeTop($arItem, $arParams, GetMessage("CATALOG_ECONOMY")); ?>
                                <? endif; ?>
                                <?= CMShop::showPriceMatrix($arItem, $arParams, $strMeasure, $arAddToBasketData); ?>
                                <?
                                $arMatrixKey = array_keys($arItem['PRICE_MATRIX']['MATRIX']);
                                $min_price_id = current($arMatrixKey);
                                ?>
                                <?
                            } elseif ($arItem["PRICES"]) {
                                $arCountPricesCanAccess = 0;
                                $min_price_id = 0;
                                ?>
                                <?= \Aspro\Functions\CAsproMShopItem::getItemPrices($arParams, $arItem["PRICES"], $strMeasure, $min_price_id); ?>
                            <? } ?>
                        <? endif; ?>
                    </div>
                    <? if ($arParams["SHOW_DISCOUNT_TIME"] == "Y") { ?>
                        <?
                        $arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $USER->GetUserGroupArray(), "N", $min_price_id, SITE_ID);
                        $arDiscount = array();
                        if ($arDiscounts)
                            $arDiscount = current($arDiscounts);
                        if ($arDiscount["ACTIVE_TO"]) {
                            ?>
                            <div class="view_sale_block <?= ($arQuantityData["HTML"] ? '' : 'wq'); ?>">
                                <div class="count_d_block">
                                    <span class="active_to_<?= $arItem["ID"] ?> hidden"><?= $arDiscount["ACTIVE_TO"]; ?></span>
                                    <div class="title"><?= GetMessage("UNTIL_AKC"); ?></div>
                                    <span class="countdown countdown_<?= $arItem["ID"] ?> values"></span>
                                    <script>
                                        $(document).ready(function () {
                                            $('.tab_slider_wrapp ul.tabs_content li.tab').each(function () {
                                                if ($(this).find('.countdown').size()) {
                                                    var active_to = $(this).find('.active_to_<?= $arItem["ID"] ?>').text(),
                                                            date_to = new Date(active_to.replace(/(\d+)\.(\d+)\.(\d+)/, '$3/$2/$1'));
                                                    $(this).find('.countdown_<?= $arItem["ID"] ?>').countdown({until: date_to, format: 'dHMS', padZeroes: true, layout: '{d<}<span class="days item">{dnn}<div class="text">{dl}</div></span>{d>} <span class="hours item">{hnn}<div class="text">{hl}</div></span> <span class="minutes item">{mnn}<div class="text">{ml}</div></span> <span class="sec item">{snn}<div class="text">{sl}</div></span>'}, $.countdown.regionalOptions['ru']);
                                                }
                                            });
                                        })
                                    </script>
                                </div>
                    <? if ($arQuantityData["HTML"]): ?>
                                    <div class="quantity_block">
                                        <div class="title"><?= GetMessage("TITLE_QUANTITY_BLOCK"); ?></div>
                                        <div class="values">
                                            <span class="item">
                                                <span class="value"><?= $totalCount; ?></span>
                                                <span class="text"><?= GetMessage("TITLE_QUANTITY"); ?></span>
                                            </span>
                                        </div>
                                    </div>
                            <? endif; ?>
                            </div>
                            <? } ?>
                        <? } ?>
                    <div class="basket_props_block" id="bx_basket_div_<?= $arItem["ID"]; ?>_<?= $sliderID; ?>" style="display: none;">
                        <?
                        if (!empty($arItem['PRODUCT_PROPERTIES_FILL'])) {
                            foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {
                                ?>
                                <input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
                                <?
                                if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
                                    unset($arItem['PRODUCT_PROPERTIES'][$propID]);
                            }
                        }
                        $arItem["EMPTY_PROPS_JS"] = "Y";
                        $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
                        if (!$emptyProductProperties) {
                            $arItem["EMPTY_PROPS_JS"] = "N";
                            ?>
                            <div class="wrapper">
                                <table>
                                    <?
                                    foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo) {
                                        ?>
                                        <tr><td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
                                            <td>
                    <?
                    if (
                            'L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE'] && 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']
                    ) {
                        foreach ($propInfo['VALUES'] as $valueID => $value) {
                            ?><label><input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?></label><?
                                                    }
                                                } else {
                                                    ?><select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                                                    foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                        ?><option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option><?
                                                    }
                                                    ?></select><?
                                                }
                                                ?>
                                            </td></tr>
                                                        <?
                                                    }
                                                    ?>
                                </table>
                            </div>
                                            <?
                                        }
                                        ?>
                    </div>

                    <div class="buttons_block clearfix">
            <?= $arAddToBasketData["HTML"] ?>
                    </div>
                </div>
            </li>
                    <? endif ?>
    <? endforeach; ?>
<? else: ?>
    <div class="empty_items"></div>
    <script type="text/javascript">
        $('.top_blocks li[data-code=BEST]').remove();
        $('.tabs_content tab[data-code=BEST]').remove();
        if (!$('.slider_navigation.top li').length) {
            $('.tab_slider_wrapp.best_block').remove();
        }
        if ($('.specials_slider_wrapp1').length) {
            if ($('.empty_items').length) {
                $('.empty_items').each(function () {
                    var index = $(this).closest('.tab').index();
                    $('.top_blocks .tabs>li:eq(' + index + ')').remove();
                    $('.tabs_content .tab:eq(' + index + ')').remove();
                })
                $('.tabs_content .tab.cur').trigger('click');
            }
        }
    </script>
<? endif; ?>