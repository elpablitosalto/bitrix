<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>

	<nav id="MainMenuWrapper">
		<div class="wrap">
			<?
			//vardump($arResult);
			?>
			<?
			$previousLevel = 0;
			$childLevelCount = 0;
			foreach ($arResult as $arItem) {
				$selected_class = '';
				if ($arItem["SELECTED"]) {
					$selected_class = 'red';
				}
			?>
				<?
				if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
					$childLevelCount = 0;

					if ($arItem["DEPTH_LEVEL"] == 2) {
				?>
		</div>
		</div>
		</div>
		<div class="mainMenuColumn">
			<div class="mainMenuBlock">
			<?
					} else if ($arItem["DEPTH_LEVEL"] == 1) {
			?>
			</div>
		</div>
		</div>
		</div>
		</div>
		</div>
	<?
					}
	?>

	<?
					//=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
	?>
<? } ?>

<?
				if ($arItem["IS_PARENT"]) {
					if ($arItem["DEPTH_LEVEL"] == 1) {
						$num_cols = 1;
						if (intval($arItem['NUM_COLS']) > 0) {
							$num_cols = $arItem['NUM_COLS'];
						}
?>
		<div class="menuSection menu_item colcount-<?= $num_cols; ?>">
			<div class="menuSectionLink lv1">
				<?= $arItem["TEXT"] ?><span class="menuSectionLinkButton" title="<?= $arItem["TEXT"] ?>"></span>
			</div>
			<div class="menuSectionArea">
				<div class="menuSectionAreaContent">
					<div class="menuSectionHeadline lv2">
						<? if (!empty($arItem['CHILDS_LVL_2'])) { ?>
							<? foreach ($arItem['CHILDS_LVL_2'] as $arItem) { ?>
								<a href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"] ?>" class="top_menu_mobile"><?= $arItem["TEXT"] ?></a>
							<? } ?>
							<?/*?><a href="" title="" class="">Produktübersicht Garten und Haus</a><?*/ ?>
						<? } ?>
					</div>
					<div class="mainMenuColumn">
						<div class="mainMenuBlock">
						<?
					} else if ($arItem["DEPTH_LEVEL"] == 2) {
						?>
							<div class="menuBlockHeadline ">
								<span class="menuBlockToggler"> </span>
								<a class="mbhl lv2 <?= $selected_class ?>" href="<?= $arItem["LINK"] ?>" title=""><?= $arItem["TEXT"] ?></a>
							</div>
						<?
					}
				} else {
					if ($arItem["DEPTH_LEVEL"] == 1) {
						?>
							<div class="menuSection menu_item colcount-4">
								<div class="menuSectionLink lv1">
									<?= $arItem["TEXT"] ?><span class="menuSectionLinkButton" title="<?= $arItem["TEXT"] ?>"></span>
								</div>
							</div>
							<?
						} else {
							if ($childLevelCount == 0) {
							?>
								<div class="menuBlockSubmenu">
								<?
							}
								?>
								<a class="menuItem lv3 <?= $selected_class ?>" href="<?= $arItem["LINK"] ?>" title="">
									<span class="title"><?= $arItem["TEXT"] ?></span>
								</a>
							<?
							$childLevelCount++;
						}
					}

					$previousLevel = $arItem["DEPTH_LEVEL"];
				}

				if ($previousLevel > 1) {
					if ($previousLevel == 2) {
							?>
								</div>
							<?
						}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?
				}
	?>
	</div>
	</nav>

<? } ?>