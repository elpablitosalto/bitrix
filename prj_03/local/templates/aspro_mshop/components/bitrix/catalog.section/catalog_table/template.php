<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<? if (count($arResult["ITEMS"]) >= 1) { ?>
    <?
    if ($fast_view_text_tmp = \Bitrix\Main\Config\Option::get('aspro.mshop', 'EXPRESSION_FOR_FAST_VIEW', GetMessage('FAST_VIEW')))
        $fast_view_text = $fast_view_text_tmp;
    else
        $fast_view_text = GetMessage('FAST_VIEW');
    ?>
    <? $arParams["BASKET_ITEMS"] = ($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array()); ?>
    <? if ($arParams["AJAX_REQUEST"] == "N") { ?>
        <table class="module_products_list">
            <tbody>
            <? } ?>
            <?
            $currencyList = '';
            if (!empty($arResult['CURRENCIES'])) {
                $templateLibrary[] = 'currency';
                $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
            }
            $templateData = array(
                'TEMPLATE_LIBRARY' => $templateLibrary,
                'CURRENCIES' => $currencyList
            );
            unset($currencyList, $templateLibrary);
            ?>
            <? $arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']); ?>
            <? foreach ($arResult["ITEMS"] as $arItem) {
                ?>
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

                    $strMeasure = '';
                    if (!$arItem["OFFERS"] || $arParams['TYPE_SKU'] === 'TYPE_2') {
                        if ($arParams["SHOW_MEASURE"] == "Y" && $arItem["CATALOG_MEASURE"]) {
                            $arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
                            $strMeasure = $arMeasure["SYMBOL_RUS"];
                        }
                        $arItem["OFFERS_MORE"] = "Y";
                    } elseif ($arItem["OFFERS"]) {
                        $strMeasure = $arItem["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
                        $arItem["OFFERS_MORE"] = "Y";
                    }
                    $elementName = ((isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arItem['NAME']);
                    ?>
                    <tr class="item main_item_wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <td class="foto-cell">
                            <div class="image_wrapper_block">
                                <?
                                $a_alt = ($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] : $arItem["NAME"] );
                                $a_title = ($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] : $arItem["NAME"] );
                                ?>
                                <? if (!empty($arItem["DETAIL_PICTURE"]) || !empty($arItem["PREVIEW_PICTURE"])) { ?>
                                    <?
                                    $picture = ($arItem["PREVIEW_PICTURE"] ? $arItem["PREVIEW_PICTURE"] : $arItem["DETAIL_PICTURE"]);
                                    $img_preview = CFile::ResizeImageGet($picture, array("width" => 50, "height" => 50), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
                                    ?>
                                    <? if ($arParams["LIST_DISPLAY_POPUP_IMAGE"] == "Y") { ?>
                                        <a class="popup_image fancy" href="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" title="<?= $a_title; ?>">
                                        <? } ?>
                                        <img src="<?= $img_preview["src"] ?>" alt="<?= $a_alt; ?>" title="<?= $a_title; ?>" />
                                        <? if ($arParams["LIST_DISPLAY_POPUP_IMAGE"] == "Y") { ?>
                                        </a>
                                    <? } ?>
                                <? } else { ?>
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/no_photo_small.png" alt="<?= $a_alt; ?>" title="<?= $a_title; ?>" />
                                <? } ?>
                                <div class="icons fast_view_block" data-event="jqm" data-param-form_id="fast_view" data-param-iblock_id="<?= $arParams["IBLOCK_ID"]; ?>" data-param-id="<?= $arItem["ID"]; ?>" data-param-item_href="<?= urlencode($arItem["DETAIL_PAGE_URL"]); ?>" data-name="fast_view"><?= $fast_view_text; ?></div>
                            </div>
                        </td>
                        <td class="item-name-cell">
                            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
                            <?= $arQuantityData["HTML"]; ?>
                        </td>
                        <? $arAddToBasketData = CMShop::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, array(), 'small', $arParams); ?>
                        <td class="price-cell">
                            <div class="cost prices clearfix">
                                <? if (count($arItem["OFFERS"]) > 0) { ?>
                                    <?
                                    $minPrice = false;
                                    if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
                                        $minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
                                    $prefix = '';
                                    if ('N' == $arParams['TYPE_SKU'] || $arParams['DISPLAY_TYPE'] == 'table') {
                                        $prefix = GetMessage("CATALOG_FROM");
                                    }
                                    ?>
                                    <div class="with_matrix" style="display:none;">
                                        <div class="price price_value_block"><span class="values_wrapper"><?= $minPrice["PRINT_DISCOUNT_VALUE"]; ?></span></div>
                                        <? if ($arParams["SHOW_OLD_PRICE"] == "Y"): ?>
                                            <div class="price discount"></div>
                                        <? endif; ?>
                                        <? if ($arParams["SHOW_DISCOUNT_PERCENT"] == "Y") { ?>
                                            <div class="sale_block matrix" <?= (!$minPrice["DISCOUNT_DIFF"] ? 'style="display:none;"' : '') ?>>
                                                <div class="sale_wrapper">
                                                    <div class="value">-<span></span>%</div>
                                                    <div class="text"><span class="title"><?= GetMessage("CATALOG_ECONOMY"); ?></span>
                                                        <span class="values_wrapper"><?= $minPrice["PRINT_DISCOUNT_DIFF"]; ?></span></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        <? } ?>
                                    </div>
                                    <? $measure_block = \Aspro\Functions\CAsproMShopSku::getMeasureRatio($arParams, $minPrice); ?>
                                    <? \Aspro\Functions\CAsproMShopSku::showItemPrices($arParams, $arItem, $item_id, $min_price_id, $arItemIDs); ?>
                                <? } else { ?>
                                    <?
                                    if (isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']) { // USE_PRICE_COUNT
                                        ?>
                                        <? if ($arItem['ITEM_PRICE_MODE'] == 'Q' && count($arItem['PRICE_MATRIX']['ROWS']) > 1): ?>
                                            <?= CMShop::showPriceRangeTop($arItem, $arParams, GetMessage("CATALOG_ECONOMY")); ?>
                                        <? endif; ?>
                                        <?= CMShop::showPriceMatrix($arItem, $arParams, $strMeasure, $arAddToBasketData); ?>
                                        <?
                                    } else {
                                        $arCountPricesCanAccess = 0;
                                        $min_price_id = 0;
                                        ?>
                                        <?= \Aspro\Functions\CAsproMShopItem::getItemPrices($arParams, $arItem["PRICES"], $strMeasure, $min_price_id); ?>
                                    <? } ?>
                                <? } ?>
                            </div>

                            <div class="basket_props_block" id="bx_basket_div_<?= $arItem["ID"]; ?>" style="display: none;">
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
                <? foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo) { ?>
                                                <tr>
                                                    <td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
                                                    <td>
                                                        <?
                                                        if ('L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE'] && 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']) {
                                                            foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                                ?>
                                                                <label>
                                                                    <input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?>
                                                                </label>
                                                            <?
                                                            }
                                                        } else {
                                                            ?>
                                                            <select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><? foreach ($propInfo['VALUES'] as $valueID => $value) { ?>
                                                                    <option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option>
                        <? } ?>
                                                            </select>
                                                <? } ?>
                                                    </td>
                                                </tr>
                                    <? } ?>
                                        </table>
                                    </div>
                                <? }
                                ?>
                            </div>
                            <div class="adaptive_button">
            <?= $arAddToBasketData["HTML"] ?>
                            </div>
                        </td>
						<td class="stickers-cell">
							<div class="stickers">
								<? if (is_array($arItem["PROPERTIES"]["HIT"]["VALUE_XML_ID"])): ?>
									<? foreach ($arItem["PROPERTIES"]["HIT"]["VALUE_XML_ID"] as $key => $class) {
										?>
										<div class="sticker_<?= strtolower($class); ?>"
											 title="<?= $arItem["PROPERTIES"]["HIT"]["VALUE"][$key] ?>"></div>
										 <? } ?>
									 <? endif; ?>
							</div>
							<? if ($arParams["SALE_STIKER"] && $arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]) {
								?>
								<div class="sticker_sale_text"><?= $arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]; ?></div>
							<? } ?>
							<?
							$a_alt = ($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] : $arItem["NAME"]);
							$a_title = ($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] : $arItem["NAME"]);
							?>
						</td>
                        <td class="but-cell item_<?= $arItem["ID"] ?>">
                            <div class="counter_wrapp">
            <? if ($arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] && !count($arItem["OFFERS"]) && $arAddToBasketData["ACTION"] == "ADD" && $arItem["CAN_BUY"]): ?>
                                    <div class="counter_block" data-item="<?= $arItem["ID"]; ?>" <?= (in_array($arItem["ID"], $arParams["BASKET_ITEMS"]) ? "style='display: none;'" : ""); ?>>
                                        <span class="minus">-</span>
                                        <input type="text" class="text" name="quantity" value="<?= $arAddToBasketData["MIN_QUANTITY_BUY"] ?>" />
                                        <span class="plus" <?= ($arAddToBasketData["MAX_QUANTITY_BUY"] ? "data-max='" . $arAddToBasketData["MAX_QUANTITY_BUY"] . "'" : "") ?>>+</span>
                                    </div>
                                    <? endif; ?>
                                <div class="button_block <?= (in_array($arItem["ID"], $arParams["BASKET_ITEMS"]) || $arAddToBasketData["ACTION"] == "ORDER" || !$arItem["CAN_BUY"] || !$arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] ? "wide" : ""); ?>">
                                    <!--noindex-->
                            <?= $arAddToBasketData["HTML"] ?>
                                    <!--/noindex-->
                                </div>
                            </div>
                            <?
                            if (isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']) { // USE_PRICE_COUNT
                                ?>
                                <? if ($arItem['ITEM_PRICE_MODE'] == 'Q' && count($arItem['PRICE_MATRIX']['ROWS']) > 1): ?>
                                    <?
                                    $arOnlyItemJSParams = array(
                                        "ITEM_PRICES" => $arItem["ITEM_PRICES"],
                                        "ITEM_PRICE_MODE" => $arItem["ITEM_PRICE_MODE"],
                                        "ITEM_QUANTITY_RANGES" => $arItem["ITEM_QUANTITY_RANGES"],
                                        "MIN_QUANTITY_BUY" => $arAddToBasketData["MIN_QUANTITY_BUY"],
                                        "ID" => $this->GetEditAreaId($arItem["ID"]),
                                            )
                                    ?>
                                    <script type="text/javascript">
                                        var ob<? echo $this->GetEditAreaId($arItem["ID"]); ?>el = new JCCatalogSectionOnlyElement(<? echo CUtil::PhpToJSObject($arOnlyItemJSParams, false, true); ?>);
                                    </script>
                            <? endif; ?>
            <? } ?>
                        </td>
                                    <? //if((!$arItem["OFFERS"] && $arParams["DISPLAY_WISH_BUTTONS"] != "N" ) || ($arParams["DISPLAY_COMPARE"] == "Y")): ?>
                        
                    <? //endif; ?>
                    </tr>
        <? endif; ?>
    <? } ?>
    <? if ($arParams["AJAX_REQUEST"] == "N") { ?>
            </tbody>
        </table>
                <? } ?>
                <? if ($arParams["AJAX_REQUEST"] == "Y") { ?>
        <div class="wrap_nav">
            <tr <?= ($arResult["NavPageCount"] > 1 ? "" : "style='display: none;'"); ?>><td>
                        <? } ?>
                        <? //if(strlen($arResult["NAV_STRING"])):?>
                <div>
                    <div class="bottom_nav <?= $arParams["DISPLAY_TYPE"]; ?>" <?= ($arParams["AJAX_REQUEST"] == "Y" && $arResult["NavPageCount"] <= 1 ? "style='display: none; '" : ""); ?>>
                <? if ($arParams["DISPLAY_BOTTOM_PAGER"] == "Y") { ?><?= $arResult["NAV_STRING"] ?><? } ?>
                    </div>
                </div>
    <? //endif;  ?>
    <? if ($arParams["AJAX_REQUEST"] == "Y") { ?>
                </td></tr>
        </div>
    <? } ?>
    <script type="text/javascript">
        $('.module_products_list').removeClass('errors');
    </script>
<? } else { ?>
                    <? if ($arParams["AJAX_REQUEST"] != "Y") { ?>
        <table class="module_products_list errors">
            <tbody>
                <tr><td>
    <? } ?>
                    <script type="text/javascript">
                        $('.module_products_list').addClass('errors');
                    </script>
                    <div class="module_products_list_b">
                        <div class="no_goods">
                            <div class="no_products">
                                <div class="wrap_text_empty">
                                    <? if ($_REQUEST["set_filter"]) { ?>
                                        <? $APPLICATION->IncludeFile(SITE_DIR . "include/section_no_products_filter.php", Array(), Array("MODE" => "html", "NAME" => GetMessage('EMPTY_CATALOG_DESCR'))); ?>
    <? } else { ?>
                                <? $APPLICATION->IncludeFile(SITE_DIR . "include/section_no_products.php", Array(), Array("MODE" => "html", "NAME" => GetMessage('EMPTY_CATALOG_DESCR'))); ?>
                            <? } ?>
                                </div>
                            </div>
    <? if ($_REQUEST["set_filter"]) { ?>
                                <span class="button wide"><?= GetMessage('RESET_FILTERS'); ?></span>
                    <? } ?>
                        </div>
                    </div>
    <? if ($arParams["AJAX_REQUEST"] != "Y") { ?>
                    </td></tr>
            </tbody>
        </table>
    <? } ?>
    <?
}?>