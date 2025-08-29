<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;
use Bitrix\Main\Grid\Declension;

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
$this->setFrameMode(true);
?>
<? if (!empty($arResult["ITEMS"])) { ?>
  <? if ($arParams["AJAX_LOAD"] != "Y") { ?>
    <div class="nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
    <? } ?>
	<div class="items-list target-help-list">
	 <?foreach ($arResult["ITEMS"] as $key => $item) {
    	$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		
		$totalProds = 0;
		$closedProds = 0;
		$categoryProds = [];
		foreach ($item['DISPLAY_PROPERTIES']['ITEM']["~VALUE"] as $prodItem) {
			$totalProds++;
			if ($prodItem["SUB_VALUES"]["ITEM_CLOSED"]["VALUE"] == 'Да') {$closedProds++;}
			$categoryProds[$prodItem["SUB_VALUES"]["ITEM_CATEGORY"]["VALUE"]] = $prodItem["SUB_VALUES"]["ITEM_CATEGORY"]["VALUE"];
		}

		//$itemClosed = (($item['DISPLAY_PROPERTIES']['CLOSED']['VALUE'] == 'Да') || ($closedProds == $totalProds));  // если проверять и по закрытым позициям
		$itemClosed = ($item['DISPLAY_PROPERTIES']['CLOSED']['VALUE'] == 'Да');

		?>
        <div class="list-item target-help-item <? if($itemClosed) echo 'complete';?>" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                <div class="target-help-item__content">
                  <div class="h6 target-help-item__title"><?=$item['NAME']?></div>
                  <div class="target-help-item__date"><?=$item['ACTIVE_FROM']?></div>
                </div>
                <div class="target-help-item__icons">
                  <div class="target-help-item__icons-title">Чем помочь:</div>
                  <ul class="target-help-item__icons-list">
                    <? $key = 0; $catCount = count($categoryProds);
					foreach ($categoryProds as $category) {
					 $key++;
					 if (($catCount > 3) && ($key > 2)) {?>
                     <li>
                      <div class="target-help-item__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-plus">
                          <use xlink:href="#plus"></use>
                        </svg>
                      </div>
                     </li>
                    <?break;
					} else {?>
                     <li>
						<?if(strlen($arResult['THCATEGORY']['LEGEND'][$category]['ICON'])>0) {
							$icon = $arResult['THCATEGORY']['LEGEND'][$category]['ICON'];
						} else {
							$icon = 'plus';
						}?>
                      <div class="target-help-item__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-<?=$icon?>">
                          <use xlink:href="#<?=$icon?>"></use>
                        </svg>
                      </div>
                     </li>
					<?}?>
					<?}?>
                  </ul>
                </div>
                <div class="target-help-item__info">
					<? if($itemClosed) {?>
						<span class="target-help-item__message-complete">Помогли
                    		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-check">
                      			<use xlink:href="#check"></use>
	                    	</svg>
						</span>
					<?} else {?>
						<span class="text-color-gray">Уже собрали</span> <b class="text-color-orange"><?=$closedProds?></b> из <?=$totalProds?>
					<?}?>
                </div>
                <div class="target-help-item__btn-block">
					<a href="<?=$item["DETAIL_PAGE_URL"]?>" <? if(!$itemClosed) echo 'class="btn"';?>>
                    <? if($itemClosed) {?><u>Посмотреть</u><?}else{?>Помочь<?}?>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                      <use xlink:href="#arrow"></use>
                    </svg>
					</a>
                </div>
          </div>

	 <?}?>
	</div>
    <? if ($arParams["AJAX_LOAD"] != "Y") { ?>
    </div>
  <? } ?>
 <? if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
   echo $arResult["NAV_STRING"];
 } ?>
<?}?>
