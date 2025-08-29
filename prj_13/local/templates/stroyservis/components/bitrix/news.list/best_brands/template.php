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
use \Bitrix\Main\Localization\Loc;
?>

<?if (is_array($arResult["ITEMS"]) && count($arResult["ITEMS"]) > 0):?>
    <section class="brand">
        <div class="title-section">
            <h2><?=Loc::getMessage('BEST_BRAND_TITLE')?></h2>
            <a class="title-link" href="<?=SITE_DIR?>brands/"><?=Loc::getMessage('BEST_BRAND_ALL')?></a>
        </div>
        <ul class="brand__list">
            <?foreach ($arResult["ITEMS"] as $key => $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li class="brand__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" itemscope itemtype="https://schema.org/ImageObject">
                        <img loading="lazy" itemprop="image" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                    </a>
                </li>
            <?endforeach;?>
        </ul>
    </section>
<?endif;?>