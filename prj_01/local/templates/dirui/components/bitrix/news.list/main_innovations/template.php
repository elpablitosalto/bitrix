<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>
    <ul class="innovation__list">
        <? foreach ($arResult["ITEMS"] as $item) { ?>
            <?
            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li class="innovation__item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                <? if (mb_strlen($item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"])) { ?>
                    <span class="innovation__title"><?= $item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"] ?></span>
                <? } ?>
                <? if (mb_strlen($item["DISPLAY_PROPERTIES"]["NUM"]["DISPLAY_VALUE"])) { ?>
                    <span class="innovation__number"><?=$item["DISPLAY_PROPERTIES"]["NUM"]["DISPLAY_VALUE"]?></span>
                <? } ?>
                <p><?= $item["NAME"] ?></p>
            </li>
        <? } ?>
    </ul>
<? } ?>