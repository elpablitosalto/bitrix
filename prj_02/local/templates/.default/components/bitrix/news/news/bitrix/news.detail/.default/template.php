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
//vardump($arResult["DISPLAY_PROPERTIES"]);
?>
<section class="news-detail-first">
    <div class="container">
        <div class="news-detail-info-block">
            <div class="news-detail-info">
                <span class="news-detail-date">
                    <?
                    echo FormatDate("j F Y", MakeTimeStamp($arResult["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"]));
                    ?>
                </span>
                <span class="news-detail-category">
                    <a href="<?= $arResult["FILTER_PUBLICATION_TYPE"]; ?>" target="_self">
                        <?= $arResult["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?>
                    </a>
                </span>
            </div>
            <?
            $GLOBALS["searchFilter"] = array(
                "MODULE_ID" => "iblock",
                "PARAM1" => $arParams["IBLOCK_TYPE"],
                "PARAM2" => $arParams["IBLOCK_ID"],
            );
            ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:search.tags.cloud",
                "",
                array(
                    "FONT_MAX" => "50",
                    "FONT_MIN" => "10",
                    "COLOR_NEW" => "3E74E6",
                    "COLOR_OLD" => "C0C0C0",
                    "PERIOD_NEW_TAGS" => "",
                    "SHOW_CHAIN" => "Y",
                    "COLOR_TYPE" => "Y",
                    "WIDTH" => "100%",
                    "SORT" => "NAME",
                    "PAGE_ELEMENTS" => "150",
                    "PERIOD" => "",
                    //"URL_SEARCH" => "/search/index.php",
                    //"URL_SEARCH" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
                    "URL_SEARCH" => $arParams["SEARCH_PAGE"],
                    "TAGS_INHERIT" => "Y",
                    "CHECK_DATES" => "Y",
                    "FILTER_NAME" => "searchFilter",
                    "arrFILTER" => array("no"),
                    "CACHE_TYPE" => "N",
                    "CACHE_TIME" => "3600",
                    "TYPE_PAGE" => "detail",
                    "TAGS_THIS_ELEMENT" => $arResult["TAGS_THIS_ELEMENT"],
                ),
                //$component
                $arParams["COMPONENT"]
            ); ?>

            <? /* ?>
            <? if (!empty($arResult["arTagsLinks"])) { ?>
                <div class="news-detail-tags">
                    <ul class="tags-list">
                        <? foreach ($arResult["arTagsLinks"] as $ar_link) { ?>
                            <li><a href="<?= $ar_link["link"] ?>" class="btn btn-transparent tag">#<?= $ar_link["tag"] ?></a></li>
                        <? } ?>
                    </ul>
                </div>
            <? } ?>
            <? */ ?>
        </div>
        <div class="news-detail-image">
            <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DETAIL_PICTURE"]["SRC"]; ?>" loading="lazy" alt="" title="" />
            </picture>
        </div>
    </div>
</section>
<section class="news-detail-content">
    <div class="container">
        <div class="section__content">
            <div id="news-detail-share" class="news-detail-share">
                <div class="section__title">Поделиться</div>
                <div data-curtain data-shape="round" data-color-scheme="blackwhite" data-services="vkontakte,whatsapp,telegram" data-size="l" class="ya-share2"></div>
            </div>
            <? if (strlen($arResult["PREVIEW_TEXT"]) > 0) { ?>
                <div class="text-size-lg news-detail-text">
                    <p class="h4 news-detail-annotation"><?= htmlspecialchars_decode($arResult["PREVIEW_TEXT"]); ?></p>
                </div>
            <? } ?>
            <? if (strlen($arResult["DETAIL_TEXT"]) > 0) { ?>
                <div class="text-size-lg news-detail-text">
                    <?= htmlspecialchars_decode($arResult["DETAIL_TEXT"]); ?>
                </div>
            <? } ?>
            <?
            //echo "CONSTRUCTOR = ".$arResult["DISPLAY_PROPERTIES"]["CONSTRUCTOR"]["VALUE"]."<br />";
            ?>
            <? if (intval($arResult["DISPLAY_PROPERTIES"]["CONSTRUCTOR"]["VALUE"]) > 0) { ?>
                <? $APPLICATION->IncludeComponent(
                    "indexis:page.constructor",
                    "",
                    array(
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "SECTION_ID" => $arResult["DISPLAY_PROPERTIES"]["CONSTRUCTOR"]["VALUE"]
                    )
                ); ?>
            <? } else {
            } ?>
            <div class="news-detail-footer">
                <?
                $ar_vals = array("PROGRAM", "PROJECT");
                foreach ($ar_vals as $val) {
                    $id = $arResult["DISPLAY_PROPERTIES"][$val]["VALUE"];
                    $name = $arResult["DISPLAY_PROPERTIES"][$val]["NAME"];
                    if (intval($id) > 0) {
                        $title = $arResult["DISPLAY_PROPERTIES"][$val]["LINK_ELEMENT_VALUE"][$id]["NAME"];
                        $url = $arResult["DISPLAY_PROPERTIES"][$val]["LINK_ELEMENT_VALUE"][$id]["DETAIL_PAGE_URL"];
                        if (strlen($title) > 0 && strlen($url) > 0) {
                ?>
                            <p class="text-size-lg">
                                <?= $name; ?> <a href="<?= $url; ?>"><u>«<?= $title; ?>»</u></a>
                            </p>
                <?
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>