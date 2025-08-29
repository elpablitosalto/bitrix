<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<? if (count($arResult['ITEMS']) > 0): ?>
    <div class="ml-live-section">
        <div class="container">
            <div class="ml-live">
                <div class="ml-live__body">
                    <div class="ml-live-list">
                        <?foreach($arResult['ITEMS'] as $arItem):?>
                            <?
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            $arMovie = isset($arResult['MOVIES'][$arItem['PROPERTIES']['MOVIE_ID']['VALUE']]) ? $arResult['MOVIES'][$arItem['PROPERTIES']['MOVIE_ID']['VALUE']] : [];
                            $movieTime = FormatDate("H:i", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                            $movieDate = FormatDate("Y-m-d H:i:s", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                            ?>
                            <div class="ml-live-item">
                                <?if (isset($arMovie['DETAIL_PAGE_URL'])):?>
                                    <a class="ml-live-item__link" href="<?=$arMovie['DETAIL_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <?else:?>
                                    <span class="ml-live-item__link" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <?endif;?>
                                    <?
                                    $moviePictureSrc = (!empty($arMovie['PREVIEW_PICTURE'])) ? CFile::GetPath($arMovie['PREVIEW_PICTURE']) : SITE_TEMPLATE_PATH . '/img/content/cartoons/no_photo.jpg';
                                    ?>
                                    <div class="ml-live-item__img">
                                        <img src="<?=$moviePictureSrc?>" alt="<?=$arMovie['NAME']?>" />
                                    </div>
                                    <div class="ml-live-item__caption">
                                        <time class="ml-live-item__time" datetime="<?=$movieDate?>">
                                            <span class="time_js_change_timezone">
                                                <?=$movieDate?>
                                            </span>
                                        </time>
                                        <p class="ml-live-item__title">
                                            <span class="ml-live-item__title-text">
                                                <?=$arMovie['NAME']?>
                                            </span>
                                            <? if (mb_strlen($arMovie['PROPERTY_VOZRAST_VALUE']) > 0): ?>
                                                <span class="age-limit-label age-limit-label_light">
                                                    <?=$arMovie['PROPERTY_VOZRAST_VALUE']?>
                                                </span>
                                            <? endif; ?>
                                        </p>
                                        <p class="ml-live-item__subtitle">
                                            <?=$arItem['NAME']?>
                                        </p>
                                    </div>
                                <?if (isset($arMovie['DETAIL_PAGE_URL'])):?>
                                    </a>
                                <?else:?>
                                    </span>
                                <?endif;?>
                            </div>
                        <?endforeach;?>
                    </div>
                </div>
                <div class="ml-live__footer">
                    <div class="ml-live__showing-now">
                        <svg class="icon icon-live">
                            <use xlink:href="#live"></use>
                        </svg>
                        <p class="ml-live__showing-now-title"><?=GetMessage('LIVE_NOW')?>: <?=$arResult['CURRENT_MOVIE']['NAME']?></p>
                    </div>
                    <button class="ml-live__toggle-btn" type="button">
                        <svg class="icon icon-collapseArrow">
                            <use xlink:href="#collapseArrow"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?endif;?>