<?
if (!empty($arResult['IPROPERTY_VALUES']['ELEMENT_META_KEYWORDS'])) {
    $APPLICATION->SetPageProperty("keywords", $arResult['IPROPERTY_VALUES']['ELEMENT_META_KEYWORDS']);
}

if (!empty($arResult['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION'])) {
    $APPLICATION->SetPageProperty("description", $arResult['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION']);
}

$bannerDesktop = CFile::ResizeImageGet($arResult['PROPERTIES']['TOP_BANNER_DESKTOP']['VALUE'], array('width'=>1920, 'height'=>530), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$bannerMobile = CFile::ResizeImageGet($arResult['PROPERTIES']['TOP_BANNER_MOBILE']['VALUE'], array('width'=>480, 'height'=>180), BX_RESIZE_IMAGE_PROPORTIONAL, true);
?>

<section class="content lookbook-detail">
    <section class="full-page-banner">
        <img class="show-desktop" src="<?=$bannerDesktop['src']?>">
        <img class="middle-show" src="<?=$bannerDesktop['src']?>">
        <img class="show-mobile" src="<?=$bannerMobile['src']?>">
    </section>
    <div class="container _column">
        <section class="content-section">
            <?=htmlspecialchars_decode($arResult['~DETAIL_TEXT'])?>
        </section>
    </div>
    <div class="container _column">
        <section class="content-section">
            <div class="content-header">
                <h1><?=$arResult['NAME']?></h1>
                <h2 class="content-title">Создание образа</h2>
            </div>
            <?
                $arPdfImage = \CFile::GetFileArray($arResult['DISPLAY_PROPERTIES']['PDF_DOCUMENT']['VALUE']);
                if(!empty($arPdfImage)){
                    ?><img src="<?=$arPdfImage["SRC"]?>" alt="<?=$arResult["NAME"]?>" /><?
                }/*else{
                    echo $arResult['~DETAIL_TEXT'];
                }*/
            ?>
            <?if(!empty($arResult['DISPLAY_PROPERTIES']['INSTRUCTION']['LINK_ELEMENT_VALUE'])):?>
                <?foreach ($arResult['DISPLAY_PROPERTIES']['INSTRUCTION']['LINK_ELEMENT_VALUE'] as $item):?>
                    <p><?
                        $arSelect = Array();
                        $arFilter = Array("IBLOCK_ID"=>4, "ID"=>$item['ID']);
                        $res = CIBlockElement::GetList(Array(), $arFilter, false);
                        if($ar_res = $res->GetNextElement())
                            $arProps = $ar_res->GetProperties();
                        $href = CFile::GetPath($arProps['FILE']['VALUE']);
                        ?>
                    </p>
                <?endforeach;?>
                <p class="content-section__download-link">
                    <a href="<?=$href?>" class="dl-link">
                        <svg class="dl-link__icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.9999 16C11.7949 16 11.5989 15.916 11.4579 15.768L6.20794 10.268C5.75294 9.792 6.09094 9 6.74994 9H9.49994V3.25C9.49994 2.561 10.0609 2 10.7499 2H13.2499C13.9389 2 14.4999 2.561 14.4999 3.25V9H17.2499C17.9089 9 18.2469 9.792 17.7919 10.268L12.5419 15.768C12.4009 15.916 12.2049 16 11.9999 16Z"></path>
                            <path d="M22.25 22H1.75C0.785 22 0 21.215 0 20.25V19.75C0 18.785 0.785 18 1.75 18H22.25C23.215 18 24 18.785 24 19.75V20.25C24 21.215 23.215 22 22.25 22Z"></path>
                        </svg>
                        <span class="dl-link__label">Скачать инструкцию</span>
                    </a>
                </p>
            <?endif;?>
        </section>
    </div>
    <div class="container _column">
        <section class="content-section">
            <div class="content-header">
                <h2 class="content-title">Готовый образ</h2>
            </div>
            <div id="lookBookDetailRedesign" class="swiper-container photo-slider">
                <div class="swiper-wrapper">
                    <?foreach($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $i=>$photo):?>
                        <?if($i<3):?>
                            <?$pic = CFile::ResizeImageGet($photo, array('width'=>386, 'height'=>470), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                            <div class="swiper-slide photo-slider__slide"><img src="<?=$pic['src']?>" alt="<?=$pic['ALT']?>" title="<?=$pic['TITLE']?>"/></div>
                        <?endif;?>
                    <?endforeach;?>
                </div>
            </div>
        </section>
    </div>
    <?if(!empty($arResult['PROPERTIES']['WHAT_WE_USE']['VALUE'])):?>
        <?
            global $arRelatedProductsFilter;
            $arRelatedProductsFilter['ID'] = $arResult['PROPERTIES']['WHAT_WE_USE']['VALUE'];
        ?>
        <section class="what-was-used">
            <div class="container _column">
                <h2>ЧТО МЫ ИСПОЛЬЗОВАЛИ</h2>
                <p>Для создания образа были использованы эти средства CONCEPT </p>
            </div>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "novelties",
                array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "ID",
                        1 => "CODE",
                        2 => "PREVIEW_PICTURE",
                        3 => "DETAIL_PICTURE",
                        4 => "",
                    ),
                    "FILTER_NAME" => "arRelatedProductsFilter",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "2",
                    "IBLOCK_TYPE" => "catalog",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "20",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(
                        0 => "PRODUCT_FEATURE",
                        1 => "PRODUCT_PROPS",
                        2 => "PRODUCT_COMPOSITION",
                        3 => "PRODUCT_TYPE",
                        4 => "",
                    ),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "COMPONENT_TEMPLATE" => "novelties"
                ),
                false
            );?>
        </section>
    <?endif;?>
    <?if(!empty($arResult['PROPERTIES']['LEARNING_COURSES']['VALUE'])):?>
        <section class="events">
            <?
            global $arEventsFilter;
            $arEventsFilter['ID'] = $arResult['PROPERTIES']['LEARNING_COURSES']['VALUE'];
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "events.lookbook",
                array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "ID",
                        1 => "CODE",
                        2 => "PREVIEW_PICTURE",
                        3 => "DETAIL_PICTURE",
                        4 => "",
                    ),
                    "FILTER_NAME" => "arEventsFilter",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "6",
                    "IBLOCK_TYPE" => "press_center",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "2",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(
                        0 => "LOCATION",
                        1 => "STATUS",
                        2 => "EVENT_TIME",
                        3 => "",
                        4 => "",
                        5 => "",
                        6 => "",
                    ),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "COMPONENT_TEMPLATE" => "events"
                ),
                false
            );?>
        </section>
    <?endif;?>
    <?if(isset($arResult['PROPERTIES']['HIDDEN_SEO_TEXT']) && !empty($arResult['PROPERTIES']['HIDDEN_SEO_TEXT']['VALUE']['TEXT'])):?>
        <div class="visually-hidden"><?=$arResult['PROPERTIES']['HIDDEN_SEO_TEXT']['~VALUE']['TEXT']?></div>
    <?endif;?>
    <?if(isset($arResult['VIDEO_STRING'])):?>
        <div class="container _column">
            <section class="content-section">
                <div class="content-header">
                    <h2 class="content-title">Видео инструкция</h2>
                </div>
                <?=$arResult['VIDEO_STRING']?>
            </section>
        </div>
    <?endif;?>
    <section class="ask-question">
        <div class="container">
            <div class="ask-question__text">
                <p>Вы можете записаться на обучение по окрашиванию профессиональной стойкой крем- краской для волос с запатентованным комплексом U-SONIC COLOR SYSTEM. Для этого заполните заявку, и наш менеджер свяжется с вами для уточнения деталей.</p>
            </div>
            <div class="ask-question__button"><a href="#learning" data-popup="learning" class="button _big">Записаться</a></div>
        </div>
    </section>
</section>