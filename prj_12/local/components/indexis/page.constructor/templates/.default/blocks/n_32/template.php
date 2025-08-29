<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];

//$arPropertieValue = $item['DISPLAY_PROPERTIES']['DEV_516']['VALUE'];
?>
<section class="nb-section nb-services-links-section" <?/*?>id="services"<?*/ ?> id="<?= $arParams['BLOCK_AREA_ID'] ?>">
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
                        <div class="nb-services-links-menu nb-services-links-menu_opened"><a class="nb-services-links-menu__title" href="/services/profilaktika-i-otbelivanie/otbelivanie/">Отбеливание</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/24.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/otbelivanie/fotootbelivanie/">Фотоотбеливание.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/otbelivanie/flash/">Flash.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/otbelivanie/philips-zoom-4-white-speed/">Philips Zoom 4! White Speed.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/otbelivanie/otbelivanie-opalescence/">Отбеливание Opalescence.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/otbelivanie/domashnee-otbelivanie/">Домашнее отбеливание.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/otbelivanie/amazing-white/">Amazing White.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/otbelivanie/whiteness/">Whiteness.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/profilaktika-i-otbelivanie/otbelivanie/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/">Профессиональная гигиена</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/25.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/chistka-zubov/">Чистка зубов.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/air-flow/">Air Flow.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/ultrazvukovaya-chistka-zubov/">Ультразвуковая чистка зубов.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/kompleksnaya-chistka/">Комплексная чистка.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/chistka-zubov-slinpro/">Чистка зубов Сlinpro.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/polirovka-i-shlifovka-zubov/">Полировка и шлифовка зубов.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/remineralizatsiya-emali-zubov/">Реминерализация эмали </a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/26.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/remineralizatsiya-emali-zubov/">Методика восстановления минерального состава и плотности зубной эмали.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/remineralizatsiya-emali-zubov/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/ftorirovanie/">Фторирование</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/30.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <?/*?><li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="#">Укрепление зубной эмали.</a></li><?*/ ?>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/ftorirovanie/">Укрепление зубной эмали. Обработка эмали зубов специальным раствором.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/ftorirovanie/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>