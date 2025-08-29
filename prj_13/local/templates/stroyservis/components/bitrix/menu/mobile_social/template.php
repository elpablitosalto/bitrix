<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul class="header-dropdown__social">
		<?foreach($arResult as $arItem):
			if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;

			$siteHost = parse_url($arItem["LINK"], PHP_URL_HOST);
			if (substr($siteHost, 0, 4) == 'www.')
				$siteHost = substr($marketplaceHost, 4);

			?>
			<li>
				<a href="<?=$arItem["LINK"]?>" rel="nofollow" target="_blank" title="<?=$arItem['TEXT']?>"><?=$arItem['TEXT']?>
					<div class="header-dropdown__social-icon">
						<?
						switch ($siteHost) {
							case 'wa.me':
								?>
								<svg width="30" height="30">
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#whatsapp"></use>
								</svg>
								<?
							break;
							case 't.me':
								?>
								<svg width="30" height="30">
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#telegram"></use>
								</svg>
								<?
							break;
						}
						?>
					</div>
				</a>
			</li>
		<?endforeach;?>
	</ul>
<?endif?>