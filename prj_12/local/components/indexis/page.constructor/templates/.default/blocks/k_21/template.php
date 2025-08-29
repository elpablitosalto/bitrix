<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
$hasColumns = (is_array($item['DISPLAY_PROPERTIES']['K_21']['VALUE']) && count($item['DISPLAY_PROPERTIES']['K_21']['VALUE']) > 0);
?>
<section class="nb-section nb-standards-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y' || mb_strlen($item['DISPLAY_PROPERTIES']['K_21_BEFORE_TEXT']['~VALUE']['TEXT']) > 0):?>
            <div class="nb-section__header">
                <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
                    <?require __DIR__ . "/../../title.php";?>
                <?endif;?>

                <? if (mb_strlen($item['DISPLAY_PROPERTIES']['K_21_BEFORE_TEXT']['~VALUE']['TEXT']) > 0): ?>
                    <div class="nb-section__desc">
                        <?= $item['DISPLAY_PROPERTIES']['K_21_BEFORE_TEXT']['~VALUE']['TEXT'] ?>
                    </div>
                <? endif; ?>
            </div>
        <?endif;?>
        <? if ($hasColumns || mb_strlen($item['DISPLAY_PROPERTIES']['K_21_AFTER_TEXT']['~VALUE']['TEXT']) > 0): ?>
            <div class="nb-section__body">
                <? if ($hasColumns): ?>
                    <div class="nb-standards">
                    <div class="row">
                        <? foreach ($item['DISPLAY_PROPERTIES']['K_21']['VALUE'] as $arItem): ?>
                            <?
                            $arItemValues = $arItem['SUB_VALUES'];
                            ?>
                            <div class="col-md-4">
                                <div class="nb-standard">
                                    <? if (!empty($arItemValues['K_21_PICTURE']['VALUE'])): ?>
                                        <div class="nb-standard__img">
                                            <?
                                            $arPicture = CFile::ResizeImageGet(
                                                $arItemValues['K_21_PICTURE']['VALUE'],
                                                array('width' => 600, 'height' => 600),
                                                BX_RESIZE_IMAGE_PROPORTIONAL,
                                                true
                                            );
                                            ?>
                                            <img src="<?= $arPicture['src'] ?>" alt="" />
                                        </div>
                                    <? endif; ?>
                                    <? if (mb_strlen($arItemValues['K_21_TITLE']['VALUE']) > 0): ?>
                                        <h3 class="nb-standard__title">
                                            <?= $arItemValues['K_21_TITLE']['VALUE'] ?>
                                        </h3>
                                    <? endif; ?>
                                    <? if (mb_strlen($arItemValues['K_21_DESCRIPTION']['~VALUE']['TEXT']) > 0): ?>
                                        <div class="nb-standard__desc">
                                            <?= $arItemValues['K_21_DESCRIPTION']['~VALUE']['TEXT'] ?>
                                        </div>
                                    <? endif; ?>
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
                <? endif; ?>
                <? if (mb_strlen($item['DISPLAY_PROPERTIES']['K_21_AFTER_TEXT']['~VALUE']['TEXT']) > 0): ?>
                    <div class="nb-section__notice">
                        <?= $item['DISPLAY_PROPERTIES']['K_21_AFTER_TEXT']['~VALUE']['TEXT'] ?>
                    </div>
                <? endif; ?>
            </div>
        <? endif; ?>
    </div>
</section>