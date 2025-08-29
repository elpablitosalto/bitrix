<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

$obj = CIBlockSection::GetList(false, ['IBLOCK_ID' => CATALOG, 'ACTIVE' => 'Y', 'CODE' => $arResult["VARIABLES"]["SECTION_CODE"]], false, ['UF_*']);
if ($res = $obj->GetNext()) {
	$arSection = $res;
} else {
	//LocalRedirect("/404.php", "404 Not Found");
	$APPLICATION->RestartBuffer();
	include $_SERVER['DOCUMENT_ROOT'] . '/404.php';
}

$detailedCollection = isset($arSection['UF_DETAILED_COLLECTION']) && $arSection['UF_DETAILED_COLLECTION'] == 1;

if ($detailedCollection) {
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/detailed-collection.css');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/collection.js');
	$APPLICATION->AddHeadString('
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
	');
}

$picDesktop = CFile::ResizeImageGet($arSection['UF_BANNER_DESKTOP'], array('width' => 1920, 'height' => 1075), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$picInfoDesktop = CFile::GetByID($arSection['UF_BANNER_DESKTOP'])->Fetch();
$picMobile = CFile::ResizeImageGet($arSection['UF_BANNER_MOBILE'], array('width' => 576, 'height' => 510), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$picInfoMobile = CFile::GetByID($arSection['UF_BANNER_MOBILE'])->Fetch();
$downloadFile = (isset($arSection['UF_LINE_DESCRIPTION'])) ? CFile::GetPath($arSection['UF_LINE_DESCRIPTION']) : false;
?>
<section class="content">
	<section class="full-page-banner full-page-banner_video_expanded<? if ($detailedCollection) {
																		echo ' full-page-banner_type_modern';
																	} ?>">
		<? if (!empty($arSection['UF_BANNER_VIDEO'])/* || ($arSection["CODE"] == "okrashivanie" && $arSection["IBLOCK_ID"] == 2 && $arSection["DEPTH_LEVEL"] == 1)*/) : ?>
			<?
			$srcVideo = \CFile::GetPath($arSection['UF_BANNER_VIDEO']);
			/*if( $arSection["CODE"] == "okrashivanie" && $arSection["IBLOCK_ID"] == 2 && $arSection["DEPTH_LEVEL"] == 1){
					$srcVideo = "/upload/video-banners/Лофт_Марс_Баннер_Итог_2.mp4";
				}*/
			?>
			<video class="banner-video" muted="" width="1920" autoplay="autoplay" loop="loop">
				<source src="<?= $srcVideo ?>" type="video/mp4"><!-- MP4 длѝ Safari, IE9, iPhone, iPad, Android, и Windows Phone 7 -->
			</video>
		<? else : ?>
			<picture class="banner-picture">
				<source media="(max-width: 576px)" srcset="<?php echo $picMobile['src']; ?>">
				<img data-pagespeed-no-transform src="<?php echo $picDesktop['src']; ?>" alt="<?php echo $arSection['NAME']; ?>" title="<?php echo $arSection['NAME']; ?>" class="picture__image"">
		    </picture>

			<?
			/*
			BitrixTools::picSrcset(array(
				"picMobile" => array(
					"src" => $picMobile['src'],
				),
				"picDesktop" => array(
					"src" => $picDesktop['src'],
				),
				"alt" => $arSection['NAME'],
				"title" => $arSection['NAME'],
				"class" => "picture__image",
				"src" => $picDesktop['src'],
				"width" => $picDesktop['width'],
				"height" => $picDesktop['height'],
			));
			*/

			/*
			$arSrcset = array();
			$arSizes = array();
			$srcset = '';
			$sizes = '';
			if (!empty($picMobile['src'])) {
				$arSrcset[] = $picMobile['src'] . ' 576w';
				$arSizes[] = '(max-width: 576px) 576px';
			}
			$arSrcset[] = $picDesktop['src'] . ' 992w';
			$arSizes[] = '(min-width: 992px) 992px';
			if (!empty($arSrcset)) {
				$srcset = 'srcset="' . implode(", ", $arSrcset) . '"';
			}
			if (!empty($arSizes)) {
				//$sizes = 'sizes="' . implode(", ", $arSizes) . '"';
			}
			?>
			<img <?= $srcset; ?> <?= $sizes; ?> alt="<?= $arSection['NAME']; ?>" title="<?= $arSection['NAME']; ?>" class="picture__image" src="<?= $picDesktop['src'] ?>" width="<?= $picDesktop['width']; ?>" height="<?= $picDesktop['height']; ?>" />
			<?*/ ?>

			<?/*?>
			<picture class="banner-picture">
				<source srcset="<?= $picMobile['src'] ?>" type="<?= (!empty($picInfoMobile) ? $picInfoMobile['CONTENT_TYPE'] : 'image/jpeg') ?>" media="(max-width: 576px)">
				<!--<source srcset="<?=$picDesktop['src']?>" type="<?=(!empty($picInfoDesktop) ? $picInfoDesktop['CONTENT_TYPE'] : 'image/jpeg')?>" media="(max-width: 991px)">-->
				<source srcset="<?= $picDesktop['src'] ?>" type="<?= (!empty($picInfoDesktop) ? $picInfoDesktop['CONTENT_TYPE'] : 'image/jpeg') ?>">
				<img class="banner-picture__image" src="<?= $picDesktop['src'] ?>">
			</picture>
			<?*/ ?>

		<? endif; ?>
	</section>
	<div class=" container">
				<section class="content-text">
					<h1 class="content-text-h1">
						<? if (!empty($arSection['UF_COLLECTION_TITLE'])) {
							echo $arSection['~UF_COLLECTION_TITLE'];
						} else {
							echo $arSection['NAME'];
						} ?>
					</h1>
					<?= $arSection['~DESCRIPTION'] ?>
					<? if ($downloadFile != false) : ?>
						<a href="<?= $downloadFile ?>" class="download">Скачать описание линейки продуктов</a>
					<? endif; ?>
					<? if (!empty($arSection["UF_MATERIALS"])) : ?>
						<? foreach ($arSection["UF_MATERIALS"] as $materialId) : ?>
							<? $rsMaterialData = \CIBlockElement::GetList(false, ['IBLOCK_ID' => MATERIALS, 'ID' => $materialId, "!PROPERTY_FILE" => false], false, false, ['*', 'PROPERTY_FILE']); ?>
							<? if ($arMaterialData = $rsMaterialData->GetNext()) { ?>
								<a href="<?= \CFile::GetPath($arMaterialData["PROPERTY_FILE_VALUE"]) ?>" class="download"><?= $arMaterialData["NAME"] ?></a>
							<? } ?>
						<? endforeach; ?>
					<? endif ?>
				</section>
				</div>
				<? if (!empty($arSection['UF_HIDDEN_SEO_TEXT'])) : ?>
					<div class="visually-hidden">
						<?= htmlspecialchars_decode($arSection['UF_HIDDEN_SEO_TEXT'], ENT_QUOTES) ?>
					</div>
				<? endif; ?>
				<? if ($detailedCollection && !empty($arSection['UF_TEXT_IMAGE'])) : ?>
					<?
					$textImage = CFile::ResizeImageGet($arSection['UF_TEXT_IMAGE'], array('width' => 1920, 'height' => 591), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					?>
					<section class="full-page-banner full-page-banner_video_expanded">
						<img class="show-desktop" src="<?= $textImage['src'] ?>" />
						<img class="middle-show" src="<?= $textImage['src'] ?>" />
						<img class="show-mobile" src="<?= $textImage['src'] ?>" />
					</section>
				<? endif; ?>
				<? if ($detailedCollection && !empty($arSection['UF_COLLECTION_FEATURES'])) : ?>
					<?
					$collectionFeatureGroup = CIBlockSection::GetList(
						array('SORT' => 'ASC'),
						array('IBLOCK_ID' => 41, 'ACTIVE' => 'Y', 'ID' => $arSection['UF_COLLECTION_FEATURES']),
						false,
						array('ID', 'NAME', 'DESCRIPTION', 'UF_FEATURE_TITLE')
					)->GetNext();
					$collectionFeatures = CIBlockElement::GetList(
						array('SORT' => 'ASC'),
						array('IBLOCK_ID' => 41, 'ACTIVE' => 'Y', 'IBLOCK_SECTION_ID' => $arSection['UF_COLLECTION_FEATURES']),
						false,
						false,
						array('ID', 'NAME', 'DETAIL_TEXT', 'DETAIL_PICTURE')
					);
					?>
					<section class="advantages content__advantages">
						<div class="container">
							<div class="advantages__inner">
								<? if (!empty($collectionFeatureGroup['UF_FEATURE_TITLE'])) : ?>
									<h2 class="content-text-h2 content-text-h2_align_center-xs"><?= $collectionFeatureGroup['UF_FEATURE_TITLE'] ?></h2>
								<? endif; ?>
								<? if (!empty($collectionFeatureGroup['DESCRIPTION'])) : ?>
									<div class="title-caption advantages__caption"><?= $collectionFeatureGroup['DESCRIPTION'] ?></div>
								<? endif; ?>
								<div class="advantages__list">
									<? while ($feature = $collectionFeatures->GetNext()) : ?>
										<div class="advantages__item">
											<? if (!empty($feature['DETAIL_PICTURE'])) : ?>
												<? $featureImage = CFile::ResizeImageGet($feature['DETAIL_PICTURE'], array('width' => 82, 'height' => 82), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
												<div class="advantages__icon">
													<img src="<?= $featureImage['src'] ?>" alt="<?= $feature['NAME'] ?>" class="advantages__img">
												</div>
											<? endif; ?>
											<div class="advantages__descr">
												<div class="advantages__title"><?= $feature['NAME'] ?></div>
												<? if (!empty($feature['DETAIL_TEXT'])) : ?>
													<p class="advantages__text"><?= $feature['DETAIL_TEXT'] ?></p>
												<? endif; ?>
											</div>
										</div>
									<? endwhile; ?>
								</div>
							</div>
						</div>
						</div>
					</section>
				<? endif; ?>
				<? if ($detailedCollection && !empty($arSection['UF_COLLECTION_INFO'])) : ?>
					<?
					$collectionInfoGroup = CIBlockSection::GetList(
						array('SORT' => 'ASC'),
						array('IBLOCK_ID' => 42, 'ACTIVE' => 'Y', 'ID' => $arSection['UF_COLLECTION_INFO']),
						false,
						array('ID', 'NAME', 'DESCRIPTION', 'UF_DESCRIPTION_TITLE')
					)->GetNext();
					$collectionInfos = CIBlockElement::GetList(
						array('SORT' => 'ASC'),
						array('IBLOCK_ID' => 42, 'ACTIVE' => 'Y', 'IBLOCK_SECTION_ID' => $arSection['UF_COLLECTION_INFO']),
						false,
						false,
						array('ID', 'NAME', 'DETAIL_TEXT', 'DETAIL_PICTURE')
					);
					$infoIndex = 1;
					?>
					<section class="steps-care content__section">
						<div class="container">
							<div class="content__accordion">
								<? if (!empty($collectionInfoGroup['UF_DESCRIPTION_TITLE'])) : ?>
									<h2 class="content-text-h2"><?= $collectionInfoGroup['UF_DESCRIPTION_TITLE'] ?></h2>
								<? endif; ?>
								<div class="accordion">
									<div class="accordion__list">
										<? while ($info = $collectionInfos->GetNext()) : ?>
											<div class="accordion__item<? if ($infoIndex === 1) : ?> accordion__item_state_open<? endif; ?>">
												<div class="accordion__icon">
													<?= file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/images/dev/empty-circle.svg'); ?>
												</div>
												<div class="accordion__header">
													<a href='#' class='accordion__title js-toggle'><?= $info['NAME'] ?></a>
													<div class="accordion__content" <? if ($infoIndex === 1) : ?>style="display: block;" <? endif; ?>>
														<? if (!empty($info['DETAIL_PICTURE'])) : ?>
															<? $infoImage = CFile::ResizeImageGet($info['DETAIL_PICTURE'], array('width' => 300, 'height' => 830), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
															<picture class="accordion__picture">
																<?/*?><source srcset="<?=$infoImage['src']?>" media=""><?*/ ?>
																<img src="<?= $infoImage['src'] ?>" alt="<?= $info['NAME'] ?>" title="<?= $info['NAME'] ?>" class="accordion__img">
															</picture>
														<? endif; ?>
														<div class="accordion__text">
															<div class="accordion__line accordion__line_position_top">
																<svg width="3" height="51" viewBox="0 0 3 51" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path d="M1.5 0L1.5 24" stroke="currentColor" stroke-width="3" stroke-dasharray="6 6" />
																	<path d="M1.5 27L1.5 51" stroke="currentColor" stroke-width="3" />
																</svg>
															</div>
															<div class="accordion__line accordion__line_position_bottom">
																<svg width="3" height="51" viewBox="0 0 3 51" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path d="M1.5 0L1.5 24" stroke="currentColor" stroke-width="3" stroke-dasharray="6 6" />
																	<path d="M1.5 27L1.5 51" stroke="currentColor" stroke-width="3" />
																</svg>
															</div>
															<?= $info['DETAIL_TEXT'] ?>
														</div>
													</div>
												</div>
											</div>
											<? $infoIndex++ ?>
										<? endwhile; ?>
									</div>
								</div>
							</div>
						</div>
					</section>
				<? endif; ?>
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"sectionPage.list",
					array(
						"IBLOCK_TYPE" => "-",
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"NEWS_COUNT" => 2000,
						"SORT_BY1" => $arParams["SORT_BY1"],
						"SORT_ORDER1" => $arParams["SORT_ORDER1"],
						"SORT_BY2" => $arParams["SORT_BY2"],
						"SORT_ORDER2" => $arParams["SORT_ORDER2"],
						"FILTER_NAME" => $arParams["FILTER_NAME"],
						"FIELD_CODE" => array(
							0 => "ID",
							1 => "CODE",
							2 => "PREVIEW_PICTURE",
							3 => "DETAIL_PICTURE",
							4 => "",
						),
						"PROPERTY_CODE" => array(
							0 => "",
							1 => "PRODUCT_FEATURE",
							2 => "PRODUCT_PROPS",
							3 => "PRODUCT_COMPOSITION",
							4 => "PRODUCT_TYPE",
							5 => "",
						),
						"CHECK_DATES" => "N",
						"STRICT_SECTION_CHECK" => "N",
						"IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
						"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
						"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
						"SEARCH_PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "N",
						"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
						"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
						"SET_TITLE" => "Y",
						"SET_BROWSER_TITLE" => "Y",
						"SET_META_KEYWORDS" => "Y",
						"SET_META_DESCRIPTION" => "Y",
						"MESSAGE_404" => $arParams["MESSAGE_404"],
						"SET_STATUS_404" => "Y",
						"SHOW_404" => "Y",
						"FILE_404" => $arParams["FILE_404"],
						"SET_LAST_MODIFIED" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
						"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
						"INCLUDE_SUBSECTIONS" => "Y",
						"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
						"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
						"MEDIA_PROPERTY" => $arParams["MEDIA_PROPERTY"],
						"SLIDER_PROPERTY" => $arParams["SLIDER_PROPERTY"],
						"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => $arParams["PAGER_TITLE"],
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
						"PAGER_SHOW_ALL" => "N",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
						"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
						"USE_RATING" => $arParams["USE_RATING"],
						"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
						"MAX_VOTE" => $arParams["MAX_VOTE"],
						"VOTE_NAMES" => $arParams["VOTE_NAMES"],
						"USE_SHARE" => $arParams["LIST_USE_SHARE"],
						"SHARE_HIDE" => $arParams["SHARE_HIDE"],
						"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
						"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
						"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
						"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
						"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
						"COMPONENT_TEMPLATE" => "sectionPage.list",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_ADDITIONAL" => ""
					),
					false
				);

				/*Временно отключил - 36126*/
				if (!$detailedCollection && !empty($arSection['UF_VIDEOS'])) {
					global $videoFilter;
					$videoFilter['ID'] = $arSection['UF_VIDEOS'];

					$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"video.block",
						array(
							"IBLOCK_TYPE" => "-",
							"IBLOCK_ID" => VIDEO,
							"NEWS_COUNT" => 24,
							"SORT_BY1" => 'date_create',
							"SORT_ORDER1" => 'desc',
							"SORT_BY2" => $arParams["SORT_BY2"],
							"SORT_ORDER2" => $arParams["SORT_ORDER2"],
							"FILTER_NAME" => 'videoFilter',
							"SET_TITLE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"FIELD_CODE" => array(
								0 => "ID",
								1 => "CODE",
								2 => "PREVIEW_PICTURE",
								3 => "DETAIL_PICTURE",
								4 => "NAME",
							),
							"PROPERTY_CODE" => array(
								0 => "",
								1 => "VIDEO_PREVIEW",
								2 => "VIDEO_LINK",
								3 => "PRODUCT_COMPOSITION",
								4 => "PRODUCT_TYPE",
								5 => "",
							),
						),
						false
					);
				}
				?>
				<? if ($detailedCollection && !empty($arSection['UF_COLLECTION_RESULTS'])) : ?>
					<section class="carousel">
						<div class="container">
							<div class="carousel__inner">
								<? $imageCount = count($arSection['UF_COLLECTION_RESULTS']); ?>
								<div class="carousel__header">
									<h2 class="content-text-h2">Результат до/после</h2>
									<? if ($imageCount > 2) : ?>
										<div class="swiper__controls">
											<button class="swiper__button swiper-button-prev">
												<svg class="swiper__icon" width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" clip-rule="evenodd" d="M12.0463 21.4208C12.1918 21.2757 12.3073 21.1033 12.3861 20.9134C12.4648 20.7236 12.5054 20.5201 12.5054 20.3146C12.5054 20.1091 12.4648 19.9056 12.3861 19.7157C12.3073 19.5259 12.1918 19.3535 12.0463 19.2083L3.77445 10.9396L12.0463 2.67084C12.3397 2.37745 12.5046 1.97952 12.5046 1.56459C12.5046 1.14967 12.3397 0.751736 12.0463 0.45834C11.7529 0.164944 11.355 0.000118205 10.9401 0.000118187C10.5252 0.000118169 10.1272 0.164944 9.83383 0.45834L0.458828 9.83334C0.313319 9.97848 0.197874 10.1509 0.119103 10.3407C0.0403333 10.5306 -0.000213136 10.7341 -0.000213145 10.9396C-0.000213154 11.1451 0.0403333 11.3486 0.119103 11.5384C0.197874 11.7283 0.313319 11.9007 0.458828 12.0458L9.83383 21.4208C9.97897 21.5664 10.1514 21.6818 10.3412 21.7606C10.5311 21.8393 10.7346 21.8799 10.9401 21.8799C11.1456 21.8799 11.3491 21.8393 11.5389 21.7606C11.7288 21.6818 11.9012 21.5664 12.0463 21.4208Z" />
													<path fill-rule="evenodd" clip-rule="evenodd" d="M21.8779 10.9395C21.8779 10.5251 21.7133 10.1276 21.4203 9.8346C21.1273 9.54157 20.7298 9.37695 20.3154 9.37695L4.69043 9.37695C4.27603 9.37695 3.8786 9.54157 3.58558 9.8346C3.29255 10.1276 3.12793 10.5251 3.12793 10.9395C3.12793 11.3539 3.29255 11.7513 3.58558 12.0443C3.8786 12.3373 4.27603 12.502 4.69043 12.502L20.3154 12.502C20.7298 12.502 21.1273 12.3373 21.4203 12.0443C21.7133 11.7513 21.8779 11.3539 21.8779 10.9395Z" />
												</svg>
											</button>
											<button class="swiper__button swiper-button-next">
												<svg class="swiper__icon" width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" clip-rule="evenodd" d="M9.83111 21.4208C9.6856 21.2757 9.57016 21.1033 9.49139 20.9134C9.41262 20.7236 9.37207 20.5201 9.37207 20.3146C9.37207 20.1091 9.41262 19.9056 9.49139 19.7157C9.57016 19.5259 9.6856 19.3535 9.83111 19.2083L18.103 10.9396L9.83111 2.67084C9.53772 2.37745 9.37289 1.97952 9.37289 1.56459C9.37289 1.14967 9.53772 0.751736 9.83111 0.45834C10.1245 0.164944 10.5224 0.000118205 10.9374 0.000118187C11.3523 0.000118169 11.7502 0.164944 12.0436 0.45834L21.4186 9.83334C21.5641 9.97848 21.6796 10.1509 21.7583 10.3407C21.8371 10.5306 21.8777 10.7341 21.8777 10.9396C21.8777 11.1451 21.8371 11.3486 21.7583 11.5384C21.6796 11.7283 21.5641 11.9007 21.4186 12.0458L12.0436 21.4208C11.8985 21.5664 11.726 21.6818 11.5362 21.7606C11.3464 21.8393 11.1429 21.8799 10.9374 21.8799C10.7318 21.8799 10.5283 21.8393 10.3385 21.7606C10.1487 21.6818 9.97626 21.5664 9.83111 21.4208Z" />
													<path fill-rule="evenodd" clip-rule="evenodd" d="M-6.8299e-08 10.9395C-8.64131e-08 10.5251 0.16462 10.1276 0.457646 9.8346C0.750671 9.54157 1.1481 9.37695 1.5625 9.37695L17.1875 9.37695C17.6019 9.37695 17.9993 9.54157 18.2924 9.8346C18.5854 10.1276 18.75 10.5251 18.75 10.9395C18.75 11.3539 18.5854 11.7513 18.2924 12.0443C17.9993 12.3373 17.6019 12.502 17.1875 12.502L1.5625 12.502C1.1481 12.502 0.750672 12.3373 0.457646 12.0443C0.16462 11.7513 -5.0185e-08 11.3539 -6.8299e-08 10.9395Z" />
												</svg>
											</button>
										</div>
									<? endif; ?>
								</div>
								<div class="carousel-result carousel__wrapper">
									<? if ($imageCount > 2) : ?>
										<div class="swiper-container swiper_js">
											<div class="swiper-wrapper">
											<? endif; ?>
											<?
											$imageIndex = 0;
											foreach ($arSection['UF_COLLECTION_RESULTS'] as $imageId) :
											?>
												<? if (!($imageIndex % 2)) : ?>
													<div class="swiper-slide carousel-result__slide">
													<? endif; ?>
													<? $resultImage = CFile::ResizeImageGet($imageId, array('width' => 592, 'height' => 400), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
													<div class="swiper__illustration">
														<img src="<?= $resultImage['src']; ?>" alt="Результат до/после" title="Результат до/после" class="swiper__img" width="<?= $resultImage['width']; ?>" height="<?= $resultImage['height']; ?>">
													</div>
													<? if ($imageIndex % 2) : ?>
													</div>
												<? endif; ?>
												<? $imageIndex++ ?>
											<? endforeach; ?>
											<? if ($imageCount % 2) : ?>
											</div>
										<? endif; ?>
										<? if ($imageCount > 2) : ?>
										</div>
										<div class="carousel__footer">
											<div class="swiper-pagination"></div>
										</div>
								</div>
							<? endif; ?>
							</div>
						</div>
						</div>
					</section>
				<? endif; ?>
				<?/*Временно отключил - 36126*/ if (!$detailedCollection && $arSection['UF_BOTTOM_BANNER_PC']) : ?>
					<div class="container desktop-show">
						<section class="banner banner-catalog">
							<?
							BitrixTools::showImageCustom(
								array(
									'IMAGE_ID' => $arSection['UF_BOTTOM_BANNER_PC'],
									'CLASS' => 'full-img',
									'LAZY_LOAD' => 'Y',
								)
							);
							?>
							<?/*?>
				<img src="<?= CFile::GetPath($arSection['UF_BOTTOM_BANNER_PC']) ?>" class="full-img" />
				<?*/ ?>
						</section>
					</div>
					<div class="container middle-show">
						<section class="banner banner-catalog">
							<?
							BitrixTools::showImageCustom(
								array(
									'IMAGE_ID' => $arSection['UF_BOTTOM_BANNER_PC'],
									'CLASS' => 'full-img',
									'LAZY_LOAD' => 'Y',
								)
							);
							?>
							<?/*?>
				<img src="<?= CFile::GetPath($arSection['UF_BOTTOM_BANNER_PC']) ?>" class="full-img" />
				<?*/ ?>
						</section>
					</div>
				<? endif; ?>
				<? if ($arSection['UF_BANNER_BOTTOM_MOB']) : ?>
					<div class="container show-mobile-cont desktop-hidden">
						<section class="banner banner-catalog">
							<? $picBottomMobile = CFile::ResizeImageGet($arSection['UF_BANNER_BOTTOM_MOB'], array('width' => 320, 'height' => 180), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
							<?
							BitrixTools::showImageCustom(
								array(
									'SRC' => $picBottomMobile['src'],
									'WIDTH' => $picBottomMobile['width'],
									'HEIGHT' => $picBottomMobile['height'],
									'CLASS' => 'show-mobile',
									'LAZY_LOAD' => 'Y',
								)
							);
							?>
							<?/*?>
				<img src="<?= $picBottomMobile['src'] ?>" class="show-mobile" />
				<?*/ ?>
						</section>
					</div>
				<? endif; ?>
				<!-- 30080 -->
				<? if ($arSection["ID"] == 440) : ?>
					<section class="content" style="margin-top: -120px;">
						<? $APPLICATION->IncludeComponent(
							"bitrix:iblock.element.add.form",
							"order_request",
							array(
								"SEF_MODE" => "Y",
								"IBLOCK_TYPE" => "forms",
								"IBLOCK_ID" => "31",
								"PROPERTY_CODES" => array(
									0 => "116",
									1 => "117",
									2 => "118",
									3 => "119",
									4 => "120",
								),
								"PROPERTY_CODES_REQUIRED" => array(
									0 => "116",
									1 => "117",
									2 => "118",
									3 => "119",
									4 => "120",
								),
								"GROUPS" => array(
									0 => "2",
								),
								"STATUS_NEW" => "N",
								"STATUS" => "ANY",
								"LIST_URL" => "",
								"ELEMENT_ASSOC" => "CREATED_BY",
								"ELEMENT_ASSOC_PROPERTY" => "",
								"MAX_USER_ENTRIES" => "100000",
								"MAX_LEVELS" => "100000",
								"LEVEL_LAST" => "Y",
								"USE_CAPTCHA" => "Y",
								"USER_MESSAGE_EDIT" => "",
								"USER_MESSAGE_ADD" => "",
								"DEFAULT_INPUT_SIZE" => "30",
								"RESIZE_IMAGES" => "Y",
								"MAX_FILE_SIZE" => "0",
								"PREVIEW_TEXT_USE_HTML_EDITOR" => "Y",
								"DETAIL_TEXT_USE_HTML_EDITOR" => "Y",
								"CUSTOM_TITLE_NAME" => "",
								"CUSTOM_TITLE_TAGS" => "",
								"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
								"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
								"CUSTOM_TITLE_IBLOCK_SECTION" => "",
								"CUSTOM_TITLE_PREVIEW_TEXT" => "",
								"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
								"CUSTOM_TITLE_DETAIL_TEXT" => "",
								"CUSTOM_TITLE_DETAIL_PICTURE" => "",
								"SEF_FOLDER" => "/",
								"COMPONENT_TEMPLATE" => "order_request"
							),
							false
						); ?>
					</section>
				<? endif; ?>
				<!-- 30080 END -->
				<section class="ask-question <? if (!$arSection['UF_BANNER_BOTTOM_MOB']) {
													echo "ask-question-mt-0";
												} ?>">
					<div class="container">
						<div class="ask-question__text">
							<p>У вас есть вопросы? Задайте их нашим специалистам. Для этого заполните форму и отправьте её. Мы ответим вам в течении 24 часов.</p>
						</div>
						<div class="ask-question__button"><a href="#askQuestion" data-popup class="button _big">Задать вопрос</a></div>
					</div>
				</section>