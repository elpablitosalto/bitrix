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
$this->setFrameMode(true);?>
<? if (!empty($arResult["ITEMS"])): ?>
    <div class="sticky-info sticky-info_size_s sticky-info_space_l">
        <div class="sticky-info__container">
            <div class="sticky-info__wrapper">
                <div class="sticky-info__title">
                    <?=html_entity_decode(htmlspecialchars_decode($arParams["TITLE"]))?>
                </div>
                <div class="sticky-info__content">
                    <ol class="sticky-info__list">
                        <? foreach ($arResult["ITEMS"] as $arItem): ?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                            <li class="sticky-info__point" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                <!-- begin .list-item-->
                                <div class="list-item list-item_type_panel list-item_mobile-layout_vertical list-item_text-size_m">
                                    <div class="list-item__wrapper">
                                        <div class="list-item__highlight">
                                            <?=$arItem["NAME"]?>
                                        </div>
                                        <div class="list-item__text">
                                            <?=htmlspecialchars_decode($arItem["PREVIEW_TEXT"])?>
                                        </div>
                                    </div>
                                </div>
                                <!-- end .list-item-->
                            </li>
                        <? endforeach; ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>