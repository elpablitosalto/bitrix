<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], '=CODE' => $arParams["PARENT_SECTION_CODE"]);
$rsSections = CIBlockSection::GetList(array('ID' => 'ASC'), $arFilter, false, ["NAME", "DESCRIPTION", "UF_REFRESH_IMAGES"]);
$arResult["SECTION"] = $rsSections->Fetch();

// Числа -->
$arResult['arNumbers'] = array();
$IBLOCK_ID = Indexis::getIblockId("numbers_home_page", "content");
if (intval($IBLOCK_ID) > 0) {
    //$arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
    $arSelect = false;
    $arFilter = array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array('sort' => 'asc'), $arFilter, false, array("nPageSize" => 4), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arFields['PROPERTIES'] = $ob->GetProperties();

        $templates = array();
        foreach ($arFields['PROPERTIES']['TEMPLATES']['VALUE'] as $key => $val) {
            $templates[] = '<span class="dp-feature-stat__number">#NUM#</span><span class="dp-feature-stat__cat">' . $val . '</span>';
        }

        $texts = array();
        foreach ($arFields['PROPERTIES']['TEXT']['VALUE'] as $key => $val) {
            $texts[] = $val;
        }

        $arItem = array(
            'NUMBER' => $arFields['PROPERTIES']['NUMBER']['VALUE'],
            'TEMPLATES' => $templates,
            //'TEXT' => $arFields['PROPERTIES']['TEXT']['VALUE'],
        );

        $arItem['TEXT'] = Indexis::num2wordStr(
            $arItem['NUMBER'],
            $texts
        );

        $arItem['NUMBER_FORMAT'] = number_format($arItem['NUMBER'], 0, '', ' ');

        $arItem['STR_WITH_NUM'] = Indexis::num2wordStr(
            $arItem['NUMBER'],
            $arItem['TEMPLATES']
        );

        $arItem['STR_WITH_NUM'] = preg_replace(
            '/<span class="dp-feature-stat__number">.+?<\/span>/', 
            '<span class="dp-feature-stat__number">'.$arItem['NUMBER_FORMAT'].'</span>', 
            $arItem['STR_WITH_NUM']
        );

        $arResult['arNumbers'][] = $arItem;
    }
}
// <-- Числа
