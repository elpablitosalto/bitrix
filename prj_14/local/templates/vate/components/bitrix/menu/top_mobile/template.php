<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
	<nav class="nav nav_style_primary">
		<ul class="nav__list">
			<?
			foreach ($arResult as $arItem):
				if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
					continue;
			?>
				<? if ($arItem["SELECTED"]): ?>
				<? else: ?>
				<? endif ?>

				<li class="nav__item">
					<a class="nav__link <?= $arItem["PARAMS"]["add_class"]; ?>" href="<?= $arItem["LINK"] ?>">
						<span class="nav__text"><?= $arItem["TEXT"] ?></span>
					</a>
				</li>

			<? endforeach ?>
		</ul>
	</nav>
<? endif ?>