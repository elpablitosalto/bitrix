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
<section class="banner-slider-block">
    <div class="swiper myBannerSwiperSlider">
        <div class="swiper-wrapper">
            <? foreach ($arResult["ITEMS"] as $arItem) : ?>
                <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) : ?>
                    <?
                    /*
                    BitrixTools::picSrcset(array(
                        "picMobile" => array(
                            "src" => $arItem['PICTURE']['MOBILE']['SRC'],
                        ),
                        "picTablet" => array(
                            "src" => $arItem['PICTURE']['TABLET']['SRC'],
                        ),
                        "picDesktop" => array(
                            "src" => $arItem['PICTURE']['DESKTOP']['SRC'],
                        ),
                        "alt" => $arItem['NAME'],
                        "title" => $arItem['NAME'],
                        "class" => "swiper-slide",
                        "src" => $arItem['PICTURE']['DESKTOP']['SRC'],
                        "width" => $arItem['PICTURE']['DESKTOP']['WIDTH'],
                        "height" => $arItem['PICTURE']['DESKTOP']['HEIGHT'],
                        "id" => $this->GetEditAreaId($arItem['ID']),
                    ));
                    /**/
                    ?>
                    <?/**/ ?>
                    <img class="swiper-slide swiper-lazy js_lazy_" id="<?= $this->GetEditAreaId($arItem['ID']); ?>" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>">
                    <?/**/ ?>
                <?php endif ?>
            <? endforeach; ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
<?/*?>
<script>
    var swiper = new Swiper(".myBannerSwiperSlider", {
        lazy: true,
        speed: 700,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
<?*/ ?>
<?/*?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            var swiper = new Swiper(".myBannerSwiperSlider", {
                speed: 700,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        }, 1000);
    })
</script>
<?*/ ?>
<?/*?>
<!--<section class="banner">-->
<!--    <div class="banner__picture">-->
<!--        <img src="--><? //=MOCKUP
                            ?><!--/images/banner/banner-1.jpg" />-->
<!--    </div>-->
<!--</section>-->
<?*/ ?>