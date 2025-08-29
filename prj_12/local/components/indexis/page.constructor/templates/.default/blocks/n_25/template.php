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
                        <div class="nb-services-links-menu nb-services-links-menu_opened"><a class="nb-services-links-menu__title" href="/services/protezirovanie/koronki-na-zuby/">Коронки</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/3.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/koronki-na-zuby/metallokeramicheskie-koronki/">Металлокерамические.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/koronki-na-zuby/keramicheskie-koronki-e-max/">Керамические E.max.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/koronki-na-zuby/tsirkonievye-koronki/">Циркониевые.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/koronki-na-zuby/mostovidnye-koronki/">Мостовидные.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/koronki-na-zuby/vremennye-koronki/">Временные.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/protezirovanie/koronki-na-zuby/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/protezirovanie/viniry-na-zuby/">Виниры</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/11.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <?/*?><li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="#">Композитные.</a></li><?*/ ?>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/viniry-na-zuby/kompozitnye-viniry-terapevticheskie/">Композитные-Терапевтические.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/viniry-na-zuby/tsirkonievye-viniry/">Циркониевые.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/viniry-na-zuby/keramicheskie-viniry-e-max/">Керамические E.max.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/viniry-na-zuby/ultratonkie-viniry/">Ультратонкие.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/protezirovanie/viniry-na-zuby/">Перейти в раздел</a>
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
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/semnoe/akrilovyy/">Акриловый.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/semnoe/neylonovyy/">Нейлоновый.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/semnoe/akri-fri/">Акри Фри.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/semnoe/byugelnyy/">Бюгельный.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/semnoe/kvadrotti/">Квадротти.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/protezirovanie/semnoe/immediat-protez-babochka/">Иммедиат-протез «Бабочка».</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/vosstanovlenie-vsekh-zubov-na-implantakh/semnoe-protezirovanie/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/protezirovanie/vkladki/">Вкладки</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/29.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/vestibuloplastika/">Изготавливается в зуботехнической лаборатории по индивидуальным слепкам.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/protezirovanie/vkladki/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>