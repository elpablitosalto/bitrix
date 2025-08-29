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
                <?= $item['DISPLAY_PROPERTIES']['DEV_518_TEXT_1']['DISPLAY_VALUE']; ?>
            </div>
        </div>
        <div class="nb-section__body">

            <? if (
                $item['DISPLAY_PROPERTIES']['DEV_518_PIC']['FILE_VALUE']["SRC"]
                || $item['DISPLAY_PROPERTIES']['DEV_518_H_PIC']['VALUE']
                || $item['DISPLAY_PROPERTIES']['DEV_518_T_PIC']['DISPLAY_VALUE']
                || $item['DISPLAY_PROPERTIES']['DEV_518_PIC_LOGO']['FILE_VALUE']["SRC"]
            ) : ?>
                <div class="row no-gutters implantology__images">
                    <? if ($item['DISPLAY_PROPERTIES']['DEV_518_PIC']['FILE_VALUE']["SRC"]) : ?>
                        <div class="col-sm-6">
                            <img src="<?= $item['DISPLAY_PROPERTIES']['DEV_518_PIC']['FILE_VALUE']["SRC"]; ?>" alt="">
                        </div>
                    <? endif; ?>
                    <? if (
                        $item['DISPLAY_PROPERTIES']['DEV_518_H_PIC']['VALUE']
                        || $item['DISPLAY_PROPERTIES']['DEV_518_T_PIC']['DISPLAY_VALUE']
                        || $item['DISPLAY_PROPERTIES']['DEV_518_PIC_LOGO']['FILE_VALUE']["SRC"]
                    ) : ?>
                        <div class="col-sm-6">
                            <? if ($item['DISPLAY_PROPERTIES']['DEV_518_H_PIC']['VALUE']) : ?>
                                <h3 class="nb-standard__title"><?= $item['DISPLAY_PROPERTIES']['DEV_518_H_PIC']['VALUE']; ?></h3>
                            <? endif; ?>
                            <? if ($item['DISPLAY_PROPERTIES']['DEV_518_T_PIC']['DISPLAY_VALUE']) : ?>
                                <p><?= $item['DISPLAY_PROPERTIES']['DEV_518_T_PIC']['DISPLAY_VALUE']; ?></p>
                            <? endif; ?>
                            <? if ($item['DISPLAY_PROPERTIES']['DEV_518_PIC_LOGO']['FILE_VALUE']["SRC"]) : ?>
                                <img src="<?= $item['DISPLAY_PROPERTIES']['DEV_518_PIC_LOGO']['FILE_VALUE']["SRC"]; ?>" alt="">
                            <? endif; ?>
                        </div>
                    <? endif; ?>
                </div>
            <? endif; ?>

            <? if (
                $item['DISPLAY_PROPERTIES']['DEV_518_H_COL_1']['VALUE']
                || $item['DISPLAY_PROPERTIES']['DEV_518_T_COL_1']['DISPLAY_VALUE']
                || $item['DISPLAY_PROPERTIES']['DEV_518_H_COL_2']['VALUE']
                || $item['DISPLAY_PROPERTIES']['DEV_518_T_COL_2']['DISPLAY_VALUE']
                || $item['DISPLAY_PROPERTIES']['DEV_518_H_COL_3']['VALUE']
                || $item['DISPLAY_PROPERTIES']['DEV_518_T_COL_3']['DISPLAY_VALUE']
            ) : ?>
                <div class="nb-standards">
                    <div class="row">
                        <? if ($item['DISPLAY_PROPERTIES']['DEV_518_H_COL_1']['VALUE'] || $item['DISPLAY_PROPERTIES']['DEV_518_T_COL_1']['DISPLAY_VALUE']) : ?>
                            <div class="col-sm-4">
                                <div class="nb-standard">
                                    <div class="nb-standard__caption">
                                        <? if ($item['DISPLAY_PROPERTIES']['DEV_518_H_COL_1']['VALUE']) : ?>
                                            <h3 class="nb-standard__title"><?= $item['DISPLAY_PROPERTIES']['DEV_518_H_COL_1']['VALUE']; ?></h3>
                                        <? endif; ?>
                                        <? if ($item['DISPLAY_PROPERTIES']['DEV_518_T_COL_1']['DISPLAY_VALUE']) : ?>
                                            <div class="nb-standard__desc">
                                                <p><?= $item['DISPLAY_PROPERTIES']['DEV_518_T_COL_1']['DISPLAY_VALUE']; ?></p>
                                            </div>
                                        <? endif; ?>
                                    </div>
                                </div>
                            </div>
                        <? endif; ?>
                        <? if ($item['DISPLAY_PROPERTIES']['DEV_518_H_COL_2']['VALUE'] || $item['DISPLAY_PROPERTIES']['DEV_518_T_COL_2']['DISPLAY_VALUE']) : ?>
                            <div class="col-sm-4">
                                <div class="nb-standard">
                                    <div class="nb-standard__caption">
                                        <? if ($item['DISPLAY_PROPERTIES']['DEV_518_H_COL_2']['VALUE']) : ?>
                                            <h3 class="nb-standard__title"><?= $item['DISPLAY_PROPERTIES']['DEV_518_H_COL_2']['VALUE']; ?></h3>
                                        <? endif; ?>
                                        <? if ($item['DISPLAY_PROPERTIES']['DEV_518_T_COL_2']['DISPLAY_VALUE']) : ?>
                                            <div class="nb-standard__desc">
                                                <p><?= $item['DISPLAY_PROPERTIES']['DEV_518_T_COL_2']['DISPLAY_VALUE']; ?></p>
                                            </div>
                                        <? endif; ?>
                                    </div>
                                </div>
                            </div>
                        <? endif; ?>
                        <? if ($item['DISPLAY_PROPERTIES']['DEV_518_H_COL_3']['VALUE'] || $item['DISPLAY_PROPERTIES']['DEV_518_T_COL_3']['DISPLAY_VALUE']) : ?>
                            <div class="col-sm-4">
                                <div class="nb-standard">
                                    <div class="nb-standard__caption">
                                        <? if ($item['DISPLAY_PROPERTIES']['DEV_518_H_COL_3']['VALUE']) : ?>
                                            <h3 class="nb-standard__title"><?= $item['DISPLAY_PROPERTIES']['DEV_518_H_COL_3']['VALUE']; ?></h3>
                                        <? endif; ?>
                                        <? if ($item['DISPLAY_PROPERTIES']['DEV_518_T_COL_3']['DISPLAY_VALUE']) : ?>
                                            <div class="nb-standard__desc">
                                                <p><?= $item['DISPLAY_PROPERTIES']['DEV_518_T_COL_3']['DISPLAY_VALUE']; ?></p>
                                            </div>
                                        <? endif; ?>
                                    </div>
                                </div>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
            <? endif; ?>

            <? if ($item['DISPLAY_PROPERTIES']['DEV_518_TEXT_2']['DISPLAY_VALUE']) : ?>
                <div class="nb-section__desc">
                    <?= $item['DISPLAY_PROPERTIES']['DEV_518_TEXT_2']['DISPLAY_VALUE']; ?>
                </div>
            <? endif; ?>

            <? if ($item['DISPLAY_PROPERTIES']['DEV_518_TEXT_3']['DISPLAY_VALUE']) : ?>
                <div class="nb-section__notice">
                    <p><?= $item['DISPLAY_PROPERTIES']['DEV_518_TEXT_3']['DISPLAY_VALUE']; ?></p>
                </div>
            <? endif; ?>

        </div>
    </div>
</section>