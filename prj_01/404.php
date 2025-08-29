<?
define('PAGE_TYPE', 4);
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Такой страницы нет или больше не существует");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-error');
?>
<section class="error">
    <p class="error__title">Такой страницы нет или&nbsp;больше не&nbsp;существует</p>
    <p class="error__text">Попробуйте перезагрузить или воспользуйтесь меню сайта для поиска нужной страницы</p>
    <a class="link-button_rose link-button_s" href="/">На главную
        <div class="link-button_arrow">
            <svg width="10" height="20">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#arrow"></use>
            </svg>
        </div>
    </a>
</section>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>