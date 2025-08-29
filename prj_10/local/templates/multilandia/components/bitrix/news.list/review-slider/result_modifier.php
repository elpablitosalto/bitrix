<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arUserIds = [];
$arResult['USER'] = [];
foreach($arResult["ITEMS"] as $arItem) {
    if (!empty($arItem['PROPERTIES']['USER_ID']['VALUE']) && !in_array($arItem['PROPERTIES']['USER_ID']['VALUE'], $arUserIds))
        $arUserIds[] = $arItem['PROPERTIES']['USER_ID']['VALUE'];
}

if (count($arUserIds) > 0) {
    $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), array("ID" => implode('|', $arUserIds)), array('FIELDS' => array('ID', 'NAME', 'LAST_NAME', 'LOGIN', 'PERSONAL_PHOTO')));
    while ($arUser = $rsUsers->GetNext())
        $arResult['USER'][$arUser['ID']] = $arUser;
}
?>