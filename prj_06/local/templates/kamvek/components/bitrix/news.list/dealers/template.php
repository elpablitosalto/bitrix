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
	<div id="mapObjectsContent" class="contentSection">
		<div class="csContent responsiveBlock">

			<? if (!empty($arResult['REGIONS'])) { ?>
				<div class="map-objects-filter">
					<div class="map-objects-region">
						<div class="map-objects-region__label">Регион</div>
						<ul class="map-objects-region__list">
							<li class="selected">Регион</li>
							<? foreach ($arResult["REGIONS"] as $arItem) { ?>
								<li data-zoom="<?= $arItem['PROPERTY_MAP_ZOOM_VALUE']; ?>" data-lng="<?= $arItem['PROPERTY_LONGITUDE_VALUE']; ?>" data-lat="<?= $arItem['PROPERTY_LATITUDE_VALUE']; ?>" data-region-id="<?= $arItem['ID']; ?>"><?= $arItem['NAME']; ?></li>
							<? } ?>
						</ul>
					</div>
				</div>
			<? } ?>

			<div id="mapObjectsList" class="map-objects-list">
				<? foreach ($arResult["ITEMS"] as $arItem) { ?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="map-objects-item dealers-item" data-map-lng="<?= $arItem['DISPLAY_PROPERTIES']['LONGITUDE']['VALUE'] ?>" data-map-lat="<?= $arItem['DISPLAY_PROPERTIES']['LATITUDE']['VALUE'] ?>" data-map-region-id="<?= $arItem['DISPLAY_PROPERTIES']['REGION']['VALUE'] ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<h3 data-map-title><?= $arItem['NAME']; ?></h3>
						Адрес: <span data-map-address><?= $arItem['DISPLAY_PROPERTIES']['ADDRESS']['VALUE'] ?></span><br />
						<? if (!empty($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'])) { ?>
							Телефон:
							<?
							$i = 0;
							foreach ($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'] as $phone) {
								$i++;
								$phone_link = preg_replace('![^0-9]+!', '', $phone);
							?>
								<a href="tel:<?= $phone_link; ?>" data-map-phone><?= $phone; ?></a>
								<?
								if ($i < count($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'])) {
									echo ', ';
								}
								?>
							<? } ?>
							<br />
						<? } ?>
						<? if (!empty($arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'])) { ?>
							E-mail: <a href="mailto:<?= $arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE']; ?>" data-map-email><?= $arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE']; ?></a>
							<br />
						<? } ?>
						<? if (!empty($arItem['DISPLAY_PROPERTIES']['WEB']['VALUE'])) { ?>
							Сайт: <a target="_blank" href="<?= $arItem['DISPLAY_PROPERTIES']['WEB']['VALUE_HREF']; ?>" data-map-site><?= $arItem['DISPLAY_PROPERTIES']['WEB']['VALUE']; ?></a>
						<? } ?>
						<? if (!empty($arItem['DISPLAY_PROPERTIES']['CUSTOM_FIELDS']['VALUE'])) { ?>
							<br />
							<? foreach ($arItem['DISPLAY_PROPERTIES']['CUSTOM_FIELDS']['VALUE'] as $key => $val) { ?>
								<?= $val; ?>: <span><?= $arItem['DISPLAY_PROPERTIES']['CUSTOM_FIELDS']['DESCRIPTION'][$key]; ?></span><br />
							<? } ?>
						<? } ?>
					</div>
				<? } ?>
			</div>

		</div>
	</div>

<? } ?>