<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Type\DateTime;

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
<? if (!empty($arResult["ITEMS"])): ?>
    <div class="section">
        <div class="section__header section__header_type_inline">
            <div class="section__title">
                <!-- begin .title-->
                <h2 class="title title_size_h2">Мы в СМИ
                </h2>
                <!-- end .title-->
            </div>
            <div class="section__carousel-nav">
                <!-- begin .carousel-nav-->
                <div class="carousel-nav js-carousel-nav"
                        data-nav-scope=".section" data-nav-target=".swiper">
                    <div class="carousel-nav__control">
                        <!-- begin .button-->
                        <button class="button button_role_navigation js-carousel-nav-prev"
                                type="button"><span class="button__holder">
                <svg class="button__icon" width="10" height="17" viewBox="0 0 10 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 1L1.33333 8.66667L9 16.3333" fill="transparent" stroke="currentColor"></path>
                </svg></span>
                        </button>
                        <!-- end .button-->
                    </div>
                    <div class="carousel-nav__control">
                        <!-- begin .button-->
                        <button class="button button_role_navigation js-carousel-nav-next"
                                type="button"><span class="button__holder">
                <svg class="button__icon" width="16" height="17" viewBox="0 0 16 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 16L11.6667 8.33333L4 0.666667" fill="transparent" stroke="currentColor"></path>
                </svg></span>
                        </button>
                        <!-- end .button-->
                    </div>
                </div>
                <!-- end .carousel-nav-->
            </div>
        </div>
        <div class="section__content">
            <div class="section__media-panel">
                <!-- begin .mass-media-carousel-->
                <div class="mass-media-carousel">
                    <div class="mass-media-carousel__container swiper js-media-carousel">
                        <div class="mass-media-carousel__wrapper swiper-wrapper">
                            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                                <?
                                $obNewsDate = !empty($arItem["ACTIVE_FROM"]) ? (new DateTime($arItem["ACTIVE_FROM"], 'd.m.Y H:i:s')) : (new DateTime($arItem["DATE_CREATE"], 'd.m.Y H:i:s'));
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                ?>
                                <div class="mass-media-carousel__slide swiper-slide"
                                     id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                    <!-- begin .news-item-->
                                    <div class="news-item news-item_role_media news-item_type_panel">
                                        <div class="news-item__content">
                                            <div class="news-item__header">
                                                <?if(!empty($arItem["PREVIEW_PICTURE"]["SRC"])):?>
                                                    <div class="news-item__illustration">
                                                        <?if(!empty($arItem["PREVIEW_PICTURE"])):?>
                                                            <picture class="case-item__picture">
                                                                <?$renderImage = CFile::ResizeImageGet(
                                                                    $arItem["PREVIEW_PICTURE"],
                                                                    Array("width" => 720, "height" => 400),
                                                                    BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
                                                                );?>
                                                                <img
                                                                    src="<?=$renderImage["src"] ?>"
                                                                    alt="<?= $arItem["NAME"] ?>"
                                                                    class="news-item__image"
                                                                    loading="lazy"
                                                                />
                                                            </picture>
                                                        <?endif;?>
                                                    </div>
                                                <?endif;?>
                                                <div class="news-item__date">
                                                    <?= $obNewsDate->format('d.m.Y') ?>
                                                </div>
                                            </div>
                                            <div class="news-item__main">
                                                <div class="news-item__title">
                                                    <?= $arItem["NAME"] ?>
                                                </div>
                                                <div class="news-item__description">
                                                    <?= htmlspecialchars_decode($arItem["PREVIEW_TEXT"]) ?>
                                                </div>
                                                <?if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])):?>
                                                    <div class="news-item__controls">
                                                        <div class="news-item__control">
                                                            <!-- begin .button-->
                                                            <?
                                                                $isExternalLink = preg_match('/(http|www)/', $arItem['PROPERTIES']['LINK']['VALUE']);
                                                            ?>
                                                            <a
                                                                    class="button button_style_borderless button_width_fit"
                                                                    <?=($isExternalLink ? 'target="_blank"' : '');?>
                                                                    href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>"
                                                            >
                                                                <span class="button__holder">
                                                                <span class="button__text">Подробнее</span>
                                                                <svg class="button__icon" width="16" height="16"
                                                                    viewBox="0 0 16 16" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M14.3536 8.35355C14.5488 8.15829 14.5488 7.84171 14.3536 7.64645L11.1716 4.46447C10.9763 4.2692 10.6597 4.2692 10.4645 4.46447C10.2692 4.65973 10.2692 4.97631 10.4645 5.17157L13.2929 8L10.4645 10.8284C10.2692 11.0237 10.2692 11.3403 10.4645 11.5355C10.6597 11.7308 10.9763 11.7308 11.1716 11.5355L14.3536 8.35355ZM2 8.5L14 8.5L14 7.5L2 7.5L2 8.5Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                                </span>
                                                            </a>
                                                            <!-- end .button-->
                                                        </div>
                                                    </div>
                                                <?endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end .news-item-->
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                    <div class="mass-media-carousel__navigation">
                        <div class="mass-media-carousel__pagination">
                            <!-- begin .bullet-pagination-->
                            <div class="bullet-pagination bullet-pagination_role_media">
                            </div>
                            <!-- end .bullet-pagination-->
                        </div>
                    </div>
                </div>
                <!-- end .mass-media-carousel-->
            </div>
        </div>
    </div>
<? endif; ?>