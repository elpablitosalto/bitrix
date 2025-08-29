<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/inputmask/jquery.inputmask.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.validate/jquery.validate.min.js");
$GLOBALS["APPLICATION"]->AddHeadString('<script async src="https://www.google.com/recaptcha/api.js?render='.RECAPTCHA_3_SITE_KEY.'"></script>');
?>
<?/*?>
<?global $USER;?>
<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("form-block".$arParams["WEB_FORM_ID"]);?>
<?if($USER->IsAuthorized()):?>
	<?
	$dbRes = CUser::GetList(($by = "id"), ($order = "asc"), array("ID" => $USER->GetID()), array("FIELDS" => array("ID", "PERSONAL_PHONE")));
	$arUser = $dbRes->Fetch();
	?>
	<script type="text/javascript">
	$(document).ready(function() {
		try{
			$('.form.<?=$arResult["arForm"]["SID"]?> input[data-sid=CLIENT_NAME], .form.<?=$arResult["arForm"]["SID"]?> input[data-sid=FIO], .form.<?=$arResult["arForm"]["SID"]?> input[data-sid=NAME]').val('<?=$USER->GetFullName()?>');
			$('.form.<?=$arResult["arForm"]["SID"]?> input[data-sid=PHONE]').val('<?=$arUser['PERSONAL_PHONE']?>');
			$('.form.<?=$arResult["arForm"]["SID"]?> input[data-sid=EMAIL]').val('<?=$USER->GetEmail()?>');
		}
		catch(e){
		}
	});
	</script>
<?endif;?>
<script type="text/javascript">
$(document).ready(function() {
	$('.form.<?=$arResult["arForm"]["SID"]?> input[data-sid="PRODUCT_NAME"]').attr('value', $('h1').text());
});
</script>
<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("form-block".$arParams["WEB_FORM_ID"], "");?>
<?*/?>