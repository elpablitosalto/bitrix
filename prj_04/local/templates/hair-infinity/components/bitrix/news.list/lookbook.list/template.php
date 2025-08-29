<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="lookbook-grid">
    <ul class="lookbook-grid__list">
        <? foreach ($arResult['ITEMS'] as $k => $arItem): ?>
            <? $arImage = CFile::ResizeImageGet(
                    !empty($arItem['PREVIEW_PICTURE']) ? $arItem['PREVIEW_PICTURE'] : $arItem['DETAIL_PICTURE'],
                    array('width' => 590, 'height' => 830),
                    BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
                    true
            ); ?>
            <li class="lookbook-grid__item">
                <!-- begin .lookbook-snippet-->
                <div class="lookbook-snippet lookbook-snippet_state_not-loaded js-look-book-sizer lookbook-grid__snippet">
                    <div class="lookbook-snippet__background">
                        <picture class="lookbook-snippet__picture">
                            <img
                                src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/blocks/lookbook-snippet/images/bg.png"
                                srcset="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/blocks/lookbook-snippet/images/bg@2x.png 2x"
                                alt=""
                                class="lookbook-snippet__image"
                                title=""
                            />
                        </picture>
                    </div>
                    <a href="<?= INFINITY_ROOT.$arItem['DETAIL_PAGE_URL'] ?>" class="lookbook-snippet__content">
                        <span class="lookbook-snippet__illustration">
                            <picture class="lookbook-snippet__picture">
                                <img
                                    src="<?= $arImage["src"] ?>"
                                    alt="<?= $arItem["NAME"] ?>"
                                    class="lookbook-snippet__image"
                                    title=""
                                />
                            </picture>
                        </span>
                    </a>
                </div>
                <!-- end .lookbook-snippet-->
            </li>
        <? endforeach; ?>
    </ul>
</div>