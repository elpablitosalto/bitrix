<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
$hasColumns = (is_array($item['DISPLAY_PROPERTIES']['K_10']['VALUE']) && count($item['DISPLAY_PROPERTIES']['K_10']['VALUE']) > 0);
$columnCount = intval($item['PROPERTIES']['K_10_COLUMN_COUNT']['VALUE_XML_ID']);
if (!$columnCount) $columnCount = 3;

$arColumnClass = [
    '2' => 'col-sm-6',
    '3' => 'col-md-4',
    '4' => 'col-sm-6 col-lg-3',
];
?>
<?if (isset($item['DISPLAY_PROPERTIES']['K_10_BEFORE_PICTURE']['FILE_VALUE']['SRC'])):?>
    <div class="fullwidth-img-section" style="background-color:#F5F9FC;">
        <img src="<?=$item['DISPLAY_PROPERTIES']['K_10_BEFORE_PICTURE']['FILE_VALUE']['SRC']?>" alt="">
    </div>
<?endif;?>
<section class="nb-section nb-standards-section<?if ($item['PROPERTIES']['K_10_BACKGROUND']['VALUE_XML_ID'] == 'dark'):?> nb-section_dark<?endif;?>" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y' || mb_strlen($item['DISPLAY_PROPERTIES']['K_10_BEFORE_TEXT']['~VALUE']['TEXT']) > 0):?>
            <div class="nb-section__header">
                <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
                    <?require __DIR__ . "/../../title.php";?>
                <?endif;?>

                <? if (mb_strlen($item['DISPLAY_PROPERTIES']['K_10_BEFORE_TEXT']['~VALUE']['TEXT']) > 0): ?>
                    <div class="nb-section__desc">
                        <?= $item['DISPLAY_PROPERTIES']['K_10_BEFORE_TEXT']['~VALUE']['TEXT'] ?>
                    </div>
                <? endif; ?>
            </div>
        <?endif;?>
        <? if ($hasColumns || mb_strlen($item['DISPLAY_PROPERTIES']['K_10_AFTER_TEXT']['~VALUE']['TEXT']) > 0): ?>
            <div class="nb-section__body">
                <? if ($hasColumns): ?>
                    <div class="nb-standards">
                    <div class="row">
                        <? foreach ($item['DISPLAY_PROPERTIES']['K_10']['VALUE'] as $arItem): ?>
                            <?
                            $arItemValues = $arItem['SUB_VALUES'];
                            ?>
                            <div class="<?=$arColumnClass[$columnCount]?>">
                                <div class="nb-standard">
                                    <? if (mb_strlen($arItemValues['K_10_LINK']['VALUE']) > 0): ?>
                                        <a href="<?=$arItemValues['K_10_LINK']['VALUE']?>" class="nb-standard__link">
                                    <? endif; ?>
                                    <? if (!empty($arItemValues['K_10_PICTURE']['VALUE'])): ?>
                                        <div class="nb-standard__img">
                                            <?
                                            $arPicture = CFile::ResizeImageGet(
                                                $arItemValues['K_10_PICTURE']['VALUE'],
                                                array('width' => 600, 'height' => 600),
                                                BX_RESIZE_IMAGE_PROPORTIONAL,
                                                true
                                            );
                                            ?>
                                            <img src="<?= $arPicture['src'] ?>" alt="" />
                                        </div>
                                    <? endif; ?>
                                    <? if (mb_strlen($arItemValues['K_10_TITLE']['VALUE']) > 0): ?>
                                        <h3 class="nb-standard__title">
                                            <?= $arItemValues['K_10_TITLE']['VALUE'] ?>
                                        </h3>
                                    <? endif; ?>
                                    <? if (mb_strlen($arItemValues['K_10_DESCRIPTION']['~VALUE']['TEXT']) > 0): ?>
                                        <div class="nb-standard__desc">
                                            <?= $arItemValues['K_10_DESCRIPTION']['~VALUE']['TEXT'] ?>
                                        </div>
                                    <? endif; ?>
                                    <? if (mb_strlen($arItemValues['K_10_ANCHOR']['VALUE']) > 0): ?>
                                        <p class="nb-standard__section"><?=$arItemValues['K_10_ANCHOR']['VALUE']?></p>
                                    <? endif; ?>
                                    <? if (mb_strlen($arItemValues['K_10_LINK']['VALUE']) > 0): ?>
                                        </a>
                                    <? endif; ?>
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
                <? endif; ?>
                <? if (mb_strlen($item['DISPLAY_PROPERTIES']['K_10_AFTER_TEXT']['~VALUE']['TEXT']) > 0): ?>
                    <div class="nb-section__notice">
                        <?= $item['DISPLAY_PROPERTIES']['K_10_AFTER_TEXT']['~VALUE']['TEXT'] ?>
                    </div>
                <? endif; ?>
            </div>
        <? endif; ?>
    </div>
</section>