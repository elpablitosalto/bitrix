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
	class="modal"
	id="<?=$arParams["MODAL_ID"]?>"
	<?if(!empty($arParams["BACKGROUND_COLOR"])):?>style="background: <?=$arParams["BACKGROUND_COLOR"]?>;"<?endif;?>
>
	<div class="modal__header">
		<?if(!empty($arParams["TITLE_HIGHLIGHT"])):?>
			<div class="modal__highlight">
				<h3 class="title title_size_h3 title_style_primary title_style_bold">
					<?=htmlspecialchars_decode($arParams["TITLE_HIGHLIGHT"])?>
				</h3>
			</div>
		<?endif;?>
		<?if(!empty($arParams["TITLE"])):?>
			<div class="modal__title">
				<h3 class="title title_size_h3 title_style_bold">
					<?=htmlspecialchars_decode($arParams["TITLE"])?>
				</h3>
			</div>
		<?endif;?>
		<?if(!empty($arParams["DESCRIPTION"])):?>
			<div class="modal__text"><?=htmlspecialchars_decode($arParams["DESCRIPTION"])?></div>
		<?endif;?>
	</div>

	<div class="modal__content">
		<?if(!empty($arParams["WEB_FORM_ID"])):?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:form.result.new",
				".default",
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
					"COMPONENT_TEMPLATE" => ".default",
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
</div>
<div class="modal modal_width_auto" id="feedback_form_<?=$arParams["FORM_ID"]?>_success">
	<div class="modal__header">
		<?if(!empty($arParams["SUCCESS_TITLE_HIGHLIGHT"])):?>
			<div class="modal__highlight">
				<h3 class="title title_size_h3 title_style_primary title_style_bold"><?=htmlspecialchars_decode($arParams["SUCCESS_TITLE_HIGHLIGHT"])?></h3>
			</div>
		<?endif;?>
		<?if(!empty($arParams["SUCCESS_TITLE"])):?>
			<div class="modal__title">
				<h3 class="title title_size_h3 title_style_bold"><?=htmlspecialchars_decode($arParams["SUCCESS_TITLE"])?></h3>
			</div>
		<?endif;?>
	</div>
	<div class="modal__content">
		<?if(!empty($arParams["SUCCESS_DESCRIPTION"])):?>
			<div class="modal__text">
				<?=htmlspecialchars_decode($arParams["SUCCESS_DESCRIPTION"])?>
			</div>
		<?endif;?>

		<?if(!empty($arParams["SUCCESS_BUTTON_TEXT"]) && !empty($arParams["SUCCESS_BUTTON_LINK"])):?>
			<div class="modal__controls">
				<div class="modal__control">
					<!-- begin .button-->
					<a href="<?=$arParams["SUCCESS_BUTTON_LINK"]?>" class="button button_width_full">
						<span class="button__holder">
							<span class="button__text"><?=$arParams["SUCCESS_BUTTON_TEXT"]?></span>
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.3536 8.35355C14.5488 8.15829 14.5488 7.84171 14.3536 7.64645L11.1716 4.46447C10.9763 4.2692 10.6597 4.2692 10.4645 4.46447C10.2692 4.65973 10.2692 4.97631 10.4645 5.17157L13.2929 8L10.4645 10.8284C10.2692 11.0237 10.2692 11.3403 10.4645 11.5355C10.6597 11.7308 10.9763 11.7308 11.1716 11.5355L14.3536 8.35355ZM2 8.5L14 8.5L14 7.5L2 7.5L2 8.5Z" fill="white"/>
							</svg>
						</span>
					</a>
					<!-- end .button-->
				</div>
			</div>
		<?endif;?>
	</div>
</div>
<div class="modal modal_width_auto" id="feedback_form_<?=$arParams["FORM_ID"]?>_error">
	<div class="modal__header">
		<?if(!empty($arParams["ERROR_TITLE"])):?>
			<div class="modal__title">
				<?=htmlspecialchars_decode($arParams["ERROR_TITLE"])?>
			</div>
		<?endif;?>
	</div>
	<div class="modal__content">
		<?if(!empty($arParams["ERROR_DESCRIPTION"])):?>
			<div class="modal__text">
				<?=htmlspecialchars_decode($arParams["ERROR_DESCRIPTION"])?>
			</div>
		<?endif;?>
	</div>
</div>