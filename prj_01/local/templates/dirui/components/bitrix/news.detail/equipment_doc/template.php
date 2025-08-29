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

if (!empty($arResult['ID'])) {
?>
	<section class="documentation">
		<div class="documentation__title">
			<h2><?= $arResult['NAME']; ?></h2>
			<div class="documentation__title-image">
				<img src="<?= $arResult['PICTURE']['SRC']; ?>" alt="<?= $arResult['PICTURE']['ALT']; ?>" title="<?= $arResult['PICTURE']['TITLE']; ?>" />
			</div>
		</div>
		<div class="page-wrapper">
			<div class="page-menu">
				<ul class="page-menu__list">
					<? if ($arResult["SHOW"]["VIDEO"]["SHOW"]) { ?>
						<li class="page-menu__item"><a class="page-menu__link" href="#videolessons">Видео-уроки</a></li>
					<? } ?>
					<? if ($arResult["SHOW"]["TECHNICAL"]["SHOW"]) { ?>
						<li class="page-menu__item"><a class="page-menu__link" href="#technical">Техническая документация</a></li>
					<? } ?>
					<? if ($arResult["SHOW"]["CLINICAL"]["SHOW"]) { ?>
						<li class="page-menu__item"><a class="page-menu__link" href="#instructions">Инструкции</a></li>
					<? } ?>
					<? if ($arResult["SHOW"]["PERMITS"]["SHOW"]) { ?>
						<li class="page-menu__item"><a class="page-menu__link" href="#documentation">Разрешительные документы</a></li>
					<? } ?>
				</ul>
				<a class="link-button_rose" href="#callback">Связаться с нами</a>
				<a class="link-button_grey" href="<?= $arResult['DETAIL_PAGE_URL'] ?>">Подробнее о <?= $arResult['NAME']; ?></a>
			</div>
			<div class="page-body">
				<?
				$IBLOCK_ID = Indexis::getIblockId("video", "knowledge");
				?>
				<? if ($arResult["SHOW"]["VIDEO"]["SHOW"] && intval( $IBLOCK_ID ) > 0) { ?>
					<div class="page-body__wrapper">
						<h3 class="documentation__anchor" id="videolessons">Видео-уроки</h3>
						<div class="documentation__slider">
							<?
							$GLOBALS['arrFilterKnowledgeVideo']['PROPERTY_EQUIPMENT'] = $arResult['ID'];
							$GLOBALS['arrFilterKnowledgeVideo'][] = array(
								"LOGIC" => "OR",
								array("!PROPERTY_VIDEO" => false),
								array("!PROPERTY_URL" => false),
							);
							?>
							<? $APPLICATION->IncludeComponent(
								"bitrix:news.list",
								"knowledge_video",
								array(
									"DISPLAY_DATE" => "N",
									"DISPLAY_NAME" => "Y",
									"DISPLAY_PICTURE" => "Y",
									"DISPLAY_PREVIEW_TEXT" => "Y",
									"AJAX_MODE" => "N",
									"IBLOCK_TYPE" => "knowledge",
									"IBLOCK_ID" => $IBLOCK_ID,
									"IBLOCK_CODE" => '',
									"NEWS_COUNT" => "100",
									"SORT_BY2" => "ACTIVE_FROM",
									"SORT_ORDER2" => "DESC",
									"SORT_BY1" => "SORT",
									"SORT_ORDER1" => "ASC",
									"FILTER_NAME" => 'arrFilterKnowledgeVideo',
									"FIELD_CODE" => array('ID', 'NAME', 'PREVIEW_PICTURE'),
									"PROPERTY_CODE" => array('VIDEO', 'URL'),
									"CHECK_DATES" => "Y",
									"DETAIL_URL" => "",
									"PREVIEW_TRUNCATE_LEN" => "",
									"ACTIVE_DATE_FORMAT" => "d.m.Y",
									"SET_TITLE" => "N",
									"SET_BROWSER_TITLE" => "Y",
									"SET_META_KEYWORDS" => "Y",
									"SET_META_DESCRIPTION" => "N",
									"SET_LAST_MODIFIED" => "Y",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"ADD_SECTIONS_CHAIN" => "N",
									"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
									"PARENT_SECTION" => "",
									"PARENT_SECTION_CODE" => "",
									"INCLUDE_SUBSECTIONS" => "Y",
									"CACHE_TYPE" => "A",
									"CACHE_TIME" => "3600",
									"CACHE_FILTER" => "Y",
									"CACHE_GROUPS" => "Y",
									"DISPLAY_TOP_PAGER" => "Y",
									"DISPLAY_BOTTOM_PAGER" => "Y",
									"PAGER_TITLE" => "Новости",
									"PAGER_SHOW_ALWAYS" => "Y",
									"PAGER_TEMPLATE" => "show_more_clinical",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "N",
									"PAGER_BASE_LINK_ENABLE" => "Y",
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
									'POPUP_BUFFER' => 'Y',
									// <-- Мои параметры 
								)
							); ?>
						</div>
					</div>
				<? } ?>
				<? if ($arResult["SHOW"]["TECHNICAL"]["SHOW"]) { ?>
					<div class="page-body__wrapper">
						<h3 class="documentation__anchor" id="technical">Техническая документация</h3>
						<?
						$GLOBALS['arrFilterTechnical']["!PROPERTY_FILE"] = false;
						$GLOBALS['arrFilterTechnical']['PROPERTY_EQUIPMENT'] = $arResult['ID'];
						?>
						<? $APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"knowledge_clinical",
							array(
								"DISPLAY_DATE" => "N",
								"DISPLAY_NAME" => "Y",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "Y",
								"AJAX_MODE" => "N",
								"IBLOCK_TYPE" => "knowledge",
								"IBLOCK_ID" => Indexis::getIblockId("technical", "knowledge"),
								"IBLOCK_CODE" => '',
								"NEWS_COUNT" => "100",
								"SORT_BY2" => "ACTIVE_FROM",
								"SORT_ORDER2" => "DESC",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"FILTER_NAME" => 'arrFilterTechnical',
								"FIELD_CODE" => array('ID', 'NAME', 'ACTIVE_FROM'),
								"PROPERTY_CODE" => array('FILE'),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_BROWSER_TITLE" => "Y",
								"SET_META_KEYWORDS" => "Y",
								"SET_META_DESCRIPTION" => "N",
								"SET_LAST_MODIFIED" => "Y",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "3600",
								"CACHE_FILTER" => "Y",
								"CACHE_GROUPS" => "Y",
								"DISPLAY_TOP_PAGER" => "Y",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => "Новости",
								"PAGER_SHOW_ALWAYS" => "Y",
								"PAGER_TEMPLATE" => "show_more_clinical",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"PAGER_BASE_LINK_ENABLE" => "Y",
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
								//'CUSTOM_SECTION_SORT' => $CUSTOM_SECTION_SORT,
								// <-- Мои параметры 
							)
						); ?>
					</div>
				<? } ?>
				<? if ($arResult["SHOW"]["CLINICAL"]["SHOW"]) { ?>
					<div class="page-body__wrapper">
						<h3 class="documentation__anchor" id="instructions">Инструкции</h3>
						<?
						$GLOBALS['arrFilterClinical']["!PROPERTY_FILE"] = false;
						$GLOBALS['arrFilterClinical']['PROPERTY_EQUIPMENT'] = $arResult['ID'];
						?>
						<? $APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"knowledge_clinical",
							array(
								"DISPLAY_DATE" => "N",
								"DISPLAY_NAME" => "Y",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "Y",
								"AJAX_MODE" => "N",
								"IBLOCK_TYPE" => "knowledge",
								"IBLOCK_ID" => Indexis::getIblockId("clinical", "knowledge"),
								"IBLOCK_CODE" => '',
								"NEWS_COUNT" => "100",
								"SORT_BY2" => "ACTIVE_FROM",
								"SORT_ORDER2" => "DESC",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"FILTER_NAME" => 'arrFilterClinical',
								"FIELD_CODE" => array('ID', 'NAME', 'ACTIVE_FROM'),
								"PROPERTY_CODE" => array('FILE'),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_BROWSER_TITLE" => "Y",
								"SET_META_KEYWORDS" => "Y",
								"SET_META_DESCRIPTION" => "N",
								"SET_LAST_MODIFIED" => "Y",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "3600",
								"CACHE_FILTER" => "Y",
								"CACHE_GROUPS" => "Y",
								"DISPLAY_TOP_PAGER" => "Y",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => "Новости",
								"PAGER_SHOW_ALWAYS" => "Y",
								"PAGER_TEMPLATE" => "show_more_clinical",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"PAGER_BASE_LINK_ENABLE" => "Y",
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
								//'CUSTOM_SECTION_SORT' => $CUSTOM_SECTION_SORT,
								// <-- Мои параметры 
							)
						); ?>
					</div>
				<? } ?>
				<? if ($arResult["SHOW"]["PERMITS"]["SHOW"]) { ?>
					<div class="page-body__wrapper">
						<h3 class="documentation__anchor" id="documentation">Разрешительные документы</h3>
						<?
						$GLOBALS['arrFilterPermits']["!PROPERTY_FILE"] = false;
						$GLOBALS['arrFilterPermits']['PROPERTY_EQUIPMENT'] = $arResult['ID'];
						?>
						<? $APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"knowledge_clinical",
							array(
								"DISPLAY_DATE" => "N",
								"DISPLAY_NAME" => "Y",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "Y",
								"AJAX_MODE" => "N",
								"IBLOCK_TYPE" => "knowledge",
								"IBLOCK_ID" => Indexis::getIblockId("permits", "knowledge"),
								"IBLOCK_CODE" => '',
								"NEWS_COUNT" => "100",
								"SORT_BY2" => "ACTIVE_FROM",
								"SORT_ORDER2" => "DESC",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"FILTER_NAME" => 'arrFilterPermits',
								"FIELD_CODE" => array('ID', 'NAME', 'ACTIVE_FROM'),
								"PROPERTY_CODE" => array('FILE'),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_BROWSER_TITLE" => "Y",
								"SET_META_KEYWORDS" => "Y",
								"SET_META_DESCRIPTION" => "N",
								"SET_LAST_MODIFIED" => "Y",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "3600",
								"CACHE_FILTER" => "Y",
								"CACHE_GROUPS" => "Y",
								"DISPLAY_TOP_PAGER" => "Y",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => "Новости",
								"PAGER_SHOW_ALWAYS" => "Y",
								"PAGER_TEMPLATE" => "show_more_clinical",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"PAGER_BASE_LINK_ENABLE" => "Y",
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
								'CHECK_PARTNER' => 'Y',
								'USER_GROUPS' => $USER->GetUserGroupArray(),
								// <-- Мои параметры 
							)
						); ?>
					</div>
				<? } ?>
			</div>
		</div>
	</section>
<?
}
?>