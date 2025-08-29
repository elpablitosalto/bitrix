<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");

?>

    <div class="dp-section dp-404-section">
        <div class="container">
            <div class="dp-404">
                <div class="dp-404__img"><img src="<?=SITE_TEMPLATE_PATH?>/img/design/404.png" alt=""><span>Ошибка 404</span></div>
                <div class="dp-404__caption">
                    <h1 class="dp-section__title">Страница не&nbsp;найдена</h1>
                    <div class="dp-section__desc">
                        <p>Неправильно набран адрес страницы, или такой страницы больше не существует на нашем сайте.</p>
                    </div>
                    <div class="dp-section__actions"><a class="dp-btn dp-btn_orange" href="/">Главная страница</a><a class="dp-btn dp-btn_orange" href="/recommendations/">Рекомендации</a></div>
                </div>
            </div>
        </div>
    </div>

<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>