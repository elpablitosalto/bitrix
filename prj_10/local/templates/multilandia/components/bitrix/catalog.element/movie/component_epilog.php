<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

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
?>
<?
/*
if(!empty($_COOKIE['favorites_'.$arResult['ID']])): ?>
<script>
$(function() {
//$('.heart-check').prop('checked', true);
$('.js--add_favorite_catalog_item_cookie_button').addClass('ml-btn-favorite_active');
});
</script>
<?endif; 
*/
?>