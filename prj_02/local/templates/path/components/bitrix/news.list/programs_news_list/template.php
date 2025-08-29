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
//vardump($arResult["ITEMS"]);
?>

<? if (!empty($arResult["ITEMS"])) { ?>

    <section class="wrapper rs__news">
        <div class="container">
            <div class="rs__content">
                <div class="rs__content--top">
                    <div class="rs__section--title">Новости программы</div>
                    <div class="rs__slider--control">
                        <div class="rs__slider--control-prev"></div>
                        <div class="rs__slider--control-next"></div>
                    </div>
                </div>
                <div class="swiper rs__materials--block js--news-slider">
                    <div class="swiper-wrapper">
                        <? foreach ($arResult["ITEMS"] as $item) {
                            $arItem = $item;
                            //echo "SHOW_TYPE = ".$arItem["SHOW_TYPE"]."<br />";
                            ?>
                            <?
                            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div id="<?= $this->GetEditAreaId($item['ID']); ?>" class="swiper-slide">
                                <div class="rs__materials--item">
                                    <picture class="rs__materials--pic">
                                        <img class="rs__materials--img" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>"/>
                                    </picture>
                                    <div class="rs__materials--info">
                                        <div class="rs__materials--chapter"><? echo FormatDate("j F Y", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"])); ?></div>
                                        <div class="rs__materials--title">
                                            <a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>">
                                            <?= $arItem["NAME"]; ?>
                                            </a>
                                        </div>
                                        <a  class="rs__link rs__materials--link" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?></a>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="is-hidden-tablet swiper-pagination"></div>
                </div>
                <div class="rs__button__group rs__section--nav">
                    <a class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right"
                       href="/news/">Больше новостей</a>
                </div>
            </div>
        </div>
    </section>


<? } ?>