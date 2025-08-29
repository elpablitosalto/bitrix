<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$item = $arParams['ITEM'];
$arPropertieValue = $item['DISPLAY_PROPERTIES']['DEV_521_DATA']['VALUE'];
$ar_item_service_id = $item['DISPLAY_PROPERTIES']['DEV_521_SERVICE']['VALUE'];
//vardump($arParams['PROPERTIES']['DEV_521_SERVICE']);
//vardump($item);
//vardump($ar_item_service_id);
//echo "SERVICE_ID = ".$arParams['SERVICE_ID']."<br />"; 
$show = in_array($arParams['SERVICE_ID'], $ar_item_service_id) && strlen($arParams['SERVICE_ID']) > 0;
if ($show) {
?>
    <section class="nb-section nb-licenses-promotion-rules" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
        <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
            <? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') : ?>
                <div class="nb-section__header">
                    <? require __DIR__ . "/../../title.php"; ?>
                </div>
            <? endif; ?>
            <div class="nb-section__body">
                <div class="nb-promotion-rules">
                    <?
                    foreach ($arPropertieValue as $arItem) {
                        $arItemValues = $arItem['SUB_VALUES'];
                    ?>
                        <div class="nb-promotion-rules__item">
                            <h3 class="nb-promotion-rules__item-title"><?= $arItemValues["DEV_521_H"]["VALUE"] ?>:</h3>
                            <div class="nb-promotion-rules__item-desc">
                                <p><?= html_entity_decode($arItemValues["DEV_521_T"]["VALUE"]["TEXT"]); ?></p>
                            </div>
                        </div>
                    <?
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
<? } ?>