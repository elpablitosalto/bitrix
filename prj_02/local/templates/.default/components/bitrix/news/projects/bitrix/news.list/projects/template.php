<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;

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
?>
<? if (!empty($arResult["ITEMS"])) {
    ?>


    <?if($arParams["AJAX_LOAD"] != "Y"){?>
    <div class="projects-list items-list nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
    <?}?>
        <?
        foreach ($arResult["ITEMS"] as $key => $item) {
            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="list-item projects-item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                <div class="h4 projects-item__title">
                    <a target="_self" href="<?= $item["DETAIL_PAGE_URL"] ?>"><?= $item["NAME"] ?></a>
                </div>
                <div class="projects-item__content">
                    <? if ($item["PREVIEW_TEXT"]) { ?>
                        <div class="text-size-lg projects-item__text"><?= $item["PREVIEW_TEXT"] ?>
                        </div>
                    <? } ?>
                    <? if (!empty($item["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]) || !empty($item["DISPLAY_PROPERTIES"]["BENEFICIARY_TYPE"]["DISPLAY_VALUE"])) { ?>
                        <div class="projects-item__tags">
                            <div class="buttons-line">
                                <? foreach ($item["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"] as $val) { ?>
                                    <span class="btn btn-transparent tag"><?= $val ?></span>
                                <? } ?>
                                <? foreach ($item["DISPLAY_PROPERTIES"]["BENEFICIARY_TYPE"]["DISPLAY_VALUE"] as $val) { ?>
                                    <span class="btn btn-transparent tag"><?= $val ?></span>
                                <? } ?>
                            </div>
                        </div>
                    <? } ?>

                    <?if(!empty($item["PROPERTIES"]["PARTNERS"]["VALUE"])){?>
                    <div class="projects-item__logos">
                        <div class="buttons-line">
                            <?foreach($item["PROPERTIES"]["PARTNERS"]["VALUE"] as $val){
                                if(!isset($arResult["PARTNERS"][$val]))
                                    continue;
                                $arPartner = $arResult["PARTNERS"][$val];
                                ?>
                            <picture>
                                <img src="<?=$arPartner["PREVIEW_PICTURE_RESIZED"]?>"" alt="<?=$arPartner["NAME"]?>" title="<?=$arPartner["NAME"]?>">
                            </picture>
                            <?}?>
                        </div>
                    </div>
                    <?}?>

                </div>
                <? if ($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]) { ?>
                    <a target="_self" href="<?= $item["DETAIL_PAGE_URL"] ?>" class="projects-item__image">
                        <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg"
                                      data-src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
                                      loading="lazy" alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>"
                                      title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>"/>
                        </picture>
                    </a>
                <? } ?>
            </div>
        <? } ?>
    <?if($arParams["AJAX_LOAD"] != "Y"){?>
    </div>
    <?}?>

    <?= $arResult['NAV_STRING'] ?>


<? } ?>
