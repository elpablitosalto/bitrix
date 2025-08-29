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
$yearDeclension = new Declension('год', 'года', 'лет');

$this->setFrameMode(true);

//var_dump($arResult["DISPLAY_PROPERTIES"]["ADOPTATION_TYPES"]["DISPLAY_VALUE"]);

?>

<div class="page-content child-card-page">
	<section class="child-card-first">
    	<div class="container">
	        <?
            $this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="child-card-main" id="<?= $this->GetEditAreaId($arResult['ID']); ?>">
              <picture class="child-card-main__image">
				<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/child-card-main-image.png" loading="lazy" alt="" title="" />
              </picture>
              <div class="row">
                <div class="col-sm-8 col-md-6 col-lg-5 col-xl-4">
                  <picture class="child-card-main__photo">
					<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" 
						data-src="<?= $arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] ?>"
						loading="lazy" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"]?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"]?>" />
                  </picture>
                </div>
                <div class="col-md-6 col-lg-7 col-xl-8">
                  <div class="child-card-main__info">
                    <h1 class="page-title"><?=$arResult['NAME']?></h1>
                    <?if($arResult["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["DISPLAY_VALUE"]){?>
						<p class="text-size-lg">
							<span class="text-color-gray"><?=$arResult["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["DISPLAY_VALUE"]?> <?=$yearDeclension->get($arResult["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["DISPLAY_VALUE"]);?></span>
						</p>
					<?}?>
                    <p class="text-size-lg">
                    	<?if($arResult["DISPLAY_PROPERTIES"]["HAIR_COLOR"]["DISPLAY_VALUE"]){?>
							<span class="text-color-gray">Цвет волос:</span> <?=$arResult["DISPLAY_PROPERTIES"]["HAIR_COLOR"]["DISPLAY_VALUE"]?><br>
						<?}?>
                    	<?if($arResult["DISPLAY_PROPERTIES"]["EYES_COLOR"]["DISPLAY_VALUE"]){?>
							<span class="text-color-gray">Цвет глаз:</span> <?=$arResult["DISPLAY_PROPERTIES"]["EYES_COLOR"]["DISPLAY_VALUE"]?>
						<?}?>
					</p>
                    <p class="text-size-lg"><?=$arResult["DETAIL_TEXT"]?></p>
                    <?if($arResult["DISPLAY_PROPERTIES"]["ADOPTATION_TYPES"]["DISPLAY_VALUE"]){?>
                    	<p class="text-size-lg"><span class="text-color-gray">Возможные формы устройства:</span> <?=$arResult["DISPLAY_PROPERTIES"]["ADOPTATION_TYPES"]["DISPLAY_VALUE"]?></p>
					<?}?>
                    <div class="buttons-line">
                    	<?if($arResult["DISPLAY_PROPERTIES"]["SIBLINGS"]["VALUE"]){?>
							<a href="<?=$arResult["DISPLAY_PROPERTIES"]["SIBLINGS"]["VALUE"]?>" target="_blank"><u>Есть братья или сестры</u></a>
						<?}?>
                    	<?if($arResult["DISPLAY_PROPERTIES"]["FEDERAL_DATA_BANK"]["VALUE"]){?>
							<a href="<?=$arResult["DISPLAY_PROPERTIES"]["FEDERAL_DATA_BANK"]["VALUE"]?>" target="_blank"><u>Федеральный банк данных</u></a>
						<?}?>
					</div>
                  </div>
                </div>
              </div>
            </div>



		</div>
	</section>
</div>
