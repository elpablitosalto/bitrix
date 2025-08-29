<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];

//$arPropertieValue = $item['DISPLAY_PROPERTIES']['DEV_516']['VALUE'];
?><section class="nb-section nb-services-links-section" <?/*?>id="services"<?*/ ?> id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') : ?>
            <div class="nb-section__header">
                <? require __DIR__ . "/../../title.php"; ?>
            </div>
        <? endif; ?>
        <div class="nb-section__body">
            <div class="nb-services-links">
                <div class="nb-services-links__row">
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu nb-services-links-menu_opened"><a class="nb-services-links-menu__title" href="/services/implantatsiya-zubov/implant-pod-klyuch/">Имплантация под ключ</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/services-links/28.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/implant-pod-klyuch/dentium-s-koronkoy/">Dentium с коронкой.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/implant-pod-klyuch/neobiotech-s-koronkoy/">Neobiotech с коронкой.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/implant-pod-klyuch/straumann-s-koronkoy/">Straumann с коронкой.</a></li>
                                        <!--                              <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link nb-services-links-menu__link_more" href="#">Ещё...</a></li>-->
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/implantatsiya-zubov/implant-pod-klyuch/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/implantatsiya-zubov/vidy-implantatsii/">Виды имплантации</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/services-links/1.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/vidy-implantatsii/implantatsiya-po-khirurgicheskomu-shablonu/">По хирургическому шаблону.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/vidy-implantatsii/srazu-s-udaleniem-zuba/">С удалением зуба.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/vidy-implantatsii/odnoetapnaya-implantatsiya/">Одноэтапная.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/vidy-implantatsii/klassicheskaya-implantatsiya-zubov/">Классическая.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/vidy-implantatsii/implantatsiya-pri-parodontoze/">При пародонтозе.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/vidy-implantatsii/mini-implantatsiya/">Мини имплантация.</a></li>
                                        <!--                              <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link nb-services-links-menu__link_more" href="#">Ещё...</a></li>-->
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/implantatsiya-zubov/vidy-implantatsii/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/implantatsiya-zubov/sinus-lifting/">Синус-лифтинг </a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/services-links/13.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/sinus-lifting/sinus-lifting-zakrytyy/">Синус-лифтинг закрытый.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/sinus-lifting/sinus-lifting-otkrytyy/">Синус-лифтинг открытый.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/sinus-lifting/sinus-lifting-odnovremenno-s-implantatsiey/">Синус-лифтинг одновременно с имплантацией.</a></li>
                                        <!--                              <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link nb-services-links-menu__link_more" href="#">Ещё...</a></li>-->
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/implantatsiya-zubov/sinus-lifting/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/implantatsiya-zubov/osteoplastika/">Остеопластика</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/services-links/14.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/osteoplastika/kostnaya-plastika-pri-atrofii/">Костная пластика при атрофии.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/osteoplastika/narashchivanie-kostnoy-tkani/">Наращивание костной ткани.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/osteoplastika/plastika-desny/">Пластика десны.</a></li>
                                        <!--                              <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link nb-services-links-menu__link_more" href="#">Ещё...</a></li>-->
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/implantatsiya-zubov/osteoplastika/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>