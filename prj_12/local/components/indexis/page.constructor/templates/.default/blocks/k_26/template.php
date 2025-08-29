<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$item = $arParams['ITEM'];

$hasTextCols = (
    mb_strlen($item['DISPLAY_PROPERTIES']['K_26_COL_1_TITLE']['VALUE']) > 0
    || mb_strlen($item['DISPLAY_PROPERTIES']['K_26_COL_1_DESCRIPTION']['~VALUE']['TEXT']) > 0
    || mb_strlen($item['DISPLAY_PROPERTIES']['K_26_COL_2_TITLE']['VALUE']) > 0
    || mb_strlen($item['DISPLAY_PROPERTIES']['K_26_COL_2_DESCRIPTION']['~VALUE']['TEXT']) > 0
);
?>
<section class="nb-section nb-standards-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y' || mb_strlen($item['DISPLAY_PROPERTIES']['K_26_BEFORE_TEXT']['~VALUE']['TEXT']) > 0):?>
            <div class="nb-section__header">
                <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
                    <?
                    // Вывод заголовка для десктопа -->
                    if (strlen($item["H_FST_PART_D"]) > 0) {
                        ?>
                        <h2 class="nb-section__title desktop">
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
                        <h2 class="nb-section__title mobile">
                            <?
                            echo $item["H_FST_PART_M"];
                            if (strlen($item["H_SEC_PART_M"]) > 0) {
                                ?> <br><span class="font-weight_normal">
                                    <?= $item["H_SEC_PART_M"]; ?>
                                </span>
                                <?
                            }
                            ?>
                        </h2>
                        <?
                    }
                    // <-- Вывод заголовка для мобильного
                    ?>
                <?endif;?>

                <? if (mb_strlen($item['DISPLAY_PROPERTIES']['K_26_BEFORE_TEXT']['~VALUE']['TEXT']) > 0): ?>
                    <div class="nb-section__desc">
                        <?= $item['DISPLAY_PROPERTIES']['K_26_BEFORE_TEXT']['~VALUE']['TEXT'] ?>
                    </div>
                <? endif; ?>
            </div>
        <?endif;?>
        <div class="nb-section__body">
			<?if (isset($item['DISPLAY_PROPERTIES']['K_26_COL_1_PICTURE']['FILE_VALUE']['SRC']) || isset($item['DISPLAY_PROPERTIES']['K_26_COL_2_PICTURE']['FILE_VALUE']['SRC'])):?>
				<div class="nb-more-block<?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_26_MORE_URL']['VALUE']) > 0) {echo ' nb-more-block_linked';}?>" style="--color:#F9FBFD;">
					<div class="row no-gutters">
						<?if (isset($item['DISPLAY_PROPERTIES']['K_26_COL_1_PICTURE']['FILE_VALUE']['SRC'])):?>
							<div class="col-sm-6"><img src="<?=$item['DISPLAY_PROPERTIES']['K_26_COL_1_PICTURE']['FILE_VALUE']['SRC']?>" alt=""></div>
						<?endif;?>
						<?if (isset($item['DISPLAY_PROPERTIES']['K_26_COL_2_PICTURE']['FILE_VALUE']['SRC'])):?>
							<div class="col-sm-6"><img src="<?=$item['DISPLAY_PROPERTIES']['K_26_COL_2_PICTURE']['FILE_VALUE']['SRC']?>" alt=""></div>
						<?endif;?>
					</div>
					<?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_26_MORE_URL']['VALUE']) > 0):?>
						<div class="nb-more-block__footer">
							<a class="nb-btn nb-btn_light nb-btn_shadow" href="<?=$item['DISPLAY_PROPERTIES']['K_26_MORE_URL']['VALUE']?>"><?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_26_MORE_ANCHOR']['VALUE']) > 0):?><?=$item['DISPLAY_PROPERTIES']['K_26_MORE_ANCHOR']['VALUE']?><?else:?>Подробнее об услуге<?endif;?></a>
						</div>
					<?endif;?>
				</div>
			<?endif;?>
            <?if ($hasTextCols):?>
                <div class="nb-standards">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="nb-standard">
                                <div class="nb-standard__caption">
                                    <?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_26_COL_1_TITLE']['VALUE']) > 0):?>
                                        <h3 class="nb-standard__title"><?=$item['DISPLAY_PROPERTIES']['K_26_COL_1_TITLE']['VALUE']?></h3>
                                    <?endif;?>
                                    <?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_26_COL_1_DESCRIPTION']['~VALUE']['TEXT']) > 0):?>
                                        <div class="nb-standard__desc">
                                            <?=$item['DISPLAY_PROPERTIES']['K_26_COL_1_DESCRIPTION']['~VALUE']['TEXT']?>
                                        </div>
                                    <?endif;?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="nb-standard">
                                <div class="nb-standard__caption">
                                    <?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_26_COL_2_TITLE']['VALUE']) > 0):?>
                                        <h3 class="nb-standard__title"><?=$item['DISPLAY_PROPERTIES']['K_26_COL_2_TITLE']['VALUE']?></h3>
                                    <?endif;?>
                                    <?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_26_COL_2_DESCRIPTION']['~VALUE']['TEXT']) > 0):?>
                                        <div class="nb-standard__desc">
                                            <?=$item['DISPLAY_PROPERTIES']['K_26_COL_2_DESCRIPTION']['~VALUE']['TEXT']?>
                                        </div>
                                    <?endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			<?endif;?>
			<?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_26_AFTER_TEXT']['~VALUE']['TEXT']) > 0):?>
				<div class="nb-section__desc">
					<?= $item['DISPLAY_PROPERTIES']['K_26_AFTER_TEXT']['~VALUE']['TEXT'] ?>
				</div>
			<?endif;?>
			<?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_26_NOTICE_TEXT']['~VALUE']['TEXT']) > 0):?>
				<div class="nb-section__notice">
					<?= $item['DISPLAY_PROPERTIES']['K_26_NOTICE_TEXT']['~VALUE']['TEXT'] ?>
				</div>
			<?endif;?>
			<?if (!isset($item['DISPLAY_PROPERTIES']['K_26_COL_1_PICTURE']['FILE_VALUE']['SRC']) && !isset($item['DISPLAY_PROPERTIES']['K_26_COL_2_PICTURE']['FILE_VALUE']['SRC'])):?>
				<?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_26_MORE_URL']['VALUE']) > 0):?>
					<div class="nb-more-block__footer">
						<a class="nb-btn nb-btn_light nb-btn_shadow" href="<?=$item['DISPLAY_PROPERTIES']['K_26_MORE_URL']['VALUE']?>"><?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_26_MORE_ANCHOR']['VALUE']) > 0):?><?=$item['DISPLAY_PROPERTIES']['K_26_MORE_ANCHOR']['VALUE']?><?else:?>Подробнее об услуге<?endif;?></a>
					</div>
				<?endif;?>
			<?endif;?>
		</div>
    </div>
</section>