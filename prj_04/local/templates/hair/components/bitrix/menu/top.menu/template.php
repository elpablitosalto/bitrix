<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<ul class="top-menu">
	<?foreach ($arResult['MENU'] as $k => $arItem):?>
		<li class="top-menu__item">
			<a class="top-menu__item-link" <?if(!empty($arItem["LINK"])):?>href="<?=$arItem["LINK"]?>"<?endif;?>><?=$arItem["TEXT"]?></a>
			<?if(isset($arItem['ITEMS']) && !empty($arItem['ITEMS'])):?>
				<ul class="dd-menu">
					<?foreach($arItem['ITEMS'] as $j => $ddItem):?>
						<li class="dd-menu__item"><a class="dd-menu__item-link" href="<?=$ddItem["LINK"]?>"><?=$ddItem["TEXT"]?></a></li>
					<?endforeach;?>
				</ul>
			<?endif;?>
		</li>
	<?endforeach;?>
</ul>