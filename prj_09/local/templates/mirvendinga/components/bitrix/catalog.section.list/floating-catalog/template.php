<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="catalog-menu js-catalog-menu">
	<!-- <button type="button" class="catalog-menu__close js-catalog-menu-close">Закрыть каталог</button> -->
	<div class="catalog-menu__backdrop js-catalog-menu-backdrop">&nbsp;</div>
	<div class="catalog-menu__header">
		<button type="button" class="catalog-menu__close js-catalog-menu-close">
			<svg width="25" height="17" viewBox="0 0 25 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="catalog-menu__icon">
				<path d="M7.56389 0.715259L0.243187 7.97319L0.202095 8.01084C0.0769939 8.13489 0.00962448 8.29452 0 8.45688V8.54268C0.00962448 8.70505 0.0769939 8.86467 0.202095 8.98873L0.238123 9.01921L7.56389 16.2843C7.83494 16.5531 8.2744 16.5531 8.54545 16.2843C8.81651 16.0155 8.81651 15.5797 8.54545 15.311L2.28982 9.10662L24.3059 9.10716C24.6892 9.10716 25 8.79902 25 8.4189C25 8.03879 24.6892 7.73064 24.3059 7.73064L2.45292 7.7301L8.54545 1.68861C8.81651 1.41983 8.81651 0.984042 8.54545 0.715259C8.2744 0.446476 7.83494 0.446476 7.56389 0.715259ZM0.614336 8.41832L8.05467 15.7976L0.692963 8.49993L0.692877 8.49726L0.733927 8.45991L0.775867 8.41832H0.614336Z" fill="#252528"></path>
			</svg>
		</button>
		<div class="catalog-menu__search">
			<? $APPLICATION->IncludeComponent(
				"waim:search.form",
				"",
				array(
					'SEARCH_PAGE' => '/search/',
					'PLACEHOLDER' => 'Поиск по сайту'
				)
			); ?>
		</div>
	</div>
	<div class="catalog-menu__wrapper js-catalog-menu-wrapper">
		<ul class="catalog-menu__list js-catalog-menu-list js-floating-catalog-max-height">
		<?$previewLevel = -1;?>
		<?foreach($arResult['GROUP_SECTIONS'] as $key => $arSection):?>
		<?
			$currentLevel = intVal($arSection['DEPTH_LEVEL']);
			$firstItem = $previewLevel === -1;
			$lastItem = $key === count($arResult['GROUP_SECTIONS']) - 1;
			$toIn = $currentLevel > $previewLevel && $previewLevel !== -1;
			$toOut = $currentLevel < $previewLevel;
			$next = $currentLevel === $previewLevel;
			$itemClass = $currentLevel === 1 ? "catalog-menu__item catalog-menu__item_width_m js-catalog-menu-item" : "catalog-menu__sub-item js-catalog-menu-item";
			?>
			<?if(!$firstItem && !$toIn && !$toOut):?></li><?endif;?>
			<?if($toOut):?>
				<?for($i = $currentLevel; $i < $previewLevel; $i++):?>
					</li><!-- 1 --></ul></div><!-- 2 --></li><!-- Закрываем последний элемент вложенного списка -->
				<?endfor;?>
			<?endif;?>
			<?if(!$toIn):?><li class="<?=$itemClass?>"><?endif;?>
			<?if($toIn):?><div class="catalog-menu__submenu js-catalog-menu-submenu <?=($currentLevel === 2 ? 'js-floating-catalog-max-height' : '')?>"><ul class="catalog-menu__sub-list js-catalog-menu-list"><!-- Открываем вложенный список--><?endif;?>
			<?if($toIn):?><li class="<?=$itemClass?>"><!-- Открываем первый элемент вложенного списка--><?endif;?>

				<div class="catalog-menu__panel">
					<a href="<?=$arSection['SECTION_PAGE_URL']?>" class="catalog-menu__link">
							<?if(!empty($arSection["PICTURE"]["SRC"])):?>
								<span class="catalog-menu__illustration">
										<img
												src="<?=$arSection["PICTURE"]["SRC"]?>"
												alt="<?=$arSection["NAME"]?>"
												class="catalog-menu__image"
										/>
								</span>
							<?endif;?>
							<span class="catalog-menu__text"><?=$arSection['NAME']?></span>
					</a>

					<?if($arSection['HAS_CHILD']):?>
						<button type="button" class="catalog-menu__trigger js-catalog-menu-item-trigger">
								Показать / Скрыть список
						</button>
					<?endif;?>
				</div>

			<?if($lastItem):?>
				<?for($i = 1; $i < $currentLevel; $i++):?></li></ul></div><!-- Закрываем вложенный список --></li><!-- Закрываем последний элемент всего списка --><?endfor;?>
			<?endif;?>
			<?$previewLevel = $currentLevel;?><?endforeach;?>
		</ul>
	</div>
</div>