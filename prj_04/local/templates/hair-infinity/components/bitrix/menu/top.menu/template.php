<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<ul class="nav__list">
	<?foreach ($arResult['MENU'] as $k => $arItem):?>
        <?
        if(empty($arItem['TEXT'])){
            continue;
        }
        ?>
		<li class="nav__item">
			<a class="nav__link" data-text="<?=$arItem["TEXT"]?>" <?if(!empty($arItem["LINK"])):?>href="<?=$arItem["LINK"]?>"<?endif;?>>
				<span class="nav__link-text"><?=$arItem["TEXT"]?></span>
			</a>
			<?if(isset($arItem['ITEMS']) && !empty($arItem['ITEMS'])):?>
				<div class="nav__submenu">
					<ul class="nav__list">
						<?foreach($arItem['ITEMS'] as $j => $ddItem):?>
							<li class="nav__item"><a class="nav__link" href="<?=$ddItem["LINK"]?>"><?=$ddItem["TEXT"]?></a></li>
						<?endforeach;?>
					</ul>
				</div>
			<?endif;?>
		</li>
	<?endforeach;?>
</ul>