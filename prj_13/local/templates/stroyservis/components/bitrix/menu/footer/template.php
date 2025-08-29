<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<?if (mb_strlen($arParams['MENU_TITLE']) > 0):?>
		<p class="footer-main__title"><?=$arParams['MENU_TITLE']?></p>
	<?endif;?>
	<ul class="footer-main__list<?if (mb_strlen($arParams['MENU_CLASS']) > 0):?> <?=$arParams['MENU_CLASS']?><?endif;?>">
		<?foreach ($arResult as $arItem) :
			if (
				($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				|| ($arItem['DEPTH_LEVEL'] != $arParams["MAX_LEVEL"])
			)
				continue;
			?>
			<li class="footer-main__item"><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
		<? endforeach ?>
	</ul>
<? endif ?>