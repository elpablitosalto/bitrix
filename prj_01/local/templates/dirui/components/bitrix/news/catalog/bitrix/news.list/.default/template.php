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
    ?>

        <?
        foreach ($arResult["ITEMS"] as $key => $item) {
            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="big-card" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                <div class="big-card__info">
                    <? if (isset($item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"])) { ?>
                        <div class="big-card__tags">
                            <? if (is_array($item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"])) {
                                foreach ($item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"] as $val) {
                                    ?>
                                    <div class="big-card__tag"><?= $val ?></div>
                                    <?
                                }
                            } else { ?>
                                <div class="big-card__tag"><?= $item["DISPLAY_PROPERTIES"]["TYPE"]["DISPLAY_VALUE"] ?></div>
                            <? } ?>
                        </div>
                    <? } ?>

                    <div class="big-card__title"><?=$item["NAME"]?></div>
                    <div class="big-card__subtitle"><?= $item["DISPLAY_PROPERTIES"]["CATEGORY"]["DISPLAY_VALUE"] ?></div>
                    <div class="big-card__main-text">
                        <p><?=$item["PREVIEW_TEXT"]?></p>
                    </div>
                    <div class="big-card__text">
                    </div>
                    <div class="big-card__btn"><a target="_blank" <?if($item["DISPLAY_PROPERTIES"]["LINK"]["DISPLAY_VALUE"]){?>href="<?=$item["DISPLAY_PROPERTIES"]["LINK"]["DISPLAY_VALUE"]?>"<?} else {?>href="<?=$item["DETAIL_PAGE_URL"]?>"<?}?> class="btn btn--rose btn--large">Подробнее</a></div>
                </div>
                <? if (isset($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"])) { ?>
                    <div class="big-card__img">
                        <picture>
                            <img class="lazyload" src="<?=SITE_TEMPLATE_PATH?>/img/icons/loader.svg" data-src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
                                 loading="lazy" alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>"/>
                        </picture>
                    </div>
                <? } ?>
            </div>

        <? } ?>


<? } else { ?>
    <p>По вашему запросу ничего не найдено</p>
<?}?>
