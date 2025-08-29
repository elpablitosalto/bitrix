<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<?
if (count($arResult["ITEMS"]) >= 1) {
    $injectId = 'sale_gift_product_' . $this->randString();
    ?>
    <?
    if ($fast_view_text_tmp = \Bitrix\Main\Config\Option::get('aspro.mshop', 'EXPRESSION_FOR_FAST_VIEW', GetMessage('FAST_VIEW')))
        $fast_view_text = $fast_view_text_tmp;
    else
        $fast_view_text = GetMessage('FAST_VIEW');
    ?>
    <ul class="viewed_navigation slider_navigation top_big custom_flex border"></ul>
    <div class="s_<?= $injectId; ?>">
        <div class="all_wrapp s_<?= $injectId; ?>">
            <div class="content_inner tab">
                <ul class="tabs_slider slides wr block-rd">
                    <?
                    $elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
                    $elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
                    $elementDeleteParams = array('CONFIRM' => GetMessage('CVP_TPL_ELEMENT_DELETE_CONFIRM'));
                    ?>
                    <? foreach ($arResult['ITEMS'] as $key => $arItem) {
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
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $elementEdit);
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
                            $arItem["strMainID"] = $this->GetEditAreaId($arItem['ID']);
                            $arItemIDs = CMShop::GetItemsIDs($arItem);

                            $strMeasure = '';
                            $totalCount = CMShop::GetTotalCount($arItem);
                            $arQuantityData = CMShop::GetQuantityArray($totalCount, $arItemIDs["ALL_ITEM_IDS"]);
                            if (!$arItem["OFFERS"]) {
                                if ($arParams["SHOW_MEASURE"] == "Y" && $arItem["CATALOG_MEASURE"]) {
                                    $arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
                                    $strMeasure = $arMeasure["SYMBOL_RUS"];
                                }
                                $arAddToBasketData = CMShop::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small', $arParams);
                            } elseif ($arItem["OFFERS"]) {
                                $strMeasure = $arItem["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
                                if (!$arItem['OFFERS_PROP']) {

                                    $arAddToBasketData = CMShop::GetAddToBasketArray($arItem["OFFERS"][0], $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small', $arParams);
                                }
                            }
                            $elementName = ((isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arItem['NAME']);
                            ?>

                            <li class="catalog_item main_item_wrapper" id="<?= $arItem["strMainID"]; ?>">
                                <div class="catalog-item__table-control">
                                    <div class="table-control">
                                        <?if ($arItem["PROPERTIES"]["RASSHIRENNAYA_RAZMERNAYA_SETKA"]["VALUE_XML_ID"] == "true"):?>
                                            <a href="#" class="table-control__icon-link" data-target="modal">
                                                <svg class="table-control__icon" width="41" height="30" viewBox="0 0 41 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect class="table-control__icon_stroke" x="9.0484" y="10.5645" width="22.9032" height="7.80645"/>
                                                    <path class="table-control__icon_stroke" d="M12.3226 13.8386V18.8709"/>
                                                    <path class="table-control__icon_stroke" d="M19.871 13.8386V18.8709"/>
                                                    <path class="table-control__icon_stroke" d="M27.4193 13.8386V18.8709"/>
                                                    <path class="table-control__icon_stroke" d="M23.6452 15.0967L23.6452 18.8709"/>
                                                    <path class="table-control__icon_stroke" d="M16.0968 15.0967L16.0968 18.8709"/>
                                                    <path class="table-control__icon_fill" d="M40.3536 15.3535C40.5488 15.1583 40.5488 14.8417 40.3536 14.6464L37.1716 11.4644C36.9763 11.2692 36.6597 11.2692 36.4645 11.4644C36.2692 11.6597 36.2692 11.9763 36.4645 12.1715L39.2929 15L36.4645 17.8284C36.2692 18.0237 36.2692 18.3402 36.4645 18.5355C36.6597 18.7308 36.9763 18.7308 37.1716 18.5355L40.3536 15.3535ZM34 15.5H40V14.5H34V15.5Z"/>
                                                    <path class="table-control__icon_fill" d="M0.646447 15.3535C0.451184 15.1583 0.451184 14.8417 0.646447 14.6464L3.82843 11.4644C4.02369 11.2692 4.34027 11.2692 4.53553 11.4644C4.7308 11.6597 4.7308 11.9763 4.53553 12.1715L1.70711 15L4.53553 17.8284C4.7308 18.0237 4.7308 18.3402 4.53553 18.5355C4.34027 18.7308 4.02369 18.7308 3.82843 18.5355L0.646447 15.3535ZM7 15.5H1V14.5H7V15.5Z"/>
                                                </svg>
                                            </a>
                                        <?endif;?>
                                        <?if ($arItem["PROPERTIES"]["ZAKLYUCHENIE_MINPROMTORG"]["VALUE"] == "Да"):?>
                                            <?//$fccFile = CMShop::GetFileInfo($arItem["PROPERTIES"]["FCC"]["VALUE"]);?>
                                            <span class="table-control__label">ФСС</span>
                                        <?endif;?>
                                    </div>
                                </div>
                                <div class="image_wrapper_block">
                                    <div class="stickers">
                                        <? if (is_array($arItem["PROPERTIES"]["HIT"]["VALUE_XML_ID"])): ?>
                                            <? foreach ($arItem["PROPERTIES"]["HIT"]["VALUE_XML_ID"] as $key => $class) { ?>
                                                <div>
                                                    <div class="sticker_<?= strtolower($class); ?>"
                                                         title="<?= $arItem["PROPERTIES"]["HIT"]["VALUE"][$key] ?>"></div>
                                                </div>
                                            <? } ?>
                                        <? endif; ?>
                                    </div>
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
                                                              class="wish_item to <?= $arParams["TYPE_SKU"]; ?>"
                                                              data-item="" data-iblock="<?= $arItem["IBLOCK_ID"] ?>"
                                                              data-offers="Y"
                                                              data-props="<?= $arOfferProps ?>"><i></i></span>
                                                        <span title="<?= GetMessage('CATALOG_WISH_OUT') ?>"
                                                              class="wish_item in added <?= $arParams["TYPE_SKU"]; ?>"
                                                              style="display: none;" data-item=""
                                                              data-iblock="<?= $arItem["IBLOCK_ID"] ?>"><i></i></span>
                                                    </div>
                                                <? endif; ?>
                                            <? endif; ?>
                                            <? if ($arParams["DISPLAY_COMPARE"] == "Y"): ?>
                                                <? if (!$arItem["OFFERS"] || ($arParams["TYPE_SKU"] !== 'TYPE_1' || ($arParams["TYPE_SKU"] == 'TYPE_1' && !$arItem["OFFERS_PROP"]))): ?>
                                                    <div class="compare_item_button">
                                                        <span title="<?= GetMessage('CATALOG_COMPARE') ?>"
                                                              class="compare_item to"
                                                              data-iblock="<?= $arItem["IBLOCK_ID"] ?>"
                                                              data-item="<?= $arItem["ID"] ?>"><i></i></span>
                                                        <span title="<?= GetMessage('CATALOG_COMPARE_OUT') ?>"
                                                              class="compare_item in added" style="display: none;"
                                                              data-iblock="<?= $arItem["IBLOCK_ID"] ?>"
                                                              data-item="<?= $arItem["ID"] ?>"><i></i></span>
                                                    </div>
                                                <? elseif ($arItem["OFFERS"]): ?>
                                                    <div class="compare_item_button">
                                                        <span title="<?= GetMessage('CATALOG_COMPARE') ?>"
                                                              class="compare_item to <?= $arParams["TYPE_SKU"]; ?>"
                                                              data-iblock="<?= $arItem["IBLOCK_ID"] ?>" data-item=""><i></i></span>
                                                        <span title="<?= GetMessage('CATALOG_COMPARE_OUT') ?>"
                                                              class="compare_item in added <?= $arParams["TYPE_SKU"]; ?>"
                                                              style="display: none;"
                                                              data-iblock="<?= $arItem["IBLOCK_ID"] ?>" data-item=""><i></i></span>
                                                    </div>
                                                <? endif; ?>
                                            <? endif; ?>
                                        </div>
                                    <? endif; ?>
                                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="thumb"
                                       id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>">
                                           <?
                                           $a_alt = ($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] : $arItem["NAME"]);
                                           $a_title = ($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] : $arItem["NAME"]);
                                           ?>
                                           <? if (!empty($arItem["PREVIEW_PICTURE"])): ?>
                                               <?
                                               $img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array("width" => 210, "height" => 275), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                               //echo "<pre>";var_dump($img);echo "</pre>";
                                               ?>
                                            <img border="0" src="<?= $img["src"]; //$arItem["PREVIEW_PICTURE"]["SRC"]    ?>"
                                                 alt="<?= $a_alt; ?>" title="<?= $a_title; ?>"/>
                                             <? elseif (!empty($arItem["DETAIL_PICTURE"])): ?>
                                                 <? $img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array("width" => 210, "height" => 275), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                                            <img border="0" src="<?= $img["src"] ?>" alt="<?= $a_alt; ?>"
                                                 title="<?= $a_title; ?>"/>
                                             <? else: ?>
                                            <img border="0" src="<?= SITE_TEMPLATE_PATH ?>/images/no_photo_medium.png"
                                                 alt="<?= $a_alt; ?>" title="<?= $a_title; ?>"/>
                                             <? endif; ?>
                                             <? if ($arParams["SALE_STIKER"] && $arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]) { ?>
                                            <div class="sticker_sale_text"><?= $arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]; ?></div>
                                        <? } ?>
                                    </a>
                                    <div class="fast_view_block" data-event="jqm" data-param-form_id="fast_view"
                                         data-param-iblock_id="<?= $arParams["IBLOCK_ID"]; ?>"
                                         data-param-id="<?= $arItem["ID"]; ?>"
                                         data-param-item_href="<?= urlencode($arItem["DETAIL_PAGE_URL"]); ?>"
                                         data-name="fast_view"><?= $fast_view_text; ?></div>
                                </div>
                                <div class="item_info <?= $arParams["TYPE_SKU"] ?>">
                                    <div class="item-title">
                                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><span><?= $arItem["NAME"] ?></span></a>
                                    </div>
                                    <? if ($arParams["SHOW_RATING"] == "Y"): ?>
                                        <div class="rating">
                                            <?
                                            $APPLICATION->IncludeComponent(
                                                    "bitrix:iblock.vote",
                                                    "element_rating_front",
                                                    Array(
                                                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                                        "IBLOCK_ID" => $arItem["IBLOCK_ID"],
                                                        "ELEMENT_ID" => $arItem["ID"],
                                                        "MAX_VOTE" => 5,
                                                        "VOTE_NAMES" => array(),
                                                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                                                        "DISPLAY_AS_RATING" => 'vote_avg'
                                                    ),
                                                    $component, array("HIDE_ICONS" => "Y")
                                            );
                                            ?>
                                        </div>
                                    <? endif; ?>
                                    <?= $arQuantityData["HTML"]; ?>
                                    <div class="cost prices clearfix">
                                        <? if ($arItem["OFFERS"]) { ?>
                                            <?
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
                                            <? \Aspro\Functions\CAsproMShopSku::showItemPrices($arParams, $arItem, $item_id, $min_price_id, $arItemIDs); ?>
                                        <? } elseif ($arItem["PRICES"]) {
                                            ?>
                                            <?
                                            $arCountPricesCanAccess = 0;
                                            $min_price_id = 0;
                                            $item_id = $arItem["ID"];
                                            ?>
                                            <?
                                            foreach ($arItem["PRICES"] as $priceCode => $arTmpPrice) {
                                                $arItem["PRICES"][$priceCode]["DISCOUNT_VALUE"] = $arItem["PRICES"][$priceCode]["DISCOUNT_DIFF"];
                                                $arItem["PRICES"][$priceCode]["PRINT_DISCOUNT_VALUE"] = $arItem["PRICES"][$priceCode]["PRINT_DISCOUNT_DIFF"];
                                            }
                                            ?>
                                            <?= \Aspro\Functions\CAsproMShopItem::getItemPrices($arParams, $arItem["PRICES"], $strMeasure, $min_price_id); ?>
                                            <?
                                        } elseif ($arItem["PRICE_MATRIX"]["MATRIX"][4]["ZERO-INF"]["PRINT_PRICE"]) {
                                            echo "<div class=\"price\">" . $arItem["PRICE_MATRIX"]["MATRIX"][4]["ZERO-INF"]["PRINT_PRICE"] . "</div>";
                                            //echo "<pre>";var_dump($arItem);echo "</pre>";
                                        }
                                        ?>
                                    </div>
                                    <? if ($arParams["SHOW_DISCOUNT_TIME"] == "Y") { ?>
                                        <? $arUserGroups = $USER->GetUserGroupArray(); ?>
                                        <? if ($arParams['SHOW_DISCOUNT_TIME_EACH_SKU'] != 'Y' || ($arParams['SHOW_DISCOUNT_TIME_EACH_SKU'] == 'Y' && !$arItem['OFFERS'])): ?>
                                            <?
                                            $arDiscounts = CCatalogDiscount::GetDiscountByProduct($arItem["ID"], $arUserGroups, "N", $min_price_id, SITE_ID);
                                            $arDiscount = array();
                                            if ($arDiscounts)
                                                $arDiscount = current($arDiscounts);
                                            if ($arDiscount["ACTIVE_TO"]) {
                                                ?>
                                                <div class="view_sale_block <?= ($arQuantityData["HTML"] ? '' : 'wq'); ?>">
                                                    <div class="count_d_block">
                                                        <span class="active_to hidden"><?= $arDiscount["ACTIVE_TO"]; ?></span>
                                                        <div class="title"><?= GetMessage("UNTIL_AKC"); ?></div>
                                                        <span class="countdown values"></span>
                                                    </div>
                                                    <? if ($arQuantityData["HTML"]): ?>
                                                        <div class="quantity_block">
                                                            <div class="title"><?= GetMessage("TITLE_QUANTITY_BLOCK"); ?></div>
                                                            <div class="values">
                                                                <span class="item">
                                                                    <span class="value" <?= (count($arItem["OFFERS"]) > 0 && $arItem["OFFERS_PROP"] ? 'style="opacity:0;"' : '') ?>><?= $totalCount; ?></span>
                                                                    <div class="text"><?= GetMessage("TITLE_QUANTITY"); ?></div>
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
                                </div>
                                <div class="catalog-item__props">
                                    <div class="catalog-item__prop-list">
                                        <!--<table class="props_list props_list_flex">
                                            <?/*
                                                $propArray = ['MATERIAL', 'SEZON', 'PLOTNOST_MATERIALA', 'RAZMER'];
                                            */?>
                                            <tbody>
                                                <?/*foreach($propArray as $propName):*/?>
                                                    <?/*if($arItem['PROPERTIES'][$propName]['VALUE']):*/?>
                                                        <tr itemprop="additionalProperty" itemscope="" itemtype="http://schema.org/PropertyValue">
                                                            <td class="char_name">
                                                                <span><span itemprop="name">
                                                                    <?/*=$arItem['PROPERTIES'][$propName]['NAME'];*/?>
                                                                </span></span>
                                                            </td>
                                                            <td class="char_value">
                                                                <span itemprop="value">
                                                                    <?/*=$arItem['PROPERTIES'][$propName]['VALUE'];*/?>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    <?/*endif;*/?>
                                                <?/*endforeach;*/?>
                                            </tbody>
                                        </table>-->
                                        <?
                                            $arQuantity = getProductQty($arItem);
                                        ?>
                                        <div class="catalog-qty-desc-wrapper">
                                            <?=$arQuantity["HTML"]?>
                                        </div>
                                    </div>
                                    <?
                                    $arColors = productColors::getProductColorsFromHL($arItem);
                                    if(!empty($arColors)):
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
                                                            <?if(!empty($color["URL"])):?>
                                                                <a class="color-option" href="<?=$color["URL"]?>">
                                                                    <span class="color-option__illustration" style="background: url('<?=$color["UF_FILE"]["src"]?>') no-repeat;">
                                                                        <span><?=$color["UF_NAME"]?></span>
                                                                    </span>
                                                                </a>
                                                            <?else:?>
                                                                <div class="color-option color-option_state_active">
                                                                    <span class="color-option__illustration" style="background: url('<?=$color["UF_FILE"]["src"]?>') no-repeat;">
                                                                        <?=$color['UF_NAME']?>
                                                                    </span>
                                                                </div>
                                                            <?endif;?>
                                                        </div>
                                                        <?
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif;?>
                                </div>
                                <div class="buttons_block">
                                    <? if (false) { // Показываем всем только переход в карточку?>
                                        <? if ($arItem["OFFERS"]) { ?>
                                            <? if (!empty($arItem['OFFERS_PROP'])) { ?>
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
                                        <? if (!$arItem["OFFERS"] || ($arItem["OFFERS"] && !$arItem['OFFERS_PROP'])): ?>
                                            <div class="counter_wrapp <?= ($arItem["OFFERS"] && $arParams["TYPE_SKU"] == "TYPE_1" ? 'woffers' : '') ?>">
                                                <? if (($arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] && $arAddToBasketData["ACTION"] == "ADD") && $arItem["CAN_BUY"]): ?>
                                                    <div class="counter_block"
                                                         data-offers="<?= ($arItem["OFFERS"] ? "Y" : "N"); ?>"
                                                         data-item="<?= $arItem["ID"]; ?>">
                                                        <span class="minus"
                                                              id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_DOWN']; ?>">-</span>
                                                        <input type="text" class="text"
                                                               id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY']; ?>"
                                                               name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>"
                                                               value="<?= $arAddToBasketData["MIN_QUANTITY_BUY"] ?>"/>
                                                        <span class="plus"
                                                              id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_UP']; ?>" <?= ($arAddToBasketData["MAX_QUANTITY_BUY"] ? "data-max='" . $arAddToBasketData["MAX_QUANTITY_BUY"] . "'" : "") ?>>+</span>
                                                    </div>
                                                <? endif; ?>
                                                <div id="<?= $arItemIDs["ALL_ITEM_IDS"]['BASKET_ACTIONS']; ?>"
                                                     class="button_block <?= (($arAddToBasketData["ACTION"] == "ORDER"/* && !$arItem["CAN_BUY"] */) || !$arItem["CAN_BUY"] || !$arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] || $arAddToBasketData["ACTION"] == "SUBSCRIBE" ? "wide" : ""); ?>">
                                                    <!--noindex-->
                                                    <?= $arAddToBasketData["HTML"] ?>
                                                    <!--/noindex-->
                                                </div>
                                            </div>
                                        <? elseif ($arItem["OFFERS"]): ?>
                                            <? if (empty($arItem['OFFERS_PROP'])) { ?>
                                                <div class="offer_buy_block buys_wrapp woffers">
                                                    <?
                                                    $arItem["OFFERS_MORE"] = "Y";
                                                    $arAddToBasketData = CMShop::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small read_more1', $arParams);
                                                    ?>
                                                    <!--noindex-->
                                                    <?= $arAddToBasketData["HTML"] ?>
                                                    <!--/noindex-->
                                                </div>
                                            <? } else { ?>
                                                <div class="offer_buy_block buys_wrapp woffers" style="display:none;">
                                                    <div class="counter_wrapp"></div>
                                                </div>
                                            <? } ?>
                                        <? endif; ?>
                                    <? } ?>
                                    <a class="button basket read_more" rel="nofollow" href="<?=$arItem["DETAIL_PAGE_URL"]?>" data-item="<?=$arItem["ID"]?>">Подробнее</a>
                                </div>
                            </li>
                        <? endif ?>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
<? } else { ?>
    <script>
        $(document).ready(function () {
            if ($('.bx_item_list_you_looked_horizontal').length) {
                $('.bx_item_list_you_looked_horizontal').remove();
            }
        })
    </script>
<? } ?>

<script>
    $(document).ready(function () {
        var flexsliderItemWidth = 232;
        var flexsliderItemMargin = 10;
        $('.s_<?= $injectId; ?> .content_inner').flexslider({
            animation: 'slide',
            selector: '.slides > li',
            slideshow: false,
            animationSpeed: 600,
            directionNav: true,
            controlNav: false,
            pauseOnHover: true,
            animationLoop: true,
            itemWidth: flexsliderItemWidth,
            itemMargin: flexsliderItemMargin,
            //minItems: flexsliderMinItems,
            controlsContainer: '.viewed_navigation',
            start: function (slider) {
                slider.find('li').css('opacity', 1);
            }
        });

        var itemsButtons = $('.s_<?= $injectId; ?> .wr > li .buttons_block'),
                itemsButtonsHeight = itemsButtons.getMaxHeights();
        $('.s_<?= $injectId; ?> .wr .buttons_block').hide();

        var tabsContentUnhover = ($('.s_<?= $injectId; ?> .all_wrapp').height() * 1) - 0;
        var tabsContentHover = tabsContentUnhover + itemsButtonsHeight + 50;
        //console.log($('.s_<?= $injectId; ?> .all_wrapp'));

        $('.s_<?= $injectId; ?> .slides').equalize({children: '.item-title'});
        $('.s_<?= $injectId; ?> .slides').equalize({children: '.item_info'});
        $('.s_<?= $injectId; ?> .slides').equalize({children: '.catalog_item'});

        $('.s_<?= $injectId; ?> .all_wrapp .content_inner').attr('data-unhover', tabsContentUnhover);
        $('.s_<?= $injectId; ?> .all_wrapp .content_inner').attr('data-hover', tabsContentHover);
        $('.s_<?= $injectId; ?> .all_wrapp').height(tabsContentUnhover);
        $('.s_<?= $injectId; ?> .all_wrapp .content_inner').addClass('absolute');

        $('.s_<?= $injectId; ?> .wr > li').hover(
                function () {
                    var tabsContentHover = $(this).closest('.content_inner').attr('data-hover') * 1;
                    $(this).closest('.content_inner').fadeTo(100, 1);
                    $(this).closest('.content_inner').stop().css({'height': tabsContentHover});
                    $(this).find('.buttons_block').fadeIn(450, 'easeOutCirc');
                },
                function () {
                    var tabsContentUnhoverHover = $(this).closest('.content_inner').attr('data-unhover') * 1;
                    $(this).closest('.content_inner').stop().animate({'height': tabsContentUnhoverHover}, 100);
                    $(this).find('.buttons_block').stop().fadeOut(233);
                }
        );
    })
</script>

<script>
    $(document).ready(function () {
        $('.catalog_block .catalog_item_wrapp .catalog_item .item-title').sliceHeight();
        $('.catalog_block .catalog_item_wrapp .catalog_item .cost').sliceHeight();
        $('.catalog_block .catalog_item_wrapp .item_info').sliceHeight({classNull: '.footer_button'});
        $('.catalog_block .catalog_item_wrapp').sliceHeight({classNull: '.footer_button'});
    });

    BX.message({
        QUANTITY_AVAILIABLE: '<? echo COption::GetOptionString("aspro.MShop", "EXPRESSION_FOR_EXISTS", GetMessage("EXPRESSION_FOR_EXISTS_DEFAULT"), SITE_ID); ?>',
        QUANTITY_NOT_AVAILIABLE: '<? echo COption::GetOptionString("aspro.MShop", "EXPRESSION_FOR_NOTEXISTS", GetMessage("EXPRESSION_FOR_NOTEXISTS"), SITE_ID); ?>',
        ADD_ERROR_BASKET: '<? echo GetMessage("ADD_ERROR_BASKET"); ?>',
        ADD_ERROR_COMPARE: '<? echo GetMessage("ADD_ERROR_COMPARE"); ?>',
    })
</script>