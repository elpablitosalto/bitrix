<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<?php if (0 < $arResult["SECTIONS_COUNT"]): ?>
	<div class="page__section">
		<div class="page__container">
				<!-- begin .section-->
				<div class="section <?=(!empty($arParams['SECTION_CLASS']) ? $arParams['SECTION_CLASS'] : '')?>">
						<div class="section__header section__header_type_l-inline">
							<?php if(!empty($arParams['TITLE'])): ?>
								<div class="section__title">
									<!-- begin .title-->
									<div class="title title_size_h1"><?=$arParams['TITLE']?></div>
									<!-- end .title-->
								</div>
							<?endif?>
								<div class="section__extra">
										<div class="section__nav">
												<!-- begin .nav-->
												<nav class="nav nav_type_secondary" data-for-map="mainMap">
														<ul class="nav__list">
															<?php foreach ($arResult['SECTIONS'] as &$arSection): ?>
																<?php if(!empty($arSection['ITEMS'])): ?>
																	<li class="nav__item">
																			<button
																					class="nav__link js-map-filter"
																					type="button"
																					data-map-region-code="map-region-<?=$arSection['ID']?>"
																					data-active-class="nav__link_state_active"
																			><?=$arSection['NAME']?></button>
																	</li>
																<?php endif; ?>
															<?php endforeach; ?>
														</ul>
												</nav>
												<!-- end .nav-->
										</div>
								</div>
						</div>
						<div class="section__content">
								<div class="section__map">
										<!-- begin .map-->
										<div class="map">
												<div
														data-region=""
														data-center="<?=$arParams['MAP_CENTER']?>"
														data-zoom="<?=$arParams['MAP_ZOOM']?>"
														data-map-id="mainMap"
														class="map__panel js-map"
												></div>
										</div>
										<!-- end .map-->
								</div>
						</div>
				</div>
				<!-- end .section-->
		</div>
	</div>
<?php endif; ?>

<script>
	(function () {
			if (typeof window.ymapGeoObjects === "undefined") {
					window.ymapGeoObjects = {};
			}
			window.ymapGeoObjects.mainMap = [
				<?php foreach ($arResult['SECTIONS'] as &$arSection): ?>
					<?php if(!empty($arSection['ITEMS'])): ?>
						<?php foreach ($arSection['ITEMS'] as &$arItem): ?>
							<?php if(!empty($arItem['PROPERTIES']['MAP']['VALUE'])):?>
								{
									regionCode: 'map-region-<?=$arSection['ID']?>',
									coords: [<?=$arItem['PROPERTIES']['MAP']['VALUE']?>],
									name: '<?=$arItem['NAME']?>',
									fields: [
											<?php if(!empty($arItem['PROPERTIES']['ADDRESS']['VALUE'])): ?>
												{
														title: "Адрес склада:",
														paragraphs: [
																"<?=$arItem['PROPERTIES']['ADDRESS']['VALUE']?>",
														]
												},
											<?php endif; ?>
											<?php if(!empty($arItem['PROPERTIES']['WORKING_MODE']['VALUE'])): ?>
												{
														title: "Режим работы:",
														paragraphs: [
																<?php foreach ($arItem['PROPERTIES']['WORKING_MODE']['VALUE'] as &$field): ?>
																	"<?=$field?>",
																<?php endforeach; ?>
														],
												},
											<?php endif; ?>
										<?php if(!empty($arItem['PROPERTIES']['PHONE']['VALUE'])): ?>
											{
												title: "Телефон:",
												paragraphs: [
													<?php foreach ($arItem['PROPERTIES']['PHONE']['VALUE'] as &$field): ?>
														'<a href="tel:<?=str_replace([' ', '(', ')', '-', '_'], '', $field)?>"><?=$field?></a> ',
													<?php endforeach; ?>
												]
											},
										<?php endif; ?>

										<?php if(!empty($arItem['PROPERTIES']['EMAIL']['VALUE'])): ?>
											{
												title: "E-mail:",
												paragraphs: [
													<?php foreach ($arItem['PROPERTIES']['EMAIL']['VALUE'] as &$field): ?>
														'<a href="mailto:<?=str_replace([' '], '', $field)?>"><?=$field?></a>',
													<?php endforeach; ?>
												]
											},
										<?php endif; ?>
									],
									icon: {
										src: '<?=SITE_TEMPLATE_PATH?>/mockup/dist/assets/blocks/map/images/marker.svg',
										width: 29,
										height: 37
									}
								},
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			];
	})();
</script>
<?/*?>
<script
	src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"
	type="text/javascript"
></script>
<?*/?>