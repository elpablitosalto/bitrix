<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul class="nb-social<?if (isset($arParams['MENU_CLASS'])):?> <?=$arParams['MENU_CLASS']?><?endif;?>">
		<?foreach($arResult as $arItem):
			if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;

			$socialHost = parse_url($arItem["LINK"], PHP_URL_HOST);
			if (substr($socialHost, 0, 4) == 'www.')
				$socialHost = substr($socialHost, 4);

			?>
			<li class="nb-social__item">
				<a class="nb-social__link" href="<?=$arItem["LINK"]?>" rel="nofollow" target="_blank" title="<?=$arItem['TEXT']?>">
					<?
					switch ($socialHost) {
						case 'vkontakte.ru':
						case 'vk.com':
							?>
							<svg class="icon icon-vk">
								<use xlink:href="#vk"></use>
							</svg>
							<?
						break;
						case 'telegram.org':
						case 't.me':
							?>
							<svg class="icon icon-telegram">
								<use xlink:href="#telegram"></use>
							</svg>
							<?
						break;
						case 'whatsapp.com':
						case 'wa.me':
							?>
							<svg class="icon icon-whatsapp">
								<use xlink:href="#whatsapp"></use>
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