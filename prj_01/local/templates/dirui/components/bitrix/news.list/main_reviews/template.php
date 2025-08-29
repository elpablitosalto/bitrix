<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>

    <section class="partners">
        <div class="partners__wrapper">
            <h2>Что о нас говорят партнеры</h2>
            <div class="top-banner__slider-navigation">
                <div class="slider-navigation slider-navigation-prev"></div>
                <div class="slider-navigation slider-navigation-next"></div>
            </div>
        </div>
        <div class="partners__slider">
            <div class="partners__wrapper">
                <? foreach ($arResult["ITEMS"] as $num => $item) {
                ?>
                    <?
                    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="partners__slide" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                        <p><?= $item["PREVIEW_TEXT"] ?></p>
                        <div class="partners__name">
                            <? if (isset($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"])) { ?>
                                <div class="partners__name-image"><img src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>" alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>">
                                </div>
                            <? } ?>
                            <div class="partners__name-staff"><?= $item["NAME"] ?>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
        <? if ($arParams['SHOW_FIND_OUT_ABOUT'] != 'N') { ?>
            <a class="link-button_rose link-button_rose-array" href="/partnership/">Узнайте о преимуществах партнерства</a>
        <? } ?>
    </section>

<? } ?>