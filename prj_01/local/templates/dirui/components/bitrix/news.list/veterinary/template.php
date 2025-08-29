<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["SECTIONS"])) { ?>
    <? foreach ($arResult["SECTIONS"] as $section) { ?>
        <div class="lk__section documentation__anchor" id="reagents-<?= $section['ID']; ?>">
            <h3><?= $section['NAME']; ?></h3>
            <div class="bookmarks-table__list">
                <div class="bookmarks-table__title">
                    <div class="bookmarks-table__title-item">Название</div>
                    <div class="bookmarks-table__title-item">Номер</div>
                    <div class="bookmarks-table__title-item">Размер</div>
                    <div class="bookmarks-table__title-item">Калибратор</div>
                    <div class="bookmarks-table__title-item">Контроли</div>
                    <div class="bookmarks-table__title-item">Метод</div>
                    <div class="bookmarks-table__title-item"></div>
                </div>
                <? foreach ($section["ITEMS"] as $item) { ?>
                    <?
                    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="bookmarks-table__row" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                        <div class="bookmarks-table__item">
                            <a class="bookmarks-table__name js_reagent_link" data-iblock-id="<?=$arParams['IBLOCK_ID']?>" data-iblock-code="<?=$arParams['IBLOCK_CODE']?>" data-element="<?= $item['ID']; ?>" data-name="<?= $item['NAME']; ?>" href="#"><?= $item['NAME']; ?></a>
                        </div>
                        <div class="bookmarks-table__item">Номер</div>
                        <div class="bookmarks-table__item"><?= $item['DISPLAY_PROPERTIES']['NUMBER']['DISPLAY_VALUE']; ?></div>
                        <div class="bookmarks-table__item">
                            <span class="bookmarks-table__first">Размер</span>
                            <span class="bookmarks-table__second">Спецификация</span>
                        </div>
                        <div class="bookmarks-table__item"><?= $item['DISPLAY_PROPERTIES']['SIZE']['DISPLAY_VALUE']; ?></div>
                        <div class="bookmarks-table__item">Калибратор</div>
                        <div class="bookmarks-table__item"><?= $item['DISPLAY_PROPERTIES']['CALIBRATOR']['DISPLAY_VALUE']; ?></div>
                        <div class="bookmarks-table__item">Контроли</div>
                        <div class="bookmarks-table__item"><?= $item['DISPLAY_PROPERTIES']['CONTROLS']['DISPLAY_VALUE']; ?></div>
                        <div class="bookmarks-table__item">Метод</div>
                        <div class="bookmarks-table__item"><?= $item['DISPLAY_PROPERTIES']['METHOD']['DISPLAY_VALUE']; ?></div>
                        <div class="bookmarks-table__item">
                            <div class="bookmarks-table__add">
                                <button class="link-button_grey link-button_xs" type="button">Добавить в заказ</button>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    <? } ?>
<? } ?>