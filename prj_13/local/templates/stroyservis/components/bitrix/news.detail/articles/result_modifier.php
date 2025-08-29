<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
if (!function_exists('multiexplode')) {
    function multiexplode ($delimiters, $string) {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
}

$arResult["DETAIL_TEXT_EXPLODED"] = [];
$arResult["PRODUCT_SLIDER_IDS"] = [];

preg_match_all("/\[slider\](.*?)\[\/slider\]/", $arResult["DETAIL_TEXT"],$arSlider);
if (is_array($arSlider[0]) && count($arSlider[0]) > 0) {
    $arResult["DETAIL_TEXT_EXPLODED"] = multiexplode($arSlider[0], $arResult["DETAIL_TEXT"]);

    foreach ($arSlider[1] as $strProductIds) {
        $arResult["PRODUCT_SLIDER_IDS"][] = array_filter(
            array_map(
                'intval',
                explode(
                    ',',
                    $strProductIds
                )
            )
        );
    }
}

$this->__component->SetResultCacheKeys(array("NAME", 'DETAIL_PAGE_URL', 'PREVIEW_TEXT'));
?>