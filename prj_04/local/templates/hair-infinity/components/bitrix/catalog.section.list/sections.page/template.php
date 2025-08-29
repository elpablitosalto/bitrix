<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="info-group">
    <ul class="info-group__list">
        <? foreach ($arResult['SECTIONS'] as $index => $arSection) : ?>
            <? $image = CFile::ResizeImageGet($arSection['DETAIL_PICTURE'], array('width' => 600, 'height' => 400), BX_RESIZE_IMAGE_EXACT, true); ?>
            <li class="info-group__item">
                <!-- begin .info-panel-->
                <div class="info-panel <? if ($index > 0 && ($index + 1) % 2 == 0) : ?>info-panel_layout_reversed<? endif; ?>">
                    <div class="info-panel__wrapper">
                        <div class="info-panel__illustration">
                            <img src="<?= $image["src"] ?>" alt="<?= $arSection["NAME"] ?>" class="info-panel__image" title="" />
                        </div>
                        <div class="info-panel__content">
                            <a class="info-panel__title" href="<?= $arSection["SECTION_PAGE_URL"] ?>"><?= $arSection["NAME"] ?></a>
                            <?/*?>
                            <div class="info-panel__title"><?=$arSection["NAME"]?></div>
                            <?*/ ?>
                            <div class="info-panel__text">
                                <?= htmlspecialchars_decode($arSection["UF_MAIN_BLOCK_SMALL_DESC"]) ?>
                            </div>
                            <? if (!empty($arSection['ITEMS'])) : ?>
                                <div class="info-panel__link-group">
                                    <ul class="info-panel__links">
                                        <? foreach ($arSection['ITEMS'] as $j => $arItem) : ?>
                                            <li class="info-panel__link-item">
                                                <!-- begin .link-->
                                                <a class="link" href="<?= $arItem['SECTION_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                                                <!-- end .link-->
                                            </li>
                                        <? endforeach; ?>
                                    </ul>
                                </div>
                            <? endif ?>
                        </div>
                    </div>
                </div>
                <!-- end .info-panel-->
            </li>
        <? endforeach; ?>
    </ul>
</div>