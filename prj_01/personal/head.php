<?
$arResultFunc = CPersonal::getHello();
if (!empty($arResultFunc['hello'])) {
    $APPLICATION->SetPageProperty("PAGE_H1", $arResultFunc['hello']);
    //echo 'hello = ' . $hello . '<br />';
    $APPLICATION->SetTitle($arResultFunc['hello']);
}
