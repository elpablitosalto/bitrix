<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

/** @var array $arResult */

?>
<a class="order_main-link" href="<?=$arResult["URL_TO_LIST"]?>"><?=GetMessage("SALE_RECORDS_LIST")?></a>
<div class="bx_my_order_cancel">
	<?php
	if($arResult["ERROR_MESSAGE"] == ''):
	?>
		<form method="post" action="<?=POST_FORM_ACTION_URI?>">
			<input type="hidden" name="CANCEL" value="Y">
			<?=bitrix_sessid_post()?>
			<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
			<?=GetMessage("SALE_CANCEL_ORDER1") ?>
			<?=GetMessage("SALE_CANCEL_ORDER2")?> #<?=$arResult["ACCOUNT_NUMBER"]?>?<br>
			<b><?= GetMessage("SALE_CANCEL_ORDER3") ?></b><br /><br />
			<?= GetMessage("SALE_CANCEL_ORDER4") ?>:<br />
			<textarea name="REASON_CANCELED" class="order__textarea"></textarea><br /><br />
			<input type="submit" name="action" value="<?=GetMessage("SALE_CANCEL_ORDER_BTN") ?>">
		</form>
	<?php
	else:
		ShowError($arResult["ERROR_MESSAGE"]);
	endif;
	?>
</div><br><br>