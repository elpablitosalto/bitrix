<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<p>Присоединяйтесь к нам</p>
	<ul class="footer-main__social-list">
		<?foreach($arResult as $arItem):
			if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;

			$siteHost = parse_url($arItem["LINK"], PHP_URL_HOST);
			if (substr($siteHost, 0, 4) == 'www.')
				$siteHost = substr($siteHost, 4);

			?>
			<li class="footer-main__social-item">
				<a href="<?=$arItem["LINK"]?>" rel="nofollow" target="_blank" title="<?=$arItem['TEXT']?>">
					<?
					switch ($siteHost) {
						case 'vk.com':
							?>
							<svg width="21" height="12">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#vk_black"></use>
							</svg>
							<?
						break;
						case 't.me':
							?>
							<svg width="20" height="17">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#telegram_black"></use>
							</svg>
							<?
						break;
						case 'youtube.com':
							?>
							<svg width="20" height="14">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#youtube_black"></use>
							</svg>
							<?
						break;
						case 'rutube.ru':
							?>
							<svg width="16" height="16">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#rutube_black"></use>
							</svg>
							<?
						break;
					}
					?>
				</a>
			</li>
		<?endforeach;?>
	</ul>
<?endif?>