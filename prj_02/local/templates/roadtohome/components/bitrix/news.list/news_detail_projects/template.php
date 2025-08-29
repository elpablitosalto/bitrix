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
//vardump($arResult["ITEMS"]);
?>
<? if (!empty($arResult["ITEMS"])) {
?>

    <div class="container">
        <h3 class="section__title">Вас могут заинтересовать проекты</h3>
        <div class="projects-list items-list">
            <?
            foreach ($arResult["ITEMS"] as $key => $item) {
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
                <div class="list-item projects-item " id="<?= $this->GetEditAreaId($item['ID']); ?>">
                    <div class="h4 projects-item__title"><a href="<?= $item["DETAIL_PAGE_URL"] ?>"><?= $item["NAME"] ?></a></div>
                    <div class="projects-item__content">
                        <? if ($item["PREVIEW_TEXT"]) { ?>
                            <div class="text-size-lg projects-item__text"><?= $item["PREVIEW_TEXT"]; ?></div>
                        <? } ?>
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
                    <? if ($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]) { ?>
                        <a target="_self" href="<?= $item["DETAIL_PAGE_URL"] ?>" class="projects-item__image">
                            <picture>
                                <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>" loading="lazy" alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>" />
                            </picture>
                        </a>
                    <? } ?>
                </div>
            <?
            }
            ?>
            <? /* ?>
                <div class="list-item projects-item ">
                    <div class="h4 projects-item__title"><a href="project-card.html">Команда мечты</a></div>
                    <div class="projects-item__content">
                        <div class="text-size-lg projects-item__text">Реабилитация и социализация детей и
                            подростков с инвалидностью (умственной отсталостью, аутизмом, синдромом Дауна,
                            нарушениями зрения и другими ограниченными возможностями здоровья); поддержка семей,
                            воспитывающих детей-инвалидов.</div>
                        <div class="projects-item__tags">
                            <div class="buttons-line"><span class="btn btn-transparent tag">Череповец</span><span class="btn btn-transparent tag">Семьям с детьми</span>
                            </div>
                        </div>
                    </div><a href="project-card.html" class="projects-item__image">
                        <picture>
                            <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/temp/70.jpg" loading="lazy" alt="" title="" />
                        </picture>
                    </a>
                </div>
                <? */ ?>
        </div>
        <div class="section__nav">
            <a href="<?= $arParams["URL_ALL_PROJECTS"]; ?>">
                <u>Смотреть проекты</u>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                    <use xlink:href="#arrow"></use>
                </svg>
            </a>
        </div>
    </div>

<? } ?>