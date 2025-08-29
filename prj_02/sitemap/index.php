<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
?>

    <div class="page-content">

        <div class="page-head">
            <div class="container">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "",
                    array(),
                    false
                ); ?>
                <h1 class="page-title"><? $APPLICATION->ShowTitle(false) ?></h1>
            </div>
        </div>

        <section class="news-main">
            <div class="container">
                <? $APPLICATION->IncludeComponent("bitrix:main.map", "", array(
                        "LEVEL" => "3",
                        "COL_NUM" => "1",
                        "SHOW_DESCRIPTION" => "Y",
                        "SET_TITLE" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600"
                    )
                ); ?>
            </div>
        </section>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>