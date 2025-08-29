<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<? if (!empty($arResult["ITEMS"])) { ?>
    <div class="page__banner">
        <div class="page__container">
            <? foreach ($arResult["ITEMS"] as $arItem) { ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <!-- begin .banner-->
                <div class="banner" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <a href="<?= $arItem["DISPLAY_PROPERTIES"]['LINK']['VALUE'] ?>">
                        <picture class="banner__picture">
                            <source srcset="<?= $arItem['PREVIEW_PICTURE_SLIDER']['SRC']; ?>" type="image/png" media="(max-width: 1024px)" class="banner__source" />
                            <img src="<?= $arItem['DETAIL_PICTURE_SLIDER']['SRC']; ?>" alt="<?= $arItem['DETAIL_PICTURE_SLIDER']["ALT"] ?>" title="<?= $arItem['DETAIL_PICTURE_SLIDER']["TITLE"] ?>" class="banner__image" />
                        </picture>
                    </a>
                </div>
                <!-- end .banner-->
            <? } ?>
        </div>
    </div>

<? } ?>