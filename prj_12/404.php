<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
?>
<section class="nb-section nb-standards-section" data-entity="page404">
    <div class="container">
        <div class="nb-section__header">
            <h1 class="nb-section__title">Страница не найдена</h1>
            <div class="nb-section__desc">
                <p>Запрашиваемая вами страница или документ отсутствуют. Проверьте правильность адреса страницы или можете перейти на
                    <a href="<?=SITE_DIR?>">главную страницу</a></p>
            </div>
        </div>
    </div>
</section>
<?php


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>