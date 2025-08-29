<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;

use Hair\General;
use Hair\Geo;

Loader::includeModule("iblock");
Loader::includeModule("user");
$geo = new Geo();

//$obj = CIBlockSection::GetList(false,['IBLOCK_ID' => SALONS, 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1],false,['ID','CODE','NAME']);
//$regionsVoc = [];
//while($res = $obj->GetNext()) {
//    if(!empty($res['CODE']))
//        $regionsVoc[$res['ID']]['CODE'] = $res['CODE'];
//        $regionsVoc[$res['ID']]['NAME'] = $res['NAME'];
//}
//
//$codeToIDs = [];
//
//$dbSections = CIBlockSection::GetList([], ['IBLOCK_ID'=>SALONS, 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE' => 'Y'], false, ['ID', 'CODE']);
//
//while($arSection = $dbSections->Fetch())
//{
//    $codeToIDs[$arSection['CODE']] = $arSection['ID'];
//}
//
//$obj = CUser::GetList(($by="id"), ($order="desc"), ['GROUPS_ID' => [DISTRIBUTOR],'ACTIVE' => 'Y'],['SELECT' => ['UF_REGION']]); // выбираем пользователей
//while($res = $obj->GetNext()) {
//
//    foreach($res['UF_REGION'] as $regionCode)
//    {
//        $list = CIBlockSection::GetNavChain(SALONS,$codeToIDs[$regionCode], array(), true);
//        $topSection = $list[0]['ID'];
//        $arResult['REGIONS'][] = $regionsVoc[$topSection]['CODE'];
//        $arResult['DISTRIBUTORS'][$regionsVoc[$topSection]['CODE']]['regionName'] = $regionsVoc[$topSection]['NAME'];
//        $arResult['DISTRIBUTORS'][$regionsVoc[$topSection]['CODE']]['cnt'] += 1;
//        $arResult['DISTRIBUTORS'][$regionsVoc[$topSection]['CODE']]['items'][$res['ID']]['name'] = $res['WORK_COMPANY'];
//        $arResult['DISTRIBUTORS'][$regionsVoc[$topSection]['CODE']]['items'][$res['ID']]['phone'] = (!empty($res['WORK_PHONE'])) ? $res['WORK_PHONE'] : $res['PERSONAL_PHONE'];
//        $arResult['DISTRIBUTORS'][$regionsVoc[$topSection]['CODE']]['items'][$res['ID']]['email'] = $res['EMAIL'];
//
//        if($res['WORK_WWW'])
//        {
//            $res['WORK_WWW'] = preg_replace('#(^.*?:\/\/|\/)#is', '', $res['WORK_WWW']);
//            $arResult['DISTRIBUTORS'][$regionsVoc[$topSection]['CODE']]['items'][$res['ID']]['url'] = 'http://'.$res['WORK_WWW'];
//            $arResult['DISTRIBUTORS'][$regionsVoc[$topSection]['CODE']]['items'][$res['ID']]['site'] = $res['WORK_WWW'];
//        }
//        else
//        {
//            $arResult['DISTRIBUTORS'][$regionsVoc[$topSection]['CODE']]['items'][$res['ID']]['url'] = '';
//            $arResult['DISTRIBUTORS'][$regionsVoc[$topSection]['CODE']]['items'][$res['ID']]['site'] = '';
//        }
//    }
//}
// echo json_encode(DISTRIBUTOR);
// die();
$obj = CIBlockSection::GetList(false,['IBLOCK_ID' => SALONS, 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1],false,['ID','CODE','NAME']);
$regionsVoc = [];
while($res = $obj->GetNext()) {
    if(!empty($res['CODE']))
        $regionsVoc[$res['ID']]['CODE'] = mb_strtoupper($res['CODE']);
    $regionsVoc[$res['ID']]['NAME'] = $res['NAME'];
}
$obj2 = CIBlockSection::GetList(false,['IBLOCK_ID' => SALONS, 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 2],false,['ID','CODE','NAME']);
while($res = $obj2->GetNext()) {
    if(!empty($res['CODE']))
        $regionsVoc[$res['ID']]['CODE'] = mb_strtoupper($res['CODE']);
    $regionsVoc[$res['ID']]['NAME'] = $res['NAME'];
};
//Добавил города в массив регионов
$codeToIDs = [];
$dbSections = CIBlockSection::GetList([], ['IBLOCK_ID'=>SALONS, 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE' => 'Y'], false, ['ID', 'CODE']);
while($arSection = $dbSections->Fetch())
{
    $codeToIDs[mb_strtoupper($arSection['CODE'])] = $arSection['ID'];
}
$obj = CUser::GetList(($by="id"), ($order="desc"), ['GROUPS_ID' => [DISTRIBUTOR],'ACTIVE' => 'Y'],['SELECT' => ['UF_REGION']]); // выбираем пользователей
while($res = $obj->GetNext()) {
    foreach($res['UF_REGION'] as $regionCode)
    {
        $list = CIBlockSection::GetNavChain(SALONS,$codeToIDs[mb_strtoupper($regionCode)], array(), true);
        foreach ($list as $item){
            $topSection = $list[0]['ID'];
            $arResult['REGIONS'][] = $regionsVoc[$item['ID']]['CODE'];
            $arResult['DISTRIBUTORS'][$regionsVoc[$item['ID']]['CODE']]['regionName'] = $regionsVoc[$item['ID']]['NAME'];
//        p($topSection);
//        p($regionsVoc[$topSection]['NAME']);
            $arResult['DISTRIBUTORS'][$regionsVoc[$item['ID']]['CODE']]['cnt'] += 1;
            $arResult['DISTRIBUTORS'][$regionsVoc[$item['ID']]['CODE']]['items'][$res['ID']]['name'] = $res['WORK_COMPANY'];
            $arResult['DISTRIBUTORS'][$regionsVoc[$item['ID']]['CODE']]['items'][$res['ID']]['phone'] = (!empty($res['WORK_PHONE'])) ? $res['WORK_PHONE'] : $res['PERSONAL_PHONE'];
            $arResult['DISTRIBUTORS'][$regionsVoc[$item['ID']]['CODE']]['items'][$res['ID']]['email'] = $res['EMAIL'];

            if($res['WORK_WWW'])
            {
                $res['WORK_WWW'] = preg_replace('#(^.*?:\/\/|\/)#is', '', $res['WORK_WWW']);
                $arResult['DISTRIBUTORS'][$regionsVoc[$item['ID']]['CODE']]['items'][$res['ID']]['url'] = 'http://'.$res['WORK_WWW'];
                $arResult['DISTRIBUTORS'][$regionsVoc[$item['ID']]['CODE']]['items'][$res['ID']]['site'] = $res['WORK_WWW'];
            }
            else
            {
                $arResult['DISTRIBUTORS'][$regionsVoc[$item['ID']]['CODE']]['items'][$res['ID']]['url'] = '';
                $arResult['DISTRIBUTORS'][$regionsVoc[$item['ID']]['CODE']]['items'][$res['ID']]['site'] = '';
            }
        }
    }
}

if($_POST['TYPE'] == 'regions'):
    echo json_encode($arResult['REGIONS']);
elseif($_POST['TYPE'] == 'distributors'):
    if (!$_POST['CODE']) {
        echo json_encode($arResult['DISTRIBUTORS']);
    } else {
        echo json_encode($arResult['DISTRIBUTORS'][$_POST['CODE']]);
    }
elseif($_POST['TYPE'] == 'namequery'):
    $filteredRegions = [];
    foreach ($arResult['DISTRIBUTORS'] as $itemID=>$item) {
        if (stripos(mb_strtolower($item['regionName'], 'UTF-8'), mb_strtolower($_POST['NAME'], 'UTF-8')) !== false) {
            $filteredRegions[$itemID] = $item['regionName'];
        }
    }
    echo json_encode($filteredRegions);
endif;