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
	class="subscribe-panel__wrapper"
	<?if(!empty($arParams["BACKGROUND_COLOR"])):?>style="background: <?=$arParams["BACKGROUND_COLOR"]?>;"<?endif;?>
>
	<div class="attention-panel__main">
		<div class="subscribe-panel__header">
			<?if(!empty($arParams["TITLE"])):?>
				<div class="subscribe-panel__title"><?=htmlspecialchars_decode($arParams["TITLE"])?></div>
			<?endif;?>
		</div>

		<?if(!empty($arParams["DESCRIPTION"])):?>
			<div class="attention-panel__text"><?=$arParams["DESCRIPTION"]?></div>
		<?endif;?>

		<div class="subscribe-panel__form">
			<?if(!empty($arParams["WEB_FORM_ID"])):?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:form.result.new",
					"default_subscribe",
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
						"NAME" => strip_tags(htmlspecialchars_decode($arParams["TITLE"])),
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
	</div>
	<?if(!empty($arParams["IMAGE"])):?>
		<div class="attention-panel__illustration">
			<picture class="attention-panel__picture">
				<img src="<?=$arParams["IMAGE"]?>" alt="<?=$arParams["TITLE"]?>" class="attention-panel__image" title="">
       </picture>
		</div>
	<?endif;?>
</div>
<div class="modal modal_role_subscribe" id="subscribe_form_<?=$arParams["FORM_ID"]?>_success">
	<div class="modal__check">
			<svg class="modal__icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15.4424 8.77832L9.88682 14.3339L6.55349 11.0005M11 21C5.47667 21 1 16.5233 1 11C1 5.47667 5.47667 1 11 1C16.5233 1 21 5.47667 21 11C21 16.5233 16.5233 21 11 21Z" stroke="#00CF9D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
			</svg>
	</div>
	<div class="modal__content">
		<?if(!empty($arParams["SUCCESS_TITLE"])):?>
			<div class="modal__title"><?=$arParams["SUCCESS_TITLE"]?></div>
		<?endif;?>
		<?if(!empty($arParams["SUCCESS_DESCRIPTION"])):?>
			<div class="modal__text">
				<span class="modal__highlight"><?=$arParams["SUCCESS_DESCRIPTION"]?></span>
			</div>
		<?endif;?>
	</div>
</div>
<div class="modal modal_role_subscribe" id="subscribe_form_<?=$arParams["FORM_ID"]?>_error">
	<div class="modal__check">
			<svg class="modal__icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15.4424 8.77832L9.88682 14.3339L6.55349 11.0005M11 21C5.47667 21 1 16.5233 1 11C1 5.47667 5.47667 1 11 1C16.5233 1 21 5.47667 21 11C21 16.5233 16.5233 21 11 21Z" stroke="#00CF9D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
			</svg>
	</div>
	<div class="modal__content">
		<?if(!empty($arParams["ERROR_TITLE"])):?>
			<div class="modal__title"><?=$arParams["ERROR_TITLE"]?></div>
		<?endif;?>
		<?if(!empty($arParams["ERROR_DESCRIPTION"])):?>
			<div class="modal__text">
				<span class="modal__highlight"><?=$arParams["ERROR_DESCRIPTION"]?></span>
			</div>
		<?endif;?>
	</div>
</div>