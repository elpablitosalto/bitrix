<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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
							<a class="dp-courses-item__img-link" href="<?= $arItem['PROPERTIES']['BUY_LINK']['VALUE'] ?>">
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
                        <div class="dp-courses-item__tags"><span class="dp-courses-item__tag dp-courses-item__category">мастер-класс</span></div>
						<a class="dp-courses-item__title-link" href="<?= $arItem['PROPERTIES']['BUY_LINK']['VALUE'] ?>">
							<h3 class="dp-courses-item__title"><?= $arItem["NAME"] ?></h3>
						</a>
                        <div class="dp-courses-item__meta">
                            <?if($arItem["DISPLAY_PROPERTIES"]["COUNT_MODULES"]["DISPLAY_VALUE"]){?>
                                <span class="dp-courses-item__modules"><?=$arItem["DISPLAY_PROPERTIES"]["COUNT_MODULES"]["VALUE"]?> <?=$declension->get($arItem["DISPLAY_PROPERTIES"]["COUNT_MODULES"]["DISPLAY_VALUE"])?></span>
                            <?}?>
                            <span class="dp-courses-item__date"><?=$arItem["DISPLAY_PROPERTIES"]["DATE_START"]["VALUE"]?> — <?=$arItem["DISPLAY_PROPERTIES"]["DATE_END"]["VALUE"]?></span>
                        </div>
                        <div class="dp-courses-item__desc">
                            <p>
                                <?=$arItem["PREVIEW_TEXT"]?>
                            </p>
                        </div>
						<div class="dp-courses-item__actions">
							<a class="dp-btn dp-btn_m dp-courses-item__btn-detail" href="<?= $arItem['PROPERTIES']['BUY_LINK']['VALUE'] ?>">Подробнее</a>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<? endforeach; ?>


