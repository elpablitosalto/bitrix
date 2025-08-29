<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$arResult = array();
$arResult['PURCHASED'] = 'N';
$materialId = $_POST['materialId'];

$USER_ID = $USER->GetID();
if (!empty($USER_ID) && !empty($materialId)) {
    $deal = new Deal();
    $arOrders = $deal->getMyOrderList(false);
    if (!empty($arOrders[$materialId])) {
        $arResult['PURCHASED'] = 'Y';
    }
}
echo json_encode($arResult);

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
