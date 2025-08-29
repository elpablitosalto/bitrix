<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>

    <? foreach ($arResult["ITEMS"] as $item) { ?>
        <?
        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div id="<?= $this->GetEditAreaId($item['ID']); ?>">
            <div class="header-top-banner__head">
                <h2 class="header-top-banner__title"><?= $item["DISPLAY_PROPERTIES"]["HEADER"]["DISPLAY_VALUE"] ?></h2>
                <a class="link-button_rose" href="/reagents/">Каталог оборудования</a>
            </div>
            <div class="header-top-banner__content">
                <div class="header-top-banner__video">
                    <div class="header-top-banner__pause">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/pause.svg">
                    </div>
                    <div class="header-top-banner__play">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/play.png">
                    </div>
                    <video preload="metadata">
                        <source src="<?= $item["DISPLAY_PROPERTIES"]["VIDEO"]["FILE_VALUE"]['SRC']; ?>" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>

        <?/*?>
                <div class="our-team__card" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                    <? if (isset($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"])) { ?>
                        <div class="our-team__bg-img" style="background-image: url('<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>')"></div>
                    <? } ?>
                    <div class="our-team__name"><?= $item["NAME"] ?></div>
                    <? if (isset($item["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"]) && $item["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"]) { ?>
                        <div class="our-team__job"><?= $item["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"] ?></div>
                    <? } ?>
                    <? if (isset($item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]) && $item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]) { ?>
                        <a class="our-team__email" href="mailto:<?= $item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"] ?>"><?= $item["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"] ?></a>
                    <? } ?>
                </div>
                <?*/ ?>
    <? } ?>

<? } ?>