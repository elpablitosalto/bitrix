<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?><section class="nb-section nb-services-links-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') : ?>
            <div class="nb-section__header">
                <h2 class="nb-section__title desktop">Стоматологические услуги <span class="font-weight_normal">в клинике «Белый кролик»</span></h2>
                <p class="nb-section__title mobile">Стоматологические услуги <br><span class="font-weight_normal">в клинике «Белый кролик»</span></p>
            </div>
        <? endif; ?>
        <div class="nb-section__body">
            <div class="nb-services-links">
                <div class="nb-services-links__row">
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu nb-services-links-menu_opened">
                            <a class="nb-services-links-menu__title" href="/services/implantatsiya-zubov/">Имплантация</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/services-links/service-1.png" alt="" /></div>

                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/vidy-implantatsii/odnoetapnaya-implantatsiya/">Одномоментная.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/vidy-implantatsii/klassicheskaya-implantatsiya-zubov/">Классическая.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/vidy-implantatsii/mini-implantatsiya/">Мини.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/sinus-lifting/">Синус-лифтинг.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/osteoplastika/">Остеопластика.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/implant-pod-klyuch/dentium-s-koronkoy/">Dentium.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/implant-pod-klyuch/neobiotech-s-koronkoy/">Neobiotech.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/implant-pod-klyuch/straumann-s-koronkoy/">Straumann.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link nb-services-links-menu__link_more" href="/services/implantatsiya-zubov/">Ещё...</a></li>
                                    </ul>
                                    <a class="nb-services-links-menu__section-link" href="/services/implantatsiya-zubov/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu">
                            <a class="nb-services-links-menu__title" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/">Все на имплантах</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/services-links/service-2.png" alt="" /></div>

                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/nesemnoe-protezirovanie/all-on-4-vse-zuby-na-4-implantakh/">All-on-4®.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/nesemnoe-protezirovanie/all-on-6-nesemnyy-protez/">All-on-6®.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/nesemnoe-protezirovanie/all-on-8/">All-on-8®.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/nesemnoe-protezirovanie/zubnoy-most-na-implantakh/">Зубной мост.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/nesemnoe-protezirovanie/koronka-na-implante/">Коронка на импланте.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/semnoe-protezirovanie/">Съемное протезирование.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link nb-services-links-menu__link_more" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/">Ещё...</a></li>
                                    </ul>
                                    <a class="nb-services-links-menu__section-link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu">
                            <a class="nb-services-links-menu__title" href="/services/protezirovanie/">Протезирование</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/services-links/service-3.png" alt="" /></div>

                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item">Коронки:</li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/koronki-na-zuby/metallokeramicheskie-koronki/">Металлокерамические.</a></li>
                                        <?/*?><li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="#">Керамические.</a></li><?*/ ?>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/koronki-na-zuby/keramicheskie-koronki-e-max/">Керамические E.max.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/koronki-na-zuby/tsirkonievye-koronki/">Циркониевые.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/viniry-na-zuby/">Виниры.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/semnoe/">Съемное протезирование.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link nb-services-links-menu__link_more" href="/services/protezirovanie/">Ещё...</a></li>
                                    </ul>
                                    <a class="nb-services-links-menu__section-link" href="/services/protezirovanie/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu">
                            <a class="nb-services-links-menu__title" href="/services/ortodontiya-ispravlenie-prikusa/">Исправление прикуса</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/services-links/service-4.png" alt="" /></div>

                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/ustanovka-breketov/">Брекеты:</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/kombinirovannye-brekety/">Комбинированные.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/sapfirovye-brekety/">Сапфировые.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/metallicheskie-brekety/">Металлические.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/keramicheskie-brekety/">Керамические.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/elaynery/">Элайнеры.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/apparaty/">Аппараты.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link nb-services-links-menu__link_more" href="/services/ortodontiya-ispravlenie-prikusa/">Ещё...</a></li>
                                    </ul>
                                    <a class="nb-services-links-menu__section-link" href="/services/ortodontiya-ispravlenie-prikusa/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu">
                            <a class="nb-services-links-menu__title" href="/services/lechenie-zubov/">Лечение зубов</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/services-links/service-5.png" alt="" /></div>

                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/lechenie-zubov/lechenie/karies/">Кариес.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/lechenie-zubov/lechenie/lechenie-kariesa-icon/">Icon.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/lechenie-zubov/lechenie/lechenie-kariesa-pod-mikroskopom/">Лечение под микроскопом.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/lechenie-zubov/lechenie/lechenie-kisty-zuba/">Лечение кисты.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/lechenie-zubov/lechenie/udalenie-zubnogo-nerva/">Удаление нерва.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/lechenie-zubov/lechenie/plombirovanie/">Пломбирование.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link nb-services-links-menu__link_more" href="/services/lechenie-zubov/">Ещё...</a></li>
                                    </ul>
                                    <a class="nb-services-links-menu__section-link" href="/services/lechenie-zubov/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu">
                            <a class="nb-services-links-menu__title" href="/services/khirurgiya/">Хирургия</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/services-links/service-6.png" alt="" /></div>

                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/udalenie-zubov/">Удаление зубов.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/udalenie-zubov/udalenie-zuba-mudrosti/">Зубы мудрости.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/khirurgicheskie-operatsii/">Операции.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/vestibuloplastika/">Вестибулопластика.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/kyuretazh-karmana/">Кюретаж кармана.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/khirurgicheskoe-lechenie/">Хирургическое лечение.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link nb-services-links-menu__link_more" href="/services/khirurgiya/">Ещё...</a></li>
                                    </ul>
                                    <a class="nb-services-links-menu__section-link" href="/services/khirurgiya/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu">
                            <a class="nb-services-links-menu__title" href="/services/diagnostika-zubov/">Диагностика</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/services-links/service-7.png" alt="" /></div>

                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/diagnostika-zubov/rentgen-zubov/">Рентген.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/diagnostika-zubov/panoramnyy-snimok/">Панорамный снимок.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/diagnostika-zubov/pritselnyy-snimok/">Прицельный снимок.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/diagnostika-zubov/kompyuternaya-tomografiya-zubov/">Компьютерная томография.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link nb-services-links-menu__link_more" href="/services/diagnostika-zubov/">Ещё...</a></li>
                                    </ul>
                                    <a class="nb-services-links-menu__section-link" href="/services/diagnostika-zubov/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu">
                            <a class="nb-services-links-menu__title" href="/services/profilaktika-i-otbelivanie/">Профилактика, отбеливание</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/services-links/service-8.png" alt="" /></div>

                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/otbelivanie/">Отбеливание.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/otbelivanie/otbelivanie-opalescence/">Opalescence.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/otbelivanie/flash/">Flash.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/">Профессиональная гигиена.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/air-flow/">Air Flow.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/kompleksnaya-chistka/">Комплексная чистка.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link nb-services-links-menu__link_more" href="/services/profilaktika-i-otbelivanie/">Ещё...</a></li>
                                    </ul>
                                    <a class="nb-services-links-menu__section-link" href="/services/profilaktika-i-otbelivanie/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>