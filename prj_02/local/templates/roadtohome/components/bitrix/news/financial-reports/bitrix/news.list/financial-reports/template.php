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
<div class="page-content financial-reports-page">
 <div class="page-head">
    <div class="container">
     <div class="section__head-block">
        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", Array(),
           false
        ); ?>
     	<h1 class="page-title"><?$APPLICATION->ShowTitle(false)?></h1>
        <picture class="section__head-pattern">
			<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/main-first-birds.png" loading="lazy" alt="Дорога к дому" title="Дорога к дому" />
        </picture>
     </div>
    </div>
 </div>
 <? if (!empty($arResult["ITEMS"])) { ?>
	<section>
    	<div class="container">
            <div class="site-accordeon">
				<?foreach ($arResult["ITEMS"] as $key => $item) {
                			$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
			                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
              		<div class="site-accordeon__item"  id="<?= $this->GetEditAreaId($item['ID']); ?>">
                		<div class="site-accordeon__item-head">
		                  <h4 class="site-accordeon__item-title"><?=$item['CODE']?> год</h4>
        		          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light site-accordeon__item-icon">
                		    <use xlink:href="#drop-light"></use>
		                  </svg>
        		        </div>
                		<div class="site-accordeon__item-body">
		                 <div class="items-list documents-list">
                    	  <div class="list-item reports-card">
                      		<div class="row">
                         	 <div class="col-sm">
                          	  <div class="text-size-lg reports-card__title">Годовой финансовый отчет Благотворительного фонда «Дорога к дому»</div>
                          		<div class="h4 reports-card__year"><?=$item['CODE']?></div>
                        	 </div>
							 <? if($item['DISPLAY_PROPERTIES']["DONATION_TOTAL"]['~VALUE'] > 0) {?>
                        	 <div class="col-sm-auto"><a href="<?=$item["DETAIL_PAGE_URL"]?>" class="reports-item__link reports-card__link">Перейти
                            	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                              		<use xlink:href="#arrow"></use>
                            	</svg></a>
							 </div>
							 <?}?>
                      		</div>
                    	  </div>

						  <?$file_values = $item['DISPLAY_PROPERTIES']["FILE"]['FILE_VALUE'];
							if( intval( $file_values['ID'] ) > 0 )
							{
								$file_values = array( $file_values );
							}	
                    	  foreach ($file_values as $file_value) {?>
							<?
							$ext_pos = mb_strrpos($file_value["FILE_NAME"], '.');
							$ext = mb_strtoupper(mb_substr($file_value["FILE_NAME"], $ext_pos+1)); 
							if(!empty($file_value["DESCRIPTION"])){
								$title = $file_value["DESCRIPTION"];
							} else {
								$title = mb_substr($file_value["FILE_NAME"], 0, $ext_pos);
							}
							$sizeMB = IntVal($file_value["FILE_SIZE"]/1024/1024);
							if($sizeMB < 1) {
								$fileSize = (string)IntVal($file_value["FILE_SIZE"]/1024).' kB';
							} else {
								$fileSize = (string)$sizeMB.' mB';
							}
							?> 
                    		<div class="list-item document-item">
								<? if($ext == 'PDF') {?>
                      				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-pdf document-item__icon">
                        				<use xlink:href="#pdf"></use>
	                      			</svg>
								<?} elseif($ext == 'DOC' || $ext == 'DOCX') {?>
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-word document-item__icon">
                        				<use xlink:href="#word"></use>
                      				</svg>
								<?} elseif($ext == 'XLS' || $ext == 'XLSX') {?>
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-exel document-item__icon">
                        				<use xlink:href="#exel"></use>
                      				</svg>
								<?}?>
                      			<div class="text-size-lg document-item__title"><?=$title?></div>
                      			<div class="document-item__info"><?=$ext; ?>, <?=$fileSize?></div>
								<a href="<?=$file_value["SRC"]?>" class="btn btn-transparent document-item__link" target="_blank">
                        			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-download">
                          				<use xlink:href="#download"></use>
                        			</svg>
								</a>
                    		</div>                          
						  <?}?>

						 </div>
						</div>
					</div>
				<?}?>
			</div>
		</div>
	</section>
 <?}?>
</div>
