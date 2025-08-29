<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    use \Bitrix\Main\Loader;

    Loader::includeModule('iblock');
    $arFilter = [
        'IBLOCK_ID' => CATALOG,
        'ACTIVE' => 'Y',
        'GLOBAL_ACTIVE' => 'Y'
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
            $res['SECTION_PAGE_URL'],
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


//global $USER;
//if ($USER->IsAdmin()){
// Переместить Сотрудничество перед Коллекции № 41428 (Изменено в рамках задачи "Исчезли разделы Biotin Sectrets и Top Secrets № 41723")
    if (is_array($aMenuLinks)) {
        foreach ($aMenuLinks as $key => $val){
            if (is_array($val)){
                if ($val[0] == "Сотрудничество"){
                    $movedIndex = $key;
                } else if ($val[0] == "Коллекции") {
                    $prepIndex = $key;
                }
            }
        }
    }

    if ($movedIndex > $prepIndex) {
        $movedElement = array_splice($aMenuLinks, $movedIndex);
        array_splice($aMenuLinks, $prepIndex, 0, $movedElement);
    } else {
        array_splice($aMenuLinks, $prepIndex, 0, $aMenuLinks[$movedIndex]);
        $movedElement = array_splice($aMenuLinks, $movedIndex);
    }
//}

    //p($aMenuLinks);
?>