<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @var CMain $APPLICATION */
/** @var CUser $USER */
/** @var CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div
	class="attention-panel article__attention-panel"
	<?if(!empty($arParams["BACKGROUND_COLOR"])):?>style="background: <?=$arParams["BACKGROUND_COLOR"]?>;"<?endif;?>
>
	<div class="attention-panel__main">
		<?if(!empty($arParams["TITLE"])):?>
			<div class="attention-panel__title"><?=$arParams["TITLE"]?></div>
		<?endif;?>

		<?if(!empty($arParams["DESCRIPTION"])):?>
			<div class="attention-panel__text"><?=$arParams["DESCRIPTION"]?></div>
		<?endif;?>

		<?if(!empty($arParams["WEB_FORM_ID"])):?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:form.result.new",
				"subscribe",
				Array(
					"SEF_MODE" => "Y",
					"WEB_FORM_ID" => $arParams["WEB_FORM_ID"],
					"SUCCESS_URL" => "",
					"CHAIN_ITEM_TEXT" => "",
					"CHAIN_ITEM_LINK" => "",
					"IGNORE_CUSTOM_TEMPLATE" => "Y",
					"USE_EXTENDED_ERRORS" => "Y",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600",
					"DO_NOT_REDIRECT" => "Y",
					"COMPONENT_TEMPLATE" => "subscribe",
					"SEF_FOLDER" => "",
					"LIST_URL" => "result_list.php",
					"EDIT_URL" => "result_edit.php",
					"PLACEHOLDER" => $arParams["PLACEHOLDER"],
					"BUTTON_TEXT" => $arParams["BUTTON_TEXT"],
					"POLICY_FULL_TEXT" => $arParams["POLICY_FULL_TEXT"],
					"NAME" => $arParams["TITLE"],
					"FORM_ID" => $arParams["FORM_ID"],
					"FORM_TYPE" => $arParams["FORM_TYPE"],
					"FORM_CALLBACK_ID" => $arParams["FORM_CALLBACK_ID"]
				),
				false
			);
			?>
		<?else:?>
			Не передан ID формы
		<?endif;?>
	</div>
	<?if(!empty($arParams["IMAGE"])):?>
		<div class="attention-panel__illustration">
			<picture class="attention-panel__picture">
				<img src="<?=$arParams["IMAGE"]?>" alt="<?=$arParams["TITLE"]?>" class="attention-panel__image" title="">
       </picture>
		</div>
	<?endif;?>
</div>
<div class="modal " id="subscribe_form_<?=$arParams["FORM_ID"]?>_success">
	<div class="modal__content">
		<?if(!empty($arParams["SUCCESS_TITLE"])):?>
			<div class="modal__title">
				<!-- begin .title-->
				<h2 class="title title_size_h2"><span class="highlight"><?=$arParams["SUCCESS_TITLE"]?></span></h2>
				<!-- end .title-->
			</div>
		<?endif;?>
		<?if(!empty($arParams["SUCCESS_DESCRIPTION"])):?>
			<div class="modal__text">
				<span class="modal__highlight"><?=$arParams["SUCCESS_DESCRIPTION"]?></span>
			</div>
		<?endif;?>
	</div>
</div>
<div class="modal " id="subscribe_form_<?=$arParams["FORM_ID"]?>_error">
	<div class="modal__content">
		<?if(!empty($arParams["ERROR_TITLE"])):?>
			<div class="modal__title">
				<!-- begin .title-->
				<h2 class="title title_size_h2"><span class="highlight"><?=$arParams["ERROR_TITLE"]?></span></h2>
				<!-- end .title-->
			</div>
		<?endif;?>
		<?if(!empty($arParams["ERROR_DESCRIPTION"])):?>
			<div class="modal__text">
				<span class="modal__highlight"><?=$arParams["ERROR_DESCRIPTION"]?></span>
			</div>
		<?endif;?>
	</div>
</div>