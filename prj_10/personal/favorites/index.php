<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
$_SESSION['SESS_CLEAR_CACHE'] = 'Y';

global $USER;

if (!$USER->IsAuthorized()) {
    LocalRedirect('/');
}
?>
<div class="ml-page-menu">
    <? $APPLICATION->IncludeComponent("bitrix:menu", "personal", [
        "ROOT_MENU_TYPE" => "personal",
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "top",
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "Y",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "86400",
        "MENU_CACHE_USE_GROUPS" => "N",
        "MENU_CACHE_GET_VARS" => ""
    ]); ?>
</div>


<?
// Получим ID избранных мультфильмов текущего пользователя -->
$ar_params = array(
    "iblock_code" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["MOVIES_FAVORITES"],
    "user_id" => $USER->GetID(),
);
$ar_result = Multilandia::GetUserFavoritesMovies($ar_params);
$arIdsCatalogFavorites = $ar_result["arMoviesIds"];
/*
foreach ($_COOKIE as $keyCookie => $valueCookie) {
$valueCookie = preg_replace('/\D/', '', $valueCookie);
if (stristr($keyCookie, 'favorites_')) {
$arIdsCatalogFavorites[$valueCookie] = preg_replace('/\D/', '', $valueCookie);
}
}
*/
// <-- Получим ID избранных мультфильмов текущего пользователя

$GLOBALS['arFavoritesFilter'] = ['ID' => $arIdsCatalogFavorites];

if (!empty($arIdsCatalogFavorites)):
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "favorites-cartoons",
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
            "FILTER_NAME" => "arFavoritesFilter",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => Indexis::getIblockId('movies'),
            "IBLOCK_TYPE" => "guide",
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
            "PROPERTY_CODE" => array("MOVIE_ID"),
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
else:
    echo '<h3>Избранные мульфильмы отсутствуют</h3>';
endif;
?>

<br>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>