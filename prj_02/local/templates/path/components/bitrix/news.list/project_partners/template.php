<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;

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

    <section class="wrapper rs__partner">
        <div class="container">
            <div class="rs__content">
                <div class="rs__content--top">
                    <div class="rs__section--title">Партнеры</div>
                    <div class="rs__slider--control">
                        <div class="rs__slider--control-prev"></div>
                        <div class="rs__slider--control-next"></div>
                    </div>
                </div>
                <div class="swiper js--slider-partner rs__partner--slider">
                    <div class="swiper-wrapper rs__partner--block">
                        <? foreach ($arResult["ITEMS"] as $item) { ?>
                            <?
                            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="swiper-slide rs__partner--item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                                <div class="rs__partner--pic">
                                    <picture>
                                        <img src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>" class="rs__partner--img"  alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>"
                                             title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>"/>
                                    </picture>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="is-hidden-desktop swiper-scrollbar"></div>
                </div>
            </div>
        </div>
    </section>
<? } ?>