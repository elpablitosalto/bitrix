<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>

    
    <? foreach ($arResult["ITEMS"] as $item) {
        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        if (!isset($item["BANNER"]))
            continue;
        switch ($item["PROPERTIES"]["TYPE"]["VALUE_XML_ID"]) {
            case "VIDEO":
                ?>
                <div class="header-top-banner__content" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                    <div class="header-top-banner__video">
                        <div class="header-top-banner__play"><img src="<?=SITE_TEMPLATE_PATH ?>/img/icons/play.png">
                        </div>
                        <div class="header-top-banner__pause"><img src="<?=SITE_TEMPLATE_PATH ?>/img/icons/pause.svg">
                        </div>
<!--                        <video preload="none" poster="--><?php //= $item["PREVIEW_PICTURE"]["SRC"] ?><!--">-->
                        <video preload="metadata">
                            <source src="<?= $item["BANNER"] ?>" type="video/mp4">
                        </video>
                    </div>
                </div>
                <?php
                break;
            default:
                ?>
                <div class="top-banner__image">
                    <img src="<?= $item["BANNER"] ?>" alt="<?= $item["NAME"] ?>">
                </div>
                <?php
                break;
        }
        ?>
    <? } ?>


<? } ?>