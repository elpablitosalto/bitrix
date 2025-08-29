<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<div class="nb-header-menu">
		<ul class="nb-header-menu__list">
			<? foreach ($arResult as $arItem) :
				if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
					continue;
			?>
				<li class="nb-header-menu__item<? if ($arItem["PARAMS"]["BIG_MENU_SERVICES"] == 'Y') : ?> nb-header-menu__item_dropdown<? endif; ?><? if ($arItem["SELECTED"]) : ?> nb-header-menu__item_active<? endif; ?>">
					<a class="nb-header-menu__link" href="<?= $arItem["LINK"] ?>"><?= $arItem['TEXT'] ?></a>
					<?
					//vardump($arItem["PARAMS"]);
					?>
					<? if ($arItem["PARAMS"]["BIG_MENU_SERVICES"] == 'Y') { ?>
						<? $APPLICATION->IncludeComponent(
							"bitrix:menu",
							"left_multilevel_services",
							array(
								"ROOT_MENU_TYPE" => "left_sub_services",
								"MAX_LEVEL" => "3",
								"CHILD_MENU_TYPE" => "",
								"USE_EXT" => "N",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "Y",
								"MENU_CACHE_TYPE" => "N",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_CACHE_GET_VARS" => ""
							)
						); ?>
					<? } ?>
				</li>
			<? endforeach; ?>
		</ul>
	</div>
<? endif ?>