<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>
    <ul class="base__list">
        <? foreach ($arResult["ITEMS"] as $item) {
            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
            <li class="base__item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                <a href="<?= $item['DETAIL_PAGE_URL']; ?>">
                    <img src="<?= $item['PICTURE']['SRC']; ?>" alt="<?= $item['PICTURE']['ALT']; ?>" title="<?= $item['PICTURE']['TITLE']; ?>" />
                    <?= $item['NAME']; ?>
                </a>
            </li>
        <? } ?>
    </ul>
<? } ?>