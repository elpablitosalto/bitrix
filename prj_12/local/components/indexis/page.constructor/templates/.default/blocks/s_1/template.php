<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$item = $arParams['ITEM'];
?>
<section class="nb-section nb-implantology-section" id="<?=$arParams['BLOCK_AREA_ID']?>">
    <div class="container" id="<?=$arParams['EDIT_AREA_ID']?>">
        <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y' || mb_strlen($item['DISPLAY_PROPERTIES']['S_1_DESCRIPTION']['~VALUE']['TEXT']) > 0):?>
            <div class="nb-section__header">
                <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
                    <?require __DIR__ . "/../../title.php";?>
                <?endif;?>

                <? if (mb_strlen($item['DISPLAY_PROPERTIES']['S_1_DESCRIPTION']['~VALUE']['TEXT']) > 0): ?>
                    <div class="nb-section__desc">
                        <?= $item['DISPLAY_PROPERTIES']['S_1_DESCRIPTION']['~VALUE']['TEXT'] ?>
                    </div>
                <? endif; ?>
            </div>
        <?endif;?>
        <div class="nb-section__body">
            <div class="nb-implantology nb-implantology-slider">
                <div class="nb-implantology-menu">
                    <div class="nb-implantology-menu__container">
                        <ul class="nb-implantology-menu__list">
                            <li class="nb-implantology-menu__item nb-implantology-menu__item_active">STRAUMANN</li>
                            <li class="nb-implantology-menu__item">DENTIUM</li>
                            <li class="nb-implantology-menu__item">NEOBIOTECH</li>
                        </ul>
                    </div>
                </div>
                <div class="nb-implantology-slider__container">
                    <div class="nb-implantology-slider__list">
                        <div class="nb-implantology-slider__item">
                            <div class="nb-implantology-item">
                                <div class="nb-implantology-item__top">
                                    <div class="nb-implantology-item__header">
                                        <div class="nb-implantology-item__title">STRAUMANN</div>
                                        <p class="nb-implantology-item__country">Швейцария</p>
                                    </div>
                                    <ul class="nb-implantology-item__fatures">
                                        <li class="nb-implantology-item__fatures-item">Премиум-класс</li>
                                        <li class="nb-implantology-item__fatures-item">Приживаемость 99%</li>
                                        <li class="nb-implantology-item__fatures-item">Скорость приживления <br>3-4 недели</li>
                                        <li class="nb-implantology-item__fatures-item">Высокая прочность</li>
                                    </ul>
                                    <div class="nb-implantology-item__img"><img src="<?=SITE_TEMPLATE_PATH?>/img/content/implantology/implant1.png" alt=""></div>
                                </div>
                                <div class="nb-implantology-item__middle">
                                    <div class="nb-implantology-item__price">
                                        <div class="nb-implantology-item__price-old"><span class="nb-implantology-item__price-old-title">Цена с установкой:</span> <span class="nb-implantology-item__price-old-value">125 000 &#8381;</span>
                                        </div>
                                        <div class="nb-implantology-item__price-actual">115 000 &#8381;</div>
                                    </div>
                                    <div class="nb-implantology-item__desc">
                                        <p>Установка премиум имплантов Straumann (Швейцария). Беремся за сложные случаи! · Без выходных. Premium по цене business. Первоклассные врачи. Персональный подход.</p>
                                    </div>
                                </div>
                                <div class="nb-implantology-item__bottom"><a class="nb-btn nb-implantology-item__btn" href="https://rabbitstom.ru/services/implantatsiya-zubov/implant-pod-klyuch/straumann-s-koronkoy/">Подробнее</a>
                                    <div class="nb-implantology-item__logo"><img src="<?=SITE_TEMPLATE_PATH?>/img/content/implantology/logo1.png" alt=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="nb-implantology-slider__item">
                            <div class="nb-implantology-item">
                                <div class="nb-implantology-item__top">
                                    <div class="nb-implantology-item__header">
                                        <div class="nb-implantology-item__title">DENTIUM</div>
                                        <p class="nb-implantology-item__country">Южная Корея</p>
                                    </div>
                                    <ul class="nb-implantology-item__fatures">
                                        <li class="nb-implantology-item__fatures-item">Премиальное качество при доступной цене</li>
                                        <li class="nb-implantology-item__fatures-item">Приживаемость 98%</li>
                                        <li class="nb-implantology-item__fatures-item">Биосовместимая резьба</li>
                                        <li class="nb-implantology-item__fatures-item">Универсальность</li>
                                    </ul>
                                    <div class="nb-implantology-item__img"><img src="<?=SITE_TEMPLATE_PATH?>/img/content/implantology/implant2.png" alt=""></div>
                                </div>
                                <div class="nb-implantology-item__middle">
                                    <div class="nb-implantology-item__price">
                                        <div class="nb-implantology-item__price-old"><span class="nb-implantology-item__price-old-title">Цена с установкой:</span> <span class="nb-implantology-item__price-old-value">115 000 &#8381;</span>
                                        </div>
                                        <div class="nb-implantology-item__price-actual">105 000 &#8381;</div>
                                    </div>
                                    <div class="nb-implantology-item__desc">
                                        <p>Компания Dentium была основана в Южной Корее в июне 2000 года, и с самого начала своей работы была ориентирована на создание систем для дентальной имплантации непревзойденного качества.</p>
                                    </div>
                                </div>
                                <div class="nb-implantology-item__bottom"><a class="nb-btn nb-implantology-item__btn" href="https://rabbitstom.ru/services/implantatsiya-zubov/implant-pod-klyuch/dentium-s-koronkoy/">Подробнее</a>
                                    <div class="nb-implantology-item__logo"><img src="<?=SITE_TEMPLATE_PATH?>/img/content/implantology/logo2.png" alt=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="nb-implantology-slider__item">
                            <div class="nb-implantology-item">
                                <div class="nb-implantology-item__top">
                                    <div class="nb-implantology-item__header">
                                        <div class="nb-implantology-item__title">NEOBIOTECH</div>
                                        <p class="nb-implantology-item__country">Южная Корея</p>
                                    </div>
                                    <ul class="nb-implantology-item__fatures">
                                        <li class="nb-implantology-item__fatures-item">Стандартный класс</li>
                                        <li class="nb-implantology-item__fatures-item">Приживаемость 98%</li>
                                        <li class="nb-implantology-item__fatures-item">Максимальная фиксация и стабильность</li>
                                        <li class="nb-implantology-item__fatures-item">SLA поверхность</li>
                                    </ul>
                                    <div class="nb-implantology-item__img"><img src="<?=SITE_TEMPLATE_PATH?>/img/content/implantology/implant3.png" alt=""></div>
                                </div>
                                <div class="nb-implantology-item__middle">
                                    <div class="nb-implantology-item__price">
                                        <div class="nb-implantology-item__price-old"><span class="nb-implantology-item__price-old-title">Цена с установкой:</span> <span class="nb-implantology-item__price-old-value">105 000 &#8381;</span>
                                        </div>
                                        <div class="nb-implantology-item__price-actual">95 000 &#8381;</div>
                                    </div>
                                    <div class="nb-implantology-item__desc">
                                        <p>Система Neobiotech – отвечает всем критериям качества, начиная с материала и заканчивая конструкцией, которая может выдерживать большие нагрузки и давление, гарантируя максимальный срок службы имплантов.</p>
                                    </div>
                                </div>
                                <div class="nb-implantology-item__bottom"><a class="nb-btn nb-implantology-item__btn" href="https://rabbitstom.ru/services/implantatsiya-zubov/implant-pod-klyuch/neobiotech-s-koronkoy/">Подробнее</a>
                                    <div class="nb-implantology-item__logo"><img src="<?=SITE_TEMPLATE_PATH?>/img/content/implantology/logo3.png" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
