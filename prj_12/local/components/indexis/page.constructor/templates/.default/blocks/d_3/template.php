<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$item = $arParams['ITEM'];

$ar_default_services = [];
// Нужно сделать так, что бы при выделении корневой услуги, врач отображается во всех под услугах,
// которые содержатся в корне -->
if (!empty($item['PROPERTIES']['D_3_DEFAULT_SERVICE']['VALUE'])) {
    $ar_default_services = array();
    $default_service = $item['PROPERTIES']['D_3_DEFAULT_SERVICE']['VALUE'];
    if (strlen($default_service) > 0) {
        $ar_default_services[] = $default_service;
    }
    if (strlen($default_service) > 0) {
        $nav = CIBlockSection::GetNavChain(false, $default_service);
        while ($v = $nav->GetNext()) {
            if ($v['ID']) {
                $ar_default_services[] = $v['ID'];
            }
        }
    }
} else if (isset($arParams['SERVICE_ID']) && is_array($arParams['SERVICE_ID']) && count($arParams['SERVICE_ID']) > 0) {
    $ar_default_services = $arParams['SERVICE_ID'];
}
//vardump($ar_default_services);
// <--
?>
<section class="nb-section nb-doctors-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>" <?/*?>id="doctors"<?*/ ?>>
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') : ?>
            <div class="nb-section__header">
                <? require __DIR__ . "/../../title.php"; ?>
            </div>
        <? endif; ?>
        <div class="nb-section__body">
            <?
            //echo "ID = ".$item['ID']."<br />";
            ?>
            <? $APPLICATION->IncludeComponent(
                "indexis:block.filter",
                "",
                array(
                    "AJAX_MODE" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => "block" . $item['ID'],
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "SHOW_FILTER" => $item['PROPERTIES']['D_3_SHOW_FILTER']['VALUE_XML_ID'],
                    "IBLOCK_ID" => Indexis::getIblockId('our_doctors', 'our_doctors'),
                    "IBLOCK_TYPE" => "our_doctors",
                    "PREFILTER_NAME" => "arPreFilter" . $item['ID'],
                    "FILTER_NAME" => "arFilter" . $item['ID'],
                    //"DEFAULT_SERVICE" => $item['PROPERTIES']['D_3_DEFAULT_SERVICE']['VALUE'],
                    "DEFAULT_SERVICE" => $ar_default_services,
                    "TEMPLATE" => (!empty($item['PROPERTIES']['D_3_TEMPLATE']['VALUE_XML_ID']) ? $item['PROPERTIES']['D_3_TEMPLATE']['VALUE_XML_ID'] : 'tile'),
                    "SYNC_CONTENT_CLINIC" => $arParams['SYNC_CONTENT_CLINIC']
                )
            ); ?>
        </div>
    </div>
</section>