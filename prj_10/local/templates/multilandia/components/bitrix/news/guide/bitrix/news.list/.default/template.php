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

$arIconCodes = [
    'MORNING' => 'morning',
    'NOON' => 'day',
    'EVENING' => 'evening',
    'NIGHT' => 'night'
];
?>
<?if (count($arResult['GROUP_ITEMS']) > 0):?>
    <div class="shedule-section">
        <?foreach ($arResult['GROUP_ITEMS'] as $timeCode => $arItems):?>
            <div class="shedule">
                <div class="shedule__header">
                    <svg class="icon icon-<?=$arIconCodes[$timeCode]?> shedule__icon">
                        <use xlink:href="#<?=$arIconCodes[$timeCode]?>"></use>
                    </svg>
                    <p class="shedule__title"><?=GetMessage($timeCode)?></p>
                    <button class="shedule__collapse-btn" type="button">
                        <svg class="icon icon-arrowBottom">
                            <use xlink:href="#arrowBottom"></use>
                        </svg>
                    </button>
                </div>
                <div class="shedule__body">
                    <div class="shedule-list">
                        <?foreach($arItems as $arItem):?>
                            <?
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            $arMovie = isset($arResult['MOVIES'][$arItem['PROPERTIES']['MOVIE_ID']['VALUE']]) ? $arResult['MOVIES'][$arItem['PROPERTIES']['MOVIE_ID']['VALUE']] : [];
                            $movieTime = FormatDate("H:i", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                            $movieDate = FormatDate("Y-m-d H:i:s", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                            ?>
                            <div class="shedule-item">
                                <?if (isset($arMovie['DETAIL_PAGE_URL'])):?>
                                    <a class="shedule-item__link" attr-id="<?=$arItem['ID']?>" href="<?=$arMovie['DETAIL_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <?else:?>
                                    <span class="shedule-item__link" attr-id="<?=$arItem['ID']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <?endif;?>
                                    <time class="shedule-item__time" datetime="<?=$movieDate?>">
                                        <span class="time_js_change_timezone">
                                            <?=$movieTime?>
                                        </span>
                                    </time>
                                    <div class="shedule-item__img">
                                        <?
                                        $moviePictureSrc = (!empty($arMovie['PREVIEW_PICTURE'])) ? CFile::GetPath($arMovie['PREVIEW_PICTURE']) : SITE_TEMPLATE_PATH . '/img/content/cartoons/no_photo.jpg';
                                        ?>
                                        <img src="<?=$moviePictureSrc?>" alt="<?=$arMovie['NAME']?>" />
                                    </div>
                                    <div class="shedule-item__caption">
                                        <p class="shedule-item__title">
                                            <span class="shedule-item__title-text"><?=$arMovie['NAME']?></span>
                                            <?if (mb_strlen($arMovie['PROPERTY_VOZRAST_VALUE']) > 0):?>
                                                <span class="age-limit-label age-limit-label_light"><?=$arMovie['PROPERTY_VOZRAST_VALUE']?></span>
                                            <?endif;?>
                                        </p>
                                        <?if (mb_strlen($arItem['PREVIEW_TEXT']) > 0 && false):?>
                                            <div class="shedule-item__series"><?=$arItem['PREVIEW_TEXT']?></div>
                                        <?elseif (mb_strlen($arMovie['PREVIEW_TEXT']) > 0):?>
                                            <div class="shedule-item__series"><?=$arMovie['PREVIEW_TEXT']?></div>
                                        <?endif;?>
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
            </div>
        <?endforeach;?>
    </div>
<?endif;?>