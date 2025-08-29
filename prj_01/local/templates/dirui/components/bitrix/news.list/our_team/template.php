<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>

    <section class="our-team">
        <h2>Наша команда</h2>
        <div class="our-team__list">
            <? foreach ($arResult["ITEMS"] as $item) { ?>
                <?
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="our-team__card" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                    <? if (isset($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"])) { ?>
                        <div class="our-team__bg-img"
                             style="background-image: url('<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>')"></div>
                    <? } ?>
                    <div class="our-team__name"><?= $item["NAME"] ?></div>
                    <? if (isset($item["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"]) && $item["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"]) { ?>
                        <div class="our-team__job"><?= $item["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"] ?></div>
                    <? } ?>
                    <? if (isset($item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]) && $item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]) { ?>
                        <a class="our-team__email" href="mailto:<?=$item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]?>"><?=$item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]?></a>
                    <? } ?>
                </div>
            <? } ?>
        </div>
    </section>
<? } ?>