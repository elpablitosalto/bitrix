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
    <div class="items-list reports-list">
    <?if($arParams["AJAX_LOAD"] != "Y"){?>
    	<div class="nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
    <?}?>
		<?foreach ($arResult["ITEMS"] as $key => $item) {
                			$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
			                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
              <div class="list-item reports-item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                <div class="row">
                  <div class="col-lg-8 col-xl-7">
                    <div class="row">
                      <div class="col-sm-7 col-lg-12">
                        <div class="h5 reports-item__title"><?=$item['NAME']?></div>
                    	  <?$file_value = $item['DISPLAY_PROPERTIES']["FILE"]["FILE_VALUE"];
							$ext_pos = mb_strrpos($file_value["FILE_NAME"], '.');
							$ext = mb_strtoupper(mb_substr($file_value["FILE_NAME"], $ext_pos+1)); 
							/*if(!empty($file_value["DESCRIPTION"])){
								$title = $file_value["DESCRIPTION"];
							} else {
								$title = mb_substr($file_value["FILE_NAME"], 0, $ext_pos);
							}*/
							$sizeMB = IntVal($file_value["FILE_SIZE"]/1024/1024);
							if($sizeMB < 1) {
								$fileSize = (string)IntVal($file_value["FILE_SIZE"]/1024).' kB';
							} else {
								$fileSize = (string)$sizeMB.' mB';
							}
							?> 
                        <div class="reports-item__info"><?=$ext; ?>, <?=$fileSize?></div>
                      </div>
                      <div class="col-sm-5 col-lg-12">
                        <div class="reports-item__buttons">
                          <div class="buttons-line"><a href="<?=$file_value["SRC"]?>" class="reports-item__link" download="<?=$file_value["FILE_NAME"]?>">Скачать
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-download">
                                <use xlink:href="#download"></use>
                              </svg></a><a href="<?=$file_value["SRC"]?>" target="_blank" class="reports-item__link">Читать
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-zipper">
                                <use xlink:href="#zipper"></use>
                              </svg></a></div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-5">
                  	<picture class="reports-item__card-image">
						<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg"
	                    	data-src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
    	                    loading="lazy" alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>"
        	                title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>"/>
            	    </picture>
                </div>
              </div>
            </div>
		<?}?>
	<?if($arParams["AJAX_LOAD"] != "Y"){?>
   		</div>
    <?}?>
	</div>
<?}?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]) {echo $arResult["NAV_STRING"];}?>

