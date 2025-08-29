<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>
    <div class="innovation__certificate">
        <h3>Международные сертификаты:</h3>
        <ul class="innovation__certificate-list">
            <? foreach ($arResult["ITEMS"] as $item) { ?>
                <?
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li id="<?= $this->GetEditAreaId($item['ID']); ?>" class="innovation__certificate-item"><span
                            href="#"><?= $item["NAME"] ?></span></li>
            <? } ?>
        </ul>
        <p>ООО «Дируи Медикал» является официальным представительством DIRUI INDUSTRIAL CO., LTD на территории
            Российской Федерации.</p>
    </div>
<? } ?>