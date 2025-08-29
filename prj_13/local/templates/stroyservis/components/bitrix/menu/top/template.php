<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<ul class="header__list">
		<?/*<li>
			<button class="header__button-catalog">
				<svg width="19" height="19">
					<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#hamburger"></use>
				</svg>Каталог
			</button>
		</li>*/?>

		<?
		foreach ($arResult as $arItem) :
			if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;
		?>
			<? if ($arItem["SELECTED"]) : ?>
				<li><a href="<?= $arItem["LINK"] ?>" class="selected"><?= $arItem["TEXT"] ?></a></li>
			<? else : ?>
				<li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
			<? endif ?>

		<? endforeach ?>

	</ul>
<? endif ?>