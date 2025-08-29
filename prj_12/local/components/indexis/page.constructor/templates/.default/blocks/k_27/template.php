<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$item = $arParams['ITEM'];
?>
<section class="nb-section nb-simultaneous-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container nb-simultaneous-container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <?
        //vardump($item['PROPERTIES']['HIDE_BLOCK_TITLE']);
        //echo 'HIDE_BLOCK_TITLE = ' . $item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] . '<br />';
        ?>
        <?
        if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') { ?>
            <div class="nb-section__header nb-simultaneous-section__header">
                <?
                // Вывод заголовка для десктопа -->
                if (strlen($item["H_FST_PART_D"]) > 0) {
                ?>
                    <h2 class="nb-section__title nb-simultaneous-section-title simultaneous-mobile desktop">
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
                    <h2 class="nb-section__title nb-simultaneous-section-title simultaneous-mobile mobile">
                        <?
                        echo $item["H_FST_PART_M"];
                        if (strlen($item["H_SEC_PART_M"]) > 0) {
                        ?> <span class="font-weight_normal">
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
            </div>
        <? } ?>
        <div class="nb-section__body nb-simultaneous-section__body">
            <div class="nb-simultaneous-section__image">
                <? if (isset($item['DISPLAY_PROPERTIES']['K_27_PICTURE']['FILE_VALUE']['SRC'])) : ?>
                    <img src="<?= $item['DISPLAY_PROPERTIES']['K_27_PICTURE']['FILE_VALUE']['SRC'] ?>" alt="">
                <? endif; ?>
            </div>
            <div class="nb-simultaneous-section__text">
                <? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') { ?>
                    <?
                    // Вывод заголовка для десктопа -->
                    if (strlen($item["H_FST_PART_D"]) > 0) {
                    ?>
                        <h2 class="nb-section__title nb-simultaneous-section-title desktop">
                            <?
                            echo $item["H_FST_PART_D"];
                            if (strlen($item["H_SEC_PART_D"]) > 0) {
                            ?> <br><span class="font-weight_normal">
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
                        <h2 class="nb-section__title nb-simultaneous-section-title mobile">
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
                <? } ?>
                <? if (mb_strlen($item['DISPLAY_PROPERTIES']['K_27_DESCRIPTION']['~VALUE']['TEXT']) > 0) : ?>
                    <div class="nb-simultaneous-text">
                        <?= $item['DISPLAY_PROPERTIES']['K_27_DESCRIPTION']['~VALUE']['TEXT']; ?>
                    </div>
                <? endif; ?>
            </div>
        </div>
    </div>
</section>