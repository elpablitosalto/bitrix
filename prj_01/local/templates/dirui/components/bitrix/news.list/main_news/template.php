<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>
    <div class="top-banner__slider-navigation">
        <div class="slider-navigation slider-navigation-prev"></div>
        <div class="slider-navigation slider-navigation-next"></div>
    </div>
    <div class="top-banner__slider">
        <div class="top-banner__slider-list">
            <? foreach ($arResult["ITEMS"] as $item) { ?>
                <?
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="top-banner__slider-item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                    <div class="top-banner__slider-image">
                        <? if ($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]) { ?>
                            <img src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
                                 alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>"
                                 title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>"/>
                        <? } ?>
                    </div>
                    <div class="top-banner__slider-wrapper">
                        <h3><?= $item["NAME"] ?></h3>
                        <p><?= $item["PREVIEW_TEXT"] ?></p>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
<? } ?>