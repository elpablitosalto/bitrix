<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>

<?
$arEventFields_2 = array(
	'EMAIL' => '89176348319@mail.ru',
);
$res = CEvent::SendImmediate("NEW_USER_PARTNER_CONFIRM", SITE_ID, $arEventFields_2);
echo $res;
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>