<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

$arComponentParameters = [
	'GROUPS' => [],
	'PARAMETERS' => [
        'USER_ID' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('BONUS_MANAGE_USER_ID'),
            'TYPE' => 'STRING',
        ]
    ]
];
?>