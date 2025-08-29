<?

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;

Loader::includeModule("iblock");

$dbParentProduct = CIBlockElement::GetList([], ['ID' => $_POST['product'], 'IBLOCK_ID' => CATALOG], false, false, [
    'ID', 'IBLOCK_ID', 'PROPERTY_COMMON_LINK'
]);

if ($arParentProduct = $dbParentProduct->Fetch()) {
    $skuLink = $arParentProduct['PROPERTY_COMMON_LINK_VALUE'];
}

$arSelect = [
    'ID',
    'NAME',
    'PROPERTY_COLOR',
    'PROPERTY_VOLUME',
    'PROPERTY_LINK'
];

if ($_REQUEST['palette'] == '' || (is_numeric($_REQUEST['palette']) && $_REQUEST['palette'] == 0)) unset($_REQUEST['palette']);


$arFilter = [
    'IBLOCK_ID' => CATALOG_SKU,
    'ACTIVE' => 'Y'
];
$arFilter['PROPERTY_PARENT_PRODUCT'] = $_POST['product'];
if ($_REQUEST['volume']) {
    $arFilter['PROPERTY_VOLUME'] = $_REQUEST['volume'];
}
$obj = CIBlockElement::GetList(false, $arFilter, false, false, $arSelect);
while ($res = $obj->GetNext()) {
    $colors[] = $res['PROPERTY_COLOR_VALUE'];
}

$arFilter = [
    'IBLOCK_ID' => CATALOG_SKU,
    'ACTIVE' => 'Y'
];
$arFilter['PROPERTY_PARENT_PRODUCT'] = $_POST['product'];
if ($_REQUEST['palette']) {
    $arFilter['PROPERTY_COLOR'] = $_REQUEST['palette'];
}

$obj = CIBlockElement::GetList(false, $arFilter, false, false, $arSelect);
while ($res = $obj->GetNext()) {
    $volumes[] = $res['PROPERTY_VOLUME_VALUE'];
}

$arFilter = [
    'IBLOCK_ID' => CATALOG_SKU,
    'ACTIVE' => 'Y'
];
$arFilter['PROPERTY_PARENT_PRODUCT'] = $_POST['product'];
if (isset($_REQUEST['volume'])) {
    $bFindSKU = false;
    $arFilter['PROPERTY_VOLUME'] = $_REQUEST['volume'];
    $arFilter['PROPERTY_COLOR'] = $_REQUEST['palette'];
    $obj = CIBlockElement::GetList(false, $arFilter, false, false, $arSelect);
    if ($res = $obj->GetNext()) {
        $bFindSKU = true;
        /*
        if ($res['PROPERTY_LINK_VALUE']) {
            $skuLink = $res['PROPERTY_LINK_VALUE'];
        }
        */
        /*$volumes[] = $res['PROPERTY_VOLUME_VALUE'];
        $colors[] = $res['PROPERTY_COLOR_VALUE'];*/
    }

    //if (!empty($skuLink)) {
    if( $bFindSKU ){    
        $result['STATUS'] = 'Y';
        $result['TYPE'] = 'SKU';
        $result['VOLUMES'] = $volumes;
        $result['COLORS'] = $colors;
        $result['LINK'] = $skuLink;
    } else {
        $result['STATUS'] = 'N';
        $result['MESSAGE'] = 'Такого товара не существует';
    }
} else if (isset($_REQUEST['volume'])) {
    $arFilter['PROPERTY_VOLUME'] = $_REQUEST['volume'];
    $obj = CIBlockElement::GetList(false, $arFilter, false, false, $arSelect);
    while ($res = $obj->GetNext()) {
        $propArray[] = $res['PROPERTY_COLOR_VALUE'];
    }
    if (!empty($propArray)) {
        $result['STATUS'] = 'Y';
        $result['TYPE'] = 'palette';
        $result['ITEMS'] = $propArray;
    } else {
        $result['STATUS'] = 'N';
        $result['MESSAGE'] = 'Такого товара не существует';
    }
} else {
    $arFilter['PROPERTY_COLOR'] = $_REQUEST['palette'];
    $obj = CIBlockElement::GetList(false, $arFilter, false, false, $arSelect);
    while ($res = $obj->GetNext()) {
        $propArray[] = $res['PROPERTY_VOLUME_VALUE'];
    }
    if (!empty($propArray)) {
        $result['STATUS'] = 'Y';
        $result['TYPE'] = 'volume';
        $result['ITEMS'] = $propArray;
    } else {
        $result['STATUS'] = 'N';
        $result['MESSAGE'] = 'Такого товара не существует';
    }
}
echo json_encode($result);
