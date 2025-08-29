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

    <section class="dp-section dp-series-recommended">
        <div class="container">
            <div class="dp-section__header">
                <h3 class="dp-section__title">Другие изделия коллекции</h3><a
                        class="dp-btn dp-btn_sm dp-btn_white dp-section__link" href=""><span>Смотреть всю коллекцию <?=$arParams["COLLECTION"]?></span>
                    <svg class="icon icon-drop-right ">
                        <use xlink:href="#drop-right"></use>
                    </svg>
                </a>
            </div>
            <div class="dp-section__body">
                <div class="dp-catalog-slider">
                    <? foreach ($arResult['SECTIONS'] as $arSection) { ?>
                        <a class="dp-catalog-item" href="<?=$arSection["SECTION_PAGE_URL"]?>" id="">
                            <div class="dp-catalog-item__image">
                                <picture><img src="  <?= $arSection["PICTURE"]["SRC"] ?>" alt="Столы Bank Line"></picture>
                            </div>
                            <h4 class="dp-catalog-item__title"><?= $arResult["PARENTS"][$arSection["IBLOCK_SECTION_ID"]]["NAME"]?> <?=$arParams["COLLECTION"]?></h4>
                            <div class="dp-catalog-item__subtitle"><?= intval($arSection["ELEMENT_CNT"]) ?> <?=$Declension->get( $arSection["ELEMENT_CNT"]);?></div>
                        </a>
                    <? } ?>
                </div>
            </div>
            <a class="dp-btn dp-btn_sm dp-btn_white dp-section__link"
               href=""><span>Смотреть всю коллекцию BankLine</span>
                <svg class="icon icon-drop-right ">
                    <use xlink:href="#drop-right"></use>
                </svg>
            </a>
        </div>
    </section>

<? } ?>