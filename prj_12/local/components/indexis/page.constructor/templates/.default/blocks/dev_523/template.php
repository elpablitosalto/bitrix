<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$item = $arParams['ITEM'];
//$arPropertieValue = $item['DISPLAY_PROPERTIES']['DEV_521_DATA']['VALUE'];
?>
<section class="nb-section nb-standards-section nb-bracket-smile-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') : ?>
            <div class="nb-section__header">
                <h2 class="nb-section__title desktop">
                    Ровная улыбка <span class="font-weight_normal">-&nbsp;уверенность и здоровье</span>
                </h2>
                <p class="nb-section__title mobile">
                    Ровная улыбка <br><span class="font-weight_normal">-&nbsp;уверенность и здоровье</span>
                </p>
            </div>
        <? endif; ?>
        <div class="nb-section__body">
            <ol class="nb-bracket-smile-section__list">
                <li class="nb-bracket-smile-section__item">
                    <div class="nb-bracket-smile-section__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/bracket-smile/img_0001.png" alt=""></div>
                    <p>Идеально адаптируются под естественный цвет зубов и практически не видны на зубах</p>
                </li>
                <li class="nb-bracket-smile-section__item">
                    <div class="nb-bracket-smile-section__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/bracket-smile/img_0002.png" alt=""></div>
                    <p>Устойчивы к окрашиванию. Красящие продукты и напитки не меняют цвет брекетов</p>
                </li>
                <li class="nb-bracket-smile-section__item">
                    <div class="nb-bracket-smile-section__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/bracket-smile/img_0003.png" alt=""></div>
                    <p>Специальное покрытие основания брекета повышает надежность адгезии и облегчает снятие брекетов</p>
                </li>
                <li class="nb-bracket-smile-section__item">
                    <div class="nb-bracket-smile-section__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/bracket-smile/img_0004.png" alt=""></div>
                    <p>Расслабляются мышцыи суставы челюстного отдела, проходят головные боли</p>
                </li>
            </ol>
        </div>
    </div>
</section>