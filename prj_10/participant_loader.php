<?php
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_CHECK', true);
require_once ($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Loader;
Loader::includeModule('iblock');

$res = CIBlockElement::GetList(['ID' => 'ASC'], [
    'IBLOCK_ID' => 5,
    'ACTIVE_DATE' => 'Y',
    'ACTIVE' => 'Y',
    '!PROPERTY_TEMP_USER_ID' => false,
], false, ['nPageSize' => 500], [
    'ID', 'PROPERTY_TEMP_USER_ID'
]);

var_dump($res->SelectedRowsCount());

$arUserExtIds = [];
$arUserIds = [];

while($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arUserExtIds[$arFields['ID']] = $arFields['PROPERTY_TEMP_USER_ID_VALUE'];
}

if (count($arUserExtIds) > 0) {
    $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), ['UF_EXTERNAL_ID' => $arUserExtIds], ['FIELDS' => ['ID'], 'SELECT' => ['UF_EXTERNAL_ID']]);
    while ($arUser = $rsUsers->Fetch()){
        foreach ($arUserExtIds as $elementId => $userExtId) {
            if ($arUser['UF_EXTERNAL_ID'] == $userExtId) {
                $arUserIds[$elementId] = $arUser['ID'];
            }
        }
    }
}

if (count($arUserIds) > 0) {
    foreach ($arUserIds as $elementId => $userId) {
        CIBlockElement::SetPropertyValuesEx($elementId, false, array('USER_ID' => $userId));
        CIBlockElement::SetPropertyValuesEx($elementId, false, array('TEMP_USER_ID' => false));
    }
}
?>
<script>
    setTimeout(function() {
        location.reload();
    }, 1500);
</script>
