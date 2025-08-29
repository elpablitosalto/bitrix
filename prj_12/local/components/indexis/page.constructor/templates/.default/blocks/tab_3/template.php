<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$item = $arParams['ITEM'];
$arTable = $item['PROPERTIES']['TAB_3_TABLE']['VALUE'];
?>
<section class="nb-section nb-comparison-table-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
            <div class="nb-section__header">
                <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
                    <?
                    // Вывод заголовка для десктопа -->
                    if (strlen($item["H_FST_PART_D"]) > 0) {
                        ?>
                        <h2 class="nb-section__title nb-section-comparison-table-title desktop">
                            <?
                            echo $item["H_FST_PART_D"];
                            if (strlen($item["H_SEC_PART_D"]) > 0) {
                                ?> <span class="font-weight_normal">
                                    <?= $item["H_SEC_PART_D"]; ?>
                                </span>
                                <?
                            }
                            ?>
                        </h2>
                        <?
                    }
                    // <-- Вывод заголовка для десктопа

                    // Вывод заголовка для мобильного -->
                    if (strlen($item["H_FST_PART_M"]) > 0) {
                        ?>
                        <h2 class="nb-section__title nb-section-comparison-table-title mobile">
                            <?
                            echo $item["H_FST_PART_M"];
                            if (strlen($item["H_SEC_PART_M"]) > 0) {
                                ?> <br><span class="font-weight_normal">
                                    <?= $item["H_SEC_PART_M"]; ?>
                                </span>
                                <?
                            }
                            ?>
                        </h2>
                        <?
                    }
                    // <-- Вывод заголовка для мобильного
                    ?>
                <?endif;?>
            </div>
        <?endif;?>
        <div class="nb-section__body nb-comparison-type__body">
            <?if (is_array($arTable) && count($arTable) > 0):?>
                <?
                $arRowNames = [];
                foreach($arTable[0]['SUB_VALUES'] as $arItem) {
                    if (substr($arItem['CODE'], 0 , 15) == 'TAB_3_TABLE_COL')
                        $arRowNames[$arItem['CODE']] = $arItem['NAME'];
                }

                $arStarIcons = [
                    'empty' => 'star-empty.svg',
                    'odd' => 'star-middle.svg',
                    'even' => 'star-full.svg',
                ];
                ?>
                <table class="nb-comparison-type-table">
                    <thead>
                        <tr>
                            <th>Брекеты</th>
                            <?foreach ($arRowNames as $rowCode => $rowName):?>
                                <th><?=$rowName?></th>
                            <?endforeach;?>
                        </tr>
                    </thead>
                    <tbody>
                        <?foreach($arTable as $rowNum => $arCol):?>
                            <tr>
                                <?foreach($arCol['SUB_VALUES'] as $arColItem):?>
                                    <?if (substr($arColItem['CODE'], 0 , 15) == 'TAB_3_TABLE_COL'):?>
                                        <td>
                                            <span class="content-comparison-type-table-mobile"><?=$arColItem['NAME']?></span>
                                            <?
                                            if ($arColItem['VALUE'] > 0) {
                                                if (($rowNum + 1) % 2 == 0) {
                                                    $iconName = $arStarIcons['even'];
                                                } else {
                                                    $iconName = $arStarIcons['odd'];
                                                }
                                            } else {
                                                $iconName = $arStarIcons['empty'];
                                            }
                                            ?>
                                            <?if ($arColItem['VALUE'] > 0):?>
                                                <?for($i = 0; $i < $arColItem['VALUE']; $i++):?>
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/design/<?=$iconName?>" alt="">
                                                <?endfor;?>
                                            <?else:?>
                                                <img src="<?=SITE_TEMPLATE_PATH?>/img/design/<?=$iconName?>" alt="">
                                            <?endif;?>
                                        </td>
                                    <?else:?>
                                        <th><?=$arColItem['VALUE']?></th>
                                    <?endif;?>
                                <?endforeach;?>
                            </tr>
                        <?endforeach;?>
                    </tbody>
                </table>
                <ul class="nb-comparison-description__list">
                    <li class="nb-comparison-description__item">Показатели:</li>
                    <li class="nb-comparison-description__item"><img src="<?=SITE_TEMPLATE_PATH?>/img/design/star-empty.svg" alt="">отсутствуют</li>
                    <li class="nb-comparison-description__item"><img src="<?=SITE_TEMPLATE_PATH?>/img/design/star-middle.svg" alt="">низкие</li>
                    <li class="nb-comparison-description__item"><img src="<?=SITE_TEMPLATE_PATH?>/img/design/star-middle.svg" alt=""><img src="<?=SITE_TEMPLATE_PATH?>/img/design/star-middle.svg" alt="">средние</li>
                    <li class="nb-comparison-description__item"><img src="<?=SITE_TEMPLATE_PATH?>/img/design/star-middle.svg" alt=""><img src="<?=SITE_TEMPLATE_PATH?>/img/design/star-middle.svg" alt=""><img src="<?=SITE_TEMPLATE_PATH?>/img/design/star-middle.svg" alt="">высокие</li>
                </ul>
            <?endif;?>
        </div>
    </div>
</section>