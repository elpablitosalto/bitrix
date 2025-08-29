<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<? global $USER; ?>



<?
if (count($arResult["ITEMS"]) >= 1) {
?>
    <?
    if ($fast_view_text_tmp = \Bitrix\Main\Config\Option::get('aspro.mshop', 'EXPRESSION_FOR_FAST_VIEW', GetMessage('FAST_VIEW')))
        $fast_view_text = $fast_view_text_tmp;
    else
        $fast_view_text = GetMessage('FAST_VIEW');
    ?>
    <? if (($arParams["AJAX_REQUEST"] == "N") || !isset($arParams["AJAX_REQUEST"])) {
    ?>
        <div class="top_wrapper">
            <div class="catalog_block">
            <? }
            ?>
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

            $arParams["BASKET_ITEMS"] = ($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array());

            $arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']);
            ?>
            <? foreach ($arResult["ITEMS"] as $arItem) {
                /*$arFilter = Array(
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "ID" => $arItem["ID"]
                );
                $res = CIBlockElement::GetList(Array(), $arFilter);
                if ($ob = $res->GetNextElement()) {
                    $arProps = $ob->GetProperties();
                }*/
            ?>

                <? if ($arItem["PROPERTIES"]['RASPRODAT']['VALUE'] !== 'Да'): ?>


                    <div class="catalog_item_wrapp">
                        <div class="basket_props_block" id="bx_basket_div_<?= $arItem["ID"]; ?>" style="display: none;">
                            <?
                            if (!empty($arItem['PRODUCT_PROPERTIES_FILL'])) {
                                foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {
                            ?>
                                    <input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                                        value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
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
                                        <? foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo) {
                                        ?>
                                            <tr>
                                                <td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
                                                <td>
                                                    <?
                                                    if ('L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE'] && 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']) {
                                                        foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                    ?>
                                                            <label>
                                                                <input type="radio"
                                                                    name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                                                                    value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?>
                                                            </label>
                                                        <?
                                                        }
                                                    } else {
                                                        ?>
                                                        <select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                                                                                                                                            foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                                                                                                            ?>
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
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

                        $arItem["strMainID"] = $this->GetEditAreaId($arItem['ID']);
                        $arItemIDs = CMShop::GetItemsIDs($arItem);

                        $totalCount = CMShop::GetTotalCount($arItem);
                        $arQuantityData = CMShop::GetQuantityArray($totalCount, $arItemIDs["ALL_ITEM_IDS"]);

                        $item_id = $arItem["ID"];
                        $strMeasure = '';

                        $bLinkedItems = (isset($arParams["LINKED_ITEMS"]) && $arParams["LINKED_ITEMS"]);
                        if ($bLinkedItems)
                            $arItem["FRONT_CATALOG"] = "Y";

                        if ($arParams["SHOW_MEASURE"] == "Y") {
                            if ($arItem["OFFERS"]) {
                                $strMeasure = $arItem["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
                            } else {
                                if ($arItem["CATALOG_MEASURE"]) {
                                    $arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
                                    $strMeasure = $arMeasure["SYMBOL_RUS"];
                                }
                            }
                        }

                        if (!$arItem["OFFERS"] || $arParams['TYPE_SKU'] !== 'TYPE_1') {
                            $arAddToBasketData = CMShop::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], ($arItem["FRONT_CATALOG"] ? true : false), $arItemIDs["ALL_ITEM_IDS"], 'small', $arParams);
                        }
                        ?>
                        <? /* <a href="<?=$arItem['DETAIL_PAGE_URL']?>"></a> */
                        ?>
                        <div class="catalog_item item_wrap <?= (($_GET['q'])) ? 's' : '' ?>" id="<?= $arItemIDs["strMainID"]; ?>">
                            <div>
                                <div class="catalog-item__table-control">
                                    <div class="table-control">
                                        <? if ($arItem["PROPERTIES"]["RASSHIRENNAYA_RAZMERNAYA_SETKA"]["VALUE_XML_ID"] == "true"): ?>
                                            <a href="#" class="table-control__icon-link" data-target="modal">
                                                <svg class="table-control__icon" width="41" height="30" viewBox="0 0 41 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect class="table-control__icon_stroke" x="9.0484" y="10.5645" width="22.9032" height="7.80645" />
                                                    <path class="table-control__icon_stroke" d="M12.3226 13.8386V18.8709" />
                                                    <path class="table-control__icon_stroke" d="M19.871 13.8386V18.8709" />
                                                    <path class="table-control__icon_stroke" d="M27.4193 13.8386V18.8709" />
                                                    <path class="table-control__icon_stroke" d="M23.6452 15.0967L23.6452 18.8709" />
                                                    <path class="table-control__icon_stroke" d="M16.0968 15.0967L16.0968 18.8709" />
                                                    <path class="table-control__icon_fill" d="M40.3536 15.3535C40.5488 15.1583 40.5488 14.8417 40.3536 14.6464L37.1716 11.4644C36.9763 11.2692 36.6597 11.2692 36.4645 11.4644C36.2692 11.6597 36.2692 11.9763 36.4645 12.1715L39.2929 15L36.4645 17.8284C36.2692 18.0237 36.2692 18.3402 36.4645 18.5355C36.6597 18.7308 36.9763 18.7308 37.1716 18.5355L40.3536 15.3535ZM34 15.5H40V14.5H34V15.5Z" />
                                                    <path class="table-control__icon_fill" d="M0.646447 15.3535C0.451184 15.1583 0.451184 14.8417 0.646447 14.6464L3.82843 11.4644C4.02369 11.2692 4.34027 11.2692 4.53553 11.4644C4.7308 11.6597 4.7308 11.9763 4.53553 12.1715L1.70711 15L4.53553 17.8284C4.7308 18.0237 4.7308 18.3402 4.53553 18.5355C4.34027 18.7308 4.02369 18.7308 3.82843 18.5355L0.646447 15.3535ZM7 15.5H1V14.5H7V15.5Z" />
                                                </svg>
                                            </a>
                                        <? endif; ?>
                                        <? if ($arItem["PROPERTIES"]["ZAKLYUCHENIE_MINPROMTORG"]["VALUE"] == "Да"): ?>
                                            <? //$fccFile = CMShop::GetFileInfo($arItem["PROPERTIES"]["FCC"]["VALUE"]);
                                            ?>
                                            <span class="table-control__label">ФСС</span>
                                        <? endif; ?>
                                    </div>
                                </div>
                                <div class="image_wrapper_block">
                                    <? /* $frame = $this->createFrame()->begin('');
                                      $frame->setBrowserStorage(true); */
                                    ?>
                                    <? if (($arParams["DISPLAY_WISH_BUTTONS"] != "N") || ($arParams["DISPLAY_COMPARE"] == "Y")): ?>
                                        <div class="like_icons">
                                            <? if ($arParams["DISPLAY_WISH_BUTTONS"] != "N"): ?>
                                                <? if (!$arItem["OFFERS"]): ?>
                                                    <div class="wish_item_button">
                                                        <span title="<?= GetMessage('CATALOG_WISH') ?>" class="wish_item to"
                                                            data-item="<?= $arItem["ID"] ?>"
                                                            data-iblock="<?= $arItem["IBLOCK_ID"] ?>"><i></i></span>
                                                        <span title="<?= GetMessage('CATALOG_WISH_OUT') ?>"
                                                            class="wish_item in added" style="display: none;"
                                                            data-item="<?= $arItem["ID"] ?>"
                                                            data-iblock="<?= $arItem["IBLOCK_ID"] ?>"><i></i></span>
                                                    </div>
                                                <? elseif ($arItem["OFFERS"] && !empty($arItem['OFFERS_PROP'])): ?>
                                                    <div class="wish_item_button" style="display: none;">
                                                        <span title="<?= GetMessage('CATALOG_WISH') ?>"
                                                            class="wish_item to <?= $arParams["TYPE_SKU"]; ?>" data-item=""
                                                            data-iblock="<?= $arItem["IBLOCK_ID"] ?>" data-offers="Y"
                                                            data-props="<?= $arOfferProps ?>"><i></i></span>
                                                        <span title="<?= GetMessage('CATALOG_WISH_OUT') ?>"
                                                            class="wish_item in added <?= $arParams["TYPE_SKU"]; ?>"
                                                            style="display: none;" data-item=""
                                                            data-iblock="<?= $arOffer["IBLOCK_ID"] ?>"><i></i></span>
                                                    </div>
                                                <? endif; ?>
                                            <? endif; ?>
                                            <? if ($arParams["DISPLAY_COMPARE"] == "Y"): ?>
                                                <? if (!$arItem["OFFERS"] || ($arParams["TYPE_SKU"] !== 'TYPE_1' || ($arParams["TYPE_SKU"] == 'TYPE_1' && !$arItem["OFFERS_PROP"]))): ?>
                                                    <div class="compare_item_button">
                                                        <span title="<?= GetMessage('CATALOG_COMPARE') ?>" class="compare_item to"
                                                            data-iblock="<?= $arParams["IBLOCK_ID"] ?>"
                                                            data-item="<?= $arItem["ID"] ?>"><i></i></span>
                                                        <span title="<?= GetMessage('CATALOG_COMPARE_OUT') ?>"
                                                            class="compare_item in added" style="display: none;"
                                                            data-iblock="<?= $arParams["IBLOCK_ID"] ?>"
                                                            data-item="<?= $arItem["ID"] ?>"><i></i></span>
                                                    </div>
                                                <? elseif ($arItem["OFFERS"]): ?>
                                                    <div class="compare_item_button">
                                                        <span title="<?= GetMessage('CATALOG_COMPARE') ?>"
                                                            class="compare_item to <?= $arParams["TYPE_SKU"]; ?>"
                                                            data-iblock="<?= $arParams["IBLOCK_ID"] ?>"
                                                            data-item="<?= $arItem["ID"] ?>"><i></i></span>
                                                        <span title="<?= GetMessage('CATALOG_COMPARE_OUT') ?>"
                                                            class="compare_item in added <?= $arParams["TYPE_SKU"]; ?>"
                                                            style="display: none;" data-iblock="<?= $arParams["IBLOCK_ID"] ?>"
                                                            data-item="<?= $arItem["ID"] ?>"><i></i></span>
                                                    </div>
                                                <? endif; ?>
                                            <? endif; ?>
                                        </div>
                                    <? endif; ?>
                                    <? //$frame->end();
                                    ?>
                                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="thumb"
                                        id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>">
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
                                        <? if (!empty($arItem["PREVIEW_PICTURE"])): ?>
                                            <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $a_alt; ?>"
                                                title="<?= $a_title; ?>" />
                                        <? elseif (!empty($arItem["DETAIL_PICTURE"])): ?>
                                            <? $img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array("width" => 210, "height" => 275), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                                            <img src="<?= $img["src"] ?>" alt="<?= $a_alt; ?>" title="<?= $a_title; ?>" />
                                        <? else: ?>
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/no_photo_medium.png" alt="<?= $a_alt; ?>"
                                                title="<?= $a_title; ?>" />
                                        <? endif; ?>
                                    </a>
                                    <div class="fast_view_block" data-event="jqm" data-param-form_id="fast_view"
                                        data-param-iblock_id="<?= $arParams["IBLOCK_ID"]; ?>" data-param-id="<?= $arItem["ID"]; ?>"
                                        data-param-item_href="<?= urlencode($arItem["DETAIL_PAGE_URL"]); ?>"
                                        data-name="fast_view"><?= $fast_view_text; ?></div>
                                </div>
                                <div class="item_info main_item_wrapper <?= $arParams["TYPE_SKU"] ?>">
                                    <div class="item-title">
                                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                            <h4><?= $arItem["NAME"] ?></h4>
                                        </a>
                                    </div>
                                    <? //=$arQuantityData["HTML"]; //остатки
                                    ?>
                                    <div class="cost prices clearfix">
                                        <?
                                        //$showCalcMinPrice = !empty($arItem['MIN_PRICE']);
                                        //vardump($arItem["OFFERS"]);
                                        if (!empty($arResult['MIN_PRICES'][$arItem['ID']]) && FALSE) {
                                        ?>
                                            <div class="cost prices clearfix" style="height: 20px;">
                                                <div class="price_matrix_block">
                                                    <div class="price_matrix_wrapper">
                                                        <div class="all_prices one_price">
                                                            <div class="price" data-currency="RUB" data-value="<?= $arResult['MIN_PRICES'][$arItem['ID']]; ?>">
                                                                <span><span class="values_wrapper"><span class="price_value"><?= $arResult['MIN_PRICES'][$arItem['ID']]; ?></span><span class="price_currency"> руб.</span></span><span class="price_measure">/шт</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?
                                        } else if ($arItem["OFFERS"]) {

                                            $minPrice = false;
                                            if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE'])) {
                                                // $minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
                                                $minPrice = $arItem['MIN_PRICE'];
                                            }
                                            $offer_id = 0;
                                            if ($arParams["TYPE_SKU"] == "N") {
                                                $offer_id = $minPrice["MIN_ITEM_ID"];
                                            }
                                            $min_price_id = $minPrice["MIN_PRICE_ID"];
                                            if (!$min_price_id)
                                                $min_price_id = $minPrice["PRICE_ID"];

                                            $arTmpOffer = current($arItem["OFFERS"]);
                                            if (!$min_price_id)
                                                $min_price_id = $arTmpOffer["MIN_PRICE"]["PRICE_ID"];
                                            $item_id = $arTmpOffer["ID"];

                                            $prefix = '';
                                            if ('N' == $arParams['TYPE_SKU'] || $arParams['DISPLAY_TYPE'] !== 'block' || empty($arItem['OFFERS_PROP'])) {
                                                $prefix = GetMessage("CATALOG_FROM");
                                            }
                                        ?>
                                            <? $measure_block = \Aspro\Functions\CAsproMShopSku::getMeasureRatio($arParams, $minPrice); ?>
                                            <?
                                            $min_price = $minPrice["PRINT_DISCOUNT_VALUE"];
                                            $showFirstPrice = false;
                                            if (!empty($arResult['MIN_PRICES'][$arItem['ID']])) {
                                                $min_price = $arResult['MIN_PRICES'][$arItem['ID']];
                                                $showFirstPrice = true;
                                            }
                                            ?>
                                            <div class="with_matrix" <? if (!$showFirstPrice) { ?><?/**/ ?>style="display:none;" <?/**/ ?><? } ?>>
                                                <div class="price price_value_block">
                                                    <span class="values_wrapper">от <?= $min_price; ?></span>
                                                </div>
                                                <? if ($arParams["SHOW_OLD_PRICE"] == "Y"): ?>
                                                    <div class="price discount"></div>
                                                <? endif; ?>
                                                <? if ($arParams["SHOW_DISCOUNT_PERCENT"] == "Y") {
                                                ?>
                                                    <div class="sale_block matrix" <?= (!$minPrice["DISCOUNT_DIFF"] ? 'style="display:none;"' : '') ?>>
                                                        <div class="sale_wrapper">
                                                            <div class="value">-<span></span>%</div>
                                                            <div class="text">
                                                                <span class="title"><?= GetMessage("CATALOG_ECONOMY"); ?></span>
                                                                <span class="values_wrapper"><?= $minPrice["PRINT_DISCOUNT_DIFF"]; ?></span>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                <? } ?>
                                            </div>
                                            <?
                                            //echo '!';
                                            ?>
                                            <?
                                            if (!$showFirstPrice) {
                                                \Aspro\Functions\CAsproMShopSku::showItemPrices($arParams, $arItem, $item_id, $min_price_id, $arItemIDs);
                                            }
                                            ?>
                                            <?
                                        } else {
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
                                            } else {
                                                $arCountPricesCanAccess = 0;
                                                $min_price_id = 0;
                                            ?>
                                                <?= \Aspro\Functions\CAsproMShopItem::getItemPrices($arParams, $arItem["PRICES"], $strMeasure, $min_price_id); ?>
                                            <? } ?>
                                        <? } ?>
                                    </div>

                                    <?

                                    if (empty($arItem['MIN_PRICE'])) {
                                        //if (!$showCalcMinPrice) {
                                        //if( FALSE ){

                                        $ar_res = CPrice::GetBasePrice($arItem["ID"]);
                                        //echo "<pre>";var_dump($ar_res["PRICE"]);echo "</pre>";

                                        if (!empty($ar_res)) {
                                    ?>
                                            <div class="cost prices clearfix" style="height: 20px;">
                                                <div class="price_matrix_block">
                                                    <div class="price_matrix_wrapper">
                                                        <div class="all_prices one_price">
                                                            <div class="price" data-currency="RUB" data-value="<?= $ar_res["PRICE"]; ?>">
                                                                <span><span class="values_wrapper"><span class="price_value"><?= $ar_res["PRICE"]; ?></span><span class="price_currency"> руб.</span></span><span class="price_measure">/шт</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        } else {
                                            $APPLICATION->IncludeFile(SITE_DIR . "include/section_no_price.php", array(), array("MODE" => "html", "NAME" => GetMessage('EMPTY_CATALOG_PRICE')));
                                        }
                                    }

                                    //echo '!!';
                                    ?>

                                    <? if ($arParams["SHOW_DISCOUNT_TIME"] != "N" && $arParams['SHOW_COUNTER_LIST'] != 'N') { ?>
                                        <? $arUserGroups = $USER->GetUserGroupArray(); ?>
                                        <? if ($arParams['SHOW_DISCOUNT_TIME_EACH_SKU'] != 'Y' || ($arParams['SHOW_DISCOUNT_TIME_EACH_SKU'] == 'Y' && !$arItem['OFFERS'])): ?>
                                            <?
                                            $arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $arUserGroups, "N", $min_price_id, SITE_ID);
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
                                                            $(document).ready(function() {
                                                                        if ($('.countdown').size()) {
                                                                            var active_to = '<?= $arDiscount["ACTIVE_TO"]; ?>',
                                                                                date_to = new Date(active_to.replace(/(\d+)\.(\d+)\.(\d+)/, '$3/$2/$1'));
                                                                            $('.countdown_<?= $arItem["ID"] ?>').countdown({
                                                                                until: date_to,
                                                                                format: 'dHMS',
                                                                                padZeroes: true,
                                                                                layout: '{d<}<span class="days item">{dnn}<div class="text">{dl}</div></span>{d>} <span class="hours item">{hnn}<div class="text">{hl}</div></span> <span class="minutes item">{mnn}<div class="text">{ml}</div></span> <span class="sec item">{snn}<div class="text">{sl}</div></span>'
                                                                            }, $.countdown.regionalOptions['ru']);
                                                                        }
                                                            });
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
                                        <? else: ?>
                                            <?
                                            if ($arItem['JS_OFFERS']) {
                                                foreach ($arItem['JS_OFFERS'] as $keyOffer => $arTmpOffer2) {
                                                    $active_to = '';
                                                    $arDiscounts = CCatalogDiscount::GetDiscountByProduct($arTmpOffer2['ID'], $arUserGroups, "N", array(), SITE_ID);
                                                    if ($arDiscounts) {
                                                        foreach ($arDiscounts as $arDiscountOffer) {
                                                            if ($arDiscountOffer['ACTIVE_TO']) {
                                                                $active_to = $arDiscountOffer['ACTIVE_TO'];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    $arItem['JS_OFFERS'][$keyOffer]['DISCOUNT_ACTIVE'] = $active_to;
                                                }
                                            }
                                            ?>
                                            <div class="view_sale_block" style="display:none;">
                                                <div class="count_d_block">
                                                    <span class="active_to_<?= $arItem["ID"] ?> hidden"><?= $arDiscount["ACTIVE_TO"]; ?></span>
                                                    <div class="title"><?= GetMessage("UNTIL_AKC"); ?></div>
                                                    <span class="countdown countdown_<?= $arItem["ID"] ?> values"></span>
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
                                        <? endif; ?>
                                    <? } ?>
                                    <div class="catalog-item__props">
                                        <div class="catalog-item__prop-list">
                                            <!--<table class="props_list props_list_flex">
                                                <?/*
                                                    $propArray = ['MATERIAL', 'SEZON', 'PLOTNOST_MATERIALA', 'RAZMER'];
                                                */ ?>
                                                <tbody>
                                                    <?/*foreach($propArray as $propName):*/ ?>
                                                        <?/*if($arItem['PROPERTIES'][$propName]['VALUE']):*/ ?>
                                                            <tr itemprop="additionalProperty" itemscope="" itemtype="http://schema.org/PropertyValue">
                                                                <td class="char_name">
                                                                    <span><span itemprop="name">
                                                                        <?/*=$arItem['PROPERTIES'][$propName]['NAME'];*/ ?>
                                                                    </span></span>
                                                                </td>
                                                                <td class="char_value">
                                                                    <span itemprop="value">
                                                                        <?/*=$arItem['PROPERTIES'][$propName]['VALUE'];*/ ?>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        <?/*endif;*/ ?>
                                                    <?/*endforeach;*/ ?>
                                                </tbody>
                                            </table>-->
                                            <?
                                            $arQuantity = getProductQty($arItem);
                                            ?>
                                            <div class="catalog-qty-desc-wrapper">
                                                <?= $arQuantity["HTML"] ?>
                                            </div>
                                        </div>
                                        <?
                                        $arColors = productColors::getProductColorsFromHL($arItem);
                                        if (!empty($arColors)):
                                        ?>
                                            <div class="catalog-item__color-group">
                                                <div class="color-group">
                                                    <div class="color-group__label">
                                                        Цвет:
                                                    </div>
                                                    <div class="color-group__list">
                                                        <?
                                                        foreach ($arColors as $color) {
                                                        ?>
                                                            <div class="color-group__item">
                                                                <? if (!empty($color["URL"])): ?>
                                                                    <a class="color-option" href="<?= $color["URL"] ?>">
                                                                        <span class="color-option__illustration" style="background: url('<?= $color["UF_FILE"]["src"] ?>') no-repeat;">
                                                                            <span><?= $color["UF_NAME"] ?></span>
                                                                        </span>
                                                                    </a>
                                                                <? else: ?>
                                                                    <div class="color-option color-option_state_active">
                                                                        <span class="color-option__illustration" style="background: url('<?= $color["UF_FILE"]["src"] ?>') no-repeat;">
                                                                            <?= $color['UF_NAME'] ?>
                                                                        </span>
                                                                    </div>
                                                                <? endif; ?>
                                                            </div>
                                                        <?
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <? endif; ?>
                                    </div>
                                    <div class="hover_block">
                                        <? if (false): // Показываем всем только переход в карточку
                                        ?>
                                            <? if ($arItem["OFFERS"]) {
                                            ?>
                                                <? if (!empty($arItem['OFFERS_PROP'])) {
                                                ?>
                                                    <div class="sku_props">
                                                        <div class="bx_catalog_item_scu wrapper_sku"
                                                            id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PROP_DIV']; ?>">
                                                            <? $arSkuTemplate = array(); ?>
                                                            <? $arSkuTemplate = CMShop::GetSKUPropsArray($arItem['OFFERS_PROPS_JS'], $arResult["SKU_IBLOCK_ID"], $arParams["DISPLAY_TYPE"], $arParams["OFFER_HIDE_NAME_PROPS"]); ?>
                                                            <?
                                                            foreach ($arSkuTemplate as $code => $strTemplate) {
                                                                if (!isset($arItem['OFFERS_PROP'][$code]))
                                                                    continue;
                                                                echo '<div>', str_replace('#ITEM#_prop_', $arItemIDs["ALL_ITEM_IDS"]['PROP'], $strTemplate), '</div>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <? $arItemJSParams = CMShop::GetSKUJSParams($arResult, $arParams, $arItem); ?>

                                                        <script type="text/javascript">
                                                            var <? echo $arItemIDs["strObName"]; ?> =
                                                                new JCCatalogSection(<? echo CUtil::PhpToJSObject($arItemJSParams, false, true); ?>);
                                                        </script>

                                                    </div>
                                                <? } ?>
                                            <? } ?>
                                            <? if (!$arItem["OFFERS"] || $arParams['TYPE_SKU'] !== 'TYPE_1'): ?>
                                                <div class="counter_wrapp <?= ($arItem["OFFERS"] && $arParams["TYPE_SKU"] == "TYPE_1" ? 'woffers' : '') ?>">
                                                    <? if (($arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] && $arAddToBasketData["ACTION"] == "ADD") && $arItem["CAN_BUY"]): ?>
                                                        <div class="counter_block" data-offers="<?= ($arItem["OFFERS"] ? "Y" : "N"); ?>"
                                                            data-item="<?= $arItem["ID"]; ?>">
                                                            <span class="minus"
                                                                id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_DOWN']; ?>">-</span>
                                                            <input type="text" class="text"
                                                                id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY']; ?>"
                                                                name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>"
                                                                value="<?= $arAddToBasketData["MIN_QUANTITY_BUY"] ?>" />
                                                            <span class="plus"
                                                                id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_UP']; ?>" <?= ($arAddToBasketData["MAX_QUANTITY_BUY"] ? "data-max='" . $arAddToBasketData["MAX_QUANTITY_BUY"] . "'" : "") ?>>+</span>
                                                        </div>
                                                    <? endif; ?>
                                                    <div onclick="ym(36139370, 'reachGoal', 'clickbuylisting');"
                                                        id="<?= $arItemIDs["ALL_ITEM_IDS"]['BASKET_ACTIONS']; ?>"
                                                        class="button_block <?= (($arAddToBasketData["ACTION"] == "ORDER"/* && !$arItem["CAN_BUY"] */) || !$arItem["CAN_BUY"] || !$arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] || $arAddToBasketData["ACTION"] == "SUBSCRIBE" ? "wide" : ""); ?>">
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
                                                            "ID" => $arItemIDs["strMainID"],
                                                        )
                                                        ?>
                                                        <script type="text/javascript">
                                                            var <? echo $arItemIDs["strObName"]; ?>el = new JCCatalogSectionOnlyElement(<? echo CUtil::PhpToJSObject($arOnlyItemJSParams, false, true); ?>);
                                                        </script>
                                                    <? endif;
                                                    ?>
                                                <? } ?>
                                            <? elseif ($arItem["OFFERS"]): ?>
                                                <? if (empty($arItem['OFFERS_PROP'])) {
                                                ?>
                                                    <div class="offer_buy_block buys_wrapp woffers">
                                                        <?
                                                        $arItem["OFFERS_MORE"] = "Y";
                                                        $arAddToBasketData = CMShop::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small read_more1', $arParams);
                                                        ?>
                                                        <!--noindex-->
                                                        <?= $arAddToBasketData["HTML"] ?>
                                                        <!--/noindex-->
                                                    </div>
                                                <? } else {
                                                ?>
                                                    <div class="offer_buy_block buys_wrapp woffers" style="display:none;">
                                                        <div class="counter_wrapp"></div>
                                                    </div>
                                                <? } ?>
                                            <? endif; ?>
                                        <? endif; ?>
                                        <div class="offer_buy_block buys_wrapp woffers">
                                            <!--noindex-->
                                            <a class="button basket read_more" rel="nofollow" href="<?= $arItem["DETAIL_PAGE_URL"] ?>" data-item="<?= $arItem["ID"] ?>">Подробнее</a>
                                            <!--/noindex-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <? endif; ?>
            <? } ?>
            <? if (($arParams["AJAX_REQUEST"] == "N") || !isset($arParams["AJAX_REQUEST"])) {
            ?>
            </div>
        </div>

    <? } ?>
    <? if ($arParams["AJAX_REQUEST"] == "Y") {
    ?>
        <div class="wrap_nav">
        <? } ?>
        <? //if(strlen($arResult["NAV_STRING"])):
        ?>
        <div class="bottom_nav <?= $arParams["DISPLAY_TYPE"]; ?>" <?= ($arParams["AJAX_REQUEST"] == "Y" ? "style='display: none; '" : ""); ?>>
            <? if ($arParams["DISPLAY_BOTTOM_PAGER"] == "Y") {
            ?><?= $arResult["NAV_STRING"] ?><? } ?>
        </div>
        <? //endif;
        ?>
        <? if ($arParams["AJAX_REQUEST"] == "Y") {
        ?>
        </div>
    <? } ?>
<?
} else {
?>
    <div class="no_goods catalog_block_view">
        <div class="no_products">
            <div class="wrap_text_empty">
                <? if ($_REQUEST["set_filter"]) {
                ?>
                    <? $APPLICATION->IncludeFile(SITE_DIR . "include/section_no_products_filter.php", array(), array("MODE" => "html", "NAME" => GetMessage('EMPTY_CATALOG_DESCR'))); ?>
                <? } else {
                ?>
                    <? $APPLICATION->IncludeFile(SITE_DIR . "include/section_no_products.php", array(), array("MODE" => "html", "NAME" => GetMessage('EMPTY_CATALOG_DESCR'))); ?>
                <? } ?>
            </div>
        </div>
        <? if ($_REQUEST["set_filter"]) {
        ?>
            <span class="button wide"><?= GetMessage('RESET_FILTERS'); ?></span>
        <? } ?>
    </div>
<? } ?>

<? if (isset($_GET['bxajaxid']) && $_GET['bxajaxid']): ?>
    <script>
        startActions();
    </script>
<? endif; ?>

<script>
    BX.message({
        QUANTITY_AVAILIABLE: '<? echo COption::GetOptionString("aspro.mshop", "EXPRESSION_FOR_EXISTS", GetMessage("EXPRESSION_FOR_EXISTS_DEFAULT"), SITE_ID); ?>',
        QUANTITY_NOT_AVAILIABLE: '<? echo COption::GetOptionString("aspro.mshop", "EXPRESSION_FOR_NOTEXISTS", GetMessage("EXPRESSION_FOR_NOTEXISTS"), SITE_ID); ?>',
        ADD_ERROR_BASKET: '<? echo GetMessage("ADD_ERROR_BASKET"); ?>',
        ADD_ERROR_COMPARE: '<? echo GetMessage("ADD_ERROR_COMPARE"); ?>',
    })
</script>