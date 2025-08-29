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

<script>
    var arGlobalSpecs = <?= $arResult['specsJs']; ?>;
</script>

<div class="dp-home-top__col-caption">
    <div class="dp-home-top__caption">
        <div class="dp-home-top__title-wrapper">
            <h1 class="dp-home-top__title"><?= $arResult["SECTION"]["DESCRIPTION"] ?></h1><span class="dp-home-top__title-sep">&nbsp;</span><span class="dp-home-top__specialization-wrapper"><span class="dp-home-top__specialization"></span></span>
        </div>
        <div class="dp-home-top-about">
            <div class="dp-home-top-about__list">
                <? foreach ($arResult["ITEMS"] as $arItem) : ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="dp-home-top-about__col">
                        <div class="dp-home-top-about-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                            <p class="dp-home-top-about-item__title"><?= $arItem["PREVIEW_TEXT"] ?>
                            </p>
                            <p class="dp-home-top-about-item__desc"><?= $arItem["DETAIL_TEXT"] ?></p>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <div class="dp-home-top__actions">

            <a <? if ($arParams["AUTH_USER"]) { ?>href="/recommendations/" <? } else { ?>href="#modal-auth" data-mb-block="1" data-modal="" <? } ?> class="dp-btn" type="button">Получить подборку</a>

            <a class="dp-btn-video" href="https://www.youtube.com/watch?v=8l1Oqvd1nbU" data-fancybox="about"><span class="dp-btn-video__icon">
                    <svg class="icon icon-play ">
                        <use xlink:href="#play"></use>
                    </svg></span><span class="dp-btn-video__label">Смотреть видео</span></a>

        </div>
    </div>
</div>
<? //continue in epilog
?>