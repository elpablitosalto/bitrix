<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$item = $arParams['ITEM'];
?>
<section class="nb-section nb-standards-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y' || mb_strlen($item['DISPLAY_PROPERTIES']['H_3_BEFORE_TEXT']['~VALUE']['TEXT']) > 0):?>
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

                <? if (mb_strlen($item['DISPLAY_PROPERTIES']['H_3_BEFORE_TEXT']['~VALUE']['TEXT']) > 0): ?>
                    <div class="nb-section__desc">
                        <?= $item['DISPLAY_PROPERTIES']['H_3_BEFORE_TEXT']['~VALUE']['TEXT'] ?>
                    </div>
                <? endif; ?>
            </div>
        <?endif;?>
        <div class="nb-section__body">
            <ul class="nb-indications-list">
                <?for($i = 1; $i <= 4; $i++):?>
                    <li class="nb-indications-item"<?if (!empty($item['PROPERTIES']['H_3_COLOR_' . $i]['VALUE'])):?> style="background-color: #<?=$item['PROPERTIES']['H_3_COLOR_' . $i]['VALUE']?>;"<?endif;?>>
                        <?if (!empty($item['PROPERTIES']['H_3_PICTURE_' . $i]['VALUE'])):?>
                            <div class="nb-indications-img">
                                <picture>
                                    <img src="<?=CFile::GetPath($item['PROPERTIES']['H_3_PICTURE_' . $i]['VALUE'])?>" alt="">
                                </picture>
                            </div>
                        <?endif;?>
                        <div class="nb-indications-description">
                            <?if (mb_strlen($item['PROPERTIES']['H_3_TITLE_' . $i]['VALUE']) > 0):?>
                                <p class="nb-indications-title"><?=$item['PROPERTIES']['H_3_TITLE_' . $i]['VALUE']?></p>
                            <?endif;?>
                            <?=$item['PROPERTIES']['H_3_DESC_' . $i]['~VALUE']['TEXT']?>
                        </div>
                    </li>
                <?endfor;?>
            </ul>
            <?if (mb_strlen($item['DISPLAY_PROPERTIES']['H_3_AFTER_TEXT']['~VALUE']['TEXT']) > 0):?>
                <div class="nb-section__desc">
                    <?= $item['DISPLAY_PROPERTIES']['H_3_AFTER_TEXT']['~VALUE']['TEXT'] ?>
                </div>
            <?endif;?>
            <?if (mb_strlen($item['DISPLAY_PROPERTIES']['H_3_NOTICE_TEXT']['~VALUE']['TEXT']) > 0):?>
                <div class="nb-section__notice">
                    <?= $item['DISPLAY_PROPERTIES']['H_3_NOTICE_TEXT']['~VALUE']['TEXT'] ?>
                </div>
            <?endif;?>
        </div>
    </div>
</section>