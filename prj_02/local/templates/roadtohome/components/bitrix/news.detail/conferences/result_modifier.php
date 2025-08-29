<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
\Dev2fun\Module\OpenGraph::Show($arResult['ID'],'element');

$arResult['FORM_REG_LINK'] = $arResult['DISPLAY_PROPERTIES']['FORM_REG_LINK']['VALUE'];
$arResult['SPEAKERS'] = $arResult['DISPLAY_PROPERTIES']['SPEAKERS']['VALUE'];
$arResult['PARTNERS'] = (isset($arResult["DISPLAY_PROPERTIES"]["PARTNERS"]["VALUE"]))?$arResult['DISPLAY_PROPERTIES']['PARTNERS']['VALUE']:[];
$arResult['END_REG'] = (isset($arResult["DISPLAY_PROPERTIES"]["END_REG"]["VALUE"]))?$arResult['DISPLAY_PROPERTIES']['END_REG']['VALUE']:false;

$this->__component->SetResultCacheKeys(array('FORM_REG_LINK', 'SPEAKERS', 'PARTNERS', 'END_REG'));