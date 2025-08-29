<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<ul class="dp-aside-menu__list">
		<?
		foreach ($arResult as $arItem) :
			//vardump($arItem);
			$selected_class = '';
			if ($arItem["SELECTED"]) {
				$selected_class = 'selected';
			}
			if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;
		?>
			<li class="dp-aside-menu__item <?=$selected_class;?>">
				<a class="dp-aside-menu__link" href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"] ?>">
					<span class="dp-aside-menu__text"><?= $arItem["TEXT"] ?></span>
				</a>
			</li>

			<? endforeach ?>
	</ul>
<? endif ?>