<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>
    <ul class="equipment__list">
        <? foreach ($arResult["ITEMS"] as $item) {
            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
            <li class="equipment__item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                <a class="equipment__link" href="<?=$arParams["FOLDER_PATH"]?><?=$item['ID'];?>/">
                    <?= $item['NAME']; ?>
                    <div class="equipment__image">
                        <img src="<?= $item['PICTURE']['SRC']; ?>" alt="<?= $item['PICTURE']['ALT']; ?>" title="<?= $item['PICTURE']['TITLE']; ?>" />
                    </div>
                </a>
            </li>
        <? } ?>
    </ul>
<? } ?>