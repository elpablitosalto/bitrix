<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<section class="marketplace">
		<div class="marketplace__wrapper">
			<div class="marketplace__content_wrapper">
				<div class="marketplace__content">
					<h2>Покупайте наши товары в&nbsp;розницу на&nbsp;маркетплейсах</h2>
					<div class="marketplace__advantage">
						<p class="marketplace__delivery"><span>100%</span> доставок вовремя</p>
						<div class="marketplace__rating">
							<img src="<?=SITE_TEMPLATE_PATH?>/img/design/star-orange.svg" alt="">
							<p><span>4,9 из 5</span> рейтинг товаров</p>
						</div>
					</div>
					<div class="marketplace__salesman">
						<div class="marketplace__logo">
							<img src="<?=SITE_TEMPLATE_PATH?>/img/content/marketplace/logo.png" alt="Logo">
						</div>
						<div class="marketplace__description">
							<p class="marketplace__premium">Premium-продавец</p><a href="<?=SITE_DIR?>">StroyServis.Su</a>
							<p>Стройте с сервисом</p>
						</div>
					</div>
				</div>
				<div class="marketplace__image">
					<img src="<?=SITE_TEMPLATE_PATH?>/img/content/marketplace/phone.png" alt="">
				</div>
			</div>
			<ul class="marketplace__list">
				<?foreach($arResult as $arItem):
					if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
						continue;

					$marketplaceHost = parse_url($arItem["LINK"], PHP_URL_HOST);
					if (substr($marketplaceHost, 0, 4) == 'www.')
						$marketplaceHost = substr($marketplaceHost, 4);

					?>
					<li class="marketplace__item">
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
		</div>
	</section>
<?endif?>