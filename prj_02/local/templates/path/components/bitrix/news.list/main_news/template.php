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
                <div class="rs__materials--block swiper js--news-slider">
                    <div class="swiper-wrapper">
                        <? foreach ($arResult["ITEMS"] as $item) { ?>
                            <?
                            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="swiper-slide" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                                <div class="rs__materials--item">
                                    <?if($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]){?>
                                        <picture class="rs__materials--pic">
                                            <img src="<?=$item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]?>" alt="<?=$item["PREVIEW_PICTURE"]["ALT"]?>"
                                                 title="<?=$item["PREVIEW_PICTURE"]["TITLE"]?>"  class="rs__materials--img">
                                        </picture>
                                    <?} else {?>
                                        <picture class="rs__materials--pic rs__materials--pic-bg">
                                            <img src="<?=SITE_TEMPLATE_PATH?>/img/svg/magnet.svg" class="rs__materials--img">
                                        </picture>
                                    <?}?>
                                    <div class="rs__materials--info">
                                        <div class="rs__materials--chapter"><?= $item["DISPLAY_ACTIVE_FROM"] ?></div>
                                        <div class="rs__materials--title"><a href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["NAME"]?></a>
                                        </div>
                                        <?if(mb_strlen($item["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["DISPLAY_VALUE"])){?>
                                        <a class="rs__link rs__materials--link" href="/news/"><?=$item["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["DISPLAY_VALUE"]?></a>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="swiper-pagination is-hidden-tablet"></div>
                </div>
                <div class="rs__button__group rs__section--nav">
                    <a class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right"
                       href="/news/">Больше новостей</a>
                </div>
            </div>
        </div>
    </section>


<? } ?>