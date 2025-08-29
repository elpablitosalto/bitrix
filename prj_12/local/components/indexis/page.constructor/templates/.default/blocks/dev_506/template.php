<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
//$arPropertieValue = $item['DISPLAY_PROPERTIES']['DEV_506']['VALUE'];

// Основное изображение
$arPicture = CFile::ResizeImageGet(
    $item['DISPLAY_PROPERTIES']['DEV_506_PICTURE']['VALUE'],
    array('width' => 812, 'height' => 849),
    BX_RESIZE_IMAGE_EXACT,
    true
);

// Иконки -->
for ($i = 1; $i <= 4; $i++) {
    $arPictureIcons[$i] = CFile::ResizeImageGet(
        $item['DISPLAY_PROPERTIES']['DEV_506_ICON_' . $i]['VALUE'],
        array('width' => 96, 'height' => 96),
        BX_RESIZE_IMAGE_EXACT,
        true
    );
}
// <-- Иконки

//echo "DISPLAY_PROPERTIES:";echo "<pre>";print_r($item['DISPLAY_PROPERTIES']);echo "</pre>";
//echo "arPictureIcons:";echo "<pre>";print_r($arPictureIcons);echo "</pre>";

// Тексты к иконкам -->
for ($i = 1; $i <= 4; $i++) {
    $arTextsIcons[$i] = $item['DISPLAY_PROPERTIES']['DEV_506_ICON_TEXT_' . $i]['VALUE']['TEXT'];
}
// <--Тексты к иконкам

?>
<div class="advantage-wrapper-bg">
    <section class="nb-section nb-advantage-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
        <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
            <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
                <div class="nb-section__header">
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
                            ?> <span class="font-weight_normal">
                                    <?= $item["H_SEC_PART_M"]; ?>
                                </span>
                                <?
                                $thd_part_m = $item['DISPLAY_PROPERTIES']['DEV_506_H_THD_PART_M']['VALUE'];
                                if (strlen($thd_part_m) > 0) {
                                ?>
                                    <span class="content-advantage-mobile">
                                        <?= $thd_part_m; ?>
                                    </span>
                                <? } ?>
                            <?
                            }
                            ?>
                        </h2>
                    <?
                    }
                    // <-- Вывод заголовка для мобильного
                    ?>
                </div>
            <?endif;?>
            <div class="nb-section__body">
                <div class="nb-advantage-content">
                    <?
                    if (strlen($arPicture["src"]) > 0) {
                    ?>
                        <img src="<?= $arPicture["src"] ?>" alt="" />
                    <?
                    }
                    ?>
                    <div class="nb-advantage-item nb-advantage-item__one">
                        <?
                        if (strlen($arPictureIcons[1]["src"]) > 0) {
                        ?>
                            <div class="nb-advantage-item__img"><img src="<?= $arPictureIcons[1]["src"] ?>" alt=""></div>
                        <?
                        }
                        if (strlen($arTextsIcons[1]) > 0) {
                            echo $arTextsIcons[1];
                        }
                        ?>
                    </div>
                    <div class="nb-advantage-item nb-advantage-item__two">
                        <?
                        if (strlen($arPictureIcons[2]["src"]) > 0) {
                        ?>
                            <div class="nb-advantage-item__img"><img src="<?= $arPictureIcons[2]["src"] ?>" alt=""></div>
                        <?
                        }
                        if (strlen($arTextsIcons[2]) > 0) {
                            echo $arTextsIcons[2];
                        }
                        ?>
                    </div>
                    <div class="nb-advantage-item nb-advantage-item__three">
                        <?
                        if (strlen($arPictureIcons[3]["src"]) > 0) {
                        ?>
                            <div class="nb-advantage-item__img"><img src="<?= $arPictureIcons[3]["src"] ?>" alt=""></div>
                        <?
                        }
                        if (strlen($arTextsIcons[3]) > 0) {
                            echo $arTextsIcons[3];
                        }
                        ?>
                    </div>
                    <div class="nb-advantage-item nb-advantage-item__four">
                        <?
                        if (strlen($arPictureIcons[4]["src"]) > 0) {
                        ?>
                            <div class="nb-advantage-item__img"><img src="<?= $arPictureIcons[4]["src"] ?>" alt=""></div>
                        <?
                        }
                        if (strlen($arTextsIcons[4]) > 0) {
                            echo $arTextsIcons[4];
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>