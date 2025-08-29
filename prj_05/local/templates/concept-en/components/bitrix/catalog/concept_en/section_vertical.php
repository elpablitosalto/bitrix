<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

define('SHOW_TEMPLATE_BOTTOM_BANNER', 'N');

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

if ($obCache->InitCache(86400, md5(serialize($arResult['VARIABLES'])), "/iblock/catalog/collection/detail/")) {
	$arSection = $obCache->GetVars();
} elseif ($obCache->StartDataCache()) {
	$arSection = array();
	if (Loader::includeModule("iblock")) {
		$obj = CIBlockSection::GetList(
			false,
			[
				'IBLOCK_ID' => CONCEPT_CATALOG_EN_IB_ID,
				'ACTIVE' => 'Y',
				'CODE' => $arResult["VARIABLES"]["SECTION_CODE"]
			],
			false,
			['UF_*']
		);
		if ($res = $obj->GetNext()) {
			$arSection = $res;
		} else {
		}

		// Верхний баннер - изображение для десктопа -->
		if (!empty($arSection['UF_BANNER_DESKTOP'])) {
			if (is_array($arSection['UF_BANNER_DESKTOP'])) {
				$arFile = $arSection['UF_BANNER_DESKTOP'];
			} else {
				$arFile = CFile::GetFileArray($arSection['UF_BANNER_DESKTOP']);
			}
			//vardump($arFile);
			$arResultLocal = getImageFormatted(array(
				'RESIZE' => 'Y',
				'FILE_VALUE' => $arFile,
				'WIDTH' => 1920,
				'HEIGHT' => 1075,
				'DEFAULT_ALT_TITLE' => $arSection['NAME']
			));
			$arSection['PICTURE_TOP_BANNER_DESKTOP'] = $arResultLocal['PICTURE'];
		}
		// <--

		// Верхний баннер - изображение для мобильного и планшета -->
		if (!empty($arSection['UF_BANNER_MOBILE'])) {
			if (is_array($arSection['UF_BANNER_MOBILE'])) {
				$arFile = $arSection['UF_BANNER_MOBILE'];
			} else {
				$arFile = CFile::GetFileArray($arSection['UF_BANNER_MOBILE']);
			}
			$arResultLocal = getImageFormatted(array(
				'RESIZE' => 'Y',
				'FILE_VALUE' => $arFile,
				'WIDTH' => 1440,
				'HEIGHT' => 9999,
				'DEFAULT_ALT_TITLE' => $arSection['NAME']
			));
			$arSection['PICTURE_TOP_BANNER_MOBILE'] = $arResultLocal['PICTURE'];
		}
		// <--

		// Цветовая палитра -->
		if (!empty($arSection['UF_BOTTOM_BANNER_PC_M'])) {
			foreach ($arSection['UF_BOTTOM_BANNER_PC_M'] as $img) {
				if (is_array($img)) {
					$arFile = $img;
				} else {
					$arFile = CFile::GetFileArray($img);
				}
				$arResultLocal = getImageFormatted(array(
					'RESIZE' => 'Y',
					'FILE_VALUE' => $arFile,
					'WIDTH' => 1440,
					'HEIGHT' => 9999,
					'DEFAULT_ALT_TITLE' => $arSection['NAME']
				));
				$arSection['PICTURE_COLOR_PALETTE_SLIDER'][] = $arResultLocal['PICTURE'];
			}
		}
		// <-- Цветовая палитра

		// Навигационная цепочка -->
		$list = \CIBlockSection::GetNavChain(false, $arSection['ID'], array(), true);
		foreach ($list as $arSectionPath) {
			$res_2 = CIBlockSection::GetByID($arSectionPath['ID']);
			if ($arChain = $res_2->GetNext()) {
				$arSection['CHAIN'][] = array(
					'NAME' => $arChain['NAME'],
					'SECTION_PAGE_URL' => $arChain['SECTION_PAGE_URL'],
				);
			}
		}
		// <-- 

		// ID разделов для фильтра -->
		$arSection['FILTER_SECTION_ID'] = array($arSection['ID']);
		$rsParentSection = CIBlockSection::GetByID($arSection['ID']);
		if ($arParentSection = $rsParentSection->GetNext()) {
			$arFilter = array(
				'IBLOCK_ID' => $arParentSection['IBLOCK_ID'],
				'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],
				'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],
				'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']
			); // выберет потомков без учета активности
			$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilter);
			while ($arSect = $rsSect->GetNext()) {
				// получаем подразделы
				$arSection['FILTER_SECTION_ID'][] = $arSect['ID'];
			}
		}
		// <--

		// Баннер -->
		//vardump($arSection);
		if (!empty($arSection['UF_BOTTOM_BANNER_PC'])) {
			if (is_array($arSection['UF_BOTTOM_BANNER_PC'])) {
				$arFile = $arSection['UF_BOTTOM_BANNER_PC'];
			} else {
				$arFile = CFile::GetFileArray($arSection['UF_BOTTOM_BANNER_PC']);
			}
			$arResultLocal = getImageFormatted(array(
				'RESIZE' => 'Y',
				'FILE_VALUE' => $arFile,
				'WIDTH' => 1440,
				'HEIGHT' => 5000,
				'DEFAULT_ALT_TITLE' => $arSection['NAME']
			));
			$arSection['BOTTOM_BANNER_PC'] = $arResultLocal['PICTURE'];
		}

		if (!empty($arSection['UF_BANNER_BOTTOM_MOB'])) {
			if (is_array($arSection['UF_BANNER_BOTTOM_MOB'])) {
				$arFile = $arSection['UF_BANNER_BOTTOM_MOB'];
			} else {
				$arFile = CFile::GetFileArray($arSection['UF_BANNER_BOTTOM_MOB']);
			}
			$arResultLocal = getImageFormatted(array(
				'RESIZE' => 'Y',
				'FILE_VALUE' => $arFile,
				'WIDTH' => 1024,
				'HEIGHT' => 5000,
				'DEFAULT_ALT_TITLE' => $arSection['NAME']
			));
			$arSection['BANNER_BOTTOM_MOB'] = $arResultLocal['PICTURE'];
		}
		// <-- 
	}
	$obCache->EndDataCache($arSection);
}

if (empty($arSection)) {
	//LocalRedirect("/404.php", "404 Not Found");
	$APPLICATION->RestartBuffer();
	include $_SERVER['DOCUMENT_ROOT'] . '/404.php';
} else {

	foreach ($arSection['CHAIN'] as $arChain) {
		$APPLICATION->AddChainItem($arChain['NAME'], $arChain['SECTION_PAGE_URL']);
	} ?>

	<? if (!empty($arSection['PICTURE_TOP_BANNER_DESKTOP']) || !empty($arSection['PICTURE_TOP_BANNER_MOBILE'])) { ?>
		<? $this->SetViewTarget('TOP_BIG_SLIDER'); ?>
		<div class="page__banner-carousel">
			<!-- begin .banner-carousel-->
			<div class="banner-carousel">
				<div class="banner-carousel__container swiper js-banner-carousel">
					<div class="banner-carousel__wrapper swiper-wrapper">
						<div class="banner-carousel__slide swiper-slide">
							<!-- begin .banner-->
							<div class="banner banner_height_auto banner-carousel__banner">
								<picture class="banner__picture">
									<? if (!empty($arSection['PICTURE_TOP_BANNER_MOBILE'])) { ?>
										<source srcset="<?= $arSection['PICTURE_TOP_BANNER_MOBILE']['SRC']; ?>" type="image/png" media="(max-width: 1024px)" class="banner__source" />
									<? } ?>
									<? if (!empty($arSection['PICTURE_TOP_BANNER_DESKTOP'])) { ?>
										<img src="<?= $arSection['PICTURE_TOP_BANNER_DESKTOP']['SRC']; ?>" alt="<?= $arSection['PICTURE_TOP_BANNER_DESKTOP']["ALT"] ?>" title="<?= $arSection['PICTURE_TOP_BANNER_DESKTOP']["TITLE"] ?>" class="banner__image" />
									<? } ?>
								</picture>
							</div>
							<!-- end .banner-->
						</div>
					</div>
					<button class="banner-carousel__arrow banner-carousel__arrow_position_left js-banner-carousel-prev" type="button">
						<svg class="banner-carousel__icon" width="9" height="18" viewbox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M8.66964 17.6224C8.77436 17.503 8.85744 17.3611 8.91413 17.2049C8.97082 17.0488 9 16.8813 9 16.7123C9 16.5432 8.97082 16.3758 8.91413 16.2196C8.85744 16.0634 8.77436 15.9216 8.66964 15.8022L2.71655 8.99966L8.66964 2.19715C8.88079 1.95577 8.99941 1.62841 8.99941 1.28706C8.99941 0.945709 8.88079 0.61834 8.66964 0.37697C8.45849 0.135599 8.17211 -4.01056e-08 7.87349 -5.45712e-08C7.57488 -6.90369e-08 7.2885 0.135599 7.07735 0.37697L0.330364 8.08957C0.225643 8.20898 0.142559 8.35083 0.0858702 8.507C0.0291809 8.66317 3.61661e-07 8.83058 3.54992e-07 8.99966C3.48323e-07 9.16874 0.0291809 9.33616 0.0858701 9.49233C0.142559 9.6485 0.225643 9.79034 0.330364 9.90975L7.07735 17.6224C7.1818 17.7421 7.3059 17.837 7.44251 17.9018C7.57913 17.9666 7.72558 18 7.87349 18C8.0214 18 8.16786 17.9666 8.30448 17.9018C8.44109 17.837 8.56518 17.7421 8.66964 17.6224Z">
							</path>
						</svg>
					</button>
					<button class="banner-carousel__arrow banner-carousel__arrow_position_right js-banner-carousel-next" type="button">
						<svg class="banner-carousel__icon" width="9" height="18" viewbox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M0.330363 17.6224C0.225642 17.503 0.142558 17.3611 0.0858685 17.2049C0.0291793 17.0488 -4.4122e-08 16.8813 -5.07909e-08 16.7123C-5.74597e-08 16.5432 0.0291793 16.3758 0.0858684 16.2196C0.142558 16.0634 0.225642 15.9216 0.330363 15.8022L6.28345 8.99966L0.330362 2.19715C0.119212 1.95577 0.000588102 1.62841 0.000588091 1.28706C0.00058808 0.945709 0.119211 0.61834 0.330362 0.37697C0.541513 0.135599 0.827895 -4.01055e-08 1.12651 -5.45711e-08C1.42512 -6.90367e-08 1.7115 0.135599 1.92265 0.37697L8.66964 8.08957C8.77436 8.20898 8.85744 8.35083 8.91413 8.507C8.97082 8.66317 9 8.83058 9 8.99966C9 9.16874 8.97082 9.33616 8.91413 9.49233C8.85744 9.6485 8.77436 9.79034 8.66964 9.90975L1.92265 17.6224C1.8182 17.7421 1.6941 17.837 1.55749 17.9018C1.42087 17.9666 1.27442 18 1.12651 18C0.978597 18 0.832139 17.9666 0.695524 17.9018C0.558908 17.837 0.434819 17.7421 0.330363 17.6224Z">
							</path>
						</svg>
					</button>
					<div class="banner-carousel__pagination">
						<!-- begin .bullet-pagination-->
						<div class="bullet-pagination">
						</div>
						<!-- end .bullet-pagination-->
					</div>
				</div>
				<!-- end .description-->
			</div>
			<!-- end .banner-carousel-->
		</div>
		<? $this->EndViewTarget(); ?>
	<? } ?>

	<?
	global $arrCollectionDetail;
	$arrCollectionDetail['SECTION_ID'] = $arSection['FILTER_SECTION_ID'];
	?>
	<?
	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"collection_detail",
		array(
			"IBLOCK_ID" => CONCEPT_CATALOG_EN_IB_ID,
			"IBLOCK_TYPE" => "catalog_en",
			//"SECTION_ID" => $arSection['ID'],
			//"SECTION_CODE" => $arSection['CODE'],
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array(
				0 => "ID",
				1 => "CODE",
				2 => "PREVIEW_PICTURE",
				3 => "DETAIL_PICTURE",
				4 => "PREVIEW_TEXT",
				5 => "NAME",
				5 => "",
				5 => "",
				5 => "",
				5 => "",
			),
			"FILTER_NAME" => "arrCollectionDetail",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "Y",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "20",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array(
				0 => "PRODUCT_FEATURE",
				1 => "PRODUCT_PROPS",
				2 => "PRODUCT_COMPOSITION",
				3 => "PRODUCT_TYPE",
				4 => "PALLETTE",
				5 => "PRODUCT_TYPE",
				6 => "PRODUCT_FEATURE",
				7 => "PRODUCT_PROPS",
				8 => "PRODUCT_COMPOSITION",
				9 => "PRODUCT_UNIQUE",
				10 => "INSTRUCTION"
			),
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC",
			"STRICT_SECTION_CHECK" => "N",
			"COMPONENT_TEMPLATE" => "novelties"
		),
		false
	); ?>


	<div class="page__detail-group">
		<div class="page__detail">
			<? if (!empty($arSection['PICTURE_COLOR_PALETTE_SLIDER'])) { ?>
				<div class="page__banner-carousel">
					<!-- begin .banner-carousel-->
					<div class="banner-carousel">
						<div class="banner-carousel__header page__container">
							<div class="banner-carousel__title">
								<!-- begin .title-->
								<h2 class="title title_size_h2 title_align_center">
									<?= GetMessage('CT_COLOR_PALETTE_SECTION_LIST_BLOCK_TITLE_DEFAULT') ?>
								</h2>
								<!-- end .title-->
							</div>
							<div class="banner-carousel__carousel-nav">
								<!-- begin .carousel-nav-->
								<div class="carousel-nav js-carousel-nav" data-nav-scope=".banner-carousel" data-nav-target=".swiper">
									<div class="carousel-nav__control">
										<button class="carousel-nav__arrow carousel-nav__arrow_type_prev js-carousel-nav-prev" type="button" aria-label="Previous Slide">
											<svg class="carousel-nav__icon">
												<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/images/icon.svg#icon_arrow-right"></use>
											</svg>
										</button>
									</div>
									<div class="carousel-nav__control">
										<button class="carousel-nav__arrow carousel-nav__arrow_type_next js-carousel-nav-next" type="button" aria-label="Next Slide">
											<svg class="carousel-nav__icon">
												<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/images/icon.svg#icon_arrow-right"></use>
											</svg>
										</button>
									</div>
								</div>
								<!-- end .carousel-nav-->
							</div>
						</div>
						<div class="banner-carousel__container swiper js-banner-carousel">
							<div class="banner-carousel__wrapper swiper-wrapper">
								<? foreach ($arSection['PICTURE_COLOR_PALETTE_SLIDER'] as $img) { ?>
									<div class="banner-carousel__slide swiper-slide">
										<!-- begin .banner-->
										<div class="banner banner_height_auto banner-carousel__banner">
											<picture class="banner__picture">
												<img src="<?= $img['SRC']; ?>" alt="<?= $img["ALT"] ?>" title="<?= $img["TITLE"] ?>" class="banner__image" />
											</picture>
										</div>
										<!-- end .banner-->
									</div>
								<? } ?>
							</div>
						</div>
					</div>
					<!-- end .banner-carousel-->
				</div>
			<? } ?>

			<?
			if (!empty($arSection['UF_RELATED_PRODUCTS'])) {
				global $arRelatedProductsFilter;
				$arRelatedProductsFilter['ID'] = $arSection['UF_RELATED_PRODUCTS']; ?>
				<? $APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"related_products",
					array(
						"IBLOCK_ID" => CONCEPT_CATALOG_EN_IB_ID,
						"IBLOCK_TYPE" => "catalog_en",
						"COMPONENT_TEMPLATE" => "related_products",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"ADD_SECTIONS_CHAIN" => "N",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"FIELD_CODE" => array(
							0 => "ID",
							1 => "CODE",
							2 => "PREVIEW_PICTURE",
							3 => "DETAIL_PICTURE",
							4 => "",
						),
						"FILTER_NAME" => "arRelatedProductsFilter",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"INCLUDE_SUBSECTIONS" => "Y",
						"MESSAGE_404" => "",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"NEWS_COUNT" => "20",
						"PAGER_TEMPLATE" => ".default",
						//"NEWS_COUNT" => 6,
						//"PAGER_TEMPLATE" => "auto_load",
						"PAGER_TITLE" => "Новости",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"PROPERTY_CODE" => array(
							0 => "PRODUCT_FEATURE",
							1 => "PRODUCT_PROPS",
							2 => "PRODUCT_COMPOSITION",
							3 => "PRODUCT_TYPE",
							4 => "",
						),
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SORT_BY1" => "ACTIVE_FROM",
						"SORT_BY2" => "SORT",
						"SORT_ORDER1" => "DESC",
						"SORT_ORDER2" => "ASC",
						"STRICT_SECTION_CHECK" => "N",
					),
					false
				); ?>
			<? } ?>

			<? if (!empty($arSection['UF_VIDEOS'])) { ?>
				<?
				global $videoFilter;
				$videoFilter['ID'] = $arSection['UF_VIDEOS'];
				//vardump($videoFilter);
				?>
				<? $APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"video_block",
					array(
						"IBLOCK_ID" => VIDEO,
						"IBLOCK_TYPE" => "materials_en",
						"COMPONENT_TEMPLATE" => "video_block",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"ADD_SECTIONS_CHAIN" => "N",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"FIELD_CODE" => array(
							0 => "ID",
							1 => "CODE",
							2 => "PREVIEW_PICTURE",
							3 => "DETAIL_PICTURE",
							4 => "",
						),
						"FILTER_NAME" => "videoFilter",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"INCLUDE_SUBSECTIONS" => "Y",
						"MESSAGE_404" => "",
						"NEWS_COUNT" => "20",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_TITLE" => "Новости",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"PROPERTY_CODE" => array(
							1 => "VIDEO_PREVIEW",
							2 => "VIDEO_LINK",
							3 => "PRODUCT_COMPOSITION",
							4 => "PRODUCT_TYPE",
							5 => "",
						),
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SORT_BY1" => "ACTIVE_FROM",
						"SORT_BY2" => "SORT",
						"SORT_ORDER1" => "DESC",
						"SORT_ORDER2" => "ASC",
						"STRICT_SECTION_CHECK" => "N",
					),
					false
				); ?>
			<? } ?>
		</div>
	</div>

	<? if (!empty($arSection['BANNER_BOTTOM_MOB']) || !empty($arSection['BOTTOM_BANNER_PC'])) { ?>
		<div class="page__banner">
			<div class="page__container">
				<!-- begin .banner-->
				<div class="banner banner_height_auto">
					<picture class="banner__picture">
						<? if (!empty($arSection['BANNER_BOTTOM_MOB'])) { ?>
							<source srcset="<?= $arSection['BANNER_BOTTOM_MOB']['SRC']; ?>" type="image/png" media="(max-width: 1024px)" class="banner__source" />
						<? } ?>
						<? if (!empty($arSection['BOTTOM_BANNER_PC'])) { ?>
							<img src="<?= $arSection['BOTTOM_BANNER_PC']['SRC']; ?>" alt="<?= $arSection['BOTTOM_BANNER_PC']["ALT"] ?>" title="<?= $arSection['BOTTOM_BANNER_PC']["TITLE"] ?>" class="banner__image" />
						<? } ?>
					</picture>
				</div>
				<!-- end .banner-->
			</div>
		</div>
	<? } ?>

<? } ?>