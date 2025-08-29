<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

/*
// Получим ID избранных мультфильмов текущего пользователя -->
$ar_params = array(
    //"action" => $_POST["action"],
    //"movie_id" => $_POST["movie_id"],
    "iblock_code" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["MOVIES_FAVORITES"],
    "user_id" => $USER->GetID(),
);
$ar_result = Multilandia::GetUserFavoritesMovies($ar_params);
// <-- 

if (in_array($arResult['ID'], $ar_result["arMoviesIds"])) {
    //$bAddClass = true;
    ?>
    <script>
        $(function () {
            $('.js--add_favorite_catalog_item_cookie_button').addClass('ml-btn-favorite_active');
        });
    </script>
<?
}
*/
?>

<?php /* Баннеру внизу */ ?>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    [
        "AREA_FILE_SHOW" => "file",
        "CODE_BANNERS" => "enotki",
        "ADDITIONAL_CLASS" => "ml-home-banner-2",
        "PATH" => SITE_DIR . "include/main_page/bottom_banners.php"
    ]
); ?>

<?/*?>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include", "", [
        "AREA_FILE_SHOW" => "file",
        "CODE_BANNERS" => "soyuzmultpark",
        "ADDITIONAL_CLASS" => "ml-home-banner-3",
        "PATH" => SITE_DIR."include/main_page/bottom_banners.php"
    ]
); ?>
<?*/ ?>
<?php /* End Баннеру внизу */ ?>

<?
if ($arResult['SHOW_CLOSE_NEWS'] == 'N') {
    $APPLICATION->SetTitle("Новости");
} else {
    $APPLICATION->SetTitle($arResult['NAME']);
    $APPLICATION->AddChainItem($arResult['NAME'], '');
}
?>