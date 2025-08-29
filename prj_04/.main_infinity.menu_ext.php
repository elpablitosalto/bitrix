<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use \Bitrix\Main\Loader;

Loader::includeModule('iblock');
$arFilter = [
    'IBLOCK_ID' => INFINITY_CATALOG_IB_ID,
    'ACTIVE' => 'Y',
    'GLOBAL_ACTIVE' => 'Y',
    '<=DEPTH_LEVEL' => 2
];
$arSelect = ['ID','IBOCK_ID','NAME','CODE','SECTION_PAGE_URL','DEPTH_LEVEL','IBLOCK_SECTION_ID'];
$obj = CIBlockSection::GetList(['left_margin' => 'ASC', 'sort'=>'ASC'],$arFilter,false,$arSelect);
$aMenuLinksExt = [];
while($res = $obj->GetNext()) {
    $arParams = [];
    $arParams['ITEM_ID'] = $res['ID'];
    if(!empty($res['IBLOCK_SECTION_ID']))
        $arParams['PARENT_SECTION_ID'] = $res['IBLOCK_SECTION_ID'];

    $aMenuLinksExt[] = array(
        $res['NAME'],
        $res["DEPTH_LEVEL"] > 1 ? $res['SECTION_PAGE_URL'] : "",
        array(), //массив доп ссылок
        $arParams
    );
}
$aMenuLinksExt[] = array(
    "Сотрудничество",
    "/about/partnership/",
    array(), //массив доп ссылок
    ["ITEM_ID" => 999]
);
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);