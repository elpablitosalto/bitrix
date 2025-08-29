<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
//$APPLICATION->SetPageProperty("title", "Демонстрационная версия продукта «1С-Битрикс: Управление сайтом»");
//$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Главная страница");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'HomePage sect_or bigSlider');
?>

<? $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"about",
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"USE_SHARE" => "N",
		"SHARE_HIDE" => "Y",
		"SHARE_TEMPLATE" => "",
		"SHARE_HANDLERS" => array("delicious"),
		"SHARE_SHORTEN_URL_LOGIN" => "",
		"SHARE_SHORTEN_URL_KEY" => "",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => 'main',
		"IBLOCK_ID" => Indexis::getIblockId('intro', 'main'),
		"ELEMENT_ID" => "",
		"ELEMENT_CODE" => "main_intro",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PICTURE', 'DETAIL_TEXT'),
		"PROPERTY_CODE" => array("H_2", 'IMAGES'),
		"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
		"DETAIL_URL" => "",
		"SET_TITLE" => "Y",
		"SET_CANONICAL_URL" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_STATUS_404" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"USE_PERMISSIONS" => "N",
		"GROUP_PERMISSIONS" => array("1"),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Страница",
		"PAGER_TEMPLATE" => "",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "Y",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
); ?>

<?
/*
// Тизеры на слайдшоу -->
ob_start();
?>
<div id="HomeTeaserSection">
	<a class="homeTeaserArea" href="/catalog/sad-i-dom/" title="Сад и дом">Сад и дом</a>
	<a class="homeTeaserArea" href="/catalog/obshchestvennye-prostranstva/" title="Общественные пространства">Общественные пространства</a>
</div>
<?
$out2 = ob_get_contents();
ob_end_clean();
$APPLICATION->AddViewContent('homeTeaserSection', $out2);
// <-- Тизеры на слайдшоу
*/
?>

<?
// FirstContent -->
ob_start();
?>
<div id="HomeTeaserSection">
	<a class="homeTeaserArea" href="catalog-section.html" title="Сад и дом">Сад и дом</a>
	<a class="homeTeaserArea" href="catalog-section.html" title="Общественные пространства">Общественные пространства</a>
</div>
<?
$out2 = ob_get_contents();
ob_end_clean();
$APPLICATION->AddViewContent('homeTeaserSection', $out2);
// <-- FirstContent
?>

<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"about_tile",
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "main",
		"IBLOCK_ID" => Indexis::getIblockId('subsections', 'main'),
		"NEWS_COUNT" => "200",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array("ID", 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'),
		"PROPERTY_CODE" => array("URL"),
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
		"AJAX_OPTION_ADDITIONAL" => ""
	)
); ?>

<div class="bgDGrau">
	<div class="respBlock">
		<? $APPLICATION->IncludeComponent(
			"bitrix:news.detail",
			"main_video_intro",
			array(
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "N",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"USE_SHARE" => "N",
				"SHARE_HIDE" => "Y",
				"SHARE_TEMPLATE" => "",
				"SHARE_HANDLERS" => array("delicious"),
				"SHARE_SHORTEN_URL_LOGIN" => "",
				"SHARE_SHORTEN_URL_KEY" => "",
				"AJAX_MODE" => "N",
				"IBLOCK_TYPE" => 'main',
				"IBLOCK_ID" => Indexis::getIblockId('video_intro', 'main'),
				"ELEMENT_ID" => "",
				"ELEMENT_CODE" => "main_video_intro",
				"CHECK_DATES" => "Y",
				"FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PICTURE', 'DETAIL_TEXT', 'PREVIEW_TEXT'),
				"PROPERTY_CODE" => array("H_2", 'IMAGES'),
				"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
				"DETAIL_URL" => "",
				"SET_TITLE" => "Y",
				"SET_CANONICAL_URL" => "Y",
				"SET_BROWSER_TITLE" => "Y",
				"BROWSER_TITLE" => "-",
				"SET_META_KEYWORDS" => "Y",
				"META_KEYWORDS" => "-",
				"SET_META_DESCRIPTION" => "Y",
				"META_DESCRIPTION" => "-",
				"SET_STATUS_404" => "N",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"ADD_ELEMENT_CHAIN" => "N",
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"USE_PERMISSIONS" => "N",
				"GROUP_PERMISSIONS" => array("1"),
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600",
				"CACHE_GROUPS" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"PAGER_TITLE" => "Страница",
				"PAGER_TEMPLATE" => "",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_BASE_LINK_ENABLE" => "Y",
				"SHOW_404" => "N",
				"MESSAGE_404" => "",
				"STRICT_SECTION_CHECK" => "Y",
				"PAGER_BASE_LINK" => "",
				"PAGER_PARAMS_NAME" => "arrPager",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N"
			)
		); ?>
		<div id="LowerBigBlocks" class="bigBlocks">
			<? $APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"main_news_tile",
				array(
					"DISPLAY_DATE" => "N",
					"DISPLAY_NAME" => "N",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"AJAX_MODE" => "N",
					"IBLOCK_TYPE" => "news",
					"IBLOCK_ID" => Indexis::getIblockId('video', 'main'),
					"NEWS_COUNT" => "20",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ACTIVE_FROM",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "",
					"FIELD_CODE" => array("ID", 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL'),
					"PROPERTY_CODE" => array("URL", 'TILE_IMAGE'),
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
					"AJAX_OPTION_ADDITIONAL" => ""
				)
			); ?>
		</div>
	</div>
</div>

<div id="HomeAwards" class="bgDGrau wideGallery">
	<div class=" responsiveBlock" style="">
		<?/*?>
		<span class="award" title="Designpreis Deutschland">
			<img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/images/Designpreis-Deutschland58.png" alt="Designpreis Deutschland58" width="58" height="74" />
		</span>
		<span class="award" title="iF Design Award">
			<img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/images/IF-Product-Design-Award-50.png" alt="IF Product Design Award 50" width="50" height="81" />
		</span>
		<span class="award" title="Top 100 ">
			<img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/images/top100-64.png" alt="top100 64" width="64" height="64" />
		</span>
		<span class="award" title="Red Dot Design Award">
			<img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/images/Reddot-design-award-130.png" alt="Reddot design award 130" width="130" height="73" />
		</span>
		<?*/ ?>
		<a href="/about/advantages/" class="award gk" title="Гарантия качества">
			<span class="award">
				<img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/images/icon-garanty.svg" alt="Гарантия качества" width="70" height="70" />
				<span class="award__title">Гарантия<br>качества</span>
			</span>
		</a>
		<a href="/about/advantages/" class="award tp" title="Технология производства">
			<span class="award">
				<img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/images/icon-services.svg" alt="Технология производства" width="70" height="70" />
				<span class="award__title">Технология<br>производства</span>
			</span>
		</a>
		<a href="/about/advantages/" class="award eko" title="Экологичность">
			<span class="award">
				<img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/images/icon-ecology.svg" alt="Экологичность" width="70" height="70" />
				<span class="award__title">Экологичность</span>
			</span>
		</a>
		<a href="https://apmbi.ru/" class="award apmbi" title="Ассоциация производителей мелкоштучных бетонных изделий" rel="nofollow" target="_blank">
			<span class="award">
				<img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/images/icon-accociation.svg" alt="Ассоциация производителей мелкоштучных бетонных изделий" width="70" height="70" />
				<span class="award__title">Ассоциация производителей<br>мелкоштучных бетонных изделий</span>
			</span>
		</a>
	</div>
</div>



<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>