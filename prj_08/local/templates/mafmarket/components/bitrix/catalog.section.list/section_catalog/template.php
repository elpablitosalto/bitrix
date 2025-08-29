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
$this->setFrameMode(true);
//echo '!!';
$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

use Bitrix\Main\Grid\Declension;
$Declension = new Declension('модель', 'модели', 'моделей');

?>

<? if (isset($arResult['SECTIONS']) && !empty($arResult['SECTIONS'])) { ?>


    <section class="dp-section dp-catalog-section" id="catalog-section">
        <div class="container">
            <div class="dp-section__body">
                <div class="dp-item-list">
                    <div class="row">
                        <?foreach($arResult['SECTIONS'] as $arSection){?>
                        <div class="col-sm-12 col-md-8">
                            <a class="dp-catalog-item" href="<?=$arSection["SECTION_PAGE_URL"]?>" id="">
                                <div class="dp-catalog-item__image">
                                    <picture>
                                        <img src="<?=$arSection["PICTURE"]["SRC"]?>" alt="<?=$arSection["NAME"]?>">
                                    </picture>
                                </div>
                                <h4 class="dp-catalog-item__title"><?=$arSection["NAME"]?></h4>
                                <div class="dp-catalog-item__subtitle"><?= intval($arSection["ELEMENT_CNT"]) ?> <?=$Declension->get( $arSection["ELEMENT_CNT"]);?></div>
                            </a>
                        </div>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<? } ?>