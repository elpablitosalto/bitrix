<?
define('PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("База знаний");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'support');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-base');
$APPLICATION->SetPageProperty("PAGE_H1", 'База знаний');
?>

<ul class="support__list">
    <li class="support__item">
        <a class="support__link base__link js_check_auth_partner" href="/knowledge/video/">
            <h3>Видео-лекции</h3><img src="<?=SITE_TEMPLATE_PATH?>/img/design/base.png" alt="">
        </a>
    </li>
    <li class="support__item">
        <a class="support__link base__link js_check_auth_partner" href="/knowledge/articles/">
            <h3>Статьи</h3><img src="<?=SITE_TEMPLATE_PATH?>/img/design/base.png" alt="">
        </a>
    </li>
    <li class="support__item">
        <a class="support__link base__link js_check_auth_partner" href="/knowledge/clinical/">
            <h3>Клинические рекомендации</h3><img src="<?=SITE_TEMPLATE_PATH?>/img/design/base.png" alt="">
        </a>
    </li>
    <li class="support__item">
        <a class="support__link base__link js_check_auth_partner" href="/knowledge/technical/">
            <h3>Технические рекомендации</h3><img src="<?=SITE_TEMPLATE_PATH?>/img/design/base.png" alt="">
        </a>
    </li>
</ul>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>