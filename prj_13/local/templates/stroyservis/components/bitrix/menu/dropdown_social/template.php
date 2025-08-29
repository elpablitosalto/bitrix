<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<?foreach($arResult as $arItem):
		if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
			continue;

		$siteHost = parse_url($arItem["LINK"], PHP_URL_HOST);
		if (substr($siteHost, 0, 4) == 'www.')
			$siteHost = substr($marketplaceHost, 4);

		?>
		<li class="header__dropdown-item">
			<a href="<?=$arItem["LINK"]?>" rel="nofollow" target="_blank" title="<?=$arItem['TEXT']?>">
				<?
				switch ($siteHost) {
					case 'wa.me':
						?>
						<svg width="18" height="19">
						<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#whatsapp_grey"></use>
						</svg><?=$arItem['TEXT']?>
						<?
						break;
					case 't.me':
						?>
						<svg class="header__icon-user" width="20" height="20">
						<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#telegram_black"></use>
						</svg><?=$arItem['TEXT']?>
						<?
						break;
				}
				?>
			</a>
		</li>
	<?endforeach;?>
<?endif?>