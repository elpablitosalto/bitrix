<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
//vardump($item['DISPLAY_PROPERTIES']['DEV_517_PIC_LEFT']);
// ['VALUE']["TEXT"]
?>
<section class="nb-section nb-standards-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <div class="nb-section__header">
            <? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') { ?>
                <? require __DIR__ . "/../../title.php"; ?>
            <? } ?>
            <div class="nb-section__desc">
                <?= $item['DISPLAY_PROPERTIES']['DEV_517_TEXT_1']['DISPLAY_VALUE']; ?>
            </div>
        </div>
        <div class="nb-section__body">
            <div class="nb-more-block">
                <div class="row no-gutters">
                    <div class="col-sm-6 implantology__color-salad" <? if (!empty($item['PROPERTIES']['DEV_517_COLOR_BG_LEFT']['VALUE'])) : ?> style="background: #<?= $item['PROPERTIES']['DEV_517_COLOR_BG_LEFT']['VALUE'] ?>;" <? endif; ?>>
                        <img src="<?= $item['DISPLAY_PROPERTIES']['DEV_517_PIC_LEFT']['FILE_VALUE']["SRC"]; ?>" alt="">
                        <div class="implantology__images_description">
                            <h3 class="nb-standard__title"><?= $item['DISPLAY_PROPERTIES']['DEV_517_SUB_H_LEFT']['VALUE']; ?></h3>
                            <p><?= $item['DISPLAY_PROPERTIES']['DEV_517_TEXT_LEFT']['DISPLAY_VALUE']; ?></p>
                        </div>
                    </div>
                    <div class="col-sm-6 implantology__color-pink" <? if (!empty($item['PROPERTIES']['DEV_517_COLOR_BG_RIGHT']['VALUE'])) : ?> style="background: #<?= $item['PROPERTIES']['DEV_517_COLOR_BG_RIGHT']['VALUE'] ?>;" <? endif; ?>>
                        <img src="<?= $item['DISPLAY_PROPERTIES']['DEV_517_PIC_RIGHT']['FILE_VALUE']["SRC"]; ?>" alt="">
                        <div class="implantology__images_description">
                            <h3 class="nb-standard__title"><?= $item['DISPLAY_PROPERTIES']['DEV_517_SUB_H_RIGHT']['VALUE']; ?></h3>
                            <p><?= $item['DISPLAY_PROPERTIES']['DEV_517_TEXT_RIGHT']['DISPLAY_VALUE']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nb-section__desc">
                <?= $item['DISPLAY_PROPERTIES']['DEV_517_TEXT_2']['DISPLAY_VALUE']; ?>
            </div>
            <div class="nb-section__notice">
                <p><?= $item['DISPLAY_PROPERTIES']['DEV_517_TEXT_3']['DISPLAY_VALUE']; ?></p>
            </div>
        </div>
    </div>
</section>