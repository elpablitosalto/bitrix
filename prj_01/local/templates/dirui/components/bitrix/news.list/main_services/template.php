<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>

    <section class="distributors">
        <h2>Сервисные центры <br>по <span>всей России</span>
        </h2>
        <div class="distributors__map-wrapper">
            <div class="distributors__raw-map"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/home/map.svg" alt="Map Russia"></div>
            <div class="distributors__map-balloons">
                <? foreach ($arResult["ITEMS"] as $item) { ?>
                    <?
                    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div id="<?= $this->GetEditAreaId($item['ID']); ?>" class="distributors__map-balloon" style="left: <?= $item["PROPERTIES"]["LEFT"]["VALUE"] ?>%; top: <?= $item["PROPERTIES"]["TOP"]["VALUE"] ?>%">
                        <div class="distributors__map-balloon-img"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/home/balloon.svg" alt="Map Russia"></div>
                        <div class="map-info">
                            <div class="map-info__close"></div>
                            <h4 class="map-info__title"><?= $item["NAME"] ?></h4>
                            <div class="map-info__list">
                                <? if (!empty($item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"])) { ?>
                                    <div class="map-info__item">Телефон</div><a class="map-info__item map-info__item-big" href="tel:<?= $item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"] ?>"><?= $item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"] ?></a>
                                <? } ?>
                                <? if (!empty($item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"])) { ?>
                                    <div class="map-info__item">E-mail</div><a class="map-info__item map-info__item-big" href="mailto:<?= $item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"] ?>"><?= $item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"] ?></a>
                                <? } ?>
                                <? if (!empty($item["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"])) { ?>
                                    <div class="map-info__item">Время работы</div>
                                    <div class="map-info__item"><?= $item["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"] ?></div>
                                <? } ?>
                                <? if (!empty($item["PREVIEW_TEXT"])) { ?>
                                    <div class="map-info__item">Адрес</div>
                                    <div class="map-info__item"><?= $item["PREVIEW_TEXT"] ?></div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
        <? $item = $arResult["ITEMS"][0]; ?>
        <div class="distributors__map-mob-modal">
            <div class="map-info">
                <div class="map-info__close"></div>
                <h4 class="map-info__title"><?= $item["NAME"] ?></h4>
                <div class="map-info__list">
                    <div class="map-info__item">Телефон</div><a class="map-info__item map-info__item-big" href="tel:<?= $item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"] ?>"><?= $item["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"] ?></a>
                    <div class="map-info__item">E-mail</div><a class="map-info__item map-info__item-big" href="mailto:<?= $item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"] ?>"><?= $item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"] ?></a>
                    <div class="map-info__item">Время работы</div>
                    <div class="map-info__item"><?= $item["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"] ?></div>
                    <div class="map-info__item">Адрес</div>
                    <div class="map-info__item"><?= $item["PREVIEW_TEXT"] ?></div>
                </div>
            </div>
        </div>
    </section>

<? } ?>