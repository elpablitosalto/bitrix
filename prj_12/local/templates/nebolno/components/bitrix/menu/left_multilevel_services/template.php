<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
//echo '!!';
//vardump($arResult);
?>

<?if (!empty($arResult)):?>
<div class="nb-header-menu-level-2">
	<div class="nb-header-menu-level-2__container">
		<ul class="nb-header-menu-level-2__list">

<?
$previousLevel = 0;
$depthLevelEnd = 0;
foreach($arResult as $arItem):?>
	<?
	$depthLevelEnd = $arItem["DEPTH_LEVEL"];
	?>

	<?/*?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?
		echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
		?>
	<?endif?>
	<?*/?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel){?>
		<?if( $arItem["DEPTH_LEVEL"] == 1 && $previousLevel == 2 ){?>
						</ul>
					</div>
				</div>
			</li>
		<?} else if( $arItem["DEPTH_LEVEL"] == 2 && $previousLevel == 3 ){?>
					</ul>
				</div>
			</li>
		<?} else if( $arItem["DEPTH_LEVEL"] == 1 && $previousLevel == 3 ){?>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</li>
		<?}?>		
	<?}?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<?/*?>
			<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul class="root-item">
			<?*/?>		

			<li class="nb-header-menu-level-2__item">
				<a class="nb-header-menu-level-2__link" href="<?=$arItem["LINK"]?>">
					<?=$arItem["TEXT"]?>
					<?
					//echo $arItem["PARAMS"]['UF_ICON'];
					?>
				</a>
				<div class="nb-header-menu-level-3">
					<button class="nb-header-menu-level-3__back" type="button">
						<svg class="icon icon-btn-arrow ">
							<use xlink:href="#btn-arrow"></use>
						</svg><span>Выбрать направление</span>
					</button>
					<button class="nb-header-menu-level-3__close" type="button"><span>Закрыть</span>
						<svg class="icon icon-cross ">
							<use xlink:href="#cross"></use>
						</svg>
					</button>
					<div class="nb-header-menu-level-3__container">
						<ul class="nb-header-menu-level-3__list">

		<?else:?>
			<?/*?>
			<li><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul>
			<?*/?>
				
			<li class="nb-header-menu-level-3__item">
				<a class="nb-header-menu-level-3__link" href="<?=$arItem["LINK"]?>">
					<span class="nb-header-menu-level-3__link-icon">
						<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
					</span>
					<span class="nb-header-menu-level-3__link-label">
						<?=$arItem["TEXT"]?>
					</span>
				</a>
				<div class="nb-header-menu-level-4">
					<ul class="nb-header-menu-level-4__list">
		
		<?endif?>

	<?else:?>

		<?/*?>
		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>
		<?*/?>

		<?if ($arItem["DEPTH_LEVEL"] == 2){?>
			<li class="nb-header-menu-level-3__item">
				<a class="nb-header-menu-level-3__link" href="<?=$arItem["LINK"]?>">
					<span class="nb-header-menu-level-3__link-icon">
						<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
					</span>
					<span class="nb-header-menu-level-3__link-label">
						<?=$arItem["TEXT"]?>
					</span>
				</a>
			</li>
		<?}else{?>
			<li class="nb-header-menu-level-<?=($arItem["DEPTH_LEVEL"]+1)?>__item">
				<a class="nb-header-menu-level-4__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
			</li>
		<?}?>	

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?/*?>
<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>
<?*/?>

<?if ($previousLevel > 1){?>
	<?if( $previousLevel == 2 ){?>
					</ul>
				</div>
			</div>
		</li>
	<?} else if( $previousLevel == 3 ){?>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</li>
	<?}?>		
<?}?>	

		</ul>
	</div>
</div>
<?endif?>