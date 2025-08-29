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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>

<?php if (0 < count($arResult['SECTIONS'])): ?>
	<div class="page__section">
		<!-- begin .section-->
		<div class="section section_header-offset_l section_header_l-inline section_style_no-overflow">
			<div class="section__header">
				<div class="section__container page__container">
					<div class="section__title">
						<!-- begin .title-->
						<h2 class="title title_size_h2">Продукция</h2>
						<!-- end .title-->
					</div>
					<div class="section__extra">
						<div class="section__tabs">
							<!-- begin .tabs-->
							<div class="tabs tabs_type_links js-tabs" data-tabs-for="#tabsProductGrid">
								<ul class="tabs__nav">
									<?php foreach ($arResult['SECTIONS'] as &$arSection): ?>
										<li class="tabs__item">
											<button class="tabs__label js-tabs-trigger" type="button"><?=$arSection['NAME']?></button>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<!-- end .tabs-->
						</div>
					</div>
				</div>
			</div>
			<div class="section__content">
				<div class="page__container">
					<div class="section__product-grid">
						<div id="tabsProductGrid" class="tabs">
							<div class="tabs__panels">
								<?php foreach ($arResult['SECTIONS'] as &$arSection): ?>
									<div class="tabs__panel js-tabs-panel">
										<!-- begin .product-grid-->
										<div class="product-grid">
											<div class="product-grid__wrapper">
												<?php foreach ($arSection['ITEMS'] as &$arItem): ?>
													<div class="product-grid__item">
														<!-- begin .product-snippet-->
														<div
															class="product-snippet product-snippet_type_panel-l product-grid__item-wrapper js-modal-product-name-container"
														>
															<a
																href="<?=$arItem['DETAIL_PAGE_URL']?>/"
																class="product-snippet__illustration"
															>
																<?php
																	if(!empty($arItem['PICTURE_ID'])) {
																		$resizeImage = CFile::ResizeImageGet($arItem['PICTURE_ID'], Array("width" => 580, "height" => 460), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
																	} else {
																		$resizeImage = array('src' => SITE_TEMPLATE_PATH . '/assets/images/image-not-found.png');
																	}
																?>
																<picture class="product-snippet__picture">
																	<img
																		data-src="<?=$resizeImage['src']?>"
																		alt="<?=$arItem['NAME']?>"
																		class="product-snippet__image lazyload"
																		src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
																	/>
																</picture>
															</a>
															<div class="product-snippet__content">
																<div
																	class="product-snippet__title js-modal-product-name"
																>
																	<a
																		href="<?=$arItem['DETAIL_PAGE_URL']?>/"
																		class="product-snippet__link"
																	><?=$arItem['NAME']?></a>
																</div>
																<?php if(!empty($arItem['DISPLAY_PROPERTIES'])): ?>
																	<div class="product-snippet__props">
																		<!-- begin .props-->
																		<div class="props props_size_s">
																			<?php foreach($arItem['DISPLAY_PROPERTIES'] as $code => $arProp): ?>
																				<?php if(!empty($arProp['NAME'])): ?>
																					<?php
																						$value = $arProp['VALUE'];
																						if(is_array($value)) $value = implode(', ', $arProp['VALUE']);
																					?>
																					<div class="props__prop">
																						<div class="props__label"><?=$arProp['NAME']?></div>
																						<div class="props__value" title="<?=$value?>"><?=$value?></div>
																					</div>
																				<?php endif; ?>
																			<?php endforeach; ?>
																		</div>
																		<!-- end .props-->
																	</div>
																<?php endif; ?>
																<div class="product-snippet__controls">
																	<div class="product-snippet__control">
																		<!-- begin .button-->
																		<a
																			data-product-id="<?=$arItem['ID']?>"
																			data-product-title="<?=$arItem['NAME']?>"
																			class="button button_width_full js-modal js-modal-product-name-get"
																			href="#modalProductContact"
																		>
																			<span class="button__holder">
																				Получить КП
																			</span>
																		</a>
																		<!-- end .button-->
																	</div>
																</div>
															</div>
														</div>
														<!-- end .product-snippet-->
													</div>
												<?php endforeach; ?>
											</div>
											<div class="product-grid__controls">
												<div class="product-grid__control">
													<!-- begin .button-->
													<a
														class="button button_width_full button_style_outline"
														href="/catalog/"
													>
														<span class="button__holder">Показать все</span>
													</a>
													<!-- end .button-->
												</div>
											</div>
										</div>
										<!-- end .product-grid-->
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end .section-->
	</div>
<?php endif; ?>