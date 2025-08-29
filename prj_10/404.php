<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

define("IS_ERROR_404", 'Y');
define("CUSTOM_LAYOUT_PAGE", 'Y');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

//$APPLICATION->SetTitle("404 Not Found");
$APPLICATION->SetTitle("Ошибка 404");

$APPLICATION->AddChainItem( "404", "" );
?>
    <div class="section-404">
        <div class="container">
            <div class="section-404__inner">
                <div class="section-404__img"></div>
                <p class="section-404__title">Упс... <br>Что-то пошло не так!
                </p>
                <p class="section-404__desc">Страница, которую вы ищите не существует</p><a class="ml-btn ml-btn_round section-404__btn" href="/">Главная страница</a>
            </div>
        </div>
    </div>

            
    <?/*?>
    <div class="ml-page">
        <div class="ml-page-header">
            <div class="container">
                <h1 class="ml-page-title">Ошибка 404</h1>
            </div>
        </div>
        <div class="ml-page-body">
            
            <div class="section-404">
                <div class="container">
                    <div class="section-404__inner">
                        <div class="section-404__img"></div>
                        <p class="section-404__title">Упс... <br>Что-то пошло не так!
                        </p>
                        <p class="section-404__desc">Страница, которую вы ищите не существует</p><a class="ml-btn ml-btn_round section-404__btn" href="/">Главная страница</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?*/?>


<?
/*
$APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
	"LEVEL"	=>	"3",
	"COL_NUM"	=>	"2",
	"SHOW_DESCRIPTION"	=>	"Y",
	"SET_TITLE"	=>	"Y",
	"CACHE_TIME"	=>	"36000000"
	)
);
*/
?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>