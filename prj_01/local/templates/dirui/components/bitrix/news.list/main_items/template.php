<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>

    <section class="performance">
        <h2>Повышайте производительность лаборатории с ведущим оборудованием</h2>
        <ul class="performance__list">
            <? foreach ($arResult["ITEMS"] as $num => $item) {
                ?>
                <?
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <? if ($num == 0) { ?>
                    <li id="<?= $this->GetEditAreaId($item['ID']); ?>" class="performance__item performance__big-block">
                        <? if (isset($arResult["REVIEWS"][$item["PROPERTIES"]["REVIEW"]["VALUE"]])) {
                            $arReview = $arResult["REVIEWS"][$item["PROPERTIES"]["REVIEW"]["VALUE"]];
                            ?>
                            <div class="performance__review">
                                <p><?= $arReview["PREVIEW_TEXT"] ?></p>
                                <div class="performance__staff">
                                    <? if (isset($arReview["PREVIEW_PICTURE_LINK"])) { ?>
                                        <div class="performance__staff-image"><img
                                                    src="<?= $arReview["PREVIEW_PICTURE_LINK"] ?>"
                                                    alt="<?= $arReview["NAME"] ?>">
                                        </div>
                                    <? } ?>
                                    <div class="performance__staff-post"><?= $arReview["NAME"] ?>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                        <a target="_blank" class="performance__block" <?if($item["DISPLAY_PROPERTIES"]["LINK"]["DISPLAY_VALUE"]){?>href="<?=$item["DISPLAY_PROPERTIES"]["LINK"]["DISPLAY_VALUE"]?>"<?} else {?>href="<?=$item["DETAIL_PAGE_URL"]?>"<?}?>>
                            <? if (isset($item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"])) { ?>
                                <div class="performance__tabs">
                                    <? if (is_array($item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"])) {
                                        foreach ($item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"] as $val) {
                                            ?>
                                            <div class="performance__tab"><?= $val ?></div>
                                            <?
                                        }
                                    } else { ?>
                                        <div class="performance__tab"><?= $item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"] ?></div>
                                    <? } ?>
                                </div>
                            <? } ?>
                            <h3><?= $item["NAME"] ?></h3>
                            <p class="performance__title"><?= $item["DISPLAY_PROPERTIES"]["CATEGORY"]["DISPLAY_VALUE"] ?></p>
                            <? if (isset($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"])) { ?>
                                <div class="performance__image"><img
                                            src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
                                            alt="<?= $item["NAME"] ?>"></div>
                            <? } ?>
                        </a>
                    </li>
                <? } else { ?>
                    <li id="<?= $this->GetEditAreaId($item['ID']); ?>" class="performance__item">
                        <a target="_blank" class="performance__block" <?if($item["DISPLAY_PROPERTIES"]["LINK"]["DISPLAY_VALUE"]){?>href="<?=$item["DISPLAY_PROPERTIES"]["LINK"]["DISPLAY_VALUE"]?>"<?} else {?>href="<?=$item["DETAIL_PAGE_URL"]?>"<?}?>>
                            <? if (isset($item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"])) { ?>
                                <div class="performance__tabs">
                                    <? if (is_array($item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"])) {
                                        foreach ($item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"] as $val) {
                                            ?>
                                            <div class="performance__tab"><?= $val ?></div>
                                            <?
                                        }
                                    } else { ?>
                                        <div class="performance__tab"><?= $item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"] ?></div>
                                    <? } ?>
                                </div>
                            <? } ?>
                            <h3><?= $item["NAME"] ?></h3>
                            <p class="performance__title"><?= $item["DISPLAY_PROPERTIES"]["CATEGORY"]["DISPLAY_VALUE"] ?></p>
                            <? if (isset($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"])) { ?>
                                <div class="performance__image"
                                     style="background-image: url('<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>')">
                                </div>
                            <? } ?>
                        </a></li>
                <? } ?>
            <? } ?>
        </ul>
        <a class="link-button_rose link-button_rose-array" href="/catalog/">Вся продукция</a>
    </section>
<? } ?>