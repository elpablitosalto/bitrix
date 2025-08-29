<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (!empty($arResult['ITEMS'])) { ?>
    <div class="icon-panel-group">
        <ul class="icon-panel-group__list">
            <? foreach ($arResult['ITEMS'] as $k => $arItem) { ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li class="icon-panel-group__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <!-- begin .icon-panel-->
                    <div class="icon-panel">
                        <div class="icon-panel__wrapper">
                            <div class="icon-panel__illustration">
                                <picture class="icon-panel__picture">
                                    <img src="<?= $arItem['PREVIEW_PICTURE_UTO']['SRC']; ?>" alt="<?= $arItem['PREVIEW_PICTURE_UTO']["ALT"] ?>" title="<?= $arItem['PREVIEW_PICTURE_UTO']["TITLE"] ?>" class="icon-panel__image" />
                                </picture>
                            </div>
                            <div class="icon-panel__info">
                                <div class="icon-panel__title">
                                    <?= $arItem["NAME"] ?>
                                </div>
                                <div class="icon-panel__text">
                                    <?= htmlspecialchars_decode($arItem["PREVIEW_TEXT"]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end .icon-panel-->
                </li>
            <? } ?>
        </ul>
    </div>
<? } ?>