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

    <section class="wrapper rs__lecturer">
        <div class="container">
            <div class="rs__content">
                <div class="rs__content--top">
                    <div class="rs__section--title">Лекторы</div>
                    <div class="rs__slider--control">
                        <div class="rs__slider--control-prev"></div>
                        <div class="rs__slider--control-next"></div>
                    </div>
                </div>
                <div class="swiper js--lecturer-slider">
                    <div class="swiper-wrapper rs__lecturer--block">
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
                                <div class="rs__lecturer--item">
                                    <div class="rs__lecturer--pic">
                                        <picture>
                                            <img src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
                                                 alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>"
                                                 title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>"
                                                 class="rs__lecturer--img">
                                        </picture>
                                    </div>
                                    <div class="rs__lecturer--info">
                                        <div class="rs__lecturer--name"><?= $item["NAME"] ?></div>
                                        <? if (mb_strlen($position)) { ?>
                                            <div class="rs__lecturer--status"><?= $position ?></div>
                                        <? } ?>
                                        <? if (mb_strlen($item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"])) { ?>
                                            <div class="rs__lecturer--phone">
                                                <a class="rs__link" href="tel:<?= $item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"] ?>"><?= $item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"] ?></a>
                                            </div>
                                        <? } ?>
                                        <? if (!empty($item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"])) { ?>
                                            <div class="rs__lecturer--mail">
                                                <a class="rs__link" href="mailto:<?= $item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"] ?>"><?= $item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"] ?></a>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="is-hidden-tablet swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>

<? } ?>