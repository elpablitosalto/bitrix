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

use Bitrix\Main\Grid\Declension;
$declension = new Declension('модуль', 'модуля', 'модулей');
?>

<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <div class="dp-slider__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <div class="dp-courses-item">
            <div class="row flex-lg-row-reverse">
                <div class="col-lg-6">
                    <? if (isset($arItem["PREVIEW_PICTURE"]["SRC"])) { ?>
                        <div class="dp-courses-item__img">
							<a target="_blank" class="dp-courses-item__img-link" href="<?= $arItem["URL"] ?>">
								<img loading="lazy"
										src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
										alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
										title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
								>
								<div class="swiper-lazy-preloader"></div>
							</a>
                        </div>
                    <? } ?>
                </div>
                <div class="col-lg-6">
                    <div class="dp-courses-item__caption">
                        <div class="dp-courses-item__tags"><span class="dp-courses-item__tag dp-courses-item__category"><?=($arItem["IBLOCK_ID"] == indexis::getIblockId("courses", "content"))?"курс":"мастер-класс";?></span></div>
						<a target="_blank" class="dp-courses-item__title-link" href="<?= $arItem["URL"] ?>">
							<h3 class="dp-courses-item__title"><?= $arItem["NAME"] ?></h3>
						</a>
                        <div class="dp-courses-item__meta">
                            <?if(isset($arResult["PROPS"][$arItem["ID"]]["COUNT_MODULES"]["VALUE"]) && mb_strlen($arResult["PROPS"][$arItem["ID"]]["COUNT_MODULES"]["VALUE"])){?>
                            <span class="dp-courses-item__modules"><?=$arResult["PROPS"][$arItem["ID"]]["COUNT_MODULES"]["VALUE"]?> <?=$declension->get($arResult["PROPS"][$arItem["ID"]]["COUNT_MODULES"]["VALUE"])?></span>
                            <?}?>
							<?if((isset($arResult["PROPS"][$arItem["ID"]]["DATE_START"]["VALUE"]) && mb_strlen($arResult["PROPS"][$arItem["ID"]]["DATE_START"]["VALUE"]))
								|| (isset($arResult["PROPS"][$arItem["ID"]]["DATE_END"]["VALUE"]) && mb_strlen($arResult["PROPS"][$arItem["ID"]]["DATE_END"]["VALUE"]))
							){?>
                            <span class="dp-courses-item__date">
								<?if(isset($arResult["PROPS"][$arItem["ID"]]["DATE_START"]["VALUE"]) && mb_strlen($arResult["PROPS"][$arItem["ID"]]["DATE_START"]["VALUE"])){?>
								<?=$arResult["PROPS"][$arItem["ID"]]["DATE_START"]["VALUE"] ?>
								<?}?>
								<?if((isset($arResult["PROPS"][$arItem["ID"]]["DATE_START"]["VALUE"]) && mb_strlen($arResult["PROPS"][$arItem["ID"]]["DATE_START"]["VALUE"]))
									&& (isset($arResult["PROPS"][$arItem["ID"]]["DATE_END"]["VALUE"]) && mb_strlen($arResult["PROPS"][$arItem["ID"]]["DATE_END"]["VALUE"]))
								){?>
								—
								<?}?>
								<?if(isset($arResult["PROPS"][$arItem["ID"]]["DATE_END"]["VALUE"]) && mb_strlen($arResult["PROPS"][$arItem["ID"]]["DATE_END"]["VALUE"])){?>
								<?=$arResult["PROPS"][$arItem["ID"]]["DATE_END"]["VALUE"] ?>
								<?}?>
							</span>
							<?}?>
						</div>
                        <div class="dp-courses-item__desc">
                            <p><?= $arItem["PREVIEW_TEXT"] ?></p>
                        </div>
						<div class="dp-courses-item__actions">
							<? if (!empty($arItem["EXTERNAL_URL"])) { ?>
								<a class="dp-btn dp-btn_m dp-course__btn-free-lesson" target="_blank" href="<?= $arItem["EXTERNAL_URL"]; ?>">Пройти пробный урок бесплатно</a>
							<? } ?>
							<? if (!empty($arItem["URL"])) { ?>
								<? if (!empty($arItem["EXTERNAL_URL"])) { ?>
								<a target="_blank" class="dp-btn dp-btn_m dp-course__btn-detail" href="<?= $arItem["URL"] ?>">Подробнее</a>
								<? } else { ?>
									<a target="_blank" class="dp-btn dp-btn_m dp-courses-item__btn-detail" href="<?= $arItem["URL"] ?>">Подробнее</a>
								<? } ?>
							<? } ?>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<? endforeach; ?>
