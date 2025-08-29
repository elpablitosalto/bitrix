<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["SECTIONS"])) { ?>
    <? foreach ($arResult["SECTIONS"] as $section) { ?>
        <div class="lk__section documentation__anchor" id="reagents-<?= $section['ID']; ?>">
            <h3><?= $section['NAME']; ?></h3>
            <div class="bookmarks-table__list">
                <div class="bookmarks-table__title">
                    <div class="bookmarks-table__title-item">Наименование</div>
                    <div class="bookmarks-table__title-item">Артикул</div>
                    <div class="bookmarks-table__title-item">Фасовка</div>
                    <?/**/?>
                    <div class="bookmarks-table__title-item"><?/*?>Калибратор<?*/?></div>
                    <div class="bookmarks-table__title-item"><?/*?>Контроли<?*/?></div>
                    <div class="bookmarks-table__title-item"><?/*?>Метод<?*/?></div>
                    <?/**/?>
                    <div class="bookmarks-table__title-item"></div>
                </div>
                <? foreach ($section["ITEMS"] as $item) { ?>
                    <?
                    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="bookmarks-table__row" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                        <div class="bookmarks-table__item bookmarks-table__popup">
                            <a class="bookmarks-table__name js_reagent_link" data-iblock-id="<?= $arParams['IBLOCK_ID'] ?>" data-iblock-code="<?= $arParams['IBLOCK_CODE'] ?>" data-element="<?= $item['ID']; ?>" data-name="<?= $item['NAME']; ?>" href="#">
                                <?= $item['NAME']; ?>
                            </a>
                        </div>
                        <div class="bookmarks-table__item">Артикул</div>
                        <div class="bookmarks-table__item bookmarks-table__popup">
                            <a class="bookmarks-table__name js_reagent_link" data-iblock-id="<?= $arParams['IBLOCK_ID'] ?>" data-iblock-code="<?= $arParams['IBLOCK_CODE'] ?>" data-element="<?= $item['ID']; ?>" data-name="<?= $item['NAME']; ?>" href="#">
                                <?= $item['DISPLAY_PROPERTIES']['NUMBER']['DISPLAY_VALUE']; ?>
                            </a>
                        </div>
                        <div class="bookmarks-table__item">
                            <span class="bookmarks-table__first">Фасовка</span>
                            <span class="bookmarks-table__second">Спецификация</span>
                        </div>
                        
                        <div class="bookmarks-table__item bookmarks-table__popup">
                            <a class="bookmarks-table__name js_reagent_link" data-iblock-id="<?= $arParams['IBLOCK_ID'] ?>" data-iblock-code="<?= $arParams['IBLOCK_CODE'] ?>" data-element="<?= $item['ID']; ?>" data-name="<?= $item['NAME']; ?>" href="#">
                                <?= $item['DISPLAY_PROPERTIES']['SIZE']['DISPLAY_VALUE']; ?>
                            </a>
                        </div>
                        <?/**/?>
                        <div class="bookmarks-table__item"><?/*?>Калибратор<?*/?></div>
                        <div class="bookmarks-table__item bookmarks-table__popup">
                            <?/*?>
                            <a class="bookmarks-table__name js_reagent_link" data-iblock-id="<?= $arParams['IBLOCK_ID'] ?>" data-iblock-code="<?= $arParams['IBLOCK_CODE'] ?>" data-element="<?= $item['ID']; ?>" data-name="<?= $item['NAME']; ?>" href="#">
                                <?= $item['DISPLAY_PROPERTIES']['CALIBRATOR']['DISPLAY_VALUE']; ?>
                            </a>
                            <?*/?>
                        </div>
                        <div class="bookmarks-table__item"><?/*?>Контроли<?*/?></div>
                        <div class="bookmarks-table__item bookmarks-table__popup">
                            <?/*?>
                            <a class="bookmarks-table__name js_reagent_link" data-iblock-id="<?= $arParams['IBLOCK_ID'] ?>" data-iblock-code="<?= $arParams['IBLOCK_CODE'] ?>" data-element="<?= $item['ID']; ?>" data-name="<?= $item['NAME']; ?>" href="#">
                                <?= $item['DISPLAY_PROPERTIES']['CONTROLS']['DISPLAY_VALUE']; ?>
                            </a>
                            <?*/?>
                        </div>
                        <div class="bookmarks-table__item"><?/*?>Метод<?*/?></div>
                        <div class="bookmarks-table__item bookmarks-table__popup">
                            <?/*?>
                            <a class="bookmarks-table__name js_reagent_link" data-iblock-id="<?= $arParams['IBLOCK_ID'] ?>" data-iblock-code="<?= $arParams['IBLOCK_CODE'] ?>" data-element="<?= $item['ID']; ?>" data-name="<?= $item['NAME']; ?>" href="#">
                                <?= $item['DISPLAY_PROPERTIES']['METHOD']['DISPLAY_VALUE']; ?>
                            </a>
                            <?*/?>
                        </div>
                        <?/**/?>
                        <div class="bookmarks-table__item">
                            <div class="bookmarks-table__add">
                                <button class="link-button_grey link-button_xs js_order_button_<?= $item['ID']; ?> js_add_reagent_to_order" data-reg-url="<?= $GLOBALS['arSiteConfig']['LINKS']['REG_PARTNER']; ?>" data-element="<?= $item['ID']; ?>" data-hide-button-class="js_in_order_button_<?= $item['ID']; ?>" data-show-button-class="js_order_button_<?= $item['ID']; ?>" type="button">Добавить в заказ</button>
                                <button class="link-button_grey link-button_xs bookmarks-table__in display-none js_in_order_button_<?= $item['ID']; ?>" type="button"><span>В заказе</span></button>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    <? } ?>
<? } ?>