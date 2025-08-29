<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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

$arCloudParams = array(
    "SEARCH" => $arResult["REQUEST"]["~QUERY"],
    "TAGS" => $arResult["REQUEST"]["~TAGS"],
    "CHECK_DATES" => $arParams["CHECK_DATES"],
    "arrFILTER" => $arParams["arrFILTER"],
    "SORT" => $arParams["TAGS_SORT"],
    "PAGE_ELEMENTS" => $arParams["TAGS_PAGE_ELEMENTS"],
    "PERIOD" => $arParams["TAGS_PERIOD"],
    "URL_SEARCH" => $arParams["TAGS_URL_SEARCH"],
    "TAGS_INHERIT" => $arParams["TAGS_INHERIT"],
    "FONT_MAX" => $arParams["FONT_MAX"],
    "FONT_MIN" => $arParams["FONT_MIN"],
    "COLOR_NEW" => $arParams["COLOR_NEW"],
    "COLOR_OLD" => $arParams["COLOR_OLD"],
    "PERIOD_NEW_TAGS" => $arParams["PERIOD_NEW_TAGS"],
    "SHOW_CHAIN" => $arParams["SHOW_CHAIN"],
    "COLOR_TYPE" => $arParams["COLOR_TYPE"],
    "WIDTH" => $arParams["WIDTH"],
    "CACHE_TIME" => $arParams["CACHE_TIME"],
    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
    "RESTART" => $arParams["RESTART"],
);

if (is_array($arCloudParams["arrFILTER"])) {
    foreach ($arCloudParams["arrFILTER"] as $strFILTER) {
        if ($strFILTER == "main") {
            $arCloudParams["arrFILTER_main"] = $arParams["arrFILTER_main"];
        } elseif ($strFILTER == "forum" && IsModuleInstalled("forum")) {
            $arCloudParams["arrFILTER_forum"] = $arParams["arrFILTER_forum"];
        } elseif (mb_strpos($strFILTER, "iblock_") === 0) {
            if (isset($arParams["arrFILTER_" . $strFILTER]) && is_array($arParams["arrFILTER_" . $strFILTER])) {
                foreach ($arParams["arrFILTER_" . $strFILTER] as $strIBlock)
                    $arCloudParams["arrFILTER_" . $strFILTER] = $arParams["arrFILTER_" . $strFILTER];
            }
        } elseif ($strFILTER == "blog") {
            $arCloudParams["arrFILTER_blog"] = $arParams["arrFILTER_blog"];
        } elseif ($strFILTER == "socialnetwork") {
            $arCloudParams["arrFILTER_socialnetwork"] = $arParams["arrFILTER_socialnetwork"];
        }
    }
}

$APPLICATION->IncludeComponent("bitrix:search.tags.cloud", ".default", $arCloudParams, $component);

?>

<? if (isset($_GET['q'])): ?>
    <h1 class="ml-page-title">
        По запросу “
        <?= $_GET['q'] ?>” найдено <?= $arResult["NAV_RESULT"]->NavRecordCount ?>
        <?= getRightWord(count($arResult['SEARCH']), array('результат', 'результата', 'результатов')); ?>
    </h1>
<? endif; ?>

<div class="ml-tab-btn-nav ">
    <div class="ml-tab-btn-nav__container">
        <ul class="ml-tab-btn-nav__list">
            <?
            if (intval($arResult["NAV_RESULT"]->NavRecordCount) > 0) {
                ?>
                <li class="ml-tab-btn-nav__item">
                    <a class="ml-tab-btn-nav__link <?= (empty($_GET['iblock_code']) && empty($_GET['main_code'])) ? 'ml-tab-btn-nav__link_active' : '' ?>"
                        href="?<?= $arResult['IBLOCK_DATA_FIND'][0]['URL'] . '&iblock_code=' . $arResult['IBLOCK_DATA_FIND'][0]['CODE'] ?>">
                        <?= $arResult['IBLOCK_DATA_FIND'][0]['NAME'] ?>
                    </a>
                </li>
            <?
            }
            ?>
            <?php foreach ($arResult['IBLOCK_DATA_FIND'] as $keyItemIblock => $valueItemIblock): ?>
                <? if (in_array($valueItemIblock['CODE'], $arResult['TABS_LINK'])): ?>
                    <li class="ml-tab-btn-nav__item">
                        <a class="ml-tab-btn-nav__link <?= ($valueItemIblock['CODE'] === $_GET['iblock_code']) ? 'ml-tab-btn-nav__link_active' : '' ?>"
                            href="?<?= $valueItemIblock['URL'] . '&iblock_code=' . $valueItemIblock['CODE'] ?>">
                            <?= $valueItemIblock['NAME'] ?>
                        </a>
                    </li>
                <? endif; ?>
            <?php endforeach; ?>
            <? foreach ($arParams["arrFILTER_main"] as $key => $code): ?>
                <? $code = preg_replace("~/~", "", $code);
                if (in_array($code, $arResult['TABS_LINK'])): ?>
                    <li class="ml-tab-btn-nav__item">
                        <a class="ml-tab-btn-nav__link <?= ($code === $_GET['main_code']) ? 'ml-tab-btn-nav__link_active' : '' ?>"
                            href="?<?= $arResult['FINAL_URL_TO_FILTER_SORT'] . '&main_code=' . $code ?>">
                            <?= GetMessage("SEARCH_MAIN_" . $code) ?>
                        </a>
                    </li>
                <? endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>


<div class="search-page">
    <form action="" method="get" style="display: none;">
        <input type="hidden" name="tags" value="<?= $arResult["REQUEST"]["TAGS"] ?>" />
        <? if ($arParams["USE_SUGGEST"] === "Y"):
            if (mb_strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"])) {
                $arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
                $obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
                $obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
            }

            $APPLICATION->IncludeComponent(
                "bitrix:search.suggest.input",
                "",
                array(
                    "NAME" => "q",
                    "VALUE" => $arResult["REQUEST"]["~QUERY"],
                    "INPUT_SIZE" => 40,
                    "DROPDOWN_SIZE" => 10,
                    "FILTER_MD5" => $arResult["FILTER_MD5"],
                ),
                $component,
                array("HIDE_ICONS" => "Y")
            ); ?>
        <? else: ?>
            <input type="text" name="q" value="<?= $arResult["REQUEST"]["QUERY"] ?>" size="40" />
        <? endif; ?>

        <? if ($arParams["SHOW_WHERE"]): ?>
            &nbsp;<select name="where">
                <option value="">
                    <?= GetMessage("SEARCH_ALL") ?>
                </option>
                <? foreach ($arResult["DROPDOWN"] as $key => $value): ?>
                    <option value="<?= $key ?>" <? if ($arResult["REQUEST"]["WHERE"] == $key)
                        echo " selected" ?>><?= $value ?></option>
                <? endforeach ?>
            </select>
        <? endif; ?>
        &nbsp;<input type="submit" value="<?= GetMessage("SEARCH_GO") ?>" />
        <input type="hidden" name="how" value="<? echo $arResult["REQUEST"]["HOW"] == "d" ? "d" : "r" ?>" />
    </form>
    <br />

    <? if (isset($arResult["REQUEST"]["ORIGINAL_QUERY"])): ?>
        <div class="search-language-guess">
            <?= GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#" => '<a href="' . $arResult["ORIGINAL_QUERY_URL"] . '">' . $arResult["REQUEST"]["ORIGINAL_QUERY"] . '</a>')) ?>
        </div>
    <? endif; ?>

    <? if ($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false): ?>

    <? elseif ($arResult["ERROR_CODE"] != 0): ?>
        <p>
            <?= GetMessage("SEARCH_ERROR") ?>
        </p>
        <? ShowError($arResult["ERROR_TEXT"]); ?>
        <p>
            <?= GetMessage("SEARCH_CORRECT_AND_CONTINUE") ?>
        </p>
        <br /><br />
        <p>
            <?= GetMessage("SEARCH_SINTAX") ?><br />
            <b>
                <?= GetMessage("SEARCH_LOGIC") ?>
            </b>
        </p>

        <table border="0" cellpadding="5">
            <tr>
                <td align="center" valign="top">
                    <?= GetMessage("SEARCH_OPERATOR") ?>
                </td>
                <td valign="top">
                    <?= GetMessage("SEARCH_SYNONIM") ?>
                </td>
                <td>
                    <?= GetMessage("SEARCH_DESCRIPTION") ?>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top">
                    <?= GetMessage("SEARCH_AND") ?>
                </td>
                <td valign="top">and, &amp;, +</td>
                <td>
                    <?= GetMessage("SEARCH_AND_ALT") ?>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top">
                    <?= GetMessage("SEARCH_OR") ?>
                </td>
                <td valign="top">or, |</td>
                <td>
                    <?= GetMessage("SEARCH_OR_ALT") ?>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top">
                    <?= GetMessage("SEARCH_NOT") ?>
                </td>
                <td valign="top">not, ~</td>
                <td>
                    <?= GetMessage("SEARCH_NOT_ALT") ?>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top">( )</td>
                <td valign="top">&nbsp;</td>
                <td>
                    <?= GetMessage("SEARCH_BRACKETS_ALT") ?>
                </td>
            </tr>
        </table>
    <? elseif (count($arResult["SEARCH"]) > 0): ?>
        <? if ($arParams["DISPLAY_TOP_PAGER"] != "N") {
            if ($_GET['iblock_code']) {
                echo $arResult["NAV_STRING"];
            }
        } ?>

        <? foreach ($arResult['ALL_DATA_BY_IBLOCK_ELEMENT'] as $keyElementType => $valueElementType): ?>

            <? if (empty($_GET['iblock_code']) && empty($_GET['main_code'])): ?>
                <h2 class="ml-section-title like_search_page_h2_title">
                    <?= $valueElementType['NAME'] ?>
                </h2>
            <? endif;

            if (empty($_GET['main_code'])) {
                $GLOBALS['arSearch' . $valueElementType['CODE_IBLOCK'] . 'Filter'] = [
                    'ID' => $valueElementType['IDS_ELEMENT'],
                ];

                $APPLICATION->IncludeComponent(
                    "bitrix:news.list", $valueElementType['CODE_IBLOCK'] . "-search",
                    [
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
                        "CACHE_TYPE" => "N",
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array("", ""),
                        "FILTER_NAME" => 'arSearch' . $valueElementType['CODE_IBLOCK'] . 'Filter',
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => Indexis::getIblockId($valueElementType['CODE_IBLOCK']),
                        "IBLOCK_TYPE" => $valueElementType['CODE_IBLOCK'],
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "99",
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
                        "PROPERTY_CODE" => array("PROPERTY_MOVIE_ID", "PROPERTY_VOZRAST", "PROPERTY_PART_OF_THE_DAY", "PROPERTY_TIME_OF_THE_DAY"),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "PROPERTY_DATE_START",
                        "SORT_BY2" => "NAME",
                        "SORT_ORDER1" => "ASC",
                        "SORT_ORDER2" => "ASC",
                        "STRICT_SECTION_CHECK" => "N"
                    ]
                );
            }
        endforeach; ?>

        <? if ($arParams["DISPLAY_BOTTOM_PAGER"] != "N") {
            if ($_GET['iblock_code']) {
                echo $arResult["NAV_STRING"];
            }
        } ?>

        <? if (!empty($_GET['main_code']) && empty($_GET['iblock_code'])): ?>
            <? if ($arResult['ALL_DATA_BY_MAIN']): ?>
                <? if ($arResult['ALL_DATA_BY_MAIN'][$_GET['main_code']]): ?>
                    <section class="ml-section ml-search-section">
                        <div class="ml-section-header">
                            <h2 class="ml-section-subtitle">
                                <?= GetMessage("SEARCH_MAIN_" . $_GET['main_code']) ?>
                            </h2>
                        </div>

                        <div class="ml-section-body">
                            <div class="row">
                                <? foreach ($arResult['ALL_DATA_BY_MAIN'][$_GET['main_code']] as $value): ?>
                                    <div class="col-lg-10 col-xl-9">
                                        <div class="text-item">
                                            <a class="text-item__link" href="<?= $value['URL']; ?>" target="_blank">
                                                <p class="text-item__title">
                                                    <?= $value['NAME']; ?>
                                                </p>
                                                <p class="text-item__desc">
                                                    <?= $value['BODY_FORMATED']; ?>
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </section>
                <? else: ?>
                    <? /* ?>
                     <section class="ml-section ml-search-section">
                     <div class="ml-section-body">
                     <div class="row">
                     <div class="col-lg-10 col-xl-9">
                     <div class="text-item">
                     <? ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND")); ?>
                     </div>
                     </div>
                     </div>
                     </div>
                     </section>
                     <? */?>
                <? endif; ?>
            <? else: ?>
                <?
                //ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND")); 
                ?>
            <? endif; ?>
        <? else: ?>
            <? if (empty($_GET['iblock_code'])): ?>
                <? if ($arResult['ALL_DATA_BY_MAIN']): ?>
                    <? foreach ($arResult['ALL_DATA_BY_MAIN'] as $keyElementType => $valueElementType): ?>
                        <section class="ml-section ml-search-section">
                            <div class="ml-section-header">
                                <h2 class="ml-section-title like_search_page_h2_title">
                                    <?= GetMessage("SEARCH_MAIN_" . $keyElementType) ?>
                                </h2>
                            </div>
                            <div class="ml-section-body">
                                <div class="row">
                                    <? foreach ($valueElementType as $value): ?>
                                        <div class="col-lg-10 col-xl-9">
                                            <div class="text-item">
                                                <a class="text-item__link" href="<?= $value['URL']; ?>" target="_blank">
                                                    <p class="text-item__title">
                                                        <?= $value['NAME']; ?>
                                                    </p>
                                                    <p class="text-item__desc">
                                                        <?= $value['BODY_FORMATED']; ?>
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    <? endforeach; ?>
                                </div>
                            </div>
                        </section>
                    <? endforeach; ?>
                <? endif; ?>
            <? endif; ?>
        <? endif; ?>

    <? else: ?>
        <?
        //ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND")); 
        ?>
    <? endif; ?>
</div>