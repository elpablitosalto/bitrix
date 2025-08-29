<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
	<div class="section__content">
		<div class="row">
		<?foreach($arResult["ITEMS"] as $key=>$item) {?>
        	<div class="col-sm-6 col-xl-<?if(($key % 2) == 0){ echo '7';} else {echo '5';}?>">
            	<div class="h6"><?=$item['NAME']?></div>
                <p class="text-color-gray"><?=$item['PREVIEW_TEXT']?></p>
				<?
				if(!empty($item["DISPLAY_PROPERTIES"]['PHONE']['DISPLAY_VALUE'])) {
					$phones = [];
						foreach($item["PROPERTIES"]['PHONE']['DESCRIPTION'] as $phoneKey => $phoneDescription) {
							// здесь именно $item["PROPERTIES"], так как в случае с одним значением в $item["DISPLAY_PROPERTIES"]['PHONE']['DISPLAY_VALUE'] не будет массива
							if (empty($phoneDescription)) {$phoneDescription= "-";}
								$phone = $item["PROPERTIES"]['PHONE']['VALUE'][$phoneKey];
								$phones[$phoneDescription][$phoneKey] = '<a href="tel:'.$phone.'"><u>'.$phone.'</u></a>';
					}
					foreach($phones as $phoneDescription => $phone) {?>
                		<div class="text-size-lg text-color-orange"><? echo implode(", ", $phone)?></div>
                  		<p><? echo trim($phoneDescription,"-");?></p>
				
					<?}?>
				<?}?>					
            </div>
		<?}?>
    	</div>
	</div>
<?}?>