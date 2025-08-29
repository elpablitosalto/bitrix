<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$item = $arParams['ITEM'];
$arTable = $item['PROPERTIES']['TAB_1_TABLE']['VALUE'];
?>
<div class="advantage-wrapper-bg">
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
            <?if (is_array($arTable) && count($arTable) > 0):?>
                <?
                $arRowNames = [];
                foreach($arTable[0]['SUB_VALUES'] as $arItem) {
                    if (substr($arItem['CODE'], 0 , 15) == 'TAB_1_TABLE_ROW')
                        $arRowNames[$arItem['CODE']] = $arItem['NAME'];
                }
                ?>
                <div class="nb-section__body">
					<?if (count($arTable) > 3):?>
					<div class="nb-comparison-table-wrapper">
					<?endif;?>
						<table class="nb-comparison-table">
							<tbody>
								<tr>
									<th class="content-comparison-table-desktop">ОТБЕЛИВАНИЕ</th>
									<?foreach($arTable as $arRow):?>
										<th><?=$arRow['SUB_VALUES']['TAB_1_TABLE_NAME']['VALUE']?></th>
									<?endforeach;?>
								</tr>
								<?foreach ($arRowNames as $rowCode => $rowName):?>
									<tr>
										<th class="content-comparison-table-desktop"><?=$rowName?></th>
										<?foreach($arTable as $arRow):?>
											<td><span class="content-comparison-table-mobile"><?=$rowName?></span><?=$arRow['SUB_VALUES'][$rowCode]['VALUE']?></td>
										<?endforeach;?>
									</tr>
								<?endforeach;?>
							</tbody>
						</table>
					<?if (count($arTable) > 3):?>
					</div>
					<?endif;?>
                </div>
            <?endif;?>
        </div>
    </section>
</div>