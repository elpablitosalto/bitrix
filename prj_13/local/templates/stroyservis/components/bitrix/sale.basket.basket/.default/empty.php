<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>

<section class="bx-sbb-empty-cart-container">
	<h3 class="bx-sbb-empty-cart-text"><?=Loc::getMessage("SBB_EMPTY_BASKET_TITLE")?></h3>
	<?
	if (!empty($arParams['EMPTY_BASKET_HINT_PATH']))
	{
		?>
		<div class="bx-sbb-empty-cart-desc">
			<?=Loc::getMessage(
				'SBB_EMPTY_BASKET_HINT',
				[
					'#A1#' => '<a href="'.$arParams['EMPTY_BASKET_HINT_PATH'].'">',
					'#A2#' => '</a>',
				]
			)?>
		</div>
		<?
	}
	?>
</section>