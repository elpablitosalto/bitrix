<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

$arComponentParameters = [
	'GROUPS' => [],
	'PARAMETERS' => [
        'USER_ID' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('BONUS_TRANSACTION_LIST_USER_ID'),
            'TYPE' => 'STRING',
        ],
        'TRANSACTION_COUNT' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('BONUS_TRANSACTION_LIST_TRANSACTION_COUNT'),
            'TYPE' => 'STRING',
        ],
    ]
];
?>