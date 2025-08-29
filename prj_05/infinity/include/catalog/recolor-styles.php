<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

$sectionColor = !empty($arParams['COLOR_CODE']) ? $arParams['COLOR_CODE'] : false;
if (
    empty($sectionColor)
    && !empty($arParams['COLOR_ID'])
    && Loader::includeModule("highloadblock")
) {
    $rsHighloadData = \Bitrix\Highloadblock\HighloadBlockTable::getList([
        'filter' => [
            '=NAME'=> "Color"
        ]
    ]);
    if ($arHighloadData = $rsHighloadData->fetch()) {
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHighloadData);
        $entityDataClass = $entity->getDataClass();
        $rsSectionColor = $entityDataClass::getList([
            'filter' => [
                '=ID' => intval($arParams['COLOR_ID'])
            ]
        ]);
        if($arSectionColor = $rsSectionColor->fetch()){
            $sectionColor = $arSectionColor["UF_COLOR_CODE"];
        }
    }
}
if(!empty($sectionColor)) {
    $asset = \Bitrix\Main\Page\Asset::getInstance();
    $asset->addString('<style>:root{--color-primary:'.$sectionColor.'}</style>');
}
?>