<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

?>
<div class="map-objects-filter" style="display: none;">
    <div class="map-objects-region">
        <div class="map-objects-region__label"><?=$arResult['REGION']['NAME']?></div>
        <ul class="map-objects-region__list">
            <li class="selected"><?=$arResult['REGION']['NAME']?></li>
            <?foreach($arResult['REGION']['VALUES'] as $arRegion):?>
                <li data-zoom="<?=$arRegion['PROPERTY_MAP_ZOOM_VALUE']?>" data-lng="<?=$arRegion['PROPERTY_LONGITUDE_VALUE']?>" data-lat="<?=$arRegion['PROPERTY_LATITUDE_VALUE']?>" data-region-id="<?=$arRegion['ID']?>"><?=$arRegion['NAME']?></li>
            <?endforeach;?>
        </ul>
    </div>
</div>
<?php

if (!empty($arResult['ITEMS'])) { ?>
    <div id="mapObjectsList" class="map-objects-list" style="display: none;">
        <?foreach ($arResult['ITEMS'] as $item) :?>
            <?
            $uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
            $areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
            $this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
            $this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
            $arCoordinates = explode(',', $item["PROPERTIES"]["COORDINATES"]["VALUE"]);
            ?>
            <div class="map-objects-item dealers-item" data-map-lng="<?=$arCoordinates[1]?>" data-map-lat="<?=$arCoordinates[0]?>" data-map-region-id="<?=$item["PROPERTIES"]["REGION"]["VALUE"]?>" id="<?=$areaIds[$item['ID']]?>">
                <h3 data-map-title>
                    <a href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["NAME"]?></a>
                </h3>
                <?if (mb_strlen($item["PROPERTIES"]["ADDRESS"]["VALUE"]) > 0):?>
                    <?=$item["PROPERTIES"]["ADDRESS"]["NAME"]?>: <span data-map-address><?=$item["PROPERTIES"]["ADDRESS"]["VALUE"]?></span><br>
                <?endif;?>
                <?if (is_array($item["PROPERTIES"]["PHONE"]["VALUE"]) && count($item["PROPERTIES"]["PHONE"]["VALUE"]) > 0):?>
                    <?=$item["PROPERTIES"]["PHONE"]["NAME"]?>:
                    <?
                    $arPhone = [];
                    foreach ($item["PROPERTIES"]["PHONE"]["VALUE"] as $phone) {
                        $arPhone[] = '<a href="tel:' . $phone . '" data-map-phone>' . $phone . '</a>';
                    }
                    echo implode(', ', $arPhone);
                    ?>
                    <br>
                <?endif;?>
                <?if (mb_strlen($item["PROPERTIES"]["SITE"]["VALUE"]) > 0):?>
                    <?=$item["PROPERTIES"]["SITE"]["NAME"]?>: <a href="<?=$item["PROPERTIES"]["SITE"]["VALUE"]?>" rel="nofollow" target="_blank" data-map-site><?=parse_url($item["PROPERTIES"]["SITE"]["VALUE"], PHP_URL_HOST)?></a>
                <?endif;?>
            </div>
        <?endforeach;?>
    </div>
<? } ?>
