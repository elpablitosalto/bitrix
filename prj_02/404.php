<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");

?>

    <div class="page-content page-404">
        <div class="page-404__pattern animate-svg-image achieved">
            <svg version="1.1" id="page-404" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1321.6 599.5"
                 style="enable-background:new 0 0 1321.6 599.5;" xml:space="preserve" width="1321.6" height="599.5">
                <path class="page-404__ground" d="M1319.1,336c-145.2-66.6-357.1-95.6-587.7-69.7C483.9,294.2,128.3,455.4,3.9,563 M1234.3,303.8
	C927.9,208,484.3,487.4,359.9,595"></path>
                <path class="page-404__trees"
                      d="M522,475.7l-4.3-27.8 M517.7,447.9c-46.3-28-41.4-64.3-9.8-102.7C541.8,377.3,556.9,409.6,517.7,447.9z"></path>
                <path class="page-404__home" d="M1030.4,7.8v-6h-6h-48.1h-6v6v35.5L921.7,3.2L917.9,0l-3.8,3.2L757.4,132.7l7.6,9.2l27.9-23.1v141.9h12V110.6
	h-2l114.9-95l54.6,45.1l48.1,39.7l12.3,10.1c-2.5,0-2.5,0-2.5,0v0v0v0.1v0.2v0.8v3.2v11.9v39.4v92.1h12v-92.1v-39.4v-8.4l28.4,23.5
	l7.7-9.2l-48-39.7V7.8z M1018.4,83.1l-36.1-29.8V13.8h36.1V83.1z M963.2,140.6v-6h-6h-79.1h-6v6V256h12V146.6h67.1V256h12V140.6z
	 M602.4,148.5l-4.6-3.4l-3.6,4.4c-16.1,19.6-26.3,39.7-25.6,59.3c0.7,19.3,11.9,36.4,34.4,50.7l2.1,24.8l12-1l-2.2-25
	c19.1-19.6,25.8-39.9,22.4-59.3C634,179.2,620.4,161.9,602.4,148.5z M625.5,201c2.5,14.3-1.9,30.4-17.7,47.3
	c-19.1-12.6-26.7-26.2-27.2-40c-0.5-13.9,6.2-29.6,19.2-46.6C613.9,173.3,623.1,186.9,625.5,201z"></path>
</svg>

        </div>
        <section class="page-404__main">
            <div class="container">
                <div class="page-head">
                    <ul itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">
                        <!--li.backa(href="") Назад
                        -->
                        <li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem"><a
                                    itemscope="itemscope" itemtype="http://schema.org/Thing" itemprop="item"
                                    href="/"><span itemprop="name">Главная</span>
                                <meta itemprop="position" content="1">
                            </a></li>
                        <li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem"><a
                                    itemscope="itemscope" itemtype="http://schema.org/Thing" itemprop="item"
                                    href="/about/"><span itemprop="name">О фонде</span>
                                <meta itemprop="position" content="2">
                            </a></li>
                        <li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem"><a
                                    itemscope="itemscope" itemtype="http://schema.org/Thing" itemprop="item"><span itemprop="name">Страница ошибки</span>
                                <meta itemprop="position" content="3">
                            </a></li>
                    </ul>
                    <h1 class="page-title">Такой страницы нет<br>или больше не&nbsp;существует</h1>
                </div>
                <div class="text-size-lg section__desc">Попробуйте перезагрузить или воспользуйтесь меню сайта для
                    поиска нужной страницы
                </div>
                <div class="section__nav">
                    <div class="buttons-line"><a href="/" class="btn btn-transparent page-404__main-btn">На
                            главную
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 class="icon icon-arrow">
                                <use xlink:href="#arrow"></use>
                            </svg>
                        </a></div>
                </div>
            </div>
        </section>
    </div>
    <style type="text/css">
        .page-404__ground {
            fill: none;
            stroke: #FF5400;
            stroke-width: 12;
        }

        .page-404__trees {
            fill: none;
            stroke: #FF5400;
            stroke-width: 12;
        }

        .page-404__home {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #FF5400;
        }
    </style>

<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>