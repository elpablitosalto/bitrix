<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

$arResult = array();
$arResultFunc = CPersonal::getUser();
$arUser = $arResultFunc['arUser'];
$arResult['TYPE'] = 'NO';

if (!$arResult['arUser']['isAdmin']) {
    if (!$arUser['isAuthorized']) {
        $arResult['TYPE'] = 'NEED_AUTH';
    } else if (!$arUser['isPartner']) {
        $arResult['TYPE'] = 'NEED_PARTNER_REG';
    }
}

echo json_encode($arResult);

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
