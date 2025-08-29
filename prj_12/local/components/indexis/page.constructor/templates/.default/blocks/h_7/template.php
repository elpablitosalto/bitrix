<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$item = $arParams['ITEM'];
?>
<section class="nb-section nb-opalescenceboost-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y' || mb_strlen($item['DISPLAY_PROPERTIES']['H_7_BEFORE_TEXT']['~VALUE']['TEXT']) > 0):?>
            <div class="nb-section__header">
                <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
                    <?
                    // Вывод заголовка для десктопа -->
                    if (strlen($item["H_FST_PART_D"]) > 0) {
                        ?>
                        <h2 class="nb-section__title nb-section-whitening-title desktop">
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
                        <h2 class="nb-section__title nb-section-whitening-title mobile">
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

                <? if (mb_strlen($item['DISPLAY_PROPERTIES']['H_7_BEFORE_TEXT']['~VALUE']['TEXT']) > 0): ?>
                    <div class="nb-section__desc">
                        <?= $item['DISPLAY_PROPERTIES']['H_7_BEFORE_TEXT']['~VALUE']['TEXT'] ?>
                    </div>
                <? endif; ?>
            </div>
        <?endif;?>
        <div class="nb-section__body">
            <ul class="nb-opalescenceboost-list">
                <?for($i = 1; $i <= 4; $i++):?>
                    <li class="nb-opalescenceboost-item">
                        <?if (mb_strlen($item['PROPERTIES']['H_7_TITLE_' . $i]['VALUE']) > 0):?>
                            <div class="nb-opalescenceboost-title"><?=$item['PROPERTIES']['H_7_TITLE_' . $i]['VALUE']?></div>
                        <?endif;?>
                        <?if (mb_strlen($item['PROPERTIES']['H_7_DESC_' . $i]['~VALUE']['TEXT']) > 0 || !empty($item['PROPERTIES']['H_7_PICTURE_' . $i]['VALUE'])):?>
                            <div class="nb-opalescenceboost-description"<?if (!empty($item['PROPERTIES']['H_7_PICTURE_' . $i]['VALUE'])):?> style="background-image: url(<?=CFile::GetPath($item['PROPERTIES']['H_7_PICTURE_' . $i]['VALUE'])?>)"<?endif;?>>
                                <?if (mb_strlen($item['PROPERTIES']['H_7_DESC_' . $i]['~VALUE']['TEXT']) > 0):?>
                                    <?=$item['PROPERTIES']['H_7_DESC_' . $i]['~VALUE']['TEXT']?>
                                <?endif;?>
                            </div>
                        <?endif;?>
                    </li>
                <?endfor;?>
            </ul>
            <?if (mb_strlen($item['DISPLAY_PROPERTIES']['H_7_AFTER_TEXT']['~VALUE']['TEXT']) > 0):?>
                <div class="nb-section__desc">
                    <?= $item['DISPLAY_PROPERTIES']['H_7_AFTER_TEXT']['~VALUE']['TEXT'] ?>
                </div>
            <?endif;?>
            <?if (mb_strlen($item['DISPLAY_PROPERTIES']['H_7_NOTICE_TEXT']['~VALUE']['TEXT']) > 0):?>
                <div class="nb-section__notice">
                    <?= $item['DISPLAY_PROPERTIES']['H_7_NOTICE_TEXT']['~VALUE']['TEXT'] ?>
                </div>
            <?endif;?>
        </div>
    </div>
</section>