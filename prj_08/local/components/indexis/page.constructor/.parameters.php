<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc;

if(!Loader::includeModule('iblock'))
	return;

$rsSection = CIBlockSection::GetTreeList(
    array('IBLOCK_ID' => Indexis::getIblockId('pages', 'constructor'), 'ACTIVE' => 'Y'),
    array('ID', 'NAME', 'DEPTH_LEVEL')
);

$arSectionList = [
    0 => '-'
];

while ($arSection = $rsSection->Fetch()) {
    $arSectionList[$arSection['ID']] = ($arSection['DEPTH_LEVEL'] > 1) ? str_repeat('.', $arSection['DEPTH_LEVEL'] - 1) : '';
    $arSectionList[$arSection['ID']] .= $arSection['NAME'] . ' [' . $arSection['ID'] . ']';
}

$arComponentParameters = [
	'GROUPS' => [],
	'PARAMETERS' => [
        'SECTION_ID' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('INDEXIS_PAGE_CONSTRUCTOR_SECTION_ID'),
            'TYPE' => 'LIST',
            'VALUES' => $arSectionList,
        ],
		"CACHE_TIME"  =>  ["DEFAULT"=>36000000],
	],
];
?>