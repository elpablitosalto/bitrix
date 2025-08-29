<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use Bitrix\Main\Grid\Declension;
$rDeclension = new Declension('рубль', 'рубля', 'рублей');

$this->setFrameMode(true);
?>
<div class="page-head">
    <div class="container">
        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", Array(),
           false
        ); ?>
     <h1 class="page-title"><?=$arResult["NAME"]?></h1>
    </div>
</div>
<?
$this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<div class="page-content report-detail-page" id="<?= $this->GetEditAreaId($arResult['ID']); ?>">
	<?//DONATION?>
	<section class="report-detail-section">
	    <div class="container">
            <div class="h4 section__title">
				<b class="h2 text-color-orange"><?echo number_format($arResult["DISPLAY_PROPERTIES"]["DONATION_TOTAL"]["VALUE"], 0, '', ' ');?> <?=$rDeclension->get($arResult["DISPLAY_PROPERTIES"]["DONATION_TOTAL"]["VALUE"]);?></b> — Поступления
			</div>

            <div class="row">
              <div class="col-lg-9 col-xl-8">
                <div class="table-container">
                  <div class="table-scroller">
                    <table id="report-detail-table-0" class="report-detail-table">
                      <thead>
                        <tr>
                          <td colspan="2">Пожертвования (гранты) полученные в <?=$arResult["CODE"]?> году</td>
                          <td>Сумма</td>
                          <td>Процент</td>
                        </tr>
                      </thead>
                      <tbody>
						<?
						$cItems = count($arResult["DISPLAY_PROPERTIES"]["DONATION"]["VALUE"]);
						$i = 0;
						$persentSum = 0;
    					foreach($arResult["DISPLAY_PROPERTIES"]["DONATION"]["VALUE"] as $item)  {?>
                         <tr>
                          <td data-color="<?=$arResult['DONATION']['LEGEND'][$item["SUB_VALUES"]["DONATION_SOURCE"]['VALUE']]['COLOR']?>">
                            <div style="background-color:<?=$arResult['DONATION']['LEGEND'][$item['SUB_VALUES']['DONATION_SOURCE']['VALUE']]['COLOR']?>" class="report-detail-table-color"></div>
                          </td>
                          <td data-label="<?=$arResult['DONATION']['LEGEND'][$item['SUB_VALUES']['DONATION_SOURCE']['VALUE']]['NAME']?>"><?=$arResult['DONATION']['LEGEND'][$item['SUB_VALUES']['DONATION_SOURCE']['VALUE']]['NAME']?></td>
                          <td data-value="<?=$item["SUB_VALUES"]["DONATION_AMOUNT"]['VALUE']?>"><b class="text-nowrap"><?echo number_format($item["SUB_VALUES"]["DONATION_AMOUNT"]['VALUE'], 0, '', ' ');?> ₽</b></td>
						  <?
						  $i++;
						  $persent = round((int)$item["SUB_VALUES"]["DONATION_AMOUNT"]['VALUE']/$arResult['DONATION']['CALC_SUM']*100, 2);
						  if ($i == $cItems) {$showPersent = 100-$persentSum;} else {$showPersent = $persent;}	
                          $persentSum = $persentSum + $persent;
						  ?>
                          <td><? echo number_format($showPersent, 2, ',', '');?>%</td>
                        </tr>
						<?
						}
						?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="2">Всего</td>
                          <td class="text-nowrap"><?echo number_format($arResult['DONATION']['CALC_SUM'], 0, '', ' ');?> ₽</td>
                          <td>100%</td>
                        </tr>
                      </tfoot>

                    </table>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-xl-4">
                <div data-source-table="#report-detail-table-0" class="report-detail-chart"></div>
              </div>

	</section>

	<?// SPENDING?>
	<section class="report-detail-section">
	    <div class="container">
            <div class="h4 section__title">
				<b class="h2 text-color-orange"><?echo number_format($arResult["DISPLAY_PROPERTIES"]["SPENDING_TOTAL"]["VALUE"], 0, '', ' ');?> <?=$rDeclension->get($arResult["DISPLAY_PROPERTIES"]["SPENDING_TOTAL"]["VALUE"]);?></b> — Траты
			</div>

            <div class="row">
              <div class="col-lg-9 col-xl-8">
                <div class="table-container">
                  <div class="table-scroller">
                    <table id="report-detail-table-1" class="report-detail-table">
                      <thead>
                        <tr>
                          <td colspan="2">Расходы в <?=$arResult["CODE"]?> году</td>
                          <td>Сумма</td>
                          <td>Процент</td>
                        </tr>
                      </thead>
                      <tbody>
						<?
						$cItems = count($arResult["DISPLAY_PROPERTIES"]["SPENDING"]["VALUE"]);
						$i = 0;
						$persentSum = 0;
    					foreach($arResult["DISPLAY_PROPERTIES"]["SPENDING"]["VALUE"] as $item)  {?>
                         <tr>
                          <td data-color="<?=$arResult['SPENDING']['LEGEND'][$item["SUB_VALUES"]["SPENDING_FOR"]['VALUE']]['COLOR']?>">
                            <div style="background-color:<?=$arResult['SPENDING']['LEGEND'][$item['SUB_VALUES']['SPENDING_SOURCE']['VALUE']]['COLOR']?>" class="report-detail-table-color"></div>
                          </td>
                          <td data-label="<?=$arResult['SPENDING']['LEGEND'][$item['SUB_VALUES']['SPENDING_FOR']['VALUE']]['NAME']?>"><?=$arResult['SPENDING']['LEGEND'][$item['SUB_VALUES']['SPENDING_FOR']['VALUE']]['NAME']?></td>
                          <td data-value="<?=$item["SUB_VALUES"]["SPENDING_AMOUNT"]['VALUE']?>"><b class="text-nowrap"><?echo number_format($item["SUB_VALUES"]["SPENDING_AMOUNT"]['VALUE'], 0, '', ' ');?> ₽</b></td>
						  <?
						  $i++;
						  $persent = round((int)$item["SUB_VALUES"]["SPENDING_AMOUNT"]['VALUE']/$arResult['SPENDING']['CALC_SUM']*100, 2);
						  if ($i == $cItems) {$showPersent = 100-$persentSum;} else {$showPersent = $persent;}	
                          $persentSum = $persentSum + $persent;
						  ?>
                          <td><? echo number_format($showPersent, 2, ',', '');?>%</td>
                        </tr>
						<?
						}
						?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="2">Всего</td>
                          <td class="text-nowrap"><?echo number_format($arResult['SPENDING']['CALC_SUM'], 0, '', ' ');?> ₽</td>
                          <td>100%</td>
                        </tr>
                      </tfoot>

                    </table>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-xl-4">
                <div data-source-table="#report-detail-table-1" class="report-detail-chart"></div>
              </div>

	</section>

</div>
