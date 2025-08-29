<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');

use \Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.js");
?>

<?php /* Список баннеров для главной */ ?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR."include/main_page/home_top.php",
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?php /* End Список баннеров для главной */ ?>

<?php /* Сегодня в эфире */ ?>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include", "", [
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR."include/main_page/live_today.php"
    ]
); ?>
<?php /* End Сегодня в эфире */  ?>

<?php /* Все анонсы */ ?>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include", "", [
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR."include/main_page/all_announcement.php"
    ]
); ?>
<?php /* End Все анонсы */  ?>

<?php /* Одобрено родителями */ ?>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include", "", [
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR."include/main_page/approved_by_parents.php"
    ]
); ?>
<?php /* End Одобрено родителями */  ?>

<?php /* Middle Banner */ ?>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include", "", [
        "AREA_FILE_SHOW" => "file",
        "CODE_BANNERS" => "krutiksy",
        "ADDITIONAL_CLASS" => "ml-home-banner-1",
        "PATH" => SITE_DIR."include/main_page/bottom_banners.php"
    ]
); ?>
<? /*$APPLICATION->IncludeComponent(
    "bitrix:main.include", "", [
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR."include/main_page/banner-krutiksy.php"
    ]
); */?>
<?php /* End Middle Banner */ ?>

<?php /* Все конкурсы */ ?>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include", "", [
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR."include/main_page/contests_children.php"
    ]
); ?>
<?php /* End Все конкурсы */ ?>

<?php /* Баннеру внизу */ ?>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include", "", [
        "AREA_FILE_SHOW" => "file",
        "CODE_BANNERS" => "enotki",
        "ADDITIONAL_CLASS" => "ml-home-banner-2",
        "PATH" => SITE_DIR."include/main_page/bottom_banners.php"
    ]
); ?>

<? $APPLICATION->IncludeComponent(
    "bitrix:main.include", "", [
        "AREA_FILE_SHOW" => "file",
        "CODE_BANNERS" => "soyuzmultpark",
        "ADDITIONAL_CLASS" => "ml-home-banner-3",
        "PATH" => SITE_DIR."include/main_page/bottom_banners.php"
    ]
); ?>
<?php /* End Баннеру внизу */ ?>






<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>