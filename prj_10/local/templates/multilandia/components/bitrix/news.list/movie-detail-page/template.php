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
$mlTheme = "green";
if ($arParams["ML_THEME"]) {
	$mlTheme = $arParams["ML_THEME"];
}
?>
<?if (count($arResult['ITEMS']) > 0):?>

    <section class="ml-section ml-section_bg">
        <div class="container">
            <div class="ml-section-header">
                <h2 class="ml-section-title">Конкурсы</h2>
				<a class="ml-btn ml-btn_round ml-btn_<?=$mlTheme?> ml-section-btn" href="/contests/">Все конкурсы</a>
            </div>
            <div class="ml-section-body">
                <div class="ml-slider" data-desktop-items="4" data-theme="<?=$mlTheme?>">
                    <div class="ml-slider__container">
                        <div class="ml-slider__wrapper">
                            <?foreach($arResult['ITEMS'] as $arItem):?>
                            <?
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                $arMovie = $arResult['MOVIES'][$arItem['PROPERTIES']['MOVIE_ID']['VALUE']];
                                $movieTime = FormatDate("H:i", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                                $movieDate = FormatDate("d.m", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                                global $DB;
                                if(!empty($arItem['PROPERTIES']['DATE_START']['VALUE'])){
                                    $start_date = $DB->FormatDate($arItem['PROPERTIES']['DATE_START']['VALUE'], "DD.MM.YYYY", "YYYY-MM-DD");
                                    $unix_date_start = strtotime($start_date);
                                }
                                if(!empty($arItem['PROPERTIES']['DATE_END']['VALUE'])){
                                    $end_date = $DB->FormatDate($arItem['PROPERTIES']['DATE_END']['VALUE'], "DD.MM.YYYY", "YYYY-MM-DD");
                                    $unix_date_end = strtotime($end_date);
                                }


                                if(isset($unix_date_start) && isset($unix_date_end)){
                                    $now = time();
                                    if($now > $unix_date_end){
                                        $achieved = true;
                                    } else {
                                        $achieved = false;
                                    }
                                } else {
                                    if(!isset($unix_date_end)){
                                        $achieved = false;
                                    } else {
                                        if($now > $unix_date_end){
                                            $achieved = true;
                                        } else {
                                            $achieved = false;
                                        }
                                    }
                                }

                                $obParser = new CTextParser;
                                $previewText = $obParser->html_cut($arItem['DETAIL_TEXT'], 150);
                                $detailText = $arItem['DETAIL_TEXT'];
                                ?>
                            <div class="ml-slider__item">
                                <div class="anim-item anim-item_contest anim-item_dark">
                                    <a class="anim-item__link" href="<?=$arItem['DETAIL_PAGE_URL'];?>">
                                        <div class="anim-item__img">
                                            <img class="lazyload" data-src="<?=CFile::GetPath($arItem['PREVIEW_PICTURE'])?>" src="<?=CFile::GetPath($arItem['PREVIEW_PICTURE'])?>" alt=""/>
                                        </div>
                                        <div class="anim-item__caption">
                                            <p class="anim-item__title"><?=$arItem['NAME'];?></p>
											<? if (mb_strlen($previewText) > 0): ?>
												<p class="anim-item__desc">
													<?=$previewText;?>
												</p>
											<? endif; ?>
                                            <?if(!$achieved):?>
												<div class="anim-item__action">
													<span class="anim-item__dates anim-item__dates_active">
														с <?=$movieDate?>
													</span>
												</div>
                                            <?else:?>
												<div class="anim-item__action">
													<span class="anim-item__dates">
														Завершен
													</span>
												</div>
                                            <?endif;?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?endforeach;?>
                            <?/*
                            <div class="ml-slider__item">
                                <div class="anim-item anim-item_contest anim-item_dark"><a class="anim-item__link" href="#">
                                        <div class="anim-item__img"><img class="lazyload" data-src="/img/content/contests/contest2.jpg" src="/img/content/contests/contest2-thumb.jpg" alt=""/>
                                        </div>
                                        <div class="anim-item__caption">
                                            <p class="anim-item__title">Лето открытий</p>
                                            <p class="anim-item__desc">Что такое лето? Это каникулы, отпуск, тёплое солнце и яркие впечатления!Идеальное лето у каждого своё: кто-то любит отдых на природе...</p><span class="anim-item__dates">Завершен</span>
                                        </div></a></div>
                            </div>
                            <div class="ml-slider__item">
                                <div class="anim-item anim-item_contest anim-item_dark"><a class="anim-item__link" href="#">
                                        <div class="anim-item__img"><img class="lazyload" data-src="/img/content/contests/contest3.jpg" src="/img/content/contests/contest3-thumb.jpg" alt=""/>
                                        </div>
                                        <div class="anim-item__caption">
                                            <p class="anim-item__title">Поехали</p>
                                            <p class="anim-item__desc">12 апреля 1961 года молодой лётчик Юрий Гагарин совершил первый в мире полёт в космос. На космическом корабле «Восток-1» он облетел ...</p><span class="anim-item__dates">Завершен</span>
                                        </div></a></div>
                            </div>
                            <div class="ml-slider__item">
                                <div class="anim-item anim-item_contest anim-item_dark"><a class="anim-item__link" href="#">
                                        <div class="anim-item__img"><img class="lazyload" data-src="/img/content/contests/contest4.jpg" src="/img/content/contests/contest4-thumb.jpg" alt=""/>
                                        </div>
                                        <div class="anim-item__caption">
                                            <p class="anim-item__title">Волшебный остров</p>
                                            <p class="anim-item__desc">Где-то далеко-далеко, на волшебной планете Монсиленд есть чудесное место – Остров Гармонии, где живут забавные человечки Монсики. </p><span class="anim-item__dates">Завершен</span>
                                        </div></a></div>
                            </div>
                            <div class="ml-slider__item">
                                <div class="anim-item anim-item_contest anim-item_dark"><a class="anim-item__link" href="#">
                                        <div class="anim-item__img"><img class="lazyload" data-src="/img/content/contests/contest1.jpg" src="/img/content/contests/contest1-thumb.jpg" alt=""/>
                                        </div>
                                        <div class="anim-item__caption">
                                            <p class="anim-item__title">Мультикотики</p>
                                            <p class="anim-item__desc">На кого из знаменитых котов похож твой домашний питомец? Не секрет, что котики уверены в своей неотразимости и в том...</p><span class="anim-item__dates">Завершен</span>
                                        </div></a></div>
                            </div>
                            <div class="ml-slider__item">
                                <div class="anim-item anim-item_contest anim-item_dark"><a class="anim-item__link" href="#">
                                        <div class="anim-item__img"><img class="lazyload" data-src="/img/content/contests/contest2.jpg" src="/img/content/contests/contest2-thumb.jpg" alt=""/>
                                        </div>
                                        <div class="anim-item__caption">
                                            <p class="anim-item__title">Лето открытий</p>
                                            <p class="anim-item__desc">Что такое лето? Это каникулы, отпуск, тёплое солнце и яркие впечатления!Идеальное лето у каждого своё: кто-то любит отдых на природе...</p><span class="anim-item__dates">Завершен</span>
                                        </div></a></div>
                            </div>
                            <div class="ml-slider__item">
                                <div class="anim-item anim-item_contest anim-item_dark"><a class="anim-item__link" href="#">
                                        <div class="anim-item__img"><img class="lazyload" data-src="/img/content/contests/contest3.jpg" src="/img/content/contests/contest3-thumb.jpg" alt=""/>
                                        </div>
                                        <div class="anim-item__caption">
                                            <p class="anim-item__title">Поехали</p>
                                            <p class="anim-item__desc">12 апреля 1961 года молодой лётчик Юрий Гагарин совершил первый в мире полёт в космос. На космическом корабле «Восток-1» он облетел ...</p><span class="anim-item__dates">Завершен</span>
                                        </div></a></div>
                            </div>
                            <div class="ml-slider__item">
                                <div class="anim-item anim-item_contest anim-item_dark"><a class="anim-item__link" href="#">
                                        <div class="anim-item__img"><img class="lazyload" data-src="/img/content/contests/contest4.jpg" src="/img/content/contests/contest4-thumb.jpg" alt=""/>
                                        </div>
                                        <div class="anim-item__caption">
                                            <p class="anim-item__title">Волшебный остров</p>
                                            <p class="anim-item__desc">Где-то далеко-далеко, на волшебной планете Монсиленд есть чудесное место – Остров Гармонии, где живут забавные человечки Монсики. </p><span class="anim-item__dates">Завершен</span>
                                        </div></a></div>
                            </div>
                            */?>
                        </div>
                    </div>
                </div>
            </div>
			<div class="ml-section-footer"><a class="ml-btn ml-btn_round ml-btn_<?=$mlTheme?> ml-section-btn" href="/contests/">Все конкурсы</a></div>
        </div>
    </section>

<?/*
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
*/?>

<?endif;?>