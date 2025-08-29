<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<ul class="dp-footer-social__list">
		<?
		foreach ($arResult as $arItem) :
			/*
			//vardump($arItem);
			$selected_class = '';
			if ($arItem["SELECTED"]) {
				$selected_class = 'selected';
			}
			if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;
			*/
		?>
			<li class="dp-footer-social__item">
				<a class="dp-footer-social__link" href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"] ?>" target="_blank">
					<?= $arItem["TEXT"] ?>
				</a>
			</li>

		<? endforeach ?>
	</ul>
<? endif ?>