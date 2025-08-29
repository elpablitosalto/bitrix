<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode( true );
$closeParent = null;
?>
<?if(!empty($arResult)): ?>
	<!-- begin .nav-->
	<div class="tab-bar-panel__container">
		<?foreach($arResult as $key => $arItem):?>
			<?if($arItem["PARAMS"]["TYPE"] === "CATALOG_TRIGGER"):?>
				<button class="tab-bar-panel__item js-catalog-menu-trigger <?if(!empty($arItem['SELECTED'])):?>tab-bar-panel__item_state_active<?endif;?>" type="button">
					<div class="tab-bar-panel__illustration">
						<?if(isset($arItem["PARAMS"]["ICON_FILE"])):?>
							<?$APPLICATION->IncludeFile(SITE_DIR . $arItem["PARAMS"]["ICON_FILE"], Array(), Array("MODE"=>"html"));?>
						<?endif?>
					</div>
					<span class="tab-bar-panel__label"><?=$arItem['TEXT']?></span>
				</button>
			<?elseif($arItem["PARAMS"]["TYPE"] === "PROFILE"):?>
				<?if($GLOBALS["USER"]->IsAuthorized()):?>
					<a class="tab-bar-panel__item <?if(!empty($arItem['SELECTED'])):?>tab-bar-panel__item_state_active<?endif;?>" href="<?=$arItem['LINK']?>">
						<span class="tab-bar-panel__illustration">
							<?if(isset($arItem["PARAMS"]["ICON_FILE"])):?>
								<?$APPLICATION->IncludeFile(SITE_DIR . $arItem["PARAMS"]["ICON_FILE"], Array(), Array("MODE"=>"html"));?>
							<?endif?>
						</span>
						<span class="tab-bar-panel__label"><?=$arItem['TEXT']?></span>
					</a>
				<?endif;?>
			<?elseif($arItem["PARAMS"]["TYPE"] === "AUTH"):?>
				<?if(!$GLOBALS["USER"]->IsAuthorized()):?>
					<a class="tab-bar-panel__item <?if(!empty($arItem['SELECTED'])):?>tab-bar-panel__item_state_active<?endif;?>" href="<?=$arItem['LINK']?>">
						<span class="tab-bar-panel__illustration">
							<?if(isset($arItem["PARAMS"]["ICON_FILE"])):?>
								<?$APPLICATION->IncludeFile(SITE_DIR . $arItem["PARAMS"]["ICON_FILE"], Array(), Array("MODE"=>"html"));?>
							<?endif?>
						</span>
						<span class="tab-bar-panel__label"><?=$arItem['TEXT']?></span>
					</a>
				<?endif;?>
			<?else:?>
				<a class="tab-bar-panel__item <?if(!empty($arItem['SELECTED'])):?>tab-bar-panel__item_state_active<?endif;?>" href="<?=$arItem['LINK']?>">
					<?if($arItem['TEXT'] === "Корзина"):?>
						<?$APPLICATION->IncludeComponent(
							"waim:sale.basket.ajax", "mobile",
							Array(
								'PATH_TO_BASKET' => CART_URL
							)
						);?>
					<?elseif($arItem['TEXT'] === "Избранное"):?>
						<?$APPLICATION->IncludeComponent(
							"waim:sale.favorites.ajax", "mobile",
							Array(
								'PATH_TO_BASKET' => CART_URL
							)
						);?>
					<?else:?>
					<span class="tab-bar-panel__illustration">
						<?if(isset($arItem["PARAMS"]["ICON_FILE"])):?>
							<?$APPLICATION->IncludeFile(SITE_DIR . $arItem["PARAMS"]["ICON_FILE"], Array(), Array("MODE"=>"html"));?>
						<?endif?>
					</span>
					<span class="tab-bar-panel__label"><?=$arItem['TEXT']?></span>
					<?endif?>
				</a>
			<?endif;?>
		<?endforeach;?>

	</div>
	<!-- end .nav-->
<?endif;?>