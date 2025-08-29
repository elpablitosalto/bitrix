<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$item = $arParams['ITEM'];
//vardump($arParams);
?>
<section class="nb-section nb-reviews-section" id="<?=$arParams['BLOCK_AREA_ID']?>">
    <div class="container" id="<?=$arParams['EDIT_AREA_ID']?>">
        <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
            <div class="nb-section__header">
                <?require __DIR__ . "/../../title.php";?>
            </div>
        <?endif;?>
        <div class="nb-section__body">
            <? $APPLICATION->IncludeComponent(
                "indexis:block.filter",
                "reviews",
                array(
                    "AJAX_MODE" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => "block" . $item['ID'],
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "SHOW_FILTER" => $item['PROPERTIES']['Z_1_SHOW_FILTER']['VALUE_XML_ID'],
                    "IBLOCK_ID" => Indexis::getIblockId('reviews', 'our_doctors'),
                    "IBLOCK_TYPE" => "our_doctors",
                    "PREFILTER_NAME" => "arPreFilter" . $item['ID'],
                    "FILTER_NAME" => "arFilter" . $item['ID'],
                    "DEFAULT_SERVICE" => $item['PROPERTIES']['Z_1_DEFAULT_SERVICE']['VALUE'],
                    "SYNC_CONTENT_CLINIC" => $arParams['SYNC_CONTENT_CLINIC'],
                    "PAGE_ELEMENT_COUNT" => $arParams['PAGE_ELEMENT_COUNT'],
                    'SERVICE_ID' => $arParams['SERVICE_ID'],
                )
            ); ?>
        </div>
    </div>
</section>