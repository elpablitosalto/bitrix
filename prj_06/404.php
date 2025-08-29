<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");

//$APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
//	"LEVEL"	=>	"3",
//	"COL_NUM"	=>	"2",
//	"SHOW_DESCRIPTION"	=>	"Y",
//	"SET_TITLE"	=>	"Y",
//	"CACHE_TIME"	=>	"3600"
//	)
//);
?>
<div id="FirstContent">
    <div class="content centerMargin">
        <h1>Страница не найдена</h1>
        <p>Неправильно набран адрес или такой страницы на сайте больше не существует.<br>
            Вернитесь на <a href="<?=SITE_DIR?>">главную</a> или воспользуйтесь поиском.</p>
    </div>
</div>
<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>