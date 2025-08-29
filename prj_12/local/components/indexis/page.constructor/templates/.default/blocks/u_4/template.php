<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$item = $arParams['ITEM'];
$showFeatures = (!empty($item['DISPLAY_PROPERTIES']['U_4_OFFER_PICTURE_1']['DISPLAY_VALUE']) || !empty($item['DISPLAY_PROPERTIES']['U_4_OFFER_PICTURE_2']['DISPLAY_VALUE']) || !empty($item['DISPLAY_PROPERTIES']['U_4_OFFER_PICTURE_3']['DISPLAY_VALUE']));
?>
<section class="nb-top-b-section nb-top-b-section_dark<? if (!$showFeatures) : ?> nb-top-b-section_no-features<? endif; ?>" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "",
        array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => SITE_ID
        )
    );
    ?>
    <div class="nb-top-b" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <div class="nb-top-b__img">
            <picture>
                <?
                $arPicture = array();
                $NO_IMAGE_DEFAULT = SITE_TEMPLATE_PATH . '/img/content/top-banner/about.jpg';

                $arFile = $item['DISPLAY_PROPERTIES']['U_4_PICTURE']['FILE_VALUE'];
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

                $arFile = $item['DISPLAY_PROPERTIES']['U_4_PICTURE_480']['FILE_VALUE'];
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

                $arFile = $item['DISPLAY_PROPERTIES']['U_4_PICTURE_991']['FILE_VALUE'];
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
                <source media="(max-width: 480px)" srcset="<?= $arPicture['PICTURE_2']['SRC'] ?>">
                <source media="(max-width: 991px)" srcset="<?= $arPicture['PICTURE_3']['SRC'] ?>">
                <img src="<?= $arPicture['PICTURE_1']['SRC'] ?>" alt="">
                <?/*?>
                <?
                $bannerPictureSrc = !empty($item['PROPERTIES']['U_4_PICTURE']['VALUE']) ? CFile::GetPath($item['PROPERTIES']['U_4_PICTURE']['VALUE']) : SITE_TEMPLATE_PATH . '/img/content/top-banner/about.jpg';
                ?>
                <source media="(max-width: 480px)" srcset="<?= $bannerPictureSrc ?>">
                <source media="(max-width: 991px)" srcset="<?= $bannerPictureSrc ?>">
                <img src="<?= $bannerPictureSrc ?>" alt="">
                <?*/ ?>
            </picture>
        </div>

        <div class="nb-top-b__caption">
            <? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') : ?>
                <?
                if (strlen($item["H_FST_PART_D"]) > 0) {
                ?>
                    <h1 class="nb-top-b__title nb-top-b__title_desktop">
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

                if (strlen($item["H_FST_PART_M"]) > 0) {
                ?>
                    <p class="nb-top-b__title nb-top-b__title_mobile">
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
                ?>
            <? endif; ?>
            <?
            $textDesktop = $item['PROPERTIES']['U_4_DESCRIPTION']['~VALUE']['TEXT'];
            $textMobile = $item['PROPERTIES']['U_4_DESCRIPTION_M']['~VALUE']['TEXT'];
            /*
            if (mb_strlen($textMobile) <= 0 && mb_strlen($textDesktop) > 0) {
                $textMobile = $textDesktop;
            }
            */
            ?>
            <? if (mb_strlen($textDesktop) > 0) { ?>
                <div class="nb-top-b__desc desktop">
                    <?= $textDesktop; ?>
                </div>
            <? } ?>
            <? if (mb_strlen($textMobile) > 0) { ?>
                <div class="nb-top-b__desc mobile">
                    <?= $textMobile ?>
                </div>
            <? } ?>
            <?/*?>
            <? if (mb_strlen($item['PROPERTIES']['U_4_DESCRIPTION']['~VALUE']['TEXT']) > 0) : ?>
                <div class="nb-top-b__desc">
                    <?= $item['PROPERTIES']['U_4_DESCRIPTION']['~VALUE']['TEXT'] ?>
                </div>
            <? endif; ?>
            <?*/ ?>
        </div>

        <? if (
            !empty($item['DISPLAY_PROPERTIES']['U_4_OFFER_PICTURE_1']['DISPLAY_VALUE'])
            || !empty($item['DISPLAY_PROPERTIES']['U_4_OFFER_PICTURE_2']['DISPLAY_VALUE'])
            || !empty($item['DISPLAY_PROPERTIES']['U_4_OFFER_PICTURE_3']['DISPLAY_VALUE'])
        ) : ?>
            <div class="nb-ftrs nb-top-b__features">
                <ul class="nb-ftrs__list">
                    <? foreach (['U_4_OFFER_PICTURE_1', 'U_4_OFFER_PICTURE_2', 'U_4_OFFER_PICTURE_3'] as $iconCode) : ?>
                        <?
                        if (empty($item['DISPLAY_PROPERTIES'][$iconCode]['FILE_VALUE']))
                            continue;
                        ?>
                        <li class="nb-ftrs__item">
                            <span class="nb-ftrs__icon">
                                <img src="<?= $item['DISPLAY_PROPERTIES'][$iconCode]['FILE_VALUE']['SRC'] ?>" alt="" />
                            </span>
                            <? if (mb_strlen($item['DISPLAY_PROPERTIES'][$iconCode]['~DESCRIPTION']) > 0) : ?>
                                <span class="nb-ftrs__desc"><?= $item['DISPLAY_PROPERTIES'][$iconCode]['~DESCRIPTION'] ?></span>
                            <? endif; ?>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        <? endif; ?>

    </div>
</section>