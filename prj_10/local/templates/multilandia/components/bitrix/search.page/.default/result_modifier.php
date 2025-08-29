<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arResult['TAB'] = [
    'movies' => [],
    'contests' => [],
    'about' => [],
    'partners' => []
];

foreach ($arResult['SEARCH'] as $arSearch) {
    if ($arSearch['MODULE_ID'] == 'iblock') {
        if (isset($arResult['TAB'][$arSearch['PARAM1']]))
            $arResult['TAB'][$arSearch['PARAM1']][] = $arSearch['ITEM_ID'];
    } else if ($arSearch['MODULE_ID'] == 'main') {

        $arUrlParts = array_values(array_filter(explode('/', $arSearch['URL'])));

        if (isset($arResult['TAB'][$arUrlParts[0]])) {
            $arResult['TAB'][$arUrlParts[0]][] = [
                'URL' => str_replace('content.php', '', $arSearch['URL']),
                'TITLE_FORMATED' => $arSearch['TITLE_FORMATED'],
                'BODY_FORMATED' => $arSearch['BODY_FORMATED'],
            ];
        }
    }
}
?>