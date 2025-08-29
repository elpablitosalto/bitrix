<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>
<nav class="dp-header-menu">
	<ul class="dp-header-menu__list">
		<?
		$repeat = 0;
		foreach ($arResult as $num => $item) {
			if ($item["DEPTH_LEVEL"] > 1) {
				?>
				<li class="<?if($item["SELECTED"]):?>dp-header-submenu__item_active <?endif;?>dp-header-submenu__item<?if(isset($item["PARAMS"]["additional_style"])) echo " ".$item["PARAMS"]["additional_style"];?>"><a
						class="dp-header-submenu__link"
						<?if(isset($item["PARAMS"]["target"])) echo " ".$item["PARAMS"]["target"];?>
						href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a>
				</li>
				<?
			} else {
				if ($repeat > 0) {
					echo str_repeat("</ul></div></li>", $repeat);
					$repeat = 0;
				}
				if ($item["IS_PARENT"]) {
					$repeat++;
					?>
					<li class="<?if($item["SELECTED"]):?>dp-header-menu__item_active <?endif;?>dp-header-menu__item dp-header-menu__item_dropdown"><a
								class="dp-header-menu__link"
								href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a>
						<div class="dp-header-submenu">
							<ul class="dp-header-submenu__list">
					<?
				} else {
					?>
					<li class="<?if($item["SELECTED"]):?>dp-header-menu__item_active <?endif;?>dp-header-menu__item<?if(isset($item["PARAMS"]["additional_style"])) echo " ".$item["PARAMS"]["additional_style"];?>"><a
								class="dp-header-menu__link"
								<?if(isset($item["PARAMS"]["target"])) echo " ".$item["PARAMS"]["target"];?>
								href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a>
					</li>
					<?
				}
			}

		}
		if ($repeat > 0) {
			echo str_repeat("</ul></div></li>", $repeat);
			$repeat = 0;
		}
		?>

		<?
		//todo временно поставили сюда, пока не будет отдельного блока для ссылки. Убрать и включить кеш в менб
		/*if ($USER->IsAuthorized()){?>
			<li class="dp-header-menu__item"><a
						class="dp-header-menu__link"
						href="#modal-questionnaire" data-modal="">Запуск квиза</a>
			</li>
		<?}*/
		?>

	</ul>
</nav>
<div class="dp-header-menu dp-header-menu-tablet">
	<button class="dp-header-menu__more" type="button">Еще</button>
	<ul class="dp-header-menu__list">
		<?
		$repeat = 0;
		foreach ($arResult as $num => $item) {
			if ($item["DEPTH_LEVEL"] > 1) {
			?>
				<li class="<?if($item["SELECTED"]):?>dp-header-submenu__item_active <?endif;?>dp-header-submenu__item"><a class="dp-header-submenu__link" href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a></li>
			<?
			} else {
				if ($repeat > 0) {
					echo str_repeat("</ul></div></li>", $repeat);
					$repeat = 0;
				}
				if ($item["IS_PARENT"]) {
				$repeat++;
			?>
					<li class="<?if($item["SELECTED"]):?>dp-header-menu__item_active <?endif;?>dp-header-menu__item">
						<a class="dp-header-menu__link" href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a>
						<div class="dp-header-submenu">
							<ul class="dp-header-submenu__list">
				<?
					} else {
				?>
					<li class="<?if($item["SELECTED"]):?>dp-header-menu__item_active <?endif;?>dp-header-menu__item"><a class="dp-header-menu__link" href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a></li>
				<?
					}
			}
		}
		if ($repeat > 0) {
			echo str_repeat("</ul></div></li>", $repeat);
			$repeat = 0;
		}
		?>
	</ul>
</div>
<? } ?>