<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<div class="partnership-page__slides-header">
    <div class="partnership-page__header">
        <h2 class="partnership-page__title">ВИДЫ СОТРУДНИЧЕСТВА</h2>
		<p>Для мастеров и салонов бренд CONCEPT предлагает несколько вариантов сотрудничества:</p>
		<p>C брендом Concept и новой линией бренда <span class="infinity-brand"><b>INFINITY</b></span>.</p>
		<p>Хотите начать работу?</p>
<p>В таком случае выбирайте подходящий пакет сотрудничества, заполните заявку, а наш менеджер свяжется с вами в течение 48 часов!</p>
    </div>
    <div class="partnership-page__arrows">
        <div class="carousel-navigation">
            <button class="carousel-navigation__arrow carousel-navigation__arrow_type_prev set-carousel__prev" type="button">Предыдущий слайд</button>
            <button class="carousel-navigation__arrow carousel-navigation__arrow_type_next set-carousel__next" type="button">Следйющий слайд</button>
        </div>
    </div>
</div>
<div class="partnership-page__slides">
    <div class="set-carousel">
        <div class="set-carousel__container swiper-container js-set-carousel">
            <div class="set-carousel__wrapper swiper-wrapper">
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <div class="set-carousel__slide swiper-slide">
                        <div class="set-carousel__content">
                            <h3><?=$arItem['NAME']?></h3>
                            <?if(!empty($arItem['PROPERTIES']['CONDITION_TEXT']['VALUE'])):?>
                                <section>
                                    <h4><strong>УСЛОВИЯ:</strong></h4>
                                    <p><?=$arItem['PROPERTIES']['CONDITION_TEXT']['VALUE']?></p>
                                </section>
                            <?endif;?>
                            <?if(!empty($arItem['DETAIL_TEXT'])):?>
                                <?=$arItem['DETAIL_TEXT']?>
                            <?endif;?>
                            <?if(!empty($arItem['PROPERTIES']['WARNING_TEXT']['VALUE'])):?>
                                <section>
                                    <h4><strong>ВНИМАНИЕ!</strong></h4>
                                    <p><?=$arItem['PROPERTIES']['WARNING_TEXT']['VALUE']?></p>
                                </section>
                            <?endif;?>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
            <div class="set-carousel__pagination bullet-pagination"></div>
        </div>
    </div>
</div>

