<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem) {
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['PICTURE'] = $arResultLocal['PICTURE'];
}

// Хлебные крошки -->
$arResult['NAV_CHAINS'] = array();
foreach ($arResult["ITEMS"] as &$arItem) {
    if (!empty($arItem['IBLOCK_SECTION_ID'])) {
        $list = CIBlockSection::GetNavChain(false, $arItem['IBLOCK_SECTION_ID'], array(), true);
        $i = 0;
        $sectionPageUrl = '';
        $chain = '';
        foreach ($list as $arSectionPath) {
            if ($i > 0) {
                $chain .= '/';
            }
            $chain .= $arSectionPath['CODE'];
            $sectionPageUrl = str_replace('#SECTION_CODE_PATH#', $chain, $arSectionPath['SECTION_PAGE_URL']);
            $arResult['NAV_CHAINS'][$arItem['IBLOCK_SECTION_ID']][$arSectionPath['ID']]['SECTION_PAGE_URL'] = $sectionPageUrl;
            $arResult['NAV_CHAINS'][$arItem['IBLOCK_SECTION_ID']][$arSectionPath['ID']]['NAME'] = $arSectionPath['NAME'];
            $i++;
        }
        $arItem['DETAIL_PAGE_URL'] = $sectionPageUrl . '#model-bank-line-1-bnk' . $arItem['ID'];
    }
}
// <-- Хлебные крошки
