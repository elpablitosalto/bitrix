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

    <div class="rs__projects--block">
        <?
        foreach ($arResult["ITEMS"] as $key => $item) {
        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="rs__projects--item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
            <div class="rs__projects--box">
                <div class="rs__projects--content">
                    <?if($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] && ($key & 1)){?>
                    <picture class="rs__projects--pic">
                        <img src="<?=$item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]?>" alt="<?=$item["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$item["PREVIEW_PICTURE"]["TITLE"]?>" class="rs__projects--img">
                    </picture>
                    <?}?>
                    <div class="rs__projects--info">
                        <div class="rs__projects--title"><a href="<?= $item["DETAIL_PAGE_URL"] ?>"><?= $item["NAME"] ?></a></div>
                        <div class="rs__projects--text"><?= $item["PREVIEW_TEXT"] ?></div>
                        <?if(isset($item["DISPLAY_PROPERTIES"]["BENEFICIARY_TYPE"]["DISPLAY_VALUE"] ) && !empty($item["DISPLAY_PROPERTIES"]["BENEFICIARY_TYPE"]["DISPLAY_VALUE"] )){?>
                        <div class="rs__label">
                            <div class="rs__label--box">
                                <? foreach ($item["DISPLAY_PROPERTIES"]["BENEFICIARY_TYPE"]["DISPLAY_VALUE"] as $val) { ?>
                                    <div class="rs__label--item"><?= $val ?></div>
                                <? } ?>
                            </div>
                        </div>
                        <?}?>
                    </div>
                    <?if($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] && !($key & 1)){?>
                        <picture class="rs__projects--pic">
                            <img src="<?=$item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]?>" alt="<?=$item["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$item["PREVIEW_PICTURE"]["TITLE"]?>" class="rs__projects--img">
                        </picture>
                    <?}?>
                </div>
            </div>
        </div>
        <?}?>
    </div>

    <?//= $arResult['NAV_STRING'] ?>

<? } ?>
