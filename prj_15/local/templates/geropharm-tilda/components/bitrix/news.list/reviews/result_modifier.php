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

    // Текст отзыва -->
    $arItem['REVIEW_PREVIEW_TEXT'] = strip_tags($arItem['PREVIEW_TEXT']);
    $arItem['REVIEW_DETAIL_TEXT'] = $arItem['PREVIEW_TEXT'];
    if (mb_strlen($arItem['REVIEW_PREVIEW_TEXT']) > 234) {
        $arItem['REVIEW_PREVIEW_TEXT'] = TruncateText($arItem['REVIEW_PREVIEW_TEXT'], 234);
        $arItem['SHOW_MORE'] = 'Y';
    }
    // <-- Текст отзыва
}
