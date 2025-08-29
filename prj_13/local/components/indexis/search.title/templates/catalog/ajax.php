<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>
	<?
	$APPLICATION->IncludeFile(
		SITE_DIR . 'include/catalog/search_products.php',
		array(
			'CATALOG_PRODUCT_IDS' => $arResult['CATALOG_PRODUCT_IDS']
		),
		array('SHOW_BORDER' => false)
	);
	?>
	<?/*if (is_array($arResult['CATEGORIES']['all']['ITEMS']) && count($arResult['CATEGORIES']['all']['ITEMS']) > 0):?>
		<?foreach($arResult['CATEGORIES']['all']['ITEMS'] as $arItem):?>
			<p><a href="<?=$arItem['URL']?>"><?=$arItem['NAME']?></a></p>
		<?endforeach;?>
	<?endif;*/?>
<?endif;?>