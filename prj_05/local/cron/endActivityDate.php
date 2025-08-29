<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
Loader::includeModule("iblock");

$filter = [
    'IBLOCK_ID' => EVENTS,
    'ACTIVE' => 'Y',
    '<=DATE_ACTIVE_TO' => date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), mktime()),
    'PROPERTY_STATUS' => false
];
$obj = CIBlockElement::GetList(false,$filter);

while($res = $obj->GetNext()) {
    $el = new \CIBlockElement;
    $id = $el->SetPropertyValuesEx($res['ID'],EVENTS,['STATUS' => 29]); //присваиваем статус Завершен
    if($id):
        $arResult['STATUS'] = 'Y';
        $arResult['TYPE'] = 'success';
        $arResult['MESSAGE'] = 'Данные успешно изменены!';
    else:
        $arResult['STATUS'] = 'N';
        $arResult['TYPE'] = 'error';
        $arResult['MESSAGE'] = $el->LAST_ERROR;
    endif;
}

