<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;

?>

<div class="row">
    <? foreach ($arResult["ITEMS"] as $item) { ?>
        <?
        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="col-sm-6 col-lg-3" id="<?= $this->GetEditAreaId($item['ID']); ?>">
            <div class="list-item main-digits-item">
                <div class="h2 main-digits-item__title">
                    <?=$item["NAME"]?>
                </div>
                <div class="text-size-lg main-digits-item__text">
                    <?=$item["PREVIEW_TEXT"]?>
                </div>
            </div>
        </div>
    <? } ?>
</div>
<br>




