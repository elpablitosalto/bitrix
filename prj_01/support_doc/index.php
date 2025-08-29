<?
define('PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Поддержка и документация");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'support');
$APPLICATION->SetPageProperty("PAGE_H1", 'Поддержка и документация');
?>

<ul class="support__list">
    <li class="support__item">
        <a class="support__link" href="/support_doc/equipment/">
            <h3>Документация и обучение по оборудованию</h3>
            <p>Инструкции, техническая документация и видеоуроки по анализаторам Dirui</p>
        </a>
    </li>
    <li class="support__item">
        <a class="support__link" href="#">
            <h3>Адаптации реагентов</h3>
            <p>У вас будет прямой доступ к инженеру, вас не оставят в трудной ситуации</p>
        </a>
    </li>
    <li class="support__item">
        <a class="support__link" href="/support_doc/service/">
            <h3>Сервис</h3>
            <p>Инструкции, техническая документация и видеоуроки по анализаторам Dirui</p>
        </a>
    </li>
    <li class="support__item">
        <a class="support__link" href="/contacts/#callback">
            <h3>Задать вопрос</h3>
            <p>Мы будем рады помочь вам: дать недостающую информацию или проконсультировать</p>
        </a>
    </li>
</ul>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>