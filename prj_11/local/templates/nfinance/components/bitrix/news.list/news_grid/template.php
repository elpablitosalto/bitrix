<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Type\DateTime;

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
<? if (!empty($arResult["ITEMS"])): ?>
    <div class="news-grid news-grid_layout_s">
        <div class="news-grid__container">
            <div class="news-grid__wrapper">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                        $obNewsDate = !empty($arItem["ACTIVE_FROM"]) ? (new DateTime($arItem["ACTIVE_FROM"], 'd.m.Y H:i:s')) : (new DateTime($arItem["DATE_CREATE"], 'd.m.Y H:i:s'));
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="news-grid__item">
                        <!-- begin .news-item-->
                        <div class="news-item news-item_type_secondary news-grid__panel">
                            <div class="news-item__content">
                                <div class="news-item__header">
                                    <div class="news-item__illustration">
                                        <picture class="news-item__picture">
                                            <?if(!empty($arItem["PREVIEW_PICTURE"]["SRC"])):?>
                                                <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" class="news-item__image" />
                                            <?endif;?>
                                        </picture>
                                    </div>
                                    <div class="news-item__date"><?= $obNewsDate->format('d.m.Y') ?></div>
                                </div>
                                <div class="news-item__main">
                                    <div class="news-item__title"><?= $arItem["NAME"] ?></div>
                                    <div class="news-item__description"><?= htmlspecialchars_decode($arItem["PREVIEW_TEXT"]) ?></div>
                                    <div class="news-item__controls">
                                    <div class="news-item__control">
                                        <!-- begin .button-->
                                        <a class="button button_style_secondary button_size_m button_width_full" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                                            <span class="button__holder">
                                                <span class="button__text">Читать</span>
                                            </span>
                                        </a>
                                        <!-- end .button-->
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end .news-item-->
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
<? endif; ?>