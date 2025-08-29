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
<? if (!empty($arResult["ITEMS"])) { 
	$yearDeclension = new Declension('год', 'года', 'лет');
	?>
    <?if($arParams["AJAX_LOAD"] != "Y"){?>
    	<div class="nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
    <?}?>
	<section>
    	<div class="container">
        	<div class="items-list children-list">
            		<div class="row align-items-height">
			<? 	$iCount = count($arResult["ITEMS"]);
				if ($iCount > 2) {$actionPos = 2;} else {$actionPos = $iCount - 1;}
				foreach ($arResult["ITEMS"] as $key => $item) {
                			$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
			                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
                			<div class="col-sm-6 col-md-4 col-lg-3" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                  			 <div class="list-item children-item">
                    			<div class="children-item__photo">
                            		<picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg"
                                          data-src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
                                          loading="lazy" alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>"
                                          title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>"/>
                            		</picture>
                    			</div>
                    			<div class="h5 children-item__name"><?=$item["NAME"]?></div>
                    			<?if($item["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["DISPLAY_VALUE"]) {?>
									<div class="children-item__age"><?=$item["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["DISPLAY_VALUE"]?> <?=$yearDeclension->get($item["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["DISPLAY_VALUE"]);?></div>
								<?}?>
                   				<div class="children-item__text"><?=$item["PREVIEW_TEXT"]?></div>
                    			<div class="children-item__buttons">
									<a href="<?=$item["DETAIL_PAGE_URL"]?>" class="btn">Подробнее о ребёнке</a>
								</div>
                  			 </div>
                  			</div>
							<? if (($key == $actionPos) && !($arParams["HIDE_BADGE"] == "Y")) {?>
                				<div class="col-sm-6 col-md-4 col-lg-3">
                  					<div class="list-item simple-action-item">
                    					<div class="h5 simple-action-item__text">Вы хотите принять ребенка в семью, ищете своего сына или дочку? Мы подскажем с чего начать.</div>
                    					<div class="simple-action-item__buttons">
											<a href="<?=$arParams["HOW_TO_HELP_LINK"]?>" target="blank" class="btn btn-white simple-action-item__btn">
												<span>Как взять ребенка в семью</span>
                        						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow"><use xlink:href="#arrow"></use></svg>
											</a>
										</div>
                  					</div>
                				</div>
							<?}?>
					<?	}?>
				</div>
			</div>
		</div>
	</section>
    <?if($arParams["AJAX_LOAD"] != "Y"){?>
    	</div>
    <?}?>
<?}?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]) {echo $arResult["NAV_STRING"];}?>

