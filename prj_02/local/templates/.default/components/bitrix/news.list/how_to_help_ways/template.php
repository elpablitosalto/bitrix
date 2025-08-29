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

    <section class="other-help">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="other-help__title">Другие способы помочь</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="other-help__list">
                        <? foreach ($arResult["ITEMS"] as $num => $item) { ?>
                            <?
                            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <a data-img="other-help--<?= $num ?>" id="<?=$this->GetEditAreaId($item['ID']);?>"
                               href="<?= $item["DISPLAY_PROPERTIES"]["LINK"]["VALUE"] ?>"
                               class="other-help__item<? if ($num == 0) { ?> other-help--active<? } ?>"><?= $item["NAME"] ?>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     class="icon icon-arrow-stroke">
                                    <use xlink:href="#arrow-stroke"></use>
                                </svg>
                            </a>
                        <? } ?>
                    </div>
                </div>
                <div class="col-sm-5 other-help__box">
                    <div class="other-help__wrapper">
                        <picture class="other-help__tick-fly"><img class="lazyload"
                                                                   src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg"
                                                                   data-src="<?= SITE_TEMPLATE_PATH ?>/images/tick-fly.svg"
                                                                   loading="lazy"
                                                                   alt="" title=""/>
                        </picture>
                        <picture class="other-help__tick-fly"><img class="lazyload"
                                                                   src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg"
                                                                   data-src="<?= SITE_TEMPLATE_PATH ?>/images/tick-fly.svg"
                                                                   loading="lazy"
                                                                   alt="" title=""/>
                        </picture>
                        <div class="other-help__image">
                            <? foreach ($arResult["ITEMS"] as $num => $item) {
                                if ($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]) {
                                    ?>
                                    <img src="<?=$item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]?>"
                                         data-img="other-help--<?= $num ?>"<? if ($num == 0) { ?> class="active"<? } ?>>
                                <? }
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<? } ?>