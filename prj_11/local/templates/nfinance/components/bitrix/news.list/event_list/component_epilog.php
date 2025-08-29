<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$arGet = $request->getQueryList()->toArray(); // массив get параметров

if ($arGet['our_events'] == 'Y') {
?>
    <input type="hidden" value="Y" class="js_our_events" />
<?
}
