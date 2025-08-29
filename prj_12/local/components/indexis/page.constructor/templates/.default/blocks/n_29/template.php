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
                        <div class="nb-services-links-menu nb-services-links-menu_opened"><a class="nb-services-links-menu__title" href="/services/ortodontiya-ispravlenie-prikusa/brekety/">Брекеты</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/20.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/ustanovka-breketov/">Установка брекетов.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/lingvalnye-brekety/">Брекеты лингвальные,</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/kombinirovannye-brekety/">комбинированные,</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/sapfirovye-brekety/">сапфировые,</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/metallicheskie-brekety/">металлические,</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/keramicheskie-brekety/">керамические,</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/brekety-camoligiruyushchie/">cамолигирующие.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/nesemnye-reteynery/">Несъемные ретейнеры.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/ortodontiya-ispravlenie-prikusa/brekety/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/ortodontiya-ispravlenie-prikusa/firmy-breketov/">Фирмы брекетов</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/19.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/firmy-breketov/damon/">Damon.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/firmy-breketov/adenta/">Adenta.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/firmy-breketov/reflection/">Reflection.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/firmy-breketov/incognito/">Incognito.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/firmy-breketov/clarity/">Clarity.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/firmy-breketov/experience/">Experience.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/ortodontiya-ispravlenie-prikusa/firmy-breketov/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/ortodontiya-ispravlenie-prikusa/elaynery/">Элайнеры</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/21.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/elaynery/elaynery-flexi-ligner/">Элайнеры Flexi ligner.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/elaynery/elaynery-evrokappa/">Элайнеры Еврокаппа.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/ortodontiya-ispravlenie-prikusa/elaynery/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/ortodontiya-ispravlenie-prikusa/apparaty/">Аппараты</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/18.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/apparaty/plastinki-na-zuby/">Пластинки на зубы.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/apparaty/kappy-dlya-ispravleniya-prikusa/">Каппы для исправления прикуса.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/apparaty/kappy-ot-bruksizma/">Каппы от бруксизма.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/apparaty/bruks-cheker/">Брукс чекер.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/ortodontiya-ispravlenie-prikusa/apparaty/sportivnye-kappy/">Спортивные каппы.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/ortodontiya-ispravlenie-prikusa/apparaty/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>