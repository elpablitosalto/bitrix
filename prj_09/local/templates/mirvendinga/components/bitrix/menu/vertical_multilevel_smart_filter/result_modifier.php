<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$previousLevel = 0;
$arParentIds = [];
foreach ($arResult as &$arItem) {

    $arItem['EXPANDED'] = false;

    $arCheckBoxInParams = $arParams['FILTER_ITEMS']['VALUES'][$arItem['PARAMS']['SECTION_ID']];

    if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
        $arParentIds = [];
    }

    if ($arItem["IS_PARENT"]) {
        $arParentIds[] = $arItem['PARAMS']['SECTION_ID'];
    }

    if ($arCheckBoxInParams['CHECKED'] || $arParams['SECTION_ID'] == $arItem["PARAMS"]["SECTION_ID"]) {
        $arItem['EXPANDED'] = true;
        $arItem['PARENTS'] = $arParentIds;
    }

    $previousLevel = $arItem["DEPTH_LEVEL"];
}

$arParentCheckedIds = [];
foreach ($arResult as &$arItem) {
    if (is_array($arItem['PARENTS'])) {
        $arParentCheckedIds = array_merge($arParentCheckedIds, $arItem['PARENTS']);
    }
}

foreach ($arResult as &$arItem) {
    $sectionId = $arItem['PARAMS']['SECTION_ID'];
    if (in_array($sectionId, $arParentCheckedIds)) {
        $arItem['EXPANDED'] = true;
    }
}

$checkedChild = false;
$checkedChildParentDepthLevel = false;
$previousLevel = 0;

// -->
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$arGet = $request->getQueryList()->toArray(); // массив get параметров
$arPost = $request->getPostList()->toArray(); // массив post параметров
//vardump($arPost);
$ajaxCallApplyFilter = 'N';
$page = $APPLICATION->GetCurPage(false);
//if ($arGet['AJAX_CALL'] == 'Y' || $arPost['AJAX_CALL'] == 'Y' || $_POST['AJAX_CALL'] == 'Y' || $_GET['AJAX_CALL'] == 'Y') {
if( !empty( $arGet['bxajaxid'] ) || strpos( $page, '/filter/' ) !== false ){
    $ajaxCallApplyFilter = 'Y';
}
// <--

foreach ($arResult as &$arItem) {

    //vardump($arItem);

    $arCheckBoxInParams = $arParams['FILTER_ITEMS']['VALUES'][$arItem['PARAMS']['SECTION_ID']];
    if (!is_array($arCheckBoxInParams)) {
        $checkboxName = rand(0, 1000);
        $arCheckBoxParams = array(
            'name' => $checkboxName,
            'value' => 'N',
            'id' => $checkboxName,
            'checked' => false,
            'disabled' => true,
            'expanded' => $arItem["EXPANDED"],
        );
    } else {
        $arCheckBoxParams = array(
            'name' => $arCheckBoxInParams['CONTROL_NAME'],
            'value' => $arCheckBoxInParams['HTML_VALUE'],
            'id' => $arCheckBoxInParams['CONTROL_ID'],
            'checked' => $arCheckBoxInParams['CHECKED'],
            'disabled' => $arCheckBoxInParams['DISABLED'],
            'tickedPartially' => $arCheckBoxInParams['CHECKED'],
            'expanded' => $arItem["EXPANDED"],
            'ajaxCall' => $ajaxCallApplyFilter,
        );
    }

    // Отметить нижестоящие разделы -->
    if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel && $checkedChildParentDepthLevel == $arItem["DEPTH_LEVEL"]) {
        $checkedChild = false;
    }

    if ($arParams['SECTION_ID'] == $arItem["PARAMS"]["SECTION_ID"]) {
        $flag = true;
        if ($ajaxCallApplyFilter == 'Y' && $arCheckBoxInParams['CHECKED'] != true) {
            $flag = false;
        }
        if ($flag == true) {
            $arCheckBoxParams['tickedPartially'] = true;
            $arCheckBoxParams['checked'] = true;
        }
        if ($arItem["IS_PARENT"]) {
            $checkedChild = true;
            $checkedChildParentDepthLevel = $arItem["DEPTH_LEVEL"];
        }
    }
    if ($checkedChild == true) {
        $flag = true;
        if ($ajaxCallApplyFilter == 'Y' && $arCheckBoxInParams['CHECKED'] != true) {
            $flag = false;
        }
        if ($flag == true) {
            $arCheckBoxParams['tickedPartially'] = true;
            $arCheckBoxParams['checked'] = true;
        }
        $arCheckBoxParams['expanded'] = true;
    }
    // <-- Отметить нижестоящие разделы

    $arItem['arCheckBoxParams'] = $arCheckBoxParams;

    $previousLevel = $arItem["DEPTH_LEVEL"];
}
