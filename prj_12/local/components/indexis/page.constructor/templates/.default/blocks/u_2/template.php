<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
?>
<section class="nb-top-b-slider-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <? $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "",
        array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => SITE_ID
        )
    ); ?>
    <div class="nb-top-b-block" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <div class="nb-top-b-block__caption">
            <? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') : ?>
                <?
                // Вывод заголовка для десктопа -->
                if (strlen($item["H_FST_PART_D"]) > 0) {
                ?>
                    <h1 class="nb-top-b-block__title nb-top-b-block__title_desktop">
                        <?
                        echo $item["H_FST_PART_D"];
                        if (strlen($item["H_SEC_PART_D"]) > 0) {
                        ?> <span>
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
                    <p class="nb-top-b-block__title nb-top-b-block__title_mobile">
                        <?
                        echo $item["H_FST_PART_M"];
                        if (strlen($item["H_SEC_PART_M"]) > 0) {
                        ?> <span class="font-weight_normal">
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
            <div class="nb-top-b-block__desc">
                <?
                $textDesktop = $item['PROPERTIES']['U_2_TEXT_D']['~VALUE']['TEXT'];
                $textMobile = $item['PROPERTIES']['U_2_TEXT_M']['~VALUE']['TEXT'];
                /*
                if (mb_strlen($textMobile) <= 0 && mb_strlen($textDesktop) > 0) {
                    $textMobile = $textDesktop;
                }
                */
                ?>
                <? if (mb_strlen($textDesktop) > 0) { ?>
                    <div class="desktop">
                        <?= $textDesktop; ?>
                    </div>
                <? } ?>
                <? if (mb_strlen($textMobile) > 0) { ?>
                    <div class="mobile">
                        <?= $textMobile ?>
                    </div>
                <? } ?>
                <?/*?>
                <p>В клинике «Белый кролик» проводятся все виды имплантаций, мы работаем с&nbsp;имплантационными системами ведущих мировых производителей из Швейцарии и Южной Кореи.</p>
                <?*/ ?>
            </div>
            <div class="nb-ftrs nb-top-b-block__features">
                <ul class="nb-ftrs__list">
                    <?
                    $style = '';
                    if (strlen($item['DISPLAY_PROPERTIES']['U_2_COLOR_TEXT_UTP']['VALUE'])) {
                        $style = 'style="color: #' . $item['DISPLAY_PROPERTIES']['U_2_COLOR_TEXT_UTP']['VALUE'] . '"';
                    }
                    ?>
                    <?
                    //vardump($item['DISPLAY_PROPERTIES']['U_2_ICON_1']);
                    ?>
                    <? foreach (['U_2_ICON_1', 'U_2_ICON_2', 'U_2_ICON_3'] as $iconCode) : ?>
                        <?
                        if (empty($item['DISPLAY_PROPERTIES'][$iconCode]['FILE_VALUE']))
                            continue;
                        ?>
                        <li class="nb-ftrs__item" <?= $style ?>>
                            <span class="nb-ftrs__icon">
                                <img src="<?= $item['DISPLAY_PROPERTIES'][$iconCode]['FILE_VALUE']['SRC'] ?>" alt="">
                            </span>
                            <? if (mb_strlen($item['DISPLAY_PROPERTIES'][$iconCode]['~DESCRIPTION']) > 0) : ?>
                                <span class="nb-ftrs__desc"><?= $item['DISPLAY_PROPERTIES'][$iconCode]['~DESCRIPTION'] ?></span>
                            <? endif; ?>
                        </li>
                    <? endforeach; ?>
                    <?/*?>
                    <li class="nb-ftrs__item" <?= $style ?>><span class="nb-ftrs__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/fix-cena.png" alt=""></span><span class="nb-ftrs__desc">Фиксированная прозрачная цена</span></li>
                    <li class="nb-ftrs__item" <?= $style ?>><span class="nb-ftrs__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/diagnostika.png" alt=""></span><span class="nb-ftrs__desc">Компьютерная диагностика</span></li>
                    <li class="nb-ftrs__item" <?= $style ?>><span class="nb-ftrs__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/operacii.png" alt=""></span><span class="nb-ftrs__desc">Операции любой сложности</span></li>
                    <?*/ ?>
                </ul>
            </div>
        </div>
        <div class="nb-top-b-block__img">
            <div class="nb-top-b-slider">
                <div class="nb-top-b-slider-container">
                    <div class="nb-top-b-slider-list">
                        <?
                        $arPicture = array();
                        $NO_IMAGE_DEFAULT = SITE_TEMPLATE_PATH . '/img/content/top-banner/slide1.jpg';

                        $arFile = $item['DISPLAY_PROPERTIES']['U_2_PICTURE']['FILE_VALUE'];
                        if (!empty($arFile)) {
                            //$arFile = CFile::GetFileArray($arElement["PREVIEW_PICTURE"]);
                            $arResultLocal = Indexis::getImageFormatted(array(
                                'RESIZE' => 'N',
                                'FILE_VALUE' => $arFile,
                                'NO_IMAGE_DEFAULT' => $NO_IMAGE_DEFAULT,
                                //'WIDTH' => 205,
                                //'HEIGHT' => 116,
                                'DEFAULT_ALT_TITLE' => ''
                            ));
                            $arPicture['PICTURE_1'] = $arResultLocal['PICTURE'];
                        } else {
                            $arPicture['PICTURE_1']['SRC'] = $NO_IMAGE_DEFAULT;
                        }

                        $arFile = $item['DISPLAY_PROPERTIES']['U_2_PICTURE_480']['FILE_VALUE'];
                        if (!empty($arFile)) {
                            //$arFile = CFile::GetFileArray($arElement["PREVIEW_PICTURE"]);
                            $arResultLocal = Indexis::getImageFormatted(array(
                                'RESIZE' => 'N',
                                'FILE_VALUE' => $arFile,
                                'NO_IMAGE_DEFAULT' => $NO_IMAGE_DEFAULT,
                                'WIDTH' => 480,
                                'HEIGHT' => 5000,
                                'DEFAULT_ALT_TITLE' => ''
                            ));
                            $arPicture['PICTURE_2'] = $arResultLocal['PICTURE'];
                        } else {
                            $arPicture['PICTURE_2']['SRC'] = $NO_IMAGE_DEFAULT;
                        }

                        $arFile = $item['DISPLAY_PROPERTIES']['U_2_PICTURE_991']['FILE_VALUE'];
                        if (!empty($arFile)) {
                            //$arFile = CFile::GetFileArray($arElement["PREVIEW_PICTURE"]);
                            $arResultLocal = Indexis::getImageFormatted(array(
                                'RESIZE' => 'N',
                                'FILE_VALUE' => $arFile,
                                'NO_IMAGE_DEFAULT' => $NO_IMAGE_DEFAULT,
                                'WIDTH' => 991,
                                'HEIGHT' => 5000,
                                'DEFAULT_ALT_TITLE' => ''
                            ));
                            $arPicture['PICTURE_3'] = $arResultLocal['PICTURE'];
                        } else {
                            $arPicture['PICTURE_3']['SRC'] = $NO_IMAGE_DEFAULT;
                        }
                        ?>
                        <div class="nb-top-b-slider-item" style="--bg-image: url(<?= $arPicture['PICTURE_1']['SRC'] ?>);">
                            <picture class="nb-top-b-slider-item__img">
                                <source media="(max-width: 480px)" srcset="<?= $arPicture['PICTURE_2']['SRC'] ?>">
                                <source media="(max-width: 991px)" srcset="<?= $arPicture['PICTURE_3']['SRC'] ?>">
                                <img src="<?= $arPicture['PICTURE_1']['SRC'] ?>" alt="">
                            </picture>
                        </div>
                        <?/*?>
                        <div class="nb-top-b-slider-item" style="--bg-image: url(<?= SITE_TEMPLATE_PATH ?>/img/content/top-banner/slide1.jpg);">
                            <picture class="nb-top-b-slider-item__img">
                                <source media="(max-width: 480px)" srcset="<?= SITE_TEMPLATE_PATH ?>/img/content/top-banner/slide1.jpg">
                                <source media="(max-width: 991px)" srcset="<?= SITE_TEMPLATE_PATH ?>/img/content/top-banner/slide1.jpg">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/content/top-banner/slide1.jpg" alt="">
                            </picture>
                        </div>
                        <?*/ ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>