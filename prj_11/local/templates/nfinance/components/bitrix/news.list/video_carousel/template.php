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

<? if (!empty($arResult["ITEMS"])): ?>
    <div class="page__section page__section_style_secondary page__section_no_overflow">
        <div class="page__holder">
            <div class="section">
                <div class="section__header section__header_type_inline">
                    <? if(!empty($arParams["TITLE"]) || !empty($arParams["TITLE_POSTFIX"])): ?>
                        <div class="section__title">
                            <!-- begin .title-->
                            <h2 class="title title_size_sh2">
                                <? if(!empty($arParams['TITLE'])): ?>
                                    <div class="highlight"><?=$arParams["TITLE"]?></div>
                                <? endif; ?>
                                <?=$arParams["TITLE_POSTFIX"]?>
                            </h2>
                            <!-- end .title-->
                        </div>
                    <? endif; ?>
                    <div class="section__carousel-nav">
                        <!-- begin .carousel-nav-->
                        <div class="carousel-nav js-carousel-nav" data-nav-scope=".section" data-nav-target=".swiper">
                            <div class="carousel-nav__control">
                                <!-- begin .button-->
                                <button class="button button_role_navigation js-carousel-nav-prev" type="button"><span class="button__holder">
                                <svg class="button__icon" width="10" height="17" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 1L1.33333 8.66667L9 16.3333" fill="transparent" stroke="currentColor"></path>
                                </svg></span>
                                </button>
                                <!-- end .button-->
                            </div>
                            <div class="carousel-nav__control">
                                <!-- begin .button-->
                                <button class="button button_role_navigation js-carousel-nav-next" type="button"><span class="button__holder">
                                <svg class="button__icon" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    <div class="section__reviews-panel">
                        <!-- begin .reviews-carousel-->
                        <div class="reviews-carousel">
                            <div class="reviews-carousel__container swiper js-reviews-carousel">
                                <div class="reviews-carousel__wrapper swiper-wrapper">
                                    <? foreach ($arResult["ITEMS"] as $arItem): ?>
                                        <?
                                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                        ?>
                                        <div class="reviews-carousel__slide swiper-slide"
                                            id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                            <!-- begin .reviews-item-->
                                            <div class="reviews-item reviews-item_description_dynamic reviews-item_dim_none">
                                                <a class="reviews-item__container js-modal"
                                                href="<?= $arItem["PROPERTIES"]["RUTUBE_LINK"]["VALUE"] ?>"
                                                data-fancybox="video-gallery"
                                                data-type="iframe"
                                                >
                                                    <span class="reviews-item__illustration">
                                                    <picture class="reviews-item__picture">
                                                        <img
                                                            src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                                            alt="<?= $arItem["NAME"] ?>"
                                                            class="reviews-item__image"
                                                            loading="lazy"
                                                        />
                                                    </picture>
                                                    </span>
                                                    <svg class="reviews-item__icon" width="60" height="60"
                                                        viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="30" cy="30" r="30" fill="white"
                                                                fill-opacity="0.7"></circle>
                                                        <path d="M39 28.2679C40.3333 29.0377 40.3333 30.9623 39 31.7321L27 38.6603C25.6667 39.4301 24 38.4678 24 36.9282L24 23.0718C24 21.5322 25.6667 20.5699 27 21.3397L39 28.2679Z"
                                                            fill="#E31513"></path>
                                                    </svg>
                                                    <span class="reviews-item__content">
                                                        <span class="reviews-item__title"><?= htmlspecialchars_decode($arItem["PROPERTIES"]["TITLE"]["VALUE"]) ?></span>
                                                        <span class="reviews-item__sphere"><?= htmlspecialchars_decode($arItem["PREVIEW_TEXT"]) ?></span>
                                                    </span>
                                                </a>
                                            </div>
                                            <!-- end .reviews-item-->
                                        </div>
                                    <? endforeach; ?>
                                </div>
                                <div class="reviews-carousel__navigation">
                                    <div class="reviews-carousel__pagination">
                                        <!-- begin .bullet-pagination-->
                                        <div class="bullet-pagination bullet-pagination_role_reviews">
                                        </div>
                                        <!-- end .bullet-pagination-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end .reviews-carousel-->
                    </div>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>