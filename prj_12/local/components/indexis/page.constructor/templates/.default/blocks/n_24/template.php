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
                        <div class="nb-services-links-menu nb-services-links-menu_opened"><a class="nb-services-links-menu__title" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/nesemnoe-protezirovanie/">Несъемное протезирование</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/2-1.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/nesemnoe-protezirovanie/all-on-4-vse-zuby-na-4-implantakh/">All-on-4® — все зубы на 4 имплантах.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/nesemnoe-protezirovanie/all-on-6-nesemnyy-protez/">All-on-6® — все зубы на 6 имплантах.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/nesemnoe-protezirovanie/all-on-8/">All-on-8® — все зубы на 8 имплантах.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/nesemnoe-protezirovanie/zubnoy-most-na-implantakh/">Мост на имплантах.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/nesemnoe-protezirovanie/koronka-na-implante/">Коронка на импланте.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/nesemnoe-protezirovanie/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/semnoe-protezirovanie/">Съемное протезирование</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/2.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/semnoe-protezirovanie/protez-na-mini-implantakh/">Протез на мини-имплантах.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/semnoe-protezirovanie/semnyy-protez-na-2-implantakh/">Съемный протез на 2 имплантах.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/semnoe-protezirovanie/balochnyy-protez-na-implantakh/">Балочный протез на имплантах.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/semnoe-protezirovanie/polnyy-semnyy-protez-na-implantakh/">Полный съемный протез на имплантах.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/semnoe-protezirovanie/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/lechenie-zubov/kompleksnoe-lechenie-vsekh-zubov-za-1-den/">Все зубы за 1 день</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/9-2.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <?/*?><li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/lechenie-zubov/kompleksnoe-lechenie-vsekh-zubov-za-1-den/">Восстановление эстетики и функциональности за 1 день. </a></li><?*/ ?>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/lechenie-zubov/kompleksnoe-lechenie-vsekh-zubov-za-1-den/">Восстановление эстетики и функциональности за 1 день. Протез устанавливается сразу после имплантации в тот же день.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/lechenie-zubov/kompleksnoe-lechenie-vsekh-zubov-za-1-den/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/implantatsiya-zubov/vidy-implantatsii/implantatsiya-po-khirurgicheskomu-shablonu/">Цифровые решения</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/31.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <?/*?><li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="#">3D моделирование.</a></li><?*/ ?>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/implantatsiya-zubov/vidy-implantatsii/implantatsiya-po-khirurgicheskomu-shablonu/">Хирургический шаблон максимально повышает точность установки, сокращает реабилитационный период.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/implantatsiya-zubov/vidy-implantatsii/implantatsiya-po-khirurgicheskomu-shablonu/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>