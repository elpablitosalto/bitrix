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
<? if (!empty($arResult["ITEMS"])) { ?>
    <? foreach ($arResult["ITEMS"] as $arItem) { ?>
        <?
        $this->SetViewTarget('TOP_BIG_IMG');
        ?>
        <div class="page__section page__section_type_intro">
            <!-- begin .section-->
            <div class="section section_spacing_top-none section_spacing_bottom-none">
                <div class="section__main">
                    <!-- begin .banner-->
                    <div class="banner banner_indent_s">
                        <div class="banner__container">
                            <picture class="banner__picture">
                                <img src="<?= $arItem['IMG_ABOUT_TOP']['SRC']; ?>" alt="<?= $arItem['IMG_ABOUT_TOP']["ALT"] ?>" title="<?= $arItem['IMG_ABOUT_TOP']["TITLE"] ?>" class="banner__image" />
                            </picture>
                            <div class="banner__main">
                                <div class="banner__title">
                                    <!-- begin .title-->
                                    <h2 class="title title_size_h1-l title_case_upper title_align_center title_size_h1-l title_case_upper title_align_center">
                                        <?= $arItem['DISPLAY_PROPERTIES']['TEXT_ABOUT_TOP']['~VALUE']['TEXT']; ?>
                                    </h2>
                                    <!-- end .title-->
                                </div>
                                <div class="banner__content">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end .banner-->
                </div>
            </div>
            <!-- end .section-->
        </div>
        <?
        $this->EndViewTarget();
        ?>
    <? } ?>
<? } ?>
<?

$arResultCacheKeys = array();
foreach ($arResult as $key => $val) {
    $arResultCacheKeys[] = $key;
}

$this->__component->SetResultCacheKeys($arResultCacheKeys);
?>