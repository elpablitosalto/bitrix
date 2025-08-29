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

//vardump($arResult);

if (!empty($arResult["ITEMS"])) {
?>
	<?
	foreach ($arResult["ITEMS"] as $arItem) {
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

		<section class="dp-section" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="container">
				<div class="contacts-requisites">
					<? if (!empty($arItem['PHONES'])) { ?>
						<? foreach ($arItem['PHONES']['arSources'] as $key => $val) { ?>
							<dl>
								<dt>Телефон</dt>
								<dd><a class="contacts-link" href="tel:<?= $arItem['PHONES']['arValuesForLink'][$key] ?>"><?= $val; ?></a></dd>
							</dl>
						<? } ?>
					<? } ?>
					<? if (!empty($arItem['DISPLAY_PROPERTIES']['EMAIL']['DISPLAY_VALUE'])) { ?>
						<dl>
							<dt>E-mail</dt>
							<dd><a class="contacts-link" href="mailto:<?= $arItem['DISPLAY_PROPERTIES']['EMAIL']['DISPLAY_VALUE']; ?>"><?= $arItem['DISPLAY_PROPERTIES']['EMAIL']['DISPLAY_VALUE']; ?></a></dd>
						</dl>
					<? } ?>
					<? if (!empty($arItem['DISPLAY_PROPERTIES']['SHEDULE']['DISPLAY_VALUE'])) { ?>
						<dl>
							<dt>Время работы</dt>
							<dd><?= $arItem['DISPLAY_PROPERTIES']['SHEDULE']['DISPLAY_VALUE']; ?></dd>
						</dl>
					<? } ?>
					<? if (!empty($arItem['DISPLAY_PROPERTIES']['ADDRESS']['DISPLAY_VALUE'])) { ?>
						<dl>
							<dt>Адрес</dt>
							<dd><?= $arItem['DISPLAY_PROPERTIES']['ADDRESS']['DISPLAY_VALUE']; ?></dd>
						</dl>
					<? } ?>
					<? if (!empty($arItem['DISPLAY_PROPERTIES']['LONGITUDE']['VALUE']) && !empty($arItem['DISPLAY_PROPERTIES']['LATITUDE']['VALUE'])) { ?>
						<dl>
							<dt></dt>
							<dd><a class="dp-btn" href="https://yandex.ru/maps/?rtext=~<?= $arItem['DISPLAY_PROPERTIES']['LONGITUDE']['VALUE']; ?>,<?= $arItem['DISPLAY_PROPERTIES']['LATITUDE']['VALUE'] ?>&rtt=auto" target="_blank"><span>Проложить маршрут</span></a></dd>
						</dl>
					<? } ?>
				</div>
				<? if (!empty($arItem['DISPLAY_PROPERTIES']['HOW_TO_GET_TEXT']['DISPLAY_VALUE'])) { ?>
					<div class="contacts-way">
						<div class="contacts-way-title">Как к нам добраться</div>
						<div class="contacts-way-toggle">
							<div class="contacts-way-wrapper">
								<div class="contacts-way-text"><?= $arItem['DISPLAY_PROPERTIES']['HOW_TO_GET_TEXT']['DISPLAY_VALUE'] ?></div>
								<div class="contacts-way-images">
									<? if (!empty($arItem['HOW_TO_GET_PICT_1'])) { ?>
										<div class="contacts-way-image">
											<img src="<?= $arItem['HOW_TO_GET_PICT_1']['SRC']; ?>" alt="<?= $arItem['HOW_TO_GET_PICT_1']['ALT']; ?>" title="<?= $arItem['HOW_TO_GET_PICT_1']['TITLE']; ?>" />
										</div>
									<? } ?>
									<? if (!empty($arItem['HOW_TO_GET_PICT_2'])) { ?>
										<div class="contacts-way-image">
											<img src="<?= $arItem['HOW_TO_GET_PICT_2']['SRC']; ?>" alt="<?= $arItem['HOW_TO_GET_PICT_2']['ALT']; ?>" title="<?= $arItem['HOW_TO_GET_PICT_2']['TITLE']; ?>" />
										</div>
									<? } ?>
								</div>
							</div>
						</div>
					</div>
				<? } ?>
				<? if (!empty($arItem['DISPLAY_PROPERTIES']['LONGITUDE']['VALUE']) && !empty($arItem['DISPLAY_PROPERTIES']['LATITUDE']['VALUE'])) { ?>
					<div class="map-wrapper" id="map-mafmarket-2" data-lat="<?=$arItem['DISPLAY_PROPERTIES']['LATITUDE']['VALUE']?>" data-lng="<?=$arItem['DISPLAY_PROPERTIES']['LONGITUDE']['VALUE']?>"></div>
				<? } ?>
			</div>
		</section>
	<?
	}
	?>
<? } ?>