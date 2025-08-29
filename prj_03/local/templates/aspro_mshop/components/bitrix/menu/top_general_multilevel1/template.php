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
				<? if ($arItem["LINK"] == $arParams["IBLOCK_CATALOG_DIR"]): ?>
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