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

    <div class="ml-section-body">
        <div class="shedule-list">

            <? foreach($arResult['ITEMS'] as $arItem):

                $arMovie = $arResult['MOVIES'][$arItem['PROPERTIES']['MOVIE_ID']['VALUE']];
                $episodeTimeStart = FormatDate("H:i", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                $episodeFullTimeStart = FormatDate("DD.MM.YYYY HH:MI:SS", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                $episodeDateStart = FormatDate("Y-m-d H:i:s", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                $episodeDateStartFormat = FormatDate("d.m", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                $episodeStartTimeUnix = MakeTimeStamp($arItem['PROPERTIES']['DATE_START']['VALUE'], 'DD.MM.YYYY HH:MI:SS'); //12.03.2023 23:00:00

                //Check Current Day Episode
                $episodeDateStartFormatFull = FormatDate("d.m.Y", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                $currentDateFormatFull = FormatDate("d.m.Y", time());
                //End Check Current Day Episode

                if($episodeDateStartFormatFull === $currentDateFormatFull) {
                    $episodeDayOrDate = 'Сегодня';
                } else {
                    $episodeDayOrDate = $episodeDateStartFormat;
                }

                //Hidden Episode if He is end
                if(time() > $episodeStartTimeUnix) {
                    continue;
                }
                ?>

                <div class="shedule-item" attr-id="<?=$arItem['ID']?>">
                    <a class="shedule-item__link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                        <time class="shedule-item__time" datetime="<?=$episodeDateStart?>">
                            <span>
                                <?=$episodeDayOrDate?>
                            </span>
                            <span class="time_js_change_timezone">
                                <?=$episodeTimeStart?>
                            </span>
                        </time>
                        <div class="shedule-item__img">
                            <img src="<?=CFile::GetPath($arItem['PREVIEW_PICTURE'])?>" alt="<?=$arItem['NAME']?>">
                        </div>
                        <div class="shedule-item__caption">
                            <p class="shedule-item__title">
                                <span class="shedule-item__title-text">
                                    <?=$arItem['NAME']?>
                                </span>
                                <? if (mb_strlen($arMovie['PROPERTY_VOZRAST_VALUE']) > 0): ?>
                                    <span class="age-limit-label age-limit-label_light">
                                        <?=$arMovie['PROPERTY_VOZRAST_VALUE']?>
                                    </span>
                                <? endif; ?>
                            </p>
                            <?if (mb_strlen($arMovie['PREVIEW_TEXT']) > 0):?>
                                <div class="shedule-item__series">
                                    <?=$arMovie['PREVIEW_TEXT']?>
                                </div>
                            <?endif;?>
                        </div>
                    </a>
                </div>
            <? endforeach; ?>

        </div>
    </div>

<? endif; ?>