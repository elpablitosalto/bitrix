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
    <div class="description-panel description-panel_layout_s">
        <div class="description-panel__container">
            <div class="description-panel__wrapper">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                    <div class="description-panel__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <!-- begin .list-item-->
                        <div class="list-item list-item_style_secondary list-item_role_panel">
                            <div class="list-item__wrapper">
                                <div class="list-item__icon">
                                    <?if(!empty($arItem["PROPERTIES"]["ICON"]["VALUE"])):?>
                                        <?
                                        $iconPath = \CFile::GetPath($arItem["PROPERTIES"]["ICON"]["VALUE"]);
                                        ?>
                                        <?if(is_file($_SERVER["DOCUMENT_ROOT"].$iconPath)):?>
                                            <?=file_get_contents($_SERVER["DOCUMENT_ROOT"].$iconPath)?>
                                        <?endif;?>
                                    <?endif;?>
                                </div>
                                <div class="list-item__highlight">
                                    <?=$arItem["NAME"]?>
                                </div>
                                <div class="list-item__text">
                                    <?=htmlspecialchars_decode($arItem["PREVIEW_TEXT"])?>
                                </div>
                            </div>
                        </div>
                        <!-- end .list-item-->
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
<? endif; ?>