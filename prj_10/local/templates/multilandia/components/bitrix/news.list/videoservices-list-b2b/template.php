<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<? if (count($arResult['ITEMS']) > 0) : ?>
    <?
    foreach ($arResult['arSections'] as $arSection) {
    ?>
        <div class="ml-videoservices b2b">
            <h2><?= $arSection['NAME']; ?></h2>
            <ul class="ml-videoservices-list">
                <? foreach ($arResult['ITEMS'] as $arItem) : ?>
                    <? if ($arItem['IBLOCK_SECTION_ID'] == $arSection['ID']) { ?>
                        <? if ($arItem['PREVIEW_PICTURE']['SRC']) : ?>
                            <li>
                                <? $fale = 'javascript:void(0);';
                                if ($arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC']) {
                                    $fale = $arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC'];
                                } else if ($arItem['DISPLAY_PROPERTIES']['IMAGE']['FILE_VALUE']['SRC']) {
                                    $fale = $arItem['DISPLAY_PROPERTIES']['IMAGE']['FILE_VALUE']['SRC'];
                                } ?>
                                <a href="<?= $fale ?>" <?= $fale != 'javascript:void(0);' ? 'download target="_blank"' : '' ?>>
                                    <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>" width="360" height="360">
                                </a>
                                <p>
                                    <?= $arItem['NAME'] ?>
                                    <?/*if($arItem['PROPERTIES']['FILE']['VALUE']):?>
                                , формат
                                <a href="<?=CFile::GetPath($arItem['PROPERTIES']['FILE']['VALUE'])?>" class="link" target="_blank">
                                    <?=$arItem['PROPERTIES']['FILE']['DESCRIPTION'];?>
                                </a>
                            <?elseif($arItem['PROPERTIES']['IMAGE']['VALUE']):?>
                                , формат
                                <a href="<?=CFile::GetPath($arItem['PROPERTIES']['IMAGE']['VALUE'])?>" class="link" target="_blank">
                                    <?=$arItem['PROPERTIES']['IMAGE']['DESCRIPTION'];?>
                                </a>
                            <?endif;*/ ?>
                                </p>
                            </li>
                        <? endif; ?>
                    <? } ?>
                <? endforeach; ?>
            </ul>
        </div>
    <? } ?>
<?php endif; ?>