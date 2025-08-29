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
<?if (count($arResult['ITEMS']) > 0):?>

    <section class="ml-section shedule-cartoon" style="margin-bottom:0;">
        <div class="container">
            <div class="ml-section-header">
                <h2 class="ml-section-subtitle">Расписание</h2>
            </div>
            <div class="ml-section-body">
                <div class="shedule-list timetable-items">
                    <?foreach($arResult['ITEMS'] as $arItem):?>
                    <div class="shedule-item timetable-item"><a class="shedule-item__link" href="<?=$arItem['DETAIL_PAGE_URL'];?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <?
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                $movieTime = FormatDate("H:i", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                                $movieDate = FormatDate("d.m.Y", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                                $movieDateShort = FormatDate("d.m", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                                $is_today = (FormatDate("d.m.Y", time()) == $movieDate);
                            ?>
                            <time class="shedule-item__time" datetime="12:05">
                                <span>
                                    <?=$is_today ? 'Сегодня' : $movieDateShort;?>
                                </span>
                                <span>
                                    <?=$movieTime;?>
                                </span>
                            </time>
                            <?
                            $arSelect = Array("IBLOCK_ID", "ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_*");
                            $arFilter = Array("IBLOCK_ID"=>1, "ID"=>$arItem['PROPERTIES']['MOVIE_ID']['VALUE']);
                            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
                            if($ob = $res->GetNextElement())
                            {
                                $arFields = $ob->GetFields();
                                $arProperties = $ob->GetProperties();
                            }
                            ?>
                            <div class="shedule-item__img">
                                <img src="<?=CFile::GetPath($arFields['PREVIEW_PICTURE']);?>" alt="<?=$arFields['NAME'];?>">
                            </div>
                            <div class="shedule-item__caption">
                                <p class="shedule-item__title">
                                    <span class="shedule-item__title-text">
                                        <?=$arFields['NAME'];?>
                                    </span>
                                    <span class="age-limit-label age-limit-label_light">
                                        <?=$arProperties['VOZRAST']['VALUE'];?>
                                    </span>
                                </p>
                                <ul class="shedule-item__series">
                                    <?foreach($arProperties['TEGI']['VALUE'] as $tag_value):?>
                                    <li class="shedule-item__series-item"><?=$tag_value;?></li>
                                    <?endforeach;?>
                                </ul>
                            </div>
                        </a>
                    </div>
                    <?endforeach;?>
                </div>
            </div>
        </div>
    </section>
    <div id="pag-timetable">
        <?=$arResult["NAV_STRING"]?>
    </div>

<!--
    <div class="ml-live-section">
        <div class="container">
            <div class="ml-live">
                <div class="ml-live__body">
                    <div class="ml-live-list">
                        <?foreach($arResult['ITEMS'] as $arItem):?>
                            <?
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            $arMovie = $arResult['MOVIES'][$arItem['PROPERTIES']['MOVIE_ID']['VALUE']];
                            $movieTime = FormatDate("H:i", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                            $movieDate = FormatDate("Y-m-d H:i:s", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                            ?>
                            <div class="ml-live-item">
                                <a class="ml-live-item__link" href="<?=$arMovie['DETAIL_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                    <div class="ml-live-item__img">
                                        <img src="<?=CFile::GetPath($arMovie['PREVIEW_PICTURE'])?>" alt="<?=$arMovie['NAME']?>" />
                                    </div>
                                    <div class="ml-live-item__caption">
                                        <time class="ml-live-item__time" datetime="<?=$movieDate?>"><?=$movieTime?></time>
                                        <p class="ml-live-item__title">
                                            <span class="ml-live-item__title-text"><?=$arMovie['NAME']?></span>
                                            <?if (mb_strlen($arMovie['PROPERTY_VOZRAST_VALUE']) > 0):?>
                                                <span class="age-limit-label age-limit-label_light"><?=$arMovie['PROPERTY_VOZRAST_VALUE']?></span>
                                            <?endif;?>
                                        </p>
                                        <p class="ml-live-item__subtitle"><?=$arItem['NAME']?></p>
                                    </div>
                                </a>
                            </div>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
<?endif;?>