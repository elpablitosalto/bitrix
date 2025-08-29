<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<? if (!empty($arResult['ITEMS'])) { ?>
    <div class="page__detail-group">
        <? foreach ($arResult['ITEMS'] as $k => $arItem) { ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <span id="<?= $arItem['ID']; ?>"></span>
            <div class="page__detail" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="page__section">
                    <!-- begin .section-->
                    <div class="section section_role_card-detail">
                        <div class="section__main">
                            <div class="section__content">
                                <div class="page__container">
                                    <div class="section__card-detail">
                                        <!-- begin .card-detail-->
                                        <div class="card-detail">
                                            <div class="card-detail__main">
                                                <div class="card-detail__info">
                                                    <div class="card-detail__title">
                                                        <!-- begin .title-->
                                                        <h1 class="title title_size_h1 title_weight_medium title_case_normal title_style_primary">
                                                            <?= htmlspecialchars_decode($arItem["NAME"]) ?>
                                                        </h1>
                                                        <!-- end .title-->
                                                    </div>
                                                    <div class="card-detail__label">
                                                        <?/*?>
                                                        Permanent Color Cream Keratin+
                                                        <?/**/ ?>
                                                    </div>
                                                    <? if (
                                                        !empty($arItem["PRODUCT_VARIANTS"])
                                                        && !empty($arItem["PRODUCT_VARIANTS"]["PROPERTY_VALUES"])
                                                        && is_array($arItem["PRODUCT_VARIANTS"]["PROPERTY_VALUES"])
                                                    ) { ?>
                                                        <?
                                                        $currentProduct = $arItem["PRODUCT_VARIANTS"]["PRODUCT_VARIANTS"][0];
                                                        $currentProductProperty = $currentProduct["PROPERTY_" . $arItem["PRODUCT_VARIANTS"]["PROPERTY_CODE"] . "_VALUE"];
                                                        ?>
                                                        <div class="card-detail__choice-group">
                                                            <!-- begin .choice-group-->
                                                            <div class="choice-group">
                                                                <div class="choice-group__caption"><?= $arItem["PRODUCT_VARIANTS"]["PROPERTY_NAME"] ?>:
                                                                </div>
                                                                <ul class="choice-group__list">
                                                                    <?
                                                                    $count = count($arItem["PRODUCT_VARIANTS"]["PROPERTY_VALUES"]);
                                                                    ?>
                                                                    <? foreach ($arItem["PRODUCT_VARIANTS"]["PROPERTY_VALUES"] as $index => $propValue) { ?>
                                                                        <?
                                                                        /*
                                                                        $checked = $currentProductProperty == $propValue["UF_XML_ID"];
                                                                        if ($count == 1) {
                                                                            $checked = true;
                                                                        }
                                                                        */
                                                                        $checked = true;
                                                                        ?>
                                                                        <li class="choice-group__item">
                                                                            <label class="choice-group__label <?= ($checked ? "choice-group__label_state_active" : "") ?>">
                                                                                <span class="choice-group__tooltip"><?= $arItem["PRODUCT_VARIANTS"]["PROPERTY_NAME"] ?></span>
                                                                                <span class="choice-group__panel"><?= $propValue["UF_NAME"] ?></span>
                                                                            </label>
                                                                        </li>
                                                                        <?/*?>
                                                                        <li class="choice-group__item">
                                                                            <label class="choice-group__label">
                                                                                <span class="choice-group__tooltip">
                                                                                    <?= $arItem["PRODUCT_VARIANTS"]["PROPERTY_NAME"] ?>
                                                                                </span>
                                                                                <input <?= ($checked ? "checked" : "") ?> class="choice-group__input" type="radio" name="product-filter-<?= $arItem["PRODUCT_VARIANTS"]["PROPERTY_CODE"] ?>" data-product-id="<?= $arItem["ID"] ?>" data-property-code="<?= $arItem["PRODUCT_VARIANTS"]["PROPERTY_CODE"] ?>" data-property-value="<?= $propValue["UF_XML_ID"] ?>" />
                                                                                <span class="choice-group__panel"><?= $propValue["UF_NAME"] ?></span>
                                                                            </label>
                                                                        </li>
                                                                        <?*/ ?>
                                                                    <? } ?>
                                                                </ul>
                                                            </div>
                                                            <!-- end .choice-group-->
                                                        </div>
                                                    <? } ?>
                                                </div>
                                                <? if (!empty($arItem["PRODUCT_GALLERY"])) { ?>
                                                    <div class="card-detail__carousel">
                                                        <!-- begin .card-detail-carousel-->
                                                        <div class="card-detail-carousel">
                                                            <div class="card-detail-carousel__container swiper js-card-detail-carousel js-extend-right">
                                                                <div class="card-detail-carousel__wrapper swiper-wrapper">
                                                                    <? foreach ($arItem["PRODUCT_GALLERY"] as $arSlide) { ?>
                                                                        <div class="card-detail-carousel__slide swiper-slide">
                                                                            <div class="card-detail-carousel__illustration">
                                                                                <picture>
                                                                                    <img src="<?= $arSlide["SRC"] ?>" alt="<?= $arSlide["ALT"] ?>" title="<?= $arSlide["TITLE"] ?>" class="card-detail-carousel__image" />
                                                                                </picture>
                                                                            </div>
                                                                        </div>
                                                                    <? } ?>
                                                                </div>
                                                                <div class="card-detail-carousel__pagination">
                                                                    <!-- begin .bullet-pagination-->
                                                                    <div class="bullet-pagination">
                                                                    </div>
                                                                    <!-- end .bullet-pagination-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end .card-detail-carousel-->
                                                    </div>
                                                <? } ?>
                                            </div>
                                            <div class="card-detail__details">
                                                <? if (!empty($arItem["DOWNLOADS"])) { ?>
                                                    <div class="card-detail__link-group">
                                                        <h2 class="card-detail__subtitle">
                                                            <?= GetMessage('NEWS_LIST_SECTION_PAGE_LIST_DOWNLOADS'); ?>
                                                        </h2>
                                                        <ul class="card-detail__link-list">
                                                            <? foreach ($arItem["DOWNLOADS"] as $arDownlod) { ?>
                                                                <? foreach ($arDownlod['VALUES'] as $arDownlodItem) { ?>
                                                                    <li class="card-detail__link-item">
                                                                        <!-- begin .icon-link-->
                                                                        <a class="icon-link icon-link_gap_l icon-link_text-size_s" href="<?= $arDownlodItem['LINK']; ?>" target="_blank">
                                                                            <span class="icon-link__icon-wrapper">
                                                                                <?= $arDownlodItem['SVG']; ?>
                                                                            </span><span class="icon-link__text"><?= $arDownlodItem['TITLE']; ?></span></a>
                                                                        <!-- end .icon-link-->
                                                                    </li>
                                                                <? } ?>
                                                            <? } ?>
                                                        </ul>
                                                    </div>
                                                <? } ?>
                                                <? if (!empty($arItem['FEATURE_SECTIONS'])) { ?>
                                                    <div class="card-detail__icon-panel-group">
                                                        <!-- begin .icon-panel-group-->
                                                        <div class="icon-panel-group icon-panel-group_size_s icon-panel-group_style_decorated">
                                                            <ul class="icon-panel-group__list">
                                                                <? foreach ($arItem['FEATURE_SECTIONS'] as $arFeatureSection) { ?>
                                                                    <li class="icon-panel-group__item">
                                                                        <!-- begin .icon-panel-->
                                                                        <div class="icon-panel icon-panel_type_compact">
                                                                            <div class="icon-panel__wrapper">
                                                                                <div class="icon-panel__illustration">
                                                                                    <?= $arFeatureSection['FILE_CONTENT']; ?>
                                                                                </div>
                                                                                <div class="icon-panel__info">
                                                                                    <div class="icon-panel__title">
                                                                                        <!-- begin .title-->
                                                                                        <div class="title title_size_h5 title_case_normal">
                                                                                            <?= $arFeatureSection['TITLE']; ?>
                                                                                        </div>
                                                                                        <!-- end .title-->
                                                                                    </div>
                                                                                    <? foreach ($arFeatureSection['VALUE'] as $val) { ?>
                                                                                        <div class="icon-panel__text">
                                                                                            <?= $val; ?>
                                                                                        </div>
                                                                                    <? } ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end .icon-panel-->
                                                                    </li>
                                                                <? } ?>
                                                            </ul>
                                                        </div>
                                                        <!-- end .icon-panel-group-->
                                                    </div>
                                                <? } ?>
                                            </div>

                                        </div>
                                        <!-- end .card-detail-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end .section-->
                </div>
                <? if (!empty($arItem['PRODUCT_OPTIONS']['ITEMS'])) { ?>
                    <div class="page__section">
                        <!-- begin .section-->
                        <div class="section section_role_gallery">
                            <div class="section__main">
                                <div class="section__header">
                                    <div class="section__header-container page__container">
                                        <div class="section__title">
                                            <!-- begin .title-->
                                            <h2 class="title title_size_h3-s title_case_upper title_style_primary">
                                                <?= $arItem['NAME'] ?> <?= GetMessage('NEWS_LIST_COLLECTION_DETAIL_PRODUCT_OPTIONS'); ?>
                                            </h2>
                                            <!-- end .title-->
                                        </div>
                                    </div>
                                </div>
                                <div class="section__content">
                                    <div class="page__container">
                                        <div class="section__entry-grid">
                                            <!-- begin .entry-grid-->
                                            <div class="entry-grid js-entry-grid entry-grid_size_mobile-s">
                                                <ul class="entry-grid__list js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
                                                    <? foreach ($arItem['PRODUCT_OPTIONS']['ITEMS'] as $arProductOptionsItem) { ?>
                                                        <li class="entry-grid__item">
                                                            <!-- begin .entry-snippet-->
                                                            <div class="entry-snippet entry-grid__snippet">
                                                                <?/*?>
                                                                <div class="entry-snippet__label">
                                                                    <?= $arProductOptionsItem['NAME']; ?>
                                                                </div>
                                                                <?*/ ?>
                                                                <div class="entry-snippet__title">
                                                                    <a class="entry-snippet__link js-modal" href="<?= $arProductOptionsItem['PICTURE_SOURCE']['SRC']; ?>">
                                                                        <?= $arProductOptionsItem['NAME']; ?>
                                                                    </a>
                                                                </div>
                                                                <a class="entry-snippet__illustration js-modal" href="<?= $arProductOptionsItem['PICTURE_SOURCE']['SRC']; ?>">
                                                                    <picture class="entry-snippet__picture">
                                                                        <img src="<?= $arProductOptionsItem['PICTURE']['SRC']; ?>" alt="<?= $arProductOptionsItem['PICTURE']["ALT"] ?>" title="<?= $arProductOptionsItem['PICTURE']["TITLE"] ?>" class="entry-snippet__image" />
                                                                    </picture>
                                                                </a>
                                                            </div>
                                                            <!-- end .entry-snippet-->
                                                        </li>
                                                    <? } ?>
                                                </ul>
                                                <?/*?>
                                                <?
                                                $navNum = $arResult['NAV_RESULT']->NavNum;
                                                ?>
                                                <div class="js_nav_string <?= "js_nav_string_" . $navNum; ?>">
                                                    <?
                                                    echo $arResult["NAV_STRING"];
                                                    ?>
                                                </div>
                                                <?*/?>

                                            </div>
                                            <!-- end .entry-grid-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end .section-->
                    </div>
                <? } ?>
                <? if (
                    !empty($arItem['PROPERTIES']['TEXT_WITH_HEADERS']['VALUE'])
                    && is_array($arItem['PROPERTIES']['TEXT_WITH_HEADERS']['VALUE'])
                    || !empty($arItem['DETAIL_TEXT'])
                ) { ?>
                    <div class="page__section">
                        <!-- begin .section-->
                        <div class="section">
                            <div class="section__main">
                                <div class="section__content">
                                    <div class="page__container">
                                        <div class="section__text-columns">
                                            <!-- begin .text-columns-->
                                            <div class="text-columns text-columns_size_mobile-s">
                                                <? if (
                                                    !empty($arItem['PROPERTIES']['TEXT_WITH_HEADERS']['VALUE'])
                                                    && is_array($arItem['PROPERTIES']['TEXT_WITH_HEADERS']['VALUE'])
                                                ) { ?>
                                                    <?
                                                    $count = count($arItem['PROPERTIES']['TEXT_WITH_HEADERS']['VALUE']);
                                                    ?>
                                                    <div class="text-columns__col">
                                                        <? for ($i = 0; $i < $count; $i++) { ?>
                                                            <? if ($i == ceil($count / 2)) { ?>
                                                    </div>
                                                    <div class="text-columns__col">
                                                    <? } ?>
                                                    <h2><?= $arItem['PROPERTIES']['TEXT_WITH_HEADERS']['VALUE'][$i] ?></h2>
                                                    <p><?= $arItem['PROPERTIES']['TEXT_WITH_HEADERS']['DESCRIPTION'][$i] ?></p>
                                                <? } ?>
                                                    </div>
                                                <? } else { ?>
                                                    <? echo htmlspecialchars_decode($arItem['DETAIL_TEXT']); ?>
                                                <? } ?>
                                                <?/*?>
                                                <div class="text-columns__col">
                                                    <h2>INFINITY PERMANENT COLOR CREAM ОТ БРЕНДА CONCEPT
                                                    </h2>
                                                    <p>Это синергия многогранности и стойкости цвета, бриллиантового блеска, восстановления структуры волос, полноценного и естественного покрытия седины.
                                                    </p>
                                                    <h2>КРАСИТЕЛЬ ДЛЯ ВОЛОС INFINITY С УНИКАЛЬНЫМ КОМПЛЕКСОМ COLOR SYSTEM
                                                    </h2>
                                                    <p>Это современное поколение красителей, гарантирующих бережное отношение к здоровью волос благодаря гибридной формуле красителя, позволяющей снизить долю аммиака за счет аминоспиртов.
                                                    </p>
                                                </div>
                                                <div class="text-columns__col">
                                                    <h2>INFINITY PERMANENT COLOR CREAM
                                                    </h2>
                                                    <p>Это одновременное окрашивание и восстановление, возможное благодаря совместному действию кератина и масла ши, входящим в состав стойкого красителя.
                                                    </p>
                                                    <h2>INFINITY PERMANENT COLOR CREAM KERATIN
                                                    </h2>
                                                    <p>Это путь от инструмента к творческому партнеру мастера, это краситель, рождающий вдохновение, с изысканным ароматом, легкий в работе и уверенный в результате.
                                                    </p>
                                                </div>
                                                <?*/ ?>
                                            </div>
                                            <!-- end .text-columns-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end .section-->
                    </div>
                <? } ?>
            </div>
        <? } ?>
    </div>
<? } ?>