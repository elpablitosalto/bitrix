<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//vardump($arResult['DISPLAY_PROPERTIES']['VISUAL_TYPE']);
?>

<? if ($arResult['DISPLAY_PROPERTIES']['VISUAL_TYPE']['VALUE_XML_ID'] != 'COLOR_MIX_STONE_TOP') { ?>
    <div id="ZwischenMenu" class="zwischenMenu">
        <div class="item" data-id="#Main"><?= $arResult['NAME']; ?></div>
        <div class="item" data-id="#cs-Farben">Цвета и фактуры</div>
        <div class="item" data-id="#cs-Eigenschaften">Особенности продукта</div>
        <div class="item" data-id="#cs-226">Технические характеристики</div>
        <div class="item" data-id="#cs-Galerie">Галерея</div>
        <div class="item" data-id="#cs-Referenzen">Реализованные объекты</div>
        <div class="item" data-id="#cs-227">Видео</div>
        <? /*?>
    <div class="item" data-id="#cs-Formate">Abmessungen</div>
    <div class="item" data-id="#cs-Objektformate">Objektformate</div>
    <div class="item" data-id="#cs-Editionen">Editionen</div>
    <div class="item" data-id="#cs-CDFarben">CDFarben</div>
    <div class="item" data-id="#cs-Verlegemuster">Verlegemuster</div>
    <div class="item" data-id="#cs-Downloads">Downloads</div>
    <div class="item" data-id="#cs-Links">Links</div>
    <div class="item" data-id="#cs-Haendler">Händler</div>
    <?*/ ?>
    </div>
<? } ?>

<div id="ContentSections" class="contentSectionArea">
    <? if ($arResult['DISPLAY_PROPERTIES']['VISUAL_TYPE']['VALUE_XML_ID'] != 'COLOR_MIX_STONE_TOP') { ?>
        <? if (strlen($arResult['IMAGE_1']['SRC']) > 0) { ?>
            <span class="debugCSTitle" style="display:none;" data-title="<?= $arResult['NAME']; ?>" data-id="111" data-template=""></span>
            <div id="cs-111" class="contentSection  parallax fullwid fullwidImg ">
                <div class="csImage parallax " style='background-image:url(<?= $arResult['IMAGE_1']['SRC']; ?>);'>
                </div>
            </div>
        <? } ?>


        <? if (!empty($arResult['DISPLAY_PROPERTIES']['COLORS_TEXTURES']['VALUE'])) { ?>
            <span class="debugCSTitle" style="display:none;" data-title="Farben" data-id="Farben" data-template="ContSectProdColors"></span>
            <div id="cs-Farben" class="pb2020 wide ">
                <?
                $GLOBALS['arrFilterColorsTextures']['ID'] = $arResult['DISPLAY_PROPERTIES']['COLORS_TEXTURES']['VALUE'];
                ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "colors_textures",
                    array(
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "N",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "directories",
                        "IBLOCK_ID" => Indexis::getIblockId('colors_textures', 'directories'),
                        "NEWS_COUNT" => "200",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "ACTIVE_FROM",
                        "SORT_ORDER2" => "DESC",
                        "FILTER_NAME" => "arrFilterColorsTextures",
                        "FIELD_CODE" => array("ID", 'NAME', 'PREVIEW_TEXT', 'DETAIL_PICTURE'),
                        "PROPERTY_CODE" => array("URL"),
                        "CHECK_DATES" => "N",
                        "DETAIL_URL" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "CACHE_FILTER" => "Y",
                        "CACHE_GROUPS" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Подразделы",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "Y",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => "",
                        "PAGER_BASE_LINK" => "",
                        "PAGER_PARAMS_NAME" => "arrPager",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",

                        // Мои параметры -->
                        "HEADER" => 'Цвета и фактуры',
                        // <-- Мои параметры
                    )
                ); ?>

            </div>
        <? } ?>


        <? if (strlen($arResult['IMAGE_2']['SRC']) > 0) { ?>
            <span class="debugCSTitle" style="display:none;" data-title="<?= $arResult['NAME']; ?>" data-id="112" data-template=""></span>
            <div id="cs-112" class="contentSection  parallax fullwid fullwidImg ">
                <div class="csImage parallax " style='background-image:url(<?= $arResult['IMAGE_2']['SRC']; ?>);'>
                </div>
            </div>
        <? } ?>

        <? if (!empty($arResult['arFeatures'])) { ?>
            <span class="debugCSTitle" style="display:none;" data-title="Особенности продукта" data-id="Особенности продукта" data-template="ContSectProdEigenschaften"></span>
            <div id="cs-Eigenschaften" class="contentSection respCElement akkSection  ">
                <div class="csContent responsiveBlock checkR">
                    <h2 class="csHeadline">Особенности продукта</h2>

                    <div class="esIconBlock">
                        <? foreach ($arResult['arFeatures'] as $key => $val) { ?>
                            <div class="esIcon">
                                <img class="iconimg" alt="<?= $val['PICTURE']['ALT'] ?>" src="<?= $val['PICTURE']['SRC'] ?>" width="40" />
                                <div class="esIconTxt">
                                    <p><?= $val['TEXT'] ?></p>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        <? } ?>

        <? if (strlen($arResult['IMAGE_3']['SRC']) > 0) { ?>
            <span class="debugCSTitle" style="display:none;" data-title="<?= $arResult['NAME']; ?>" data-id="113" data-template=""></span>
            <div id="cs-113" class="contentSection  parallax fullwid fullwidImg ">
                <div class="csImage parallax " style='background-image:url(<?= $arResult['IMAGE_3']['SRC']; ?>);'>
                </div>
            </div>
        <? } ?>

        <? if (!empty($arResult['DISPLAY_PROPERTIES']['SPECIFICATIONS']['~VALUE']['TEXT'])) { ?>
            <span class="debugCSTitle" style="display:none;" data-title="Технические характеристики" data-id="226" data-template=""></span>
            <div id="cs-226" class="contentSection  bgGrau noparallax ">
                <div class="csContent responsiveBlock">
                    <h2 class="sectionTitle open">Технические характеристики</h2>
                    <div class="blockContent">
                        <div class="tablewrapper format-table-wrapper">
                            <?= $arResult['DISPLAY_PROPERTIES']['SPECIFICATIONS']['~VALUE']['TEXT']; ?>
                        </div>
                    </div>
                </div>
            </div>

        <? } ?>


        <? if (strlen($arResult['IMAGE_4']['SRC']) > 0) { ?>
            <span class="debugCSTitle" style="display:none;" data-title="<?= $arResult['NAME']; ?>" data-id="114" data-template=""></span>
            <div id="cs-114" class="contentSection  parallax fullwid fullwidImg ">
                <div class="csImage parallax " style='background-image:url(<?= $arResult['IMAGE_4']['SRC']; ?>);'>
                </div>
            </div>
        <? } ?>


        <? if (!empty($arResult['GALLERY_PICTURES'])) { ?>
            <span class="debugCSTitle" style="display:none;" data-title="Galerie" data-id="Galerie" data-template="ContentSectionGallery"></span>
            <div id="cs-Galerie" class="pb2020 productSection wideGallery">
                <h2 class="sectionTitle open">Галерея</h2>
                <div class="sectionContent gallery">
                    <div class="gallerySwitch"><span class="galleryOpener">Открыть галерею</span><span class="galleryCloser">Закрыть галерею</span></div>
                    
                    <?
                    $bCentered = false;
                    if (!empty($arResult['PROPERTIES']['CENTERED']['VALUE_XML_ID'])) {
                        if ($arResult['PROPERTIES']['CENTERED']['VALUE_XML_ID'] == 'Y') {
                            $bCentered = true;
                        }
                    }
                    ?>
                    <div id="JustifiedGallery" class="justified-gallery <? if ($bCentered) { ?> centered<? } ?> <? if (is_array($arResult['GALLERY_PICTURES']) && count($arResult['GALLERY_PICTURES']) == 1) : ?> one-item<? endif; ?>">

                        <? foreach ($arResult['GALLERY_PICTURES'] as $key => $arItemImage) { ?>
                            <div itemscope itemtype="https://schema.org/ImageObject" class="inspirationsBild" title="<?= $arItemImage['TITLE']; ?>">
                                <img loading="lazy" src="<?= $arItemImage['SRC']; ?>" alt="<?= $arItemImage['ALT']; ?>" title="<?= $arItemImage['TITLE']; ?>" width="<?= $arItemImage['WIDTH']; ?>" height="<?= $arItemImage['HEIGHT']; ?>" />
                                <meta itemprop="contentUrl" content="<?= $arItemImage['SOURCE_PICTURE']['SRC']; ?>" />
                                <meta itemprop="description" content="<?= $arItemImage['TITLE']; ?>" />
                                <meta itemprop="thumbnailUrl" content="<?= $arItemImage['SRC']; ?>" />
                                <div class="interaction"><span class="butty galThumb lupe full insp-icon iconfont " data-mfp-src="<?= $arItemImage['SOURCE_PICTURE']['SRC']; ?>" title="<?= $arItemImage['TITLE']; ?>">&#xe815;</span></div>
                            </div>
                        <? } ?>

                    </div>
                </div>
            </div>
        <? } ?>

        <?/*?>
        <div class="csContent responsiveBlock">
            <div class="blockContent">
                <div class="tablewrapper format-table-wrapper">
                <?*/ ?>

        <? if (intval($arResult['ID']) > 0) { ?>
            <section id="cs-Referenzen" class="pb2020 contentSection wide responsiveBlock akkSection" data-minhig="700">
                <div class="csContent">
                    <?
                    $GLOBALS['arrFilterObjectsDetailProduct']['PROPERTY_PRODUCTS'] = $arResult['ID'];
                    ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "objects_detail_product",
                        array(
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "N",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "AJAX_MODE" => "N",
                            "IBLOCK_TYPE" => "gallery",
                            "IBLOCK_ID" => Indexis::getIblockId('objects', 'gallery'),
                            "NEWS_COUNT" => "200",
                            "SORT_BY1" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_BY2" => "ACTIVE_FROM",
                            "SORT_ORDER2" => "DESC",
                            "FILTER_NAME" => "arrFilterObjectsDetailProduct",
                            "FIELD_CODE" => array("ID", 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'DETAIL_PICTURE'),
                            "PROPERTY_CODE" => array("URL"),
                            "CHECK_DATES" => "N",
                            "DETAIL_URL" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "CACHE_FILTER" => "Y",
                            "CACHE_GROUPS" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_TITLE" => "Подразделы",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => "",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "Y",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => "",
                            "PAGER_BASE_LINK" => "",
                            "PAGER_PARAMS_NAME" => "arrPager",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",

                            // Мои параметры -->
                            "HEADER" => 'Реализованные объекты',
                            // <-- Мои параметры
                        )
                    ); ?>
                </div>
            </section>
        <? } ?>
        
                <?/*?>
                </div>
            </div>
        </div>
        <?*/ ?>
    <? } ?>


    <? if (!empty($arResult['DISPLAY_PROPERTIES']['VIDEO_LINK']['VALUE'])) { ?>
        <span class="debugCSTitle" style="display:none;" data-title="Видео" data-id="227" data-template=""></span>
        <div id="cs-227" class="contentSection csvideo bgGrau noparallax smallwidImg ">
            <?
            $h2 = 'Видео';
            if (strlen($arParams['VIDEO_SECTION_HEADER']) > 0) {
                $h2 = $arParams['VIDEO_SECTION_HEADER'];
            }
            ?>
            <div class="csTitle responsiveBlock">
                <h2 class="csHeadline"><?= $h2; ?></h2>
            </div>
            <?
            $arYouTubeUrlParts = parse_url($arResult['DISPLAY_PROPERTIES']['VIDEO_LINK']['VALUE']);
            $videoCode = str_replace('/embed/', '', $arYouTubeUrlParts['path']);
            ?>
            <div class="csImage smallWid video ">
                <img class="preview" loading="lazy" src="<? if (isset($arResult['DISPLAY_PROPERTIES']['VIDEO_PREVIEW']['FILE_VALUE']['SRC'])) : ?><?= $arResult['DISPLAY_PROPERTIES']['VIDEO_PREVIEW']['FILE_VALUE']['SRC']; ?><? else : ?>https://img.youtube.com/vi/<?= $videoCode ?>/maxresdefault.jpg<? endif; ?>" alt="Verlegung Grossformat Platten" />
                <div id='player-227' data-id="227" class="videoFrame lazy plyr__video-embed" data-plyr-provider="youtube" data-type="youtube" data-plyr-embed-id="<?= $videoCode ?>" data-plyr-config="{'autoplay':'false','noCookie':'true'}" style="--plyr-color-main: #b70c1d;">
                    <span class="play"></span>
                </div>
            </div>
            <? if (!empty($arResult['DISPLAY_PROPERTIES']['VIDEO_DESCRIPTION']['~VALUE']['TEXT'])) { ?>
                <div class="csContent responsiveBlock">
                    <div class="page-opener-description video-desc">
                        <h3><?= $arResult['DISPLAY_PROPERTIES']['VIDEO_SUBTITLE']['~VALUE']; ?></h3>
                        <p><?= $arResult['DISPLAY_PROPERTIES']['VIDEO_DESCRIPTION']['~VALUE']['TEXT']; ?></p>
                    </div>
                </div>
            <? } ?>
        </div>
    <? } ?>

</div>