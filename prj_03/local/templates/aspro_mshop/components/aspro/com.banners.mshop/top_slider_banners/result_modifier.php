<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem) {
    $background = is_array($arItem["DETAIL_PICTURE"]) ? $arItem["DETAIL_PICTURE"]["SRC"] : $this->GetFolder() . "/images/background.jpg";

    $arItem['BACKGROUND'] = $background;

    $arFile = $arItem["DETAIL_PICTURE"];
    if (is_array($arFile)) {
        $arResultLocal = BitrixTools::getImageFormatted(array(
            'RESIZE' => 'Y',
            'FILE_VALUE' => $arFile,
            //'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            'WIDTH' => 541,
            'HEIGHT' => 5000,
            'DEFAULT_ALT_TITLE' => $arItem['NAME'],
            'QUALITY' => false,
        ));
        $arItem['BACKGROUND_540'] = $arResultLocal['PICTURE']['SRC'];

        $arResultLocal = BitrixTools::getImageFormatted(array(
            'RESIZE' => 'Y',
            'FILE_VALUE' => $arFile,
            //'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            'WIDTH' => 721,
            'HEIGHT' => 5000,
            'DEFAULT_ALT_TITLE' => $arItem['NAME'],
            'QUALITY' => false,
        ));
        $arItem['BACKGROUND_720'] = $arResultLocal['PICTURE']['SRC'];

        $arResultLocal = BitrixTools::getImageFormatted(array(
            'RESIZE' => 'Y',
            'FILE_VALUE' => $arFile,
            //'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            'WIDTH' => 901,
            'HEIGHT' => 5000,
            'DEFAULT_ALT_TITLE' => $arItem['NAME'],
            'QUALITY' => false,
        ));
        $arItem['BACKGROUND_900'] = $arResultLocal['PICTURE']['SRC'];

        $arResultLocal = BitrixTools::getImageFormatted(array(
            'RESIZE' => 'Y',
            'FILE_VALUE' => $arFile,
            //'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            'WIDTH' => 1081,
            'HEIGHT' => 5000,
            'DEFAULT_ALT_TITLE' => $arItem['NAME'],
            'QUALITY' => false,
        ));
        $arItem['BACKGROUND_1080'] = $arResultLocal['PICTURE']['SRC'];
    }
}

$this->__component->SetResultCacheKeys(array("ITEMS"));
