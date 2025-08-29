<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
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
<?
// Детальная страница -->
$DETAIL_URL = $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"];
if (!empty($arParams['CUSTOM_DETAIL_URL'])) {
	$DETAIL_URL = $arParams['CUSTOM_DETAIL_URL'];
}
// <-- Детальная страница
?>

<?
// Сохранённые материалы -->
$bNoSavedMaterials = false;
$arSavedIds = array();
if ($arParams['SHOW_SAVED'] == 'Y') {
	$arResultFunc = CMaterials::getSavedMaterials(array(
		"USER_ID" => $USER->GetID(),
		'MATERIAL_IBLOCK_ID' => [
			Indexis::getIblockId("articles", "content"),
			Indexis::getIblockId("webinars", "content"),
			Indexis::getIblockId("master-class", "content")
		],
		'CURRENT_IBLOCK_ID' => $arParams["IBLOCK_ID"],
	));
	if (!empty($arResultFunc['arFilterResult']['ID'])) {
		$GLOBALS[$arParams["~FILTER_NAME"]] = array(
			'PROPERTY_MATERIAL_IBLOCK_ID' => $arParams["IBLOCK_ID"],
		);
		//$GLOBALS[$arParams["~FILTER_NAME"]]['IBLOCK_ID'] = $arParams["IBLOCK_ID"];
		foreach ($arResultFunc['arFilterResult']['ID'] as $key => $val) {
			$GLOBALS[$arParams["~FILTER_NAME"]]['ID'][] = $val;
		}
		$arSavedIds = $GLOBALS[$arParams["~FILTER_NAME"]]['ID'];
	} else {
		$bNoSavedMaterials = true;
	}
}
//echo '1 FILTER_NAME = '.$arParams["~FILTER_NAME"].'<br />';
//vardump($arParams);
//vardump($GLOBALS[$arParams["~FILTER_NAME"]]);
// <-- Сохранённые материалы
?>

<? if (!$bNoSavedMaterials || 1) { ?>
	<div class="dp-page__header">
		<?/*?>
		<? if (!$bNoSavedMaterials || 1) { ?>
			<? if ($arParams['SHOW_BACK_TO_RECOMMEND'] == 'Y' || $bNoSavedMaterials) { ?>
				<?
				include($_SERVER["DOCUMENT_ROOT"] . "/local/include/materials/back_to_personal.php");
				?>
			<? } ?>
		<? } ?>
		<?*/ ?>

		<? if (!$bNoSavedMaterials) { ?>
			<h1 class="dp-page__title"><? $APPLICATION->ShowProperty('PAGE_H1'); ?></h1>
			<h2><? $APPLICATION->ShowProperty('PAGE_H2'); ?></h2>
		<? } ?>

		<? if ($arParams['SHOW_TABS'] == 'Y') { ?>
			<?
			$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR . "/local/include/materials/tabs.php",
					"MATERIAL_TYPE" => $arParams['MATERIAL_TYPE'],
					"IBLOCKS" => $arResultFunc["iblocks"]
				)
			);
			?>
		<? } ?>

		<? if (!$bNoSavedMaterials) { ?>
			<? if ($arParams['SHOW_FILTER'] == 'Y') { ?>
				<? $arFilterFromComponent = $APPLICATION->IncludeComponent(
					"indexis:filter.materials",
					"materials",
					array(
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "Y",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",

						//"PERSONAL" => "Y",
						"USER_ID" => $USER->GetID(),
						"HIBLOCK_ID" => $GLOBALS['arSiteConfig']['HIBLOCK']['THEMES']['ID'],
					)
				); ?>
				<?
				// Фильтр -->
				$arResultFunc = CMaterials::getFilterMaterials(array(
					"arFilterFromComponent" => $arFilterFromComponent,
					"USER_ID" => $USER->GetID(),
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"MATERIAL_TYPE" => $arParams['MATERIAL_TYPE'],
				));
				if (!empty($arResultFunc['arFilterResult'])) {
					foreach ($arResultFunc['arFilterResult'] as $key => $val) {
						$GLOBALS[$arParams["~FILTER_NAME"]][$key] = $arResultFunc['arFilterResult'][$key];
					}
					//$_GET['']
				}
				//vardump($GLOBALS[$arParams["~FILTER_NAME"]]);
				// <-- Фильтр
				?>
			<? } ?>
		<? } ?>

		<? if (!$bNoSavedMaterials) { ?>
			<? if ($arParams['SHOW_SORT_PANEL'] == 'Y') { ?>
				<div class="dp-sort-panel">
					<?
					include($_SERVER["DOCUMENT_ROOT"] . "/local/include/materials/sort.php");
					?>
					<?
					include($_SERVER["DOCUMENT_ROOT"] . "/local/include/materials/search.php");
					?>
				</div>
			<? } ?>
		<? } ?>
	</div>
<? } ?>
<div class="dp-page__body">
	<?
	if ($bNoSearchResults) {
		//ShowError('Ничего не найдено');
	?>
		<div class="dp-empty-results">
			<div class="note">
				<p>
					Материалы с выбранными параметрами фильтрации и поиска не найдены.<br>
					Попробуйте изменить условия поиска.
				</p>
			</div>
		</div>
	<?
	} else if ($bNoSavedMaterials) {
		//ShowError('Нет сохраненных материалов');
		$APPLICATION->AddViewContent('STUB_HEADER_CONTENT_1', '<div class="dp-page__bg"><div class="dp-page__inner">');
		$APPLICATION->AddViewContent('STUB_HEADER_CONTENT_2', '</div></div>');
	?>
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR . "/local/include/materials/no_saved_materials.php",
			)
		); ?>
	<?
	} else {
	?>
		<?
		//vardump($GLOBALS[$arParams["~FILTER_NAME"]]);
		if ($arParams['MATERIAL_TYPE'] == 'WEBINARS') {
			$GLOBALS[$arParams["~FILTER_NAME"]]['!PROPERTY_FILE'] = false;
		}
		?>
		<? $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			$arParams['LIST_TEMPLATE'],
			[
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"NEWS_COUNT" => $arParams["NEWS_COUNT"],
				"SORT_BY1" => $arParams["SORT_BY1"],
				"SORT_ORDER1" => $arParams["SORT_ORDER1"],
				"SORT_BY2" => $arParams["SORT_BY2"],
				"SORT_ORDER2" => $arParams["SORT_ORDER2"],
				"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"DETAIL_URL" => $DETAIL_URL,
				"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
				"IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
				"MESSAGE_404" => $arParams["MESSAGE_404"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"SHOW_404" => $arParams["SHOW_404"],
				"FILE_404" => $arParams["FILE_404"],
				"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
				"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
				"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
				"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
				"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
				"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
				"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
				"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
				"FILTER_NAME" => $arParams["~FILTER_NAME"],
				"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
				"CHECK_DATES" => $arParams["CHECK_DATES"],

				// Мои параметры -->
				'HEADER' => 'Статьи',
				'SHOW_MORE_SHOW' => 'N',
				'SHOW_H2' => 'N',
				'USER_AUTHORIZED' => $USER->IsAuthorized() ? 'Y' : 'N',
				'SAVED_IDS' => $arSavedIds,
				'FILTER' => $GLOBALS[$arParams["~FILTER_NAME"]],
				'SHOW_EMPTY_BLOCK' => $arParams['SHOW_EMPTY_BLOCK'] ? $arParams['SHOW_EMPTY_BLOCK'] : 'N',
				'OG' => $arParams['OG'],
				'USER_ORDERS' => $arParams['USER_ORDERS'],
				// <-- Мои параметры
			],
			$component,
			['HIDE_ICONS' => 'N']
		); ?>
	<? } ?>
</div>