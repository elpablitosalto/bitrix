<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказ");
?>
<div class="section__checkout">
	<?$APPLICATION->IncludeComponent(
		"waim:order",
		"",
		[],
		false
	);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>