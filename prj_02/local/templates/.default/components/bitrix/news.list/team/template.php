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
<? if (!empty($arResult["ITEMS"])) {
?>
    <section id="projects-detail-team" class="projects-detail-team">
        <div class="container">
            <div class="projects-detail-team-slider">
                <div class="section__head">
                    <h2 class="h3 section__title">Команда проекта</h2>
                    <div class="section__nav">
                        <div class="swiper-nav lg">
                            <button type="button" class="swiper-button prev">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                                    <use xlink:href="#drop-light"></use>
                                </svg>
                            </button>
                            <button type="button" class="swiper-button next">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                                    <use xlink:href="#drop-light"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="swiper-nav">
                            <button type="button" class="swiper-button prev">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop">
                                    <use xlink:href="#drop"></use>
                                </svg>
                            </button>
                            <button type="button" class="swiper-button next">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop">
                                    <use xlink:href="#drop"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="swiper-container items-list">
                    <div class="swiper-wrapper">

                        <?
                        foreach ($arResult["ITEMS"] as $key => $item) {
                            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            $position = "";
                            if (is_array($item["DISPLAY_PROPERTIES"]["PROJECT_POSITION"]["DISPLAY_VALUE"])) {
                                foreach ($item["DISPLAY_PROPERTIES"]["PROJECT_LINK"]["VALUE"] as $num => $projectID) {
                                    if ($projectID == $arParams["CURRENT_PROJECT"]) {
                                        $position = $item["DISPLAY_PROPERTIES"]["PROJECT_POSITION"]["DISPLAY_VALUE"][$num];
                                    }
                                }
                            } else $position = $item["DISPLAY_PROPERTIES"]["PROJECT_POSITION"]["DISPLAY_VALUE"];

                            if (strlen($position) <= 0) {
                                $position = $item["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"];
                            }
                        ?>

                            <div class="swiper-slide" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                                <div class="list-item person-item">
                                    <? if (!empty($item["PREVIEW_PICTURE"])) { ?>
                                        <div class="person-item__photo">
                                            <picture>
                                                <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>" loading="lazy" alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>" />
                                            </picture>
                                        </div>
                                    <? } ?>
                                    <div class="text-size-lg person-item__name"><?= $item["NAME"] ?></div>
                                    <? if (mb_strlen($position)) { ?>
                                        <div class="person-item__info"><?= $position ?></div>
                                    <? } ?>
                                    <? if (mb_strlen($item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"])) { ?>
                                        <div class="text-size-lg person-item__phone">
                                            <a href="tel:<?= $item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"] ?>">
                                                <u><?= $item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"] ?></u>
                                            </a>
                                        </div>
                                    <? } ?>
                                    <?/*<div class="person-item__link"><a href="<?=$item["DETAIL_PAGE_URL"];?>">
                                            <u>Подробнее</u></a></div>*/ ?>
                                    <? if (
                                        !(empty($item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]) 
                                        && empty($item["PREVIEW_TEXT"]))
                                        ) { ?>
                                        <a data-modal="#modal-team-<?= $item["ID"] ?>" class="employee-card__link">Подробнее</a>
                                        <div id="modal-team-<?= $item["ID"] ?>" class="modal modal-team">
                                            <button type="button" data-fancybox-close="data-fancybox-close" class="modal-close">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close">
                                                    <use xlink:href="#close"></use>
                                                </svg>
                                            </button>
                                            <div class="modal-team__wrapper">
                                                <!--.modal-team__decor-->
                                                <div class="modal-team__image">
                                                    <div class="modal-team__img-wrapper">
                                                        <picture class="modal-team__main-image">
                                                            <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $item["PREVIEW_PICTURE"]["SRC"] ?>" loading="lazy" alt="<?= $item["NAME"] ?>" title="<?= $item["NAME"] ?>" />
                                                        </picture>
                                                    </div>
                                                </div>
                                                <div class="modal-team__rside">
                                                    <div class="modal-team__title"><?= $item["NAME"] ?></div>
                                                    <? if (!empty($position)) { ?>
                                                        <div class="modal-team__job"><?= $position ?></div>
                                                    <? } ?>
                                                    <? if (!empty($item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"])) { ?>
                                                        <div class="modal-team__phone">Телефон:&nbsp;<a><?= $item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"] ?></a></div>
                                                    <? } ?>
                                                    <? if (!empty($item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"])) { ?>
                                                        <div class="modal-team__email">E-mail:&nbsp;<a><?= $item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"] ?></a></div>
                                                    <? } ?>
                                                    <? if (!empty($item["PREVIEW_TEXT"])) { ?>
                                                        <div class="modal-team__info"><?= $item["PREVIEW_TEXT"] ?></div>
                                                    <? } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <? } ?>
                                </div>
                            </div>

                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


<? } ?>