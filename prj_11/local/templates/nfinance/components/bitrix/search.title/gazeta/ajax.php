<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>
	<table class="title-search-result">
		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
			<tr>
				<td class="title-search-separator">&nbsp;</td>
			</tr>
			<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
				<?if($category_id !== "others"):?>
					<?if($category_id === "all"):?>
						<tr>
							<td class="title-search-all"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>
						</tr>
					<?else:?>
						<?if(empty($arItem["TYPE"])):?>
							<tr>
								<td class="title-search-item"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>
							</tr>
						<?endif;?>
					<?endif;?>
				<?endif;?>
			<?endforeach;?>
		<?endforeach;?>
		<tr>
			<td class="title-search-separator">&nbsp;</td>
		</tr>
	</table>
<?endif;
?>