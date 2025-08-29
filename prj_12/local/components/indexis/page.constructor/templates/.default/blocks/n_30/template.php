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
                        <div class="nb-services-links-menu nb-services-links-menu_opened"><a class="nb-services-links-menu__title" href="/services/parodontologiya-lechenie-desen/lechenie-desen/">Лечение десен</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/22.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/lechenie-desen/lechenie-gingivita/">Лечение гингивита.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/lechenie-desen/lechenie-parodontita/">Лечение пародонтита.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/lechenie-desen/lechenie-parodontoza/">Лечение пародонтоза.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/lechenie-desen/zakrytie-retsessii/">Закрытие рецессии.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/lechenie-desen/vospaleniya-i-krovotechenie/">Воспаления и кровотечение.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/lechenie-desen/shinirovanie-zubov/">Шинирование зубов.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/parodontologiya-lechenie-desen/lechenie-desen/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/khirurgiya/khirurgicheskoe-lechenie/">Хирургическое лечение</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/13.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/khirurgicheskoe-lechenie1/kyuretazh-desen/">Кюретаж десен.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/khirurgicheskoe-lechenie1/gingivektomiya/">Гингивэктомия.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/khirurgicheskoe-lechenie1/frenuloplastika/">Френулопластика.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/khirurgicheskoe-lechenie1/gingivoplastika/">Гингивопластика.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/khirurgicheskoe-lechenie1/loskutnaya-operatsiya/">Лоскутная операция.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/khirurgicheskoe-lechenie1/issechenie-desnevogo-kapyushona/">Иссечение десневого капюшона.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/khirurgiya/khirurgicheskoe-lechenie/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/parodontologiya-lechenie-desen/konservativnoe-lechenie/">Консервативное лечение</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/15.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/parodontologiya-lechenie-desen/konservativnoe-lechenie/">Безоперационные методики используются, когда хирургической операции еще можно избежать. </a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/parodontologiya-lechenie-desen/konservativnoe-lechenie/">Перейти в раздел</a>
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
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/kompleksnaya-chistka/">Комплексная чистка.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/ultrazvukovaya-chistka-zubov/">Ультразвуковая чистка зубов - удаление зубного камня.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/chistka-zubov/">Чистка зубов.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/air-flow/"> Air Flow.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/profilaktika-i-otbelivanie/professionalnaya-gigiena/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>