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
<div class="popup-reagent__title">
	<h2><?= $arResult['NAME']; ?></h2>
</div>
<div class="popup-reagent__body">
	<div class="popup-reagent__wrapper" id="popup-reagent__wrapper">
		<div class="popup-reagent__description">
			<div class="popup-reagent__image">
				<img src="<?= $arResult['PICTURE']['SRC']; ?>" alt="<?= $arResult['PICTURE']['ALT']; ?>" title="<?= $arResult['PICTURE']['TITLE']; ?>" />
			</div>
			<div class="popup-reagent__characteristics">
				<div class="popup-reagent__characteristics-list">
					<? foreach ($arResult['arDsiplayProperties'] as $code => $arProp) { ?>
						<dl>
							<dt><?= $arProp['NAME'] ?></dt>
							<dd><?= $arProp['DISPLAY_VALUE'] ?></dd>
						</dl>
					<? } ?>
				</div>
				<div class="popup-reagent__add">
					<button class="link-button_rose js_order_button_<?= $arResult['ID']; ?> js_add_reagent_to_order" data-reg-url="<?= $GLOBALS['arSiteConfig']['LINKS']['REG_PARTNER']; ?>" data-element="<?= $arResult['ID']; ?>" data-hide-button-class="js_in_order_button_<?= $arResult['ID']; ?>" data-show-button-class="js_order_button_<?= $arResult['ID']; ?>" type="button">Добавить в заказ</button>
					<button class="link-button_rose display-none js_in_order_button_<?= $arResult['ID']; ?>" type="button">В заказе</button>
				</div>
			</div>
		</div>
		<? if (!empty($arResult['arDocs'])) { ?>
			<div class="popup-reagent__documentation">
				<h3>Документы:</h3>
				<ul class="comparison__list">
					<? foreach ($arResult['arDocs'] as $arDoc) { ?>
						<li class="comparison__item">
							<a class="comparison__link" href="<?= $arDoc['SRC']; ?>" download>
								<div class="recommendation__title"><?= $arDoc['NAME']; ?></div>
								<div class="recommendation__file"><?= $arDoc['TYPE_FORMAT']; ?>, <?= $arDoc['SIZE_FORMAT']; ?></div>
								<div class="recommendation__download">
									<svg width="16" height="16">
										<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#downward"></use>
									</svg>
								</div>
							</a>
						</li>
					<? } ?>
				</ul>
			</div>
		<? } ?>
		<div class="c-form--select">
			<select>
				<option>Адаптация реагента</option>
				<option>Адаптация реагента 2</option>
				<option>Адаптация реагента 3</option>
			</select>
		</div>
		<? if (!empty($arResult['arEquipment'])) { ?>
			<div class="popup-reagent__for">
				<h3>Подходит для оборудования:</h3>
				<ul class="popup-reagent__list">
					<? foreach ($arResult['arEquipment'] as $key => $arItem) { ?>
						<li class="popup-reagent__item">
							<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
								<?= $arItem['NAME'] ?>
								<div class="popup-reagent__picture">
									<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
								</div>
							</a>
						</li>
					<? } ?>
				</ul>
			</div>
		<? } ?>
	</div>
</div>
<button class="popup_close"></button>