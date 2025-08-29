<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<? if (!empty($arResult["ITEMS"])) { ?>
	<ul class="popup__order-list">
		<? foreach ($arResult["ITEMS"] as $arItem) : ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<li class="popup__order-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<div class="popup__order-cell"><? echo $arItem["NAME"] ?></div>
				<div class="popup__order-cell"><? echo $arItem["PROPERTY_NUMBER_VALUE"] ?></div>
				<div class="popup__order-cell">
					<button class="table__button js_list_minus_quantity" type="button" data-el-id="<?= $arItem['ID']; ?>" data-action="minus" data-inputidprefix="js_list_input_quantity_order_">-</button>
					<label>
						<input class="table__input" type="number" placeholder="1" value="1" required="required" id="js_list_input_quantity_order_<?= $arItem['ID']; ?>" />
					</label>
					<button class="table__button js_list_plus_quantity" type="button" data-el-id="<?= $arItem['ID']; ?>" data-action="plus" data-inputidprefix="js_list_input_quantity_order_">+</button>
				</div>
				<div class="order__button-wrapper">
					<button class="link-button_grey link-button_xs order__button-add js_order_button_<?= $arItem['ID']; ?> js_add_reagent_to_order" data-from-popup="Y" data-quantity-input-id="js_list_input_quantity_order_<?= $arItem['ID']; ?>" data-reg-url="<?= $GLOBALS['arSiteConfig']['LINKS']['REG_PARTNER']; ?>" data-element="<?= $arItem['ID']; ?>" data-hide-button-class="js_in_order_button_<?= $arItem['ID']; ?>" data-show-button-class="js_order_button_<?= $arItem['ID']; ?>" type="button">Добавить</button>
					<button class="link-button_grey link-button_xs bookmarks-table__in display-none js_in_order_button_<?= $arItem['ID']; ?>" type="button"><span>В заказе</span></button>
				</div>
			</li>
		<? endforeach; ?>
	</ul>
<? } ?>