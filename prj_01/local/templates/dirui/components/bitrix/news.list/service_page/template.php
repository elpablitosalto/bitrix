<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>

    <? foreach ($arResult["ITEMS"] as $item) { ?>
        <?
        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div id="<?= $this->GetEditAreaId($item['ID']); ?>">
            <section class="service__image">
                <div class="service__title">
                    <h2><?= $item["DISPLAY_PROPERTIES"]["H1"]["DISPLAY_VALUE"] ?></h2>
                    <? if (!empty($item["DETAIL_TEXT"])) { ?>
                        <p><?= $item["DETAIL_TEXT"] ?></p>
                    <? } ?>
                </div>
                <? if (!empty($item['PICTURE']['SRC'])) { ?>
                    <picture>
                        <source media="(max-width: 576px)" srcset="<?= $item['PICTURE_1']['SRC']; ?>">
                        <source media="(max-width: 991px)" srcset="<?= $item['PICTURE_2']['SRC']; ?>">
                        <img src="<?= $item['PICTURE']['SRC']; ?>" alt="<?= $item['PICTURE']['ALT']; ?>" title="<?= $item['PICTURE']['TITLE']; ?>" />
                    </picture>
                <? } ?>
            </section>
            <? if (!empty($item["DISPLAY_PROPERTIES"]["BLOCK_2_L"]["DISPLAY_VALUE"])) { ?>
                <section class="service__services">
                    <h3><?= $item["DISPLAY_PROPERTIES"]["BLOCK_2_H"]["DISPLAY_VALUE"] ?></h3>
                    <ul class="service__services-list">
                        <? foreach ($item["DISPLAY_PROPERTIES"]["BLOCK_2_L"]["DISPLAY_VALUE"] as $key => $val) { ?>
                            <li><?= $val; ?></li>
                        <? } ?>
                    </ul>
                </section>
            <? } ?>
            <? if (!empty($item["DISPLAY_PROPERTIES"]["BLOCK_3_L"]["DISPLAY_VALUE"])) { ?>
                <section class="service__conditions">
                    <h3><?= $item["DISPLAY_PROPERTIES"]["BLOCK_3_H"]["DISPLAY_VALUE"] ?></h3>
                    <ul class="service__list">
                        <? foreach ($item["DISPLAY_PROPERTIES"]["BLOCK_3_L"]["DISPLAY_VALUE"] as $key => $val) { ?>
                            <li class="service__item">
                                <span class="service__number"><?= html_entity_decode($val); ?></span>
                                <?/*?>
                                <span class="service__number">1 <span class="service__inter">час</span></span>
                                <?*/ ?>
                                <p><?= $item["DISPLAY_PROPERTIES"]["BLOCK_3_L"]["DESCRIPTION"][$key]; ?></p>
                            </li>
                        <? } ?>
                        <?/*?>
                        <li class="service__item"><span class="service__number">1 <span class="service__inter">год</span></span>
                            <p>Запатентованных технологий</p>
                        </li>
                        <li class="service__item"><span class="service__number"><span class="service__inter">до</span> 14 <span class="service__inter">дней</span></span>
                            <p>Срок ремонта</p>
                        </li>
                        <li class="service__item"><span class="service__number">2-4 <span class="service__inter">месяца</span></span>
                            <p>Срок ремонта в случае необходимости заказа специальных запчастей</p>
                        </li>
                        <?*/ ?>
                    </ul>
                </section>
            <? } ?>
            <? if (!empty($item["DISPLAY_PROPERTIES"]["BLOCK_4_E"]["VALUE"])) { ?>
                <section class="service__connection">
                    <h3><?= $item["DISPLAY_PROPERTIES"]["BLOCK_4_H"]["DISPLAY_VALUE"] ?></h3>
                    <div class="service__wrapper">
                        <?
                        //vardump($item["DISPLAY_PROPERTIES"]["BLOCK_4_E"]);
                        ?>
                        <? foreach ($item["DISPLAY_PROPERTIES"]["BLOCK_4_E"]["VALUE"] as $key => $val) { ?>
                            <div class="service__connections">
                                <h4><?= $val['SUB_VALUES']['BLOCK_4_E_H']['VALUE'] ?></h4>
                                <?
                                $ar = explode(';', $val['SUB_VALUES']['BLOCK_4_E_L']['VALUE']['TEXT']);
                                ?>
                                <? if (!empty($ar)) { ?>
                                    <ul class="service__connection-list">
                                        <? foreach ($ar as $k => $v) { ?>
                                            <li><?= $v; ?></li>
                                        <? } ?>
                                    </ul>
                                <? } ?>
                                <a href="<?= $val['SUB_VALUES']['BLOCK_4_E_B_L']['VALUE'] ?>">
                                    <?= $val['SUB_VALUES']['BLOCK_4_E_B_H']['VALUE'] ?>
                                </a>
                            </div>
                        <? } ?>
                    </div>
                </section>
            <? } ?>
        </div>
    <? } ?>

<? } ?>