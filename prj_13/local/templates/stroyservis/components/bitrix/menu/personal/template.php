<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<div class="c-tabs">
		<ul>
			<?foreach ($arResult as $arItem) :
				if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
					continue;
				?>
				<li<?if ($arItem["SELECTED"]):?> class="c-tabs__active"<?endif;?>><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
			<? endforeach ?>
		</ul>
		<div class="swiper-container c-tabs__mob-swiper">
			<div class="swiper-wrapper">
				<?foreach ($arResult as $arItem) :
					if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
						continue;
					?>
					<div class="swiper-slide<?if ($arItem["SELECTED"]):?> c-tabs__active<?endif;?>">
						<a class="header-submenu__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
					</div>
				<? endforeach ?>
			</div>
		</div>
	</div>
<? endif ?>