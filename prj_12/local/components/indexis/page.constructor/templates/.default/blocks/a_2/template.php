<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$item = $arParams['ITEM'];
?>
<section class="nb-section nb-stocks-section<?//if ($arParams['HIDE_TOP_BANNER_ON_MOBILE'] == "Y"):?> nb-stocks-section-filtered<?//endif;?>" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
		<? if ($arParams['HIDE_TOP_BANNER_ON_MOBILE'] == "Y") : ?>
			<div class="nb-section__header">
				<? $APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"",
					array(
						"START_FROM" => "0",
						"PATH" => "",
						"SITE_ID" => SITE_ID
					)
				); ?>
				<?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
					<?require __DIR__ . "/../../title.php";?>
				<?endif;?>
			</div>
		<? else : ?>
			<?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
				<div class="nb-section__header">
					<?require __DIR__ . "/../../title.php";?>
				</div>
			<?endif;?>
		<? endif; ?>
		<div class="nb-section__body">
			<? $APPLICATION->IncludeComponent(
				"indexis:block.filter",
				"promos",
				array(
					"AJAX_MODE" => "Y",
					"AJAX_OPTION_ADDITIONAL" => "block" . $item['ID'],
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "N",
					"SHOW_FILTER" => $item['PROPERTIES']['A_2_SHOW_FILTER']['VALUE_XML_ID'],
					//"SHOW_FILTER" => "Y",
					"IBLOCK_ID" => Indexis::getIblockId('promotions', 'services'),
					"IBLOCK_TYPE" => "services",
					"PREFILTER_NAME" => "arPreFilter" . $item['ID'],
					"FILTER_NAME" => "arFilter" . $item['ID'],
					"DEFAULT_SERVICE" => $item['PROPERTIES']['A_2_DEFAULT_SERVICE']['VALUE'],
					"HIDE_TOP_BANNER_ON_MOBILE" => $arParams['HIDE_TOP_BANNER_ON_MOBILE'],
					"H_FST_PART_M" => $item["H_FST_PART_M"],
					"H_SEC_PART_M" => $item["H_SEC_PART_M"],
					//"BLOCK_ID" => $item['ID'],
					//"DEFAULT_SPECIALIZATIONS" => $item['PROPERTIES']['D_3_DEFAULT_SPECIALIZATION']['VALUE'],
					"SYNC_CONTENT_CLINIC" => $arParams['SYNC_CONTENT_CLINIC']
				)
			); ?>
		</div>
    </div>
</section>