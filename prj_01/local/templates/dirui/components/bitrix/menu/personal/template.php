<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<div class="page-menu js_personal_left_menu">
		<ul class="page-menu__list">
			<?
			foreach ($arResult as $arItem) :
				if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
					continue;
				$countBasketItemsStrOut = '';
				if ($arItem["PARAMS"]["check_partner"] == 'Y') {
					if ($arParams['IS_PARTNER'] == false) {
						continue;
					}
					if ($arParams['IS_PARTNER'] == true) {
						if (strlen($arParams['countBasketItemsStr']) > 0) {
							$countBasketItemsStrOut = '<span>' . $arParams['countBasketItemsStr'] . '</span>';
						}
					}
				}
			?>
				<? if ($arItem["SELECTED"]) : ?>
					<li class="page-menu__item"><a class="page-menu__link page-menu__link_active" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?> <? echo $countBasketItemsStrOut; ?></a></li>
				<? else : ?>
					<li class="page-menu__item"><a class="page-menu__link" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?> <? echo $countBasketItemsStrOut; ?></a></li>
				<? endif ?>
			<? endforeach ?>
		</ul>
	</div>
<? endif ?>