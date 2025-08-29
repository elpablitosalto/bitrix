<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["SECTIONS"])) { ?>
    <div class="bookmarks-table__content">
        <? foreach ($arResult["SECTIONS"] as $section) { ?>
            <div class="bookmarks-table__table">
                <h3 class="bookmarks-table__title" id="section-<?= $section["ID"] ?>"><?= $section["NAME"] ?></h3>
                <div class="c-custom-table">
                    <div class="c-custom-table__item c-custom-table__item--title">Название</div>
                    <div class="c-custom-table__item c-custom-table__item--title">Номер в каталоге</div>
                    <div class="c-custom-table__item c-custom-table__item--title">Необходимость калибратора</div>
                    <div class="c-custom-table__item c-custom-table__item--title">Необходимость контролей</div>
                    <div class="c-custom-table__item c-custom-table__item--title">Метод</div>
                    <div class="c-custom-table__item c-custom-table__item--title">Размер</div>
                    <? foreach ($section["ITEMS"] as $item) { ?>
                        <?
                        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <a id="<?= $this->GetEditAreaId($item['ID']); ?>" class="c-custom-table__item"><?=$item["NAME"]?></a>
                        <div class="c-custom-table__item"><?=$item["DISPLAY_PROPERTIES"]["NUMBER"]["DISPLAY_VALUE"]?></div>
                        <div class="c-custom-table__item"><?=$item["DISPLAY_PROPERTIES"]["CALIBRATOR"]["DISPLAY_VALUE"]?></div>
                        <div class="c-custom-table__item"><?=$item["DISPLAY_PROPERTIES"]["CONTROL"]["DISPLAY_VALUE"]?></div>
                        <div class="c-custom-table__item"><?=$item["DISPLAY_PROPERTIES"]["METHOD"]["DISPLAY_VALUE"]?></div>
                        <div class="c-custom-table__item"><?=$item["DISPLAY_PROPERTIES"]["SIZE"]["DISPLAY_VALUE"]?></div>
                    <? } ?>
                </div>
            </div>
        <? } ?>
    </div>
<? } ?>