<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
Loader::includeModule('iblock');

$res = CIBlockElement::GetList(['SORT' => 'ASC'], [
    'IBLOCK_ID' => Indexis::getIblockId('history_our_clients', 'content'),
    'ACTIVE_DATE' => 'Y',
    'ACTIVE' => 'Y',
], false, ['nPageSize' => 1], [
    'ID'
]);

$arResult['HAS_HISTORY'] = ($res->SelectedRowsCount() > 0);
?>