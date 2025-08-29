<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>
    <section class="service__command">
        <div class="service__command-wrapper">
            <h3>Наша команда — сертифицированные специалисты</h3>
            <div class="service__navigation">
                <div class="slider-navigation slider-navigation-prev"></div>
                <div class="slider-navigation slider-navigation-next"></div>
            </div>
        </div>
        <div class="service__swiper">
            <div class="service__wrappers">
                <? foreach ($arResult["ITEMS"] as $item) { ?>
                    <?
                    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="service__slide" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                        <div class="service__slide-image">
                            <img src="<?= $item['PICTURE']['SRC']; ?>" alt="<?= $item['PICTURE']['ALT']; ?>" title="<?= $item['PICTURE']['TITLE']; ?>" />
                        </div>
                        <p><?= $item["NAME"] ?></p>
                        <? if (isset($item["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"]) && $item["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"]) { ?>
                            <p><?= $item["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"] ?></p>
                        <? } ?>
                        <? if (!empty($item["DISPLAY_PROPERTIES"]["EXPERIENCE"]["DISPLAY_VALUE"])) { ?>
                            <p>Опыт - <?= Indexis::num2word($item['DISPLAY_PROPERTIES']['EXPERIENCE']['VALUE'], ['год', 'года', 'лет']); ?></p>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </div>
    </section>
<? } ?>