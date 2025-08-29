<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;
$this->setFrameMode(true);
?>
<ul class="contacts__list">
    <li class="contacts__item">
        <a class="contacts__link" href="tel:<?=General::formatPhone(General::GetStaticInfo('main_phone'))?>">
            <span class="contacts__link-text" itemprop="telephone">
                <?=General::formatPhone(General::GetStaticInfo('main_phone'))?>
            </span>
        </a>
    </li>
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li class="contacts__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <a class="contacts__link" href="tel:<?=$arItem['PROPERTIES']['TELEPHONE_NUMBER']['VALUE']?>">
                <span class="contacts__link-text">
                    <?=$arItem['PROPERTIES']['TELEPHONE_NUMBER']['VALUE']?>
                </span>
                <span class="contacts__label">
                    <?=$arItem["NAME"]?>
                </span>
            </a>
        </li>
    <?endforeach;?>
</ul>