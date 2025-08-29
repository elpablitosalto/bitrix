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
<? if (!empty($arResult["ITEMS"])): ?>
    <div class="description-panel description-panel_layout_s description-panel_indent_s">
        <div class="description-panel__container">
            <div class="description-panel__wrapper">
                <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
                <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                    <div class="description-panel__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <!-- begin .list-item-->
                        <div class="list-item list-item_type_tall-panel <?if(!($key % 2)):?>list-item_gradient_primary<?endif;?> <?if(!empty($arItem["PREVIEW_PICTURE"]["SRC"])):?>list-item_gradient_secondary<?endif;?>">

                            <?if(!empty($arItem["PREVIEW_PICTURE"]["SRC"])):?>
                                <?
                                    $renderImage = CFile::ResizeImageGet(
                                        $arItem["PREVIEW_PICTURE"],
                                        Array("width" => 720, "height" => 640),
                                        BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
                                    );
                                ?>
                                <div class="list-item__background">
                                    <picture class="list-item__picture">
                                        <img
                                            class="list-item__image"
                                            src="<?=$renderImage["src"]?>"
                                            alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"
                                        />
                                    </picture>
                                </div>
                            <?else:?>
                                <div class="list-item__wrapper">
                                    <div class="list-item__title"><?=htmlspecialchars_decode($arItem["NAME"])?></div>
                                    <div class="list-item__text">
                                        <?=htmlspecialchars_decode($arItem["PREVIEW_TEXT"])?>
                                    </div>
                                </div>
                            <?endif;?>
                        </div>
                        <!-- end .list-item-->
                    </div>
                <? endforeach; ?>
            </div>

            <?$buttonShow = !empty($arParams["BUTTON_SHOW"]) ? $arParams["BUTTON_SHOW"] : false;?>

            <?if($buttonShow && (!empty($arParams["BUTTON_LINK"]) || !empty($arParams["BUTTON_TEXT"]))):?>
                <div class="description-panel__controls">
                    <div class="description-panel__control">
                    <!-- begin .button-->
                    <a class="button js-modal" href="<?=$arParams["BUTTON_LINK"]?>">
                        <span class="button__holder">
                            <span class="button__text"><?=$arParams["BUTTON_TEXT"]?></span>
                            <?if(!empty($arParams["DOWNLOAD_ICON"])):?>
                                <svg class="button__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.99967 14.1667V2.5M16.6663 17.5H3.33301M14.1663 10L9.99884 14.1675L5.83217 10" stroke="currentColor" fill="transparent" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            <? endif; ?>
                        </span>
                    </a>
                    <!-- end .button-->
                    </div>
                </div>
            <? endif; ?>
        </div>
    </div>
<? endif; ?>