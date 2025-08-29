<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<div id="RelationMenuWrapper" class="noprint">
		<nav id="RelationMenu" class="noprint checkR">
			<?/*?>
			<div class="menu_item section  parent">
				<a class="" href="/company/" title="Company">Company</a>
			</div>
			<?*/?>
			<?
			foreach ($arResult as $arItem) :
				$selected_class = 'link';
				if ($arItem["SELECTED"]) {
					$selected_class = 'current';
				}
				if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
					continue;
			?>
				<?/*?>
				<? if ($arItem["SELECTED"]) : ?>
					<li><a href="<?= $arItem["LINK"] ?>" class="selected"><?= $arItem["TEXT"] ?></a></li>
				<? else : ?>
					<li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
				<? endif ?>
				<?*/ ?>

				<div class="menu_item <?= $selected_class; ?> sibling">
					<a class="" href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"] ?>"><?= $arItem["TEXT"] ?></a>
				</div>

			<? endforeach ?>

		</nav>
	</div>
<? endif ?>