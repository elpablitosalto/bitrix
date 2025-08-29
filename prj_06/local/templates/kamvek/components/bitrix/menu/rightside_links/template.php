<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
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
		<a class="rightSideLink iconfont <?= $arItem["PARAMS"]["ext_class"]; ?>" href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"] ?>" <?if (isset($arItem["PARAMS"]["target"])):?> target="<?= $arItem["PARAMS"]["target"]; ?>"<?endif;?>>
			<span class="title"><?= $arItem["TEXT"] ?></span>
			<span class="icon<?if (isset($arItem["PARAMS"]["icon_lib"])):?> <?= $arItem["PARAMS"]["icon_lib"]; ?><?endif;?>"><?= $arItem["PARAMS"]["icon_code"]; ?></span>
		</a>

	<? endforeach ?>
<? endif ?>