<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$arResult = array();

$arResult['TYPE'] = 'NO';

if (!$USER->IsAuthorized()) {
    $arResult['TYPE'] = 'NEED_AUTH';
}

echo json_encode($arResult);

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
