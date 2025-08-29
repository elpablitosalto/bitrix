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

use Bitrix\Main\Grid\Declension;
?>

<?
$countDeclension = new Declension('проект', 'проекта', 'проектов');
if (!empty($arResult["ITEMS"])) {
?>

    <section id="projects-detail-projects" class="projects-detail-projects">
        <div class="container">
            <h3 class="section__title">Проекты программы <span class="text-size-lg text-color-gray section__title-sub"><?= count($arResult["ITEMS"]) ?> <?= $countDeclension->get(count($arResult["ITEMS"])) ?></span></h3>
            <div class="projects-list items-list">
                <?
                $i = 0;
                foreach ($arResult["ITEMS"] as $item) {
                    $i++;
                    if (intval($arParams["NEWS_COUNT_SHOW"]) > 0 && $i > $arParams["NEWS_COUNT_SHOW"]) {
                        break;
                    }
                ?>
                    <?
                    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div id="<?= $this->GetEditAreaId($item['ID']); ?>" class="list-item projects-item ">
                        <div class="h4 projects-item__title"><a href="<?= $item["DETAIL_PAGE_URL"] ?>"><?= $item["NAME"] ?></a></div>
                        <div class="projects-item__content">
                            <div class="text-size-lg projects-item__text"><?= $item["PREVIEW_TEXT"] ?>
                            </div>
                            <? if (!empty($item["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]) || !empty($item["DISPLAY_PROPERTIES"]["BENEFICIARY_TYPE"]["DISPLAY_VALUE"])) { ?>
                                <div class="projects-item__tags">
                                    <div class="buttons-line">
                                        <? foreach ($item["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"] as $val) { ?>
                                            <span class="btn btn-transparent tag"><?= $val ?></span>
                                        <? } ?>
                                        <? foreach ($item["DISPLAY_PROPERTIES"]["BENEFICIARY_TYPE"]["DISPLAY_VALUE"] as $val) { ?>
                                            <span class="btn btn-transparent tag"><?= $val ?></span>
                                        <? } ?>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                        <a href="<?= $item["DETAIL_PAGE_URL"] ?>" class="projects-item__image">
                            <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>" loading="lazy" alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>" />
                            </picture>
                        </a>
                    </div>
                <? } ?>
            </div>
            <div class="section__nav">
                <div class="buttons-line">
                    <?
                    $href = "/projects/";
                    if( $arParams["SOURCE_ELEMENT_ID"] == 161 )
                    {
                        $href = "/projects/programma-doroga-k-domu/";
                    }
                    if( $arParams["SOURCE_ELEMENT_ID"] == 162 )
                    {
                        $href = "/projects/programma-put-k-uspekhu/";
                    }
                    ?>
                    <a href="<?=$href;?>" class="btn">Все активные проекты
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                            <use xlink:href="#arrow"></use>
                        </svg>
                    </a>
                    <a href="/projects/?pf-1=projectFilter_253_3918974738&set_filter=y&projectFilter_253_3918974738=Y">
                        <u>Завершенные проекты</u>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                            <use xlink:href="#arrow"></use>
                        </svg>
                    </a></div>
            </div>
        </div>
    </section>

<? } ?>