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
                <div class="rs__content--top rs__content--top-half">
                    <div class="rs__section--title">Материалы для родителей</div>
                    <div class="rs__content--top-text">
                        <p>Дорогие родители, здесь мы собрали для вас материалы, подготовленные специалистами фонда.
                            В медиатеке вы можете найти записи вебинаров, семинаров, лекций, тренингов и других
                            материалов.</p>
                        <p>Мы хотим дать вам как можно больше возможностей для воспитания ребенка и построения или
                            восстановления гармоничных отношений с ним.</p>
                    </div>
                </div>
                <div class="rs__label--container">
                    <div class="rs__label--liner">
                        <div class="rs__label--box">
                            <?foreach($arResult["ENUMS"] as $ENUM){?>
                            <a class="rs__label--item" href="">#<?=$ENUM["VALUE"]?></a>
                            <?}?>
                        </div>
                    </div>
                </div>
                <div class="rs__content--top">
                    <div class="rs__slider--control">
                        <div class="rs__slider--control-prev"></div>
                        <div class="rs__slider--control-next"></div>
                    </div>
                </div>
                <div class="swiper js--materials-slider rs__materials--block">
                    <div class="swiper-wrapper">
                        <? foreach ($arResult["ITEMS"] as $item) { ?>
                            <?
                            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="swiper-slide" id="<?= $this->GetEditAreaId($item['ID']); ?>">
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
                            </div>
                        <? } ?>
                    </div>
                    <div class="is-hidden-tablet swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>

<? } ?>