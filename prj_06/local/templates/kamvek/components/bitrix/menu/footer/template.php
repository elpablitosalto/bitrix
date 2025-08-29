<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<div class="footerColumn">
		<?
		foreach ($arResult as $arItem) :
			//vardump($arItem);
			$selected_class = 'link';
			if ($arItem["SELECTED"]) {
				$selected_class = 'current';
			}
			if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;
		?>
			<div class="menu_item ">
				<a href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"] ?>"><?= $arItem["TEXT"] ?></a>
			</div>

		<? endforeach ?>
	</div>
<? endif ?>