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

<? if (isset($arResult['SECTIONS']['PARENTS']) && !empty($arResult['SECTIONS']['PARENTS'])) { ?>


    <? foreach ($arResult['SECTIONS']['PARENTS'] as $sectId => $arSection) { ?>
        <section class="dp-section dp-catalog-section" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
            <div class="container">
                <div class="dp-section__header">
                    <h3 class="dp-section__title"><?= $arSection["NAME"] ?></h3><a
                            class="dp-btn dp-btn_sm dp-btn_white dp-section__link"
                            href="<?= $arSection["SECTION_PAGE_URL"] ?>"><span>Все <?= $arSection["NAME"] ?></span>
                        <svg class="icon icon-drop-right ">
                            <use xlink:href="#drop-right"></use>
                        </svg>
                    </a>
                </div>
                <? if (isset($arResult['SECTIONS']['CHILDRENS'][$arSection["ID"]])) { ?>
                    <div class="dp-section__body">
                        <div class="dp-catalog-slider">
                            <? foreach ($arResult['SECTIONS']['CHILDRENS'][$arSection["ID"]] as $arChild) { ?>
                                <a class="dp-catalog-item" href="<?=$arChild["SECTION_PAGE_URL"]?>" id="">
                                    <div class="dp-catalog-item__image">
                                        <??>
                                        <picture>
                                            <img src="<?=$arChild["PICTURE"]["SRC"]?>" alt="<?=$arChild["NAME"]?>">
                                        </picture>

                                    </div>
                                    <h4 class="dp-catalog-item__title"><?= $arChild["NAME"] ?></h4>
                                    <div class="dp-catalog-item__subtitle"><?= intval($arChild["ELEMENT_CNT"]) ?> <?=$Declension->get( $arChild["ELEMENT_CNT"]);?></div>
                                </a>
                            <? } ?>
                        </div>
                    </div>
                <? } ?>
                <a class="dp-btn dp-btn_sm dp-btn_white dp-section__mobile-link"
                   href="<?= $arSection["SECTION_PAGE_URL"] ?>"><span>Все <?= $arSection["NAME"] ?><</span>
                    <svg class="icon icon-drop-right ">
                        <use xlink:href="#drop-right"></use>
                    </svg>
                </a>
            </div>
        </section>


    <? } ?>


<? } ?>