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
<section class="dp-section">
	<div class="container">
		<a class="materials-card__button" href="#">
			<svg class="icon icon-drop-left ">
				<use xlink:href="#drop-left"></use>
			</svg><span>Материалы</span>
		</a>
		<h1 class="materials-card__title"><?= $arResult['NAME']; ?></h1>
		<div class="materials-card__wrapper">
			<img src="<?= $arResult['PICTURE']['SRC']; ?>" alt="<?= $arResult['PICTURE']['ALT']; ?>" title="<?= $arResult['PICTURE']['TITLE']; ?>" />
		</div>
		<div class="materials-card__wrapper">
			<?= $arResult['DETAIL_TEXT']; ?>
		</div>
		<? if (!empty($arResult['DISPLAY_PROPERTIES']['COLOR_OPTIONS']['VALUE'])) { ?>
			<div class="materials-card__wrapper">

				<?
				$GLOBALS['arrFilterColorOptions']['ID'] = $arResult['DISPLAY_PROPERTIES']['COLOR_OPTIONS']['VALUE'];
				?>
				<div class="materials-colors__wrapper">
					<h3 class="materials-card__subtitle">Варианты окраски <?= $arResult['DISPLAY_PROPERTIES']['MATERIAL_NAME']['VALUE']; ?></h3>
					<? $APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"color_options",
						array(
							"DISPLAY_DATE" => "N",
							"DISPLAY_NAME" => "N",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"AJAX_MODE" => "N",
							"IBLOCK_TYPE" => "directory",
							"IBLOCK_ID" => Indexis::getIblockId('color_options', 'directory'),
							"NEWS_COUNT" => "200",
							"SORT_BY1" => 'SORT',
							"SORT_ORDER1" => 'ASC',
							"SORT_BY2" => "SORT",
							"SORT_ORDER2" => "ASC",
							"FILTER_NAME" => "arrFilterColorOptions",
							"FIELD_CODE" => array("ID", 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'),
							"PROPERTY_CODE" => array('MAIN', 'SERIES'),
							"CHECK_DATES" => "N",
							"DETAIL_URL" => "",
							"PREVIEW_TRUNCATE_LEN" => "",
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"SET_TITLE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_LAST_MODIFIED" => "N",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"ADD_SECTIONS_CHAIN" => "N",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"PARENT_SECTION" => "",
							"PARENT_SECTION_CODE" => "",
							"INCLUDE_SUBSECTIONS" => "Y",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "3600",
							"CACHE_FILTER" => "Y",
							"CACHE_GROUPS" => "Y",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "N",
							"PAGER_TITLE" => "Подразделы",
							"PAGER_SHOW_ALWAYS" => "Y",
							"PAGER_TEMPLATE" => "show_more",
							//"PAGER_TEMPLATE" => "",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"SET_STATUS_404" => "N",
							"SHOW_404" => "N",
							"MESSAGE_404" => "",
							"PAGER_BASE_LINK" => "",
							"PAGER_PARAMS_NAME" => "arrPager",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",

							// Мои параметры -->
							// <-- Мои параметры
						)
					); ?>
				</div>

			</div>
		<? } ?>
		<? if (!empty($arResult['DISPLAY_PROPERTIES']['INVOICE_OPTIONS']['VALUE'])) { ?>
			<div class="materials-card__wrapper">
				<?
				$GLOBALS['arrFilterInvoiceOptions']['ID'] = $arResult['DISPLAY_PROPERTIES']['INVOICE_OPTIONS']['VALUE'];
				?>
				<div class="materials-colors__wrapper">
					<h3 class="materials-card__subtitle">Варианты фактур <?= $arResult['DISPLAY_PROPERTIES']['MATERIAL_NAME']['VALUE']; ?></h3>
					<? $APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"color_options",
						array(
							"DISPLAY_DATE" => "N",
							"DISPLAY_NAME" => "N",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"AJAX_MODE" => "N",
							"IBLOCK_TYPE" => "directory",
							"IBLOCK_ID" => Indexis::getIblockId('invoice_options', 'directory'),
							"NEWS_COUNT" => "200",
							"SORT_BY1" => 'SORT',
							"SORT_ORDER1" => 'ASC',
							"SORT_BY2" => "SORT",
							"SORT_ORDER2" => "ASC",
							"FILTER_NAME" => "arrFilterInvoiceOptions",
							"FIELD_CODE" => array("ID", 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'),
							"PROPERTY_CODE" => array('MAIN', 'SERIES'),
							"CHECK_DATES" => "N",
							"DETAIL_URL" => "",
							"PREVIEW_TRUNCATE_LEN" => "",
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"SET_TITLE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_LAST_MODIFIED" => "N",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"ADD_SECTIONS_CHAIN" => "N",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"PARENT_SECTION" => "",
							"PARENT_SECTION_CODE" => "",
							"INCLUDE_SUBSECTIONS" => "Y",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "3600",
							"CACHE_FILTER" => "Y",
							"CACHE_GROUPS" => "Y",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "N",
							"PAGER_TITLE" => "Подразделы",
							"PAGER_SHOW_ALWAYS" => "Y",
							"PAGER_TEMPLATE" => "show_more",
							//"PAGER_TEMPLATE" => "",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"SET_STATUS_404" => "N",
							"SHOW_404" => "N",
							"MESSAGE_404" => "",
							"PAGER_BASE_LINK" => "",
							"PAGER_PARAMS_NAME" => "arrPager",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",

							// Мои параметры -->
							// <-- Мои параметры
						)
					); ?>
				</div>

			</div>
		<? } ?>
		<? if (!empty($arResult['DISPLAY_PROPERTIES']['COLOR']['VALUE'])) { ?>
			<div class="materials-card__wrapper">
				<?
				$GLOBALS['arrFilterColors']['ID'] = $arResult['DISPLAY_PROPERTIES']['COLOR']['VALUE'];
				$GLOBALS['arrFilterColors']['!PROPERTY_COLOR_CODE'] = false;
				?>
				<div class="materials-colors__wrapper">
					<h3 class="materials-card__subtitle">Цвета</h3>
					<? $APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"colors",
						array(
							"DISPLAY_DATE" => "N",
							"DISPLAY_NAME" => "N",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"AJAX_MODE" => "N",
							"IBLOCK_TYPE" => "directory",
							"IBLOCK_ID" => Indexis::getIblockId('colors', 'directory'),
							"NEWS_COUNT" => "200",
							"SORT_BY1" => 'SORT',
							"SORT_ORDER1" => 'ASC',
							"SORT_BY2" => "SORT",
							"SORT_ORDER2" => "ASC",
							"FILTER_NAME" => "arrFilterColors",
							"FIELD_CODE" => array("ID", 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'),
							"PROPERTY_CODE" => array('MAIN', 'SERIES', 'COLOR_CODE', 'CODE'),
							"CHECK_DATES" => "N",
							"DETAIL_URL" => "",
							"PREVIEW_TRUNCATE_LEN" => "",
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"SET_TITLE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_LAST_MODIFIED" => "N",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"ADD_SECTIONS_CHAIN" => "N",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"PARENT_SECTION" => "",
							"PARENT_SECTION_CODE" => "",
							"INCLUDE_SUBSECTIONS" => "Y",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "3600",
							"CACHE_FILTER" => "Y",
							"CACHE_GROUPS" => "Y",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "N",
							"PAGER_TITLE" => "Подразделы",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_TEMPLATE" => "",
							//"PAGER_TEMPLATE" => "",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"SET_STATUS_404" => "N",
							"SHOW_404" => "N",
							"MESSAGE_404" => "",
							"PAGER_BASE_LINK" => "",
							"PAGER_PARAMS_NAME" => "arrPager",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",

							// Мои параметры -->
							"SHOW_PAGER" => "N",
							"SHOW_HEADER" => "N",
							// <-- Мои параметры
						)
					); ?>
				</div>

			</div>
		<? } ?>
		<?
		$GLOBALS['arrFilterSeeAlsoMaterials']['!ID'] = $arResult['ID'];
		$GLOBALS['arrFilterSeeAlsoMaterials']['SECTION_ID'] = $arResult['IBLOCK_SECTION_ID'];
		?>
		<? $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"see_also",
			array(
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "N",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"AJAX_MODE" => "N",
				"IBLOCK_TYPE" => "content",
				"IBLOCK_ID" => Indexis::getIblockId('materials', 'content'),
				"NEWS_COUNT" => "200",
				"SORT_BY1" => 'SORT',
				"SORT_ORDER1" => 'ASC',
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "arrFilterSeeAlsoMaterials",
				"FIELD_CODE" => array("ID", 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL'),
				"PROPERTY_CODE" => array(''),
				"CHECK_DATES" => "N",
				"DETAIL_URL" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"SET_TITLE" => "N",
				"SET_BROWSER_TITLE" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"INCLUDE_SUBSECTIONS" => "Y",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"PAGER_TITLE" => "Подразделы",
				"PAGER_SHOW_ALWAYS" => "Y",
				"PAGER_TEMPLATE" => "show_more",
				//"PAGER_TEMPLATE" => "",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"SET_STATUS_404" => "N",
				"SHOW_404" => "N",
				"MESSAGE_404" => "",
				"PAGER_BASE_LINK" => "",
				"PAGER_PARAMS_NAME" => "arrPager",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",

				// Мои параметры -->
				// <-- Мои параметры
			)
		); ?>

		<a class="dp-btn materials-item__button" href="<?= $arParams['LIST_URL']; ?>">
			<svg class="icon icon-drop-left ">
				<use xlink:href="#drop-left"></use>
			</svg><span>К списку материалов</span>
		</a>
	</div>
</section>