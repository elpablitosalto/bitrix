<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
//var_dump( $item );
//echo "item:";echo "<pre>";print_r($item);echo "</pre>";
?>
<? if (is_array($item['DISPLAY_PROPERTIES']['P_1']['VALUE']) && count($item['DISPLAY_PROPERTIES']['P_1']['VALUE']) > 0): ?>
    <section class="nb-section nb-advantages-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
        <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
            <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
                <div class="nb-section__header">
                    <?require __DIR__ . "/../../title.php";?>
                </div>
            <?endif;?>
            <div class="nb-section__body">
                <div class="nb-advantages">
                    <div class="nb-advantages__container">
                        <div class="nb-advantages__list">
                            <? foreach ($item['DISPLAY_PROPERTIES']['P_1']['VALUE'] as $arItem): ?>
                                <?
                                $arItemValues = $arItem['SUB_VALUES'];
                                ?>
                                <div class="nb-advantages__col">
                                    <div class="nb-advantage">
                                        <? if (!empty($arItemValues['P_1_PICTURE']['VALUE'])): ?>
                                            <div class="nb-advantage__img">
                                                <?
                                                $arPicture = CFile::ResizeImageGet(
                                                    $arItemValues['P_1_PICTURE']['VALUE'],
                                                    array('width' => 330, 'height' => 330),
                                                    BX_RESIZE_IMAGE_EXACT,
                                                    true
                                                );
                                                ?>
                                                <img src="<?= $arPicture['src'] ?>" alt="" />
                                            </div>
                                        <? endif; ?>
                                        <div class="nb-advantage__caption">
                                            <? if (mb_strlen($arItemValues['P_1_TITLE']['VALUE']) > 0): ?>
                                                <div class="nb-advantage__title">
                                                    <?= $arItemValues['P_1_TITLE']['VALUE'] ?>
                                                </div>
                                            <? endif; ?>
                                            <? if (mb_strlen($arItemValues['P_1_DESCRIPTION']['~VALUE']['TEXT']) > 0): ?>
                                                <div class="nb-advantage__desc">
                                                    <?= $arItemValues['P_1_DESCRIPTION']['~VALUE']['TEXT'] ?>
                                                </div>
                                            <? endif; ?>
                                            <? if (mb_strlen($arItemValues['P_1_AFTER_DESCRIPTION']['~VALUE']['TEXT']) > 0): ?>
                                                <div class="nb-advantage__img-desc">
                                                    <?= $arItemValues['P_1_AFTER_DESCRIPTION']['~VALUE']['TEXT'] ?>
                                                </div>
                                            <? endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? endif; ?>