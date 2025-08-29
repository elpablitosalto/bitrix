<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc;

if(!Loader::includeModule('iblock'))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes();

$arIBlocks = [];
$db_iblock = CIBlock::GetList(
	['SORT' => 'ASC'], 
	['SITE_ID' => $_REQUEST['site'], 'TYPE' => ($arCurrentValues['IBLOCK_TYPE'] != '-' ? $arCurrentValues['IBLOCK_TYPE'] : '')]
);

while($arRes = $db_iblock->Fetch())
{
	$arIBlocks[$arRes['ID']] = '[' . $arRes['ID'] . '] ' . $arRes['NAME'];
}

$arProperty_LNS = [];
$rsProp = CIBlockProperty::GetList(
	['sort'=>'asc', 'name'=>'asc'], 
	['ACTIVE'=>'Y', 'IBLOCK_ID'=> (isset($arCurrentValues['IBLOCK_ID']) ? $arCurrentValues['IBLOCK_ID'] : $arCurrentValues['ID'])]
);

while ($arr = $rsProp->Fetch())
{
	$arProperty[$arr['CODE']] = '[' . $arr['CODE'] . '] ' . $arr['NAME'];
	if (in_array($arr['PROPERTY_TYPE'], ['L', 'N', 'S']))
	{
		$arProperty_LNS[$arr['CODE']] = '[' . $arr['CODE'] . '] ' . $arr['NAME'] . ($arr['IS_REQUIRED'] == 'Y' ? ' *' : '');
	}
}

$arComponentParameters = [
	'GROUPS' => [],
	'PARAMETERS' => [
		'IBLOCK_TYPE' => [
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('IBLOCK_FORM_IBLOCK_TYPE'),
			'TYPE' => 'LIST',
			'VALUES' => $arTypesEx,
			'DEFAULT' => 'forms',
			'REFRESH' => 'Y',
		],
		'IBLOCK_ID' => [
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('IBLOCK_FORM_IBLOCK_ID'),
			'TYPE' => 'LIST',
			'VALUES' => $arIBlocks,
			'DEFAULT' => '={$_REQUEST[\'ID\']}',
			'ADDITIONAL_VALUES' => 'Y',
			'REFRESH' => 'Y',
		],
		'FORM_CODE' => [
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('IBLOCK_FORM_FORM_CODE'),
			'TYPE' => 'STRING',
		],
		'EVENT_NAME' => [
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('IBLOCK_FORM_EVENT_NAME'),
			'TYPE' => 'STRING',
		],
		'BUTTON_TEXT' => [
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('IBLOCK_FORM_BUTTON_TEXT'),
			'TYPE' => 'STRING',
		],
		'PROPERTY_CODE' => [
			'PARENT' => 'DATA_SOURCE',
			'NAME' => Loc::getMessage('IBLOCK_FORM_PROPERTY_CODE'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'VALUES' => $arProperty_LNS,
			'ADDITIONAL_VALUES' => 'Y',
		],
		"CACHE_TIME"  =>  ["DEFAULT"=>36000000],
	],
];
?>