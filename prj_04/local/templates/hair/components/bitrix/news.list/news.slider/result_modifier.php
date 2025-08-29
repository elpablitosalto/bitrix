<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $USER;
$userGroups = $USER->isAuthorized() ? $USER->GetUserGroupArray() : [];
//print_r($arParams);
$arResult['SECTIONS']['all']['TITLE'] = 'Все ' . mb_strtolower($arParams['PAGER_TITLE']);
$sectionsTitles = [
    MASTER => [
        'CODE' => 'masters',
        'TITLE' => 'Новости для мастеров',
    ],
    TECH => [
        'CODE' => 'techs',
        'TITLE' => 'Новости для технологов',
    ],
    DISTRIBUTOR => [
        'CODE' => 'distributors',
        'TITLE' => 'Новости для дистрибьюторов'
    ]
];
foreach ($arResult['ITEMS'] as $k => &$arItem):
    if (empty($arItem['PROPERTIES']['USER_GROUP_ID']['VALUE'])) {
        $arItem['PROPERTIES']['USER_GROUP_ID']['VALUE'] = [];
    }
    $newsUserGroup = array_intersect($userGroups, $arItem['PROPERTIES']['USER_GROUP_ID']['VALUE']);
    if (!empty($newsUserGroup)) {
        foreach ($newsUserGroup as $groupID):
            $arResult['SECTIONS'][$sectionsTitles[$groupID]['CODE']]['TITLE'] = $sectionsTitles[$groupID]['TITLE'];
            $arResult['SECTIONS'][$sectionsTitles[$groupID]['CODE']]['ID'] = $groupID;
            $arItem['SECTION']['CODE'] = $sectionsTitles[$groupID]['CODE'];
        endforeach;
    } else if (!empty($arItem['PROPERTIES']['USER_GROUP_ID']['VALUE']) && !$USER->isAuthorized()) {
        $arItem['SECTION']['CODE'] = 'hidden';
    }
endforeach;


// Заменить URL -->
foreach ($arResult['ITEMS'] as $k => &$arItem) {
    if (!empty($arItem['PROPERTIES']['EXT_LINK']['VALUE'])) {
        $arItem['DETAIL_PAGE_URL'] = $arItem['PROPERTIES']['EXT_LINK']['VALUE'];
    }
}
// <--