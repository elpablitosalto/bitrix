<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Согласие на обработку cookies");
?>
<?/*?><section class="employees"><?*/?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/terms_cookies.php"
                    )
                ); ?>

            </div>
        </div>
    </div>
</section>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>