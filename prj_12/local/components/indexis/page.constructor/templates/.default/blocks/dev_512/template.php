<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$item = $arParams['ITEM'];
?>
<section class="nb-top-banner-section nb-top-banner-section-slider nb-top-banner-section-whitening" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
	<? $APPLICATION->IncludeComponent(
		"bitrix:breadcrumb",
		"",
		array(
			"START_FROM" => "0",
			"PATH" => "",
			"SITE_ID" => SITE_ID
		)
	); ?>
	<div class="nb-top-banner" id="<?= $arParams['EDIT_AREA_ID'] ?>">
		<picture class="nb-top-banner-whitening">
			<?/**/ ?>
			<source media="(max-width: 576px)" srcset="<? if (!empty($item['PROPERTIES']['DEV_512_BACKGROUND_M']['VALUE'])) : ?><?= CFile::GetPath($item['PROPERTIES']['DEV_512_BACKGROUND_M']['VALUE']) ?><? else : ?><?= SITE_TEMPLATE_PATH ?>/img/content/top-banner/whitening-lap.jpg<? endif; ?>">
			<?/**/ ?>
			<img src="<? if (!empty($item['PROPERTIES']['DEV_512_BACKGROUND_D']['VALUE'])) : ?><?= CFile::GetPath($item['PROPERTIES']['DEV_512_BACKGROUND_D']['VALUE']) ?><? else : ?><?= SITE_TEMPLATE_PATH ?>/img/content/top-banner/whitening.jpg<? endif; ?>" alt="">
		</picture>
		<picture class="nb-top-banner-whitening-bg">
			<img src="<? if (!empty($item['PROPERTIES']['DEV_512_PICTURE_D']['VALUE'])) : ?><?= CFile::GetPath($item['PROPERTIES']['DEV_512_PICTURE_D']['VALUE']) ?><? else : ?><?= SITE_TEMPLATE_PATH ?>/img/content/top-banner/peoples/р-28.png<? endif; ?>" alt="">
		</picture>
		<div class="nb-top-banner__caption nb-top-banner-whitening__caption">
			<? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') : ?>
				<?
				// Вывод заголовка для десктопа -->
				if (strlen($item["H_FST_PART_D"]) > 0) {
				?>
					<h1 class="nb-top-banner-whitening__title desktop">
						<?
						echo $item["H_FST_PART_D"];
						if (strlen($item["H_SEC_PART_D"]) > 0) {
						?> <span class="font-weight_normal">
								<?= $item["H_SEC_PART_D"]; ?>
							</span>
						<?
						}
						?>
					</h1>
				<?
				}
				// <-- Вывод заголовка для десктопа

				// Вывод заголовка для мобильного -->
				if (strlen($item["H_FST_PART_M"]) > 0) {
				?>
					<p class="nb-top-banner-whitening__title mobile">
						<?
						echo $item["H_FST_PART_M"];
						if (strlen($item["H_SEC_PART_M"]) > 0) {
						?> <br><span class="font-weight_normal">
								<?= $item["H_SEC_PART_M"]; ?>
							</span>
						<?
						}
						?>
					</p>
				<?
				}
				// <-- Вывод заголовка для мобильного
				?>
			<? endif; ?>
			<ul class="nb-top-banner-whitening__list">
				<? for ($i = 1; $i <= 3; $i++) : ?>
					<?
					$r = $g = $b = null;
					$r_2 = $g_2 = $b_2 = null;
					?>
					<? if (mb_strlen($item['PROPERTIES']['DEV_512_COLOR_' . $i]['VALUE']) > 0) : ?>
						<?
						$hex = $item['PROPERTIES']['DEV_512_COLOR_' . $i]['VALUE'];
						list($r, $g, $b) = sscanf($hex, "%02x%02x%02x");
						?>
					<? endif; ?>
					<? if (mb_strlen($item['PROPERTIES']['DEV_512_COLOR_' . $i . "_2"]['VALUE']) > 0) : ?>
						<?
						$hex_2 = $item['PROPERTIES']['DEV_512_COLOR_' . $i . "_2"]['VALUE'];
						list($r_2, $g_2, $b_2) = sscanf($hex_2, "%02x%02x%02x");
						?>
					<? endif; ?>
					<?
					$background_color = "";
					if ($r !== null && $g  !== null && $b !== null) {
						$background_color = 'background-color: rgba(' . $r . ', ' . $g . ', ' . $b . ', 0.7);';
					}
					$background_color_2 = "";
					if ($r_2 !== null && $g_2  !== null && $b_2 !== null) {
						$background_color_2 = 'background-color: rgba(' . $r_2 . ', ' . $g_2 . ', ' . $b_2 . ', 0.7);';
					}
					$background_image = "";
					if (mb_strlen($item['PROPERTIES']['DEV_512_PIC_BACK_' . $i]['VALUE']) > 0) {
						$path = CFile::GetPath($item['PROPERTIES']['DEV_512_PIC_BACK_' . $i]['VALUE']);
						$background_image = 'background-image:url(' . $path . ');';
					}
					$title_d = $item['PROPERTIES']['DEV_512_TITLE_' . $i]['VALUE'];
					$title_m = $item['PROPERTIES']['DEV_512_TITLE_M_' . $i]['VALUE'];
					if (strlen($title_m) <= 0) {
						$title_m = $title_d;
					}

					// Цвет текста -->
					$ext_style = '';
					$text_color = $item['PROPERTIES']['DEV_512_COLOR_TEXT_' . $i]['VALUE'];
					if (strlen($text_color) > 0) {
						$ext_style = 'style="color: #' . $text_color . ';"';
					}
					//echo 'text_color = '.$text_color.'<br />';
					// <-- Цвет текста
					?>
					<li class="nb-top-banner-whitening__item" style="<? echo $background_color; ?>">
						<div class="nb-top-banner-whitening__item-bg" style="<? echo $background_color; ?> <? echo $background_image; ?>">
							<div class="content-whitening-desktop" <?=$ext_style;?>>
								<? if (mb_strlen($title_d) > 0) : ?>
									<p class="nb-top-banner-whitening__item-title" <?=$ext_style;?>><?= $title_d; ?></p>
								<? endif; ?>
								<?= $item['PROPERTIES']['DEV_512_DESC_' . $i . '_D']['~VALUE']['TEXT'] ?>
							</div>
							<div class="content-whitening-mobile" <?=$ext_style;?>>
								<?= (mb_strlen($item['PROPERTIES']['DEV_512_DESC_' . $i . '_M']['~VALUE']['TEXT']) > 0 ? $item['PROPERTIES']['DEV_512_DESC_' . $i . '_M']['~VALUE']['TEXT'] : $item['PROPERTIES']['DEV_512_DESC_' . $i . '_D']['~VALUE']['TEXT']) ?>
							</div>
						</div>
					</li>
				<? endfor; ?>
			</ul>
			<button class="nb-top-banner-whitening__button" type="button" data-modal="#modal-call-makeup">Записаться на приём</button>
		</div>
	</div>
</section>