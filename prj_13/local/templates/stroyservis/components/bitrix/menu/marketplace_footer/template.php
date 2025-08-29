<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<p>Покупайте наши товары в розницу</p>
	<ul class="footer-main__markets-list">
		<?foreach($arResult as $arItem):
			if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;

			$marketplaceHost = parse_url($arItem["LINK"], PHP_URL_HOST);
			if (substr($marketplaceHost, 0, 4) == 'www.')
				$marketplaceHost = substr($marketplaceHost, 4);

			?>
			<li class="footer-main__markets-item">
				<a href="<?=$arItem["LINK"]?>" rel="nofollow" target="_blank" title="<?=$arItem['TEXT']?>">
					<?
					switch ($marketplaceHost) {
						case 'wildberries.ru':
							?>
							<img loading="lazy" src="<?=SITE_TEMPLATE_PATH?>/img/design/logo-wildberries.png" alt="<?=$arItem['TEXT']?>">
							<?
							break;
						case 'leroymerlin.ru':
							?>
							<img loading="lazy" src="<?=SITE_TEMPLATE_PATH?>/img/design/logo-leroymerlin.png" alt="<?=$arItem['TEXT']?>">
							<?
							break;
						case 'ozon.ru':
							?>
							<img loading="lazy" src="<?=SITE_TEMPLATE_PATH?>/img/design/logo-ozon.png" alt="<?=$arItem['TEXT']?>">
							<?
							break;
						case 'market.yandex.ru':
							?>
							<img loading="lazy" src="<?=SITE_TEMPLATE_PATH?>/img/design/logo-yandexmarket.png" alt="<?=$arItem['TEXT']?>">
							<?
							break;
						case 'megamarket.ru':
							?>
							<img loading="lazy" src="<?=SITE_TEMPLATE_PATH?>/img/design/logo-megamarket.svg" alt="<?=$arItem['TEXT']?>">
							<?
						break;
					}
					?>
				</a>
			</li>
		<?endforeach;?>
	</ul>
<?endif?>