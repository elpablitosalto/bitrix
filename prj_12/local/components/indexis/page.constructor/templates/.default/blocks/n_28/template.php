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
                        <div class="nb-services-links-menu nb-services-links-menu_opened"><a class="nb-services-links-menu__title" href="/services/khirurgiya/udalenie-zubov/">Удаление зубов</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/17.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/udalenie-zubov/udalenie-slozhnogo-zuba/">Сложное удаление.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/udalenie-zubov/udalenie-zuba-mudrosti/">Удаление зуба мудрости.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/udalenie-zubov/udalenie-retinirovannogo-zuba/">Удаление ретинированного зуба.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/udalenie-zubov/udalenie-distopirovannogo-zuba/">Удаление дистопированного зуба.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/udalenie-zubov/udalenie-kornya-zuba/">Удаление корня зуба.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/khirurgiya/udalenie-zubov/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/khirurgiya/khirurgicheskie-operatsii/">Хирургические манипуляции</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/13.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/khirurgicheskie-operatsii/tsistektomiya-udalenie-kisty-zuba/">Цистэктомия - Удаление кисты зуба.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/khirurgicheskie-operatsii/udalenie-granulemy/">Удаление гранулемы.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/khirurgicheskie-operatsii/udalenie-implanta/">Удаление импланта.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/khirurgicheskie-operatsii/rezektsiya-kornya-zuba/">Резекция корня зуба.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/khirurgiya/khirurgicheskie-operatsii/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/khirurgiya/khirurgicheskoe-lechenie/">Хирургическое лечение</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/15.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/khirurgicheskoe-lechenie/plastika-desny1/">Пластика десны.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/khirurgicheskoe-lechenie/lechenie-periostita-flyusa/">Лечение периостита (флюса).</a></li>
                                        <?/*?><li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="#">Лечение абсцесса.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="#">Лечение флегмоны.</a></li><?*/ ?>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/khirurgicheskoe-lechenie/lechenie-perikoronita/">Лечение перикоронита.</a></li>
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/khirurgicheskoe-lechenie/plastika-uzdechki-guby-ili-yazyka/">Пластика уздечки губы или языка.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/khirurgiya/khirurgicheskoe-lechenie/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nb-services-links__col">
                        <div class="nb-services-links-menu"><a class="nb-services-links-menu__title" href="/services/khirurgiya/vestibuloplastika/">Вестибулопластика</a>
                            <div class="nb-services-links-menu__dropdown">
                                <div class="nb-services-links-menu__icon"><img src="/local/templates/nebolno/img/content/services-links/14.png" alt=""></div>
                                <div class="nb-services-links-menu__caption">
                                    <ul class="nb-services-links-menu__list">
                                        <li class="nb-services-links-menu__item"><a class="nb-services-links-menu__link" href="/services/khirurgiya/vestibuloplastika/">Изготавливается в зуботехнической лаборатории по индивидуальным слепкам.</a></li>
                                    </ul><a class="nb-services-links-menu__section-link" href="/services/khirurgiya/vestibuloplastika/">Перейти в раздел</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>