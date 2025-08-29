<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
$arPropertieValue = $item['DISPLAY_PROPERTIES']['DEV_505']['VALUE'];

if (is_array($arPropertieValue) && count($arPropertieValue) > 0) {
?>
    <section class="nb-section nb-stages-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
        <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
            <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
                <div class="nb-section__header">
                    <?
                    // Вывод заголовка для десктопа -->
                    if (strlen($item["H_FST_PART_D"]) > 0) {
                    ?>
                        <h2 class="nb-section__title nb-section-stages-title desktop">
                            <?
                            echo $item["H_FST_PART_D"];
                            if (strlen($item["H_SEC_PART_D"]) > 0) {
                            ?> <span class="font-weight_normal">
                                    <?= $item["H_SEC_PART_D"]; ?>
                                </span>
                            <?
                            }
                            ?>
                        </h2>
                    <?
                    }
                    // <-- Вывод заголовка для десктопа

                    // Вывод заголовка для мобильного -->
                    if (strlen($item["H_FST_PART_M"]) > 0) {
                    ?>
                        <p class="nb-section__title nb-section-stages-title mobile">
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
                    <?if (mb_strlen($item['PROPERTIES']['DEV_505_BEFORE_TEXT']['~VALUE']['TEXT']) > 0):?>
                        <div class="nb-section__desc">
                            <?=$item['PROPERTIES']['DEV_505_BEFORE_TEXT']['~VALUE']['TEXT']?>
                        </div>
                    <?endif;?>
                </div>
            <?endif;?>
            <div class="nb-section__body nb-section-stages__body">
				<div class="nb-stages-slider-wrapper">
					<div class="nb-stages__container">
						<ol class="nb-stages-list">
							<?
							$ii = 0;
							foreach ($arPropertieValue as $arItem) {
								$ii++;
								$arItemValues = $arItem['SUB_VALUES'];
								$background_color_h = strlen($arItemValues['DEV_505_COLOR_H']['VALUE']) > 0
									? $arItemValues['DEV_505_COLOR_H']['VALUE'] : 'rgba(244, 221, 227, .5)';
								$background_color_d = strlen($arItemValues['DEV_505_COLOR_D']['VALUE']) > 0
									? $arItemValues['DEV_505_COLOR_D']['VALUE'] : 'rgba(244, 221, 227, 1)';

								if (
									substr($background_color_h, 0, 1) !== '#'
									&& substr($background_color_h, 0, 3) !== 'rgb'
									&& in_array(strlen($background_color_h), [3, 6])
								)
									$background_color_h = '#' . $background_color_h;

								if (
									substr($background_color_d, 0, 1) !== '#'
									&& substr($background_color_d, 0, 3) !== 'rgb'
									&& in_array(strlen($background_color_d), [3, 6])
								)
									$background_color_d = '#' . $background_color_d;
							?>
								<li class="nb-stages-item">
									<div class="nb-stages-description" style="background-color: <?= $background_color_d; ?>">
										<? if (mb_strlen($arItemValues['DEV_505_TITLE_D']['VALUE']) > 0) { ?>
											<p class="nb-stages-title content-stages-desktop" style="background-color: <?= $background_color_h; ?>;">
												<?= $arItemValues['DEV_505_TITLE_D']['VALUE'] ?>
											</p>
										<? } ?>
										<? if (mb_strlen($arItemValues['DEV_505_TITLE_M']['VALUE']) > 0) { ?>
											<p class="nb-stages-title content-stages-mobile">
												<?= $arItemValues['DEV_505_TITLE_M']['VALUE']; ?>
											</p>
										<? } ?>
										<? if (mb_strlen($arItemValues['DEV_505_DESCRIPTION_D']['~VALUE']['TEXT']) > 0) { ?>
											<p class="nb-stages-text content-stages-desktop">
												<?= $arItemValues['DEV_505_DESCRIPTION_D']['~VALUE']['TEXT']; ?>
											</p>
										<? } ?>
										<? if (mb_strlen($arItemValues['DEV_505_DESCRIPTION_M']['~VALUE']['TEXT']) > 0) { ?>
											<p class="nb-stages-text content-stages-mobile">
												<?= $arItemValues['DEV_505_DESCRIPTION_M']['~VALUE']['TEXT']; ?>
											</p>
										<? } ?>
									</div>
									<?
									if (!empty($arItemValues['DEV_505_PICTURE_D']['VALUE'])) {
										$arPicture_d = CFile::ResizeImageGet(
											$arItemValues['DEV_505_PICTURE_D']['VALUE'],
											array('width' => 592, 'height' => 296),
											BX_RESIZE_IMAGE_EXACT,
											true
										);
										$arPicture_m = CFile::ResizeImageGet(
											$arItemValues['DEV_505_PICTURE_M']['VALUE'],
											array('width' => 575, 'height' => 575),
											BX_RESIZE_IMAGE_EXACT,
											true
										);
									?>
										<div class="nb-stages-img">
											<picture>
												<source media="(max-width: 991px)" srcset="<?= $arPicture_m['src'] ?>">
												<img src="<?= $arPicture_d['src'] ?>" alt="">
											</picture>
										</div>
									<? } ?>
								</li>
							<? } ?>
						</ol>
					</div>
					<div class="nb-stages-slider content-stages-mobile-s">
						<div class="nb-stages-slider__container">
							<ul class="nb-stages-slider__list">
								<?
								$ii = 0;
								foreach ($arPropertieValue as $arItem) {
									$ii++;
									$arItemValues = $arItem['SUB_VALUES'];
									$active = "";
									if ($ii == 1) {
										$active = "nb-stages-slider__item_active";
									}
								?>
									<? if (mb_strlen($arItemValues['DEV_505_TITLE_M']['VALUE']) > 0) { ?>
										<li class="nb-stages-slider__item <?= $active; ?>"><span><?= $ii; ?></span><?= $arItemValues['DEV_505_TITLE_M']['VALUE'] ?></li>
									<? } ?>
								<? } ?>
							</ul>
						</div>
					</div>
				</div>
				<?if (mb_strlen($item['PROPERTIES']['DEV_505_AFTER_TEXT']['~VALUE']['TEXT']) > 0):?>
					<div class="nb-section__desc">
						<?=$item['PROPERTIES']['DEV_505_AFTER_TEXT']['~VALUE']['TEXT']?>
					</div>
				<?endif;?>
				<?if (mb_strlen($item['PROPERTIES']['DEV_505_NOTICE_TEXT']['~VALUE']['TEXT']) > 0):?>
					<div class="nb-section__notice">
						<?=$item['PROPERTIES']['DEV_505_NOTICE_TEXT']['~VALUE']['TEXT']?>
					</div>
				<?endif;?>
			</div>
        </div>
    </section>
<?
}
?>