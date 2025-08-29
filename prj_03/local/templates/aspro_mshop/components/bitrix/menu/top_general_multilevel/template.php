<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<? if ($arResult): ?>
	<ul class="menu adaptive">
		<li class="menu_opener"><a><?= GetMessage('MENU_NAME') ?></a><i class="icon"></i>
			<div class="burger_wrapper" style="display: none;"><?= CMShop::showIconSvg('', SITE_TEMPLATE_PATH . '/images/svg/burger.svg', 'mobile_fixed_burger'); ?></div>
		</li>
	</ul>
	<ul class="menu full">
		<?
		$arTmpParams = explode(',', $arParams["IBLOCK_CATALOG_ID"]);
		$iblockID = $arTmpParams[0]; ?>
		<? foreach ($arResult as $arItem): ?>
			<li class="menu_item_l1 <?= ($arItem["SELECTED"] ? ' current' : '') ?><?= ($arItem["LINK"] == $arParams["IBLOCK_CATALOG_DIR"] ? ' catalog' : '') ?>">
				<a href="<?= $arItem["LINK"] ?>">
					<span><?= $arItem["TEXT"] ?></span>
				</a>
				<? if ($arItem["IS_PARENT"] == 1): ?>
					<div class="child submenu line">
						<div class="child_wrapp">
							<? foreach ($arItem["CHILD"] as $arSubItem): ?>
								<a class="<?= ($arSubItem["SELECTED"] ? ' current' : '') ?>" href="<?= $arSubItem["LINK"] ?>"><?= $arSubItem["TEXT"] ?></a>
							<? endforeach; ?>
						</div>
					</div>
				<? endif; ?>
				<? global $HIDE_CATALOG_MULTILEVEL;
				$showSubCatalog = ($HIDE_CATALOG_MULTILEVEL || $arParams['FIXED'] == 'Y');
				?>
				<? if ($arItem["LINK"] == $arParams["IBLOCK_CATALOG_DIR"] && $showSubCatalog): ?>
					<? $APPLICATION->IncludeComponent(
						"bitrix:catalog.section.list",
						"top_menu",
						array(
							"IBLOCK_TYPE" => $arParams["IBLOCK_CATALOG_TYPE"],
							"IBLOCK_ID" => $iblockID,
							"SECTION_ID" => "",
							"SECTION_CODE" => "",
							"COUNT_ELEMENTS" => "N",
							"TOP_DEPTH" => "2",
							"SECTION_FIELDS" => array(0 => "", 1 => "",),
							"SECTION_USER_FIELDS" => array(0 => "", 1 => "",),
							"SECTION_URL" => "",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "86400",
							"URL" => $_SERVER["REQUEST_URI"],
							"CACHE_GROUPS" => "N",
							"ADD_SECTIONS_CHAIN" => "N"
						)
					); ?>
				<? endif; ?>
			</li>
		<? endforeach; ?>
		<li class="stretch"></li>
		<? $fixed = (isset($arParams['FIXED']) && $arParams['FIXED'] == 'Y' ? '_fixed' : ''); ?>
		<li class="search_row">
			<? $APPLICATION->IncludeComponent(
				"bitrix:search.form",
				"top",
				array(
					"PAGE" => $arParams["IBLOCK_CATALOG_DIR"],
					"USE_SUGGEST" => "N",
					"USE_SEARCH_TITLE" => "Y",
					"INPUT_ID" => "title-search-input4" . $fixed,
					"CONTAINER_ID" => "title-search4"
				),
				false
			); ?>
		</li>
	</ul>
	<? global $TEMPLATE_OPTIONS; ?>
	<div class="search_middle_block">
		<? $APPLICATION->IncludeComponent(
			"bitrix:search.title",
			(strToLower($TEMPLATE_OPTIONS["BASKET"]["CURRENT_VALUE"]) == "fly" ? "catalog" : "mshop"),
			array(
				"NUM_CATEGORIES" => "1",
				"TOP_COUNT" => "5",
				"ORDER" => "date",
				"USE_LANGUAGE_GUESS" => "Y",
				"CHECK_DATES" => "Y",
				"SHOW_OTHERS" => "Y",
				"PAGE" => $arParams["IBLOCK_CATALOG_DIR"],
				"CATEGORY_0_TITLE" => GetMessage("CATEGORY_PRODU�TCS_SEARCH_NAME"),
				"CATEGORY_0" => array(
					0 => 'iblock_' . $arParams["IBLOCK_CATALOG_TYPE"],
				),
				"CATEGORY_0_iblock_" . $arParams["IBLOCK_CATALOG_TYPE"] => array(
					0 => (count($arTmpParams) > 1 ? $arTmpParams[1] : $arParams["IBLOCK_CATALOG_ID"]),
				),
				"SHOW_INPUT" => "Y",
				"INPUT_ID" => "title-search-input2" . $fixed,
				"CONTAINER_ID" => "title-search2",
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"PRICE_VAT_INCLUDE" => "Y",
				"SHOW_ANOUNCE" => "N",
				"PREVIEW_TRUNCATE_LEN" => "50",
				"SHOW_PREVIEW" => "Y",
				"PREVIEW_WIDTH" => "38",
				"PREVIEW_HEIGHT" => "38",
				"CONVERT_CURRENCY" => "N",
			),

			false,
			array(
				"HIDE_ICONS" => "Y"
			)
		); ?>
	</div>
	<div class="search_block">
		<span class="icon"></span>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".main-nav .menu > li:not(.current):not(.menu_opener) > a").click(function() {
				$(this).parents("li").siblings().removeClass("current");
				$(this).parents("li").addClass("current");
			});

			$(".main-nav .menu .child_wrapp a").click(function() {
				$(this).siblings().removeClass("current");
				$(this).addClass("current");
			});
		});
	</script>
<? endif; ?>