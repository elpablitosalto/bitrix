<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
	<nav class="nav nav_layout_horizontal">
		<ul class="nav__list">
			<?
			$previousLevel = 0;
			foreach ($arResult as $arItem): ?>

				<? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
					<?= str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
				<? endif ?>

				<? if ($arItem["IS_PARENT"]) { ?>
					<li class="nav__item">
						<!-- Active link modifier: nav__link_state_active-->
						<a class="nav__link <? if ($arItem["SELECTED"]) { ?>nav__link_state_active<? } ?>" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
						<div class="nav__sub">
							<ul class="nav__list">
							<? } else { ?>
								<li class="nav__item">
									<!-- Active link modifier: nav__link_state_active-->
									<a class="nav__link <? if ($arItem["SELECTED"]) { ?>nav__link_state_active<? } ?>" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
								</li>
							<? } ?>

							<? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

						<? endforeach ?>

						<? if ($previousLevel > 1): //close last item tags
						?>
							<?= str_repeat("</ul></div></li>", ($previousLevel - 1)); ?>
						<? endif ?>

							</ul>
	</nav>
<? endif ?>