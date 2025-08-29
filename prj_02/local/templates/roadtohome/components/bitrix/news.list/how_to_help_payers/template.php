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
    <div class="section reviews">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="reviews__head">
                        <h3>Искренне благодарим за помощь</h3>
                        <div class="arrows">
                            <button class="arrow-left-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow-left">
                                    <use xlink:href="#arrow-left"></use>
                                </svg>
                            </button>
                            <button class="arrow-right-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow-right">
                                    <use xlink:href="#arrow-right"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="swiper-how-help-reviews swiper-container">
                        <div class="swiper-wrapper reviews__list">
                            <?
                            foreach ($arResult["ITEMS"] as $key => $item) {
                                $name = $item["NAME"];
                                if (strpos($name, "/") !== false) {
                                    $name = "";
                                }
                            ?>
                                <?
                                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                ?>
                                <div class="swiper-slide" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                                    <div class="reviews__item">
                                        <div class="reviews__title">
                                            <div class="reviews__amout"><?= $item["DISPLAY_PROPERTIES"]["SUM"]["DISPLAY_VALUE"] ?>
                                                ₽
                                            </div>
                                            <div class="reviews__name"><?= $name; ?></div>
                                        </div>
                                        <? if (mb_strlen($item["PREVIEW_TEXT"])) { ?>
                                            <div class="reviews__text"><?= $item["PREVIEW_TEXT"] ?>
                                            </div>
                                        <? } ?>
                                        <div class="reviews__date"><?= $item["DISPLAY_ACTIVE_FROM"] ?></div>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? } ?>