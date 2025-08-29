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
  <? if ($arParams["AJAX_LOAD"] != "Y") { ?>
    <div class="nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
    <? } ?>
	<div class="items-list managers-list">
        <? foreach ($arResult["ITEMS"] as $item) { ?>
	        <?
            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
              <div class="list-item managers-item" id="<?=$this->GetEditAreaId($item['ID']);?>">
                <div class="row">
                  <div class="col-sm-5 col-lg-3">
                    <div class="managers-item__photo">
                    	<picture>
							<img class="lazyload" src="<?=SITE_TEMPLATE_PATH?>/images/loader.svg"
                            	data-src="<?=$item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]?>"
                                loading="lazy" alt="<?=$item["PREVIEW_PICTURE"]["ALT"]?>"
                                title="<?=$item["PREVIEW_PICTURE"]["TITLE"]?>"/>
                        </picture>
                    </div>
                  </div>
                  <div class="col-sm-7 col-lg-9">
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="managers-item__content">
                          <div class="text-size-lg managers-item__name"><?=$item["NAME"]?></div>
						  <? if (!empty($item["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"])) {?>
                          	<div class="managers-item__info"><?=$item["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"]?></div>
						  <?}?>
						  <? foreach ($item["DISPLAY_PROPERTIES"]["PROJECT_LINK"]["VALUE"] as $projectID) {?>
						  <? if (!empty($arResult["PROJECTS"][$projectID]["NAME"])) {?>
                          	<div class="managers-item__text"><?=$arResult["PROJECTS"][$projectID]["NAME"]?></div>
						  <?}?>
						  <? if (!empty($arResult["PROJECTS"][$projectID]["ADDRESS"])) {?>
                          	<div class="managers-item__address"><span class="text-color-gray">Адрес:</span> <?=$arResult["PROJECTS"][$projectID]["ADDRESS"]?></div>
						  <?}?>
						  <?}?>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="managers-item__contacts">
						  <? if (!empty($item["PROPERTIES"]["PHONE"]["VALUE"])) {?>
                          	<div class="managers-item__contacts-item"><span class="text-color-gray">Телефон:</span> <a href="tel:<?=$item["PROPERTIES"]["PHONE"]["VALUE"]?>"><u><?=$item["PROPERTIES"]["PHONE"]["VALUE"]?></u></a></div>
						  <?}?>
						  <? if (!empty($item["PROPERTIES"]["EMAIL"]["VALUE"])) {?>
                          	<div class="managers-item__contacts-item"><span class="text-color-gray">E-mail:</span> <a href="mailto:<?=$item["PROPERTIES"]["EMAIL"]["VALUE"]?>"><u><?=$item["PROPERTIES"]["EMAIL"]["VALUE"]?></u></a></div>
						  <?}?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
		<? } ?>
    <? if ($arParams["AJAX_LOAD"] != "Y") { ?>
    	</div>
	<? } ?>
    </div>
<? } ?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]) {echo $arResult["NAV_STRING"];}?>
