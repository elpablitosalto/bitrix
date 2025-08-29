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

    <section class="wrapper rs__materials">
        <div class="container">
            <div class="rs__content">
                <div class="rs__content--top">
                    <div class="rs__section--title">Материалы программы</div>
                    <div class="rs__slider--control">
                        <div class="rs__slider--control-prev"></div>
                        <div class="rs__slider--control-next"></div>
                    </div>
                </div>
                <div class="js--materials-col--slider rs__materials--box rs__materials--box-slider">
                    <div class="rs__materials--block rs__materials--block-slider">
                        <? foreach ($arResult["ITEMS"] as $item) {
                            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <? if ($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]) { ?>
                                <div class="rs__materials--item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                                    <picture class="rs__materials--pic">
                                        <img src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
                                             alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>"
                                             title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>"
                                             class="rs__materials--img">
                                    </picture>
                                    <div class="rs__materials--info">
                                        <div class="rs__materials--chapter"><?= $item["DISPLAY_ACTIVE_FROM"] ?></div>
                                        <div class="rs__materials--title"><a href="<?=$item["DETAIL_PAGE_URL"]?>"><?= $item["NAME"] ?></a>
                                        </div>
                                        <? if (mb_strlen($item["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["DISPLAY_VALUE"])) { ?>
                                            <a class="rs__link rs__materials--link" href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["DISPLAY_VALUE"]?></a>
                                        <? } ?>
                                    </div>
                                </div>
                            <? } else { ?>
                                <div class="rs__materials--item no-pic" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                                    <div class="rs__materials--info">
                                        <div class="rs__materials--chapter"><?= $item["DISPLAY_ACTIVE_FROM"] ?></div>
                                        <div class="rs__materials--title"><a href="<?=$item["DETAIL_PAGE_URL"]?>"><?= $item["NAME"] ?></a>
                                        </div>
                                        <? if (mb_strlen($item["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["DISPLAY_VALUE"])) { ?>
                                            <a class="rs__link rs__materials--link" href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["DISPLAY_VALUE"]?></a>
                                        <? } ?>
                                    </div>
                                    <div class="rs__materials--ico">
                                        <span class="ico-arrow-big">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </span>
                                    </div>
                                </div>
                            <? } ?>
                        <? } ?>
                    </div>
                </div>
                <div class="swiper-pagination is-hidden-desktop"></div>
                <div class="rs__button__group rs__section--nav">
                    <a class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right"
                       href="/media/">Больше материалов</a>
                </div>
            </div>
        </div>
    </section>


<? } ?>